<?php
namespace KlaviyoAPI;

class Subclient {

    public function __construct(
        $api_instance, 
        $wait_seconds = 3,
        $num_retries = 3,
        $retry_codes = [429,503,504,524]
    ) {
        $this->api_instance = $api_instance;
        $this->wait_seconds = $wait_seconds;
        $this->num_retries = $num_retries;
        $this->retry_codes = $retry_codes;

        $this->_CURSOR_LENGTH = 44;
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

            $param = new \ReflectionParameter(array($this->api_instance, $name),'page_cursor');
            
            $param_position = $param->getPosition();

            if (count($args) > $param_position) {

                $page_cursor = $args[$param_position];
                if ($page_cursor != NULL) {
                    if ($this->is_url($page_cursor)) {
                        $page_cursor = $this->new_page_cursor($page_cursor);

                        $args[$param_position] = $page_cursor;
                    }
                }


            }
        }

        $attempts = 0;
        
        do {

            try {
                $result = $this->api_instance->$name(...$args);
                return $result;
            } catch (Exception $e) {
                
                if ( ! in_array($e->getCode(),$this->retry_codes)) {
                    throw $e;
                }
                else {
                    echo "\nretrying...\n";
                    $attempts++;
                    sleep($this->wait_seconds);
                    continue;
    
                }
            }
        
            break;
        
        } while($attempts < ($this->num_retries));

        throw $e;
    }


    protected function is_url($link) {
        return (is_string($link) && preg_match('/^https?:\/\//',$link));
    }

    protected function new_page_cursor($link) {
        if (!$this->is_url($link)) {
            return $link;
        } else {
            $found_token = NULL;
            foreach ($this->_CURSOR_SEARCH_TOKENS as $search_token) {
                $strpos = strpos($link, $search_token);
                if ($strpos != False) {
                    $found_token = $search_token;
                    break;
                }
            }

            if ($found_token != NULL) {
                $start = $strpos+strlen($found_token)+1;
                $new_cursor = substr($link, $start, $this->_CURSOR_LENGTH);

                return $new_cursor;
                
            } else {
                return $link;
            }

        }
    }
}
