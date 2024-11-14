<?php
namespace KlaviyoAPI;

use KlaviyoAPI\ApiException;

class Subclient {

    public $api_instance;
    public $wait_seconds;
    public $num_retries;
    public $retry_codes;

    // vars for exponential backoff
    public $base_interval = 0.5;
    public $max_interval = 60;
    public $multiplier = 1.5;
    public $rand_factor = 0.5;

    public $_CURSOR_SEARCH_TOKENS;

    public function __construct(
        $api_instance, 
        $wait_seconds = null,
        $num_retries = 3,
        $retry_codes = [429,503,504,524]
    ) {
        $this->api_instance = $api_instance;
        $this->wait_seconds = $wait_seconds;
        $this->num_retries = $num_retries;
        $this->retry_codes = $retry_codes;

        $this->_CURSOR_SEARCH_TOKENS = ['page%5Bcursor%5D','page[cursor]'];
    }

    public function __call($name, $args) {

        # first: if $page_cursor is passed in, check if it needs updating
        $method = new \ReflectionMethod($this-> api_instance, $name);
        $params = $method->getParameters();

        $param_names = [];

        foreach ($params as $_param) {
            $param_names[] = $_param->getName();
        }

        if (in_array('page_cursor', $param_names)) {

            if (isset($args['page_cursor'])) {
                $param_position = 'page_cursor';
            } else {
                $param = new \ReflectionParameter(array($this->api_instance, $name), 'page_cursor');

                $param_position = $param->getPosition();
            }

            if (isset($args[$param_position])) {
                $page_cursor = $this->new_page_cursor($args[$param_position]);

                $args[$param_position] = $page_cursor;
            }
        }

        $make_request = function() use ($name, $args) {
            return $this->api_instance->$name(...$args);
        };

        return $this->with_retry($make_request);
    }

    public function with_retry($func_to_call) {
        $last_request_retry_after = null;
        $last_request_timestamp = null;
        $attempt = 0;
        $iteration = 0;

        while (True) {
            try {
                $retry_after_value_elapsed = $last_request_retry_after === null || microtime(true) - $last_request_timestamp > $last_request_retry_after;
                if ($retry_after_value_elapsed) {
                    $attempt++;
                    return $func_to_call();
                }
            } catch (ApiException $e) {
                if (!in_array($e->getCode(),$this->retry_codes) || $attempt >= $this->num_retries) {
                    throw $e;
                }
                $response_headers = $e->getResponseHeaders();
                $last_request_retry_after = array_key_exists('Retry-After', $response_headers) ? $response_headers['Retry-After'][0] : null;
                $last_request_timestamp = microtime(true);
            }
            $sleep_seconds = $this->wait_seconds === null ? $this->exponential_backoff($iteration) : $this->wait_seconds;
            usleep(ceil($sleep_seconds * 1000000));
            $iteration++;
        }
    }

    private function exponential_backoff($iteration) {
        $wait_time = min($this->base_interval * $this->multiplier**$iteration, $this->max_interval);

        // apply randomness to avoid thundering herd
        $delta = $this->rand_factor * $wait_time;
        $random_0_to_1 = mt_rand() / mt_getrandmax();
        $random_neg_1_to_1 = 2 * $random_0_to_1 - 1;
        return $wait_time + $delta * $random_neg_1_to_1;
    }

    protected function is_url($string) {
        return (is_string($string) && preg_match('/^https?:\/\//',$string));
    }

    protected function new_page_cursor($cursor) {
        if ($this->is_url($cursor)) {
            $cursor = $cursor;
            $found_token = NULL;
            foreach ($this->_CURSOR_SEARCH_TOKENS as $search_token) {
                $strpos = strpos($cursor, $search_token);
                if ($strpos != False) {
                    $found_token = $search_token;
                    break;
                }
            }

            if ($found_token != NULL) {

                $cursor = explode($found_token, $cursor)[1];
                $cursor = explode("&", $cursor)[0];
            }
        }

        $cursor = urldecode($cursor);
        return $cursor;                
    }
}
