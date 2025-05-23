<?php
/**
 * DataPrivacyApi
 * PHP version 7.4
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Klaviyo API
 *
 * The Klaviyo REST API. Please visit https://developers.klaviyo.com for more details.
 *
 * Contact: developers@klaviyo.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.1.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace KlaviyoAPI\API;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use KlaviyoAPI\ApiException;
use KlaviyoAPI\Configuration;
use KlaviyoAPI\HeaderSelector;
use KlaviyoAPI\ObjectSerializer;

/**
 * DataPrivacyApi Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DataPrivacyApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation requestProfileDeletion
     *
     * Request Profile Deletion
     *
     * @param  \KlaviyoAPI\Model\DataPrivacyCreateDeletionJobQuery $data_privacy_create_deletion_job_query data_privacy_create_deletion_job_query (required)
     *
     * @throws \KlaviyoAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function requestProfileDeletion($data_privacy_create_deletion_job_query, $apiKey = null)
    {
        $this->requestProfileDeletionWithHttpInfo($data_privacy_create_deletion_job_query, $apiKey);
    }

    /**
     * Alias of `requestProfileDeletion`
     *
     * @deprecated use `requestProfileDeletion` instead
     */
    public function createDataPrivacyDeletionJob(...$args) {
        return $this->requestProfileDeletion(...$args);
    }

    /**
     * Operation requestProfileDeletionWithHttpInfo
     *
     * Request Profile Deletion
     *
     * @param  \KlaviyoAPI\Model\DataPrivacyCreateDeletionJobQuery $data_privacy_create_deletion_job_query (required)
     *
     * @throws \KlaviyoAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function requestProfileDeletionWithHttpInfo($data_privacy_create_deletion_job_query, $apiKey = null)
    {
        $request = $this->requestProfileDeletionRequest($data_privacy_create_deletion_job_query, $apiKey);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlaviyoAPI\Model\GetAccounts400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\KlaviyoAPI\Model\GetAccounts400Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Alias of `requestProfileDeletionWithHttpInfo`
     *
     * @deprecated use `requestProfileDeletionWithHttpInfo` instead
     */
    public function createDataPrivacyDeletionJobWithHttpInfo(...$args) {
        return $this->requestProfileDeletionWithHttpInfo(...$args);
    }

    /**
     * Operation requestProfileDeletionAsync
     *
     * Request Profile Deletion
     *
     * @param  \KlaviyoAPI\Model\DataPrivacyCreateDeletionJobQuery $data_privacy_create_deletion_job_query (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function requestProfileDeletionAsync($data_privacy_create_deletion_job_query, $apiKey = null)
    {
        return $this->requestProfileDeletionAsyncWithHttpInfo($data_privacy_create_deletion_job_query, $apiKey)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Alias of `requestProfileDeletionAsync`
     *
     * @deprecated use `requestProfileDeletionAsync` instead
     */
    public function createDataPrivacyDeletionJobAsync(...$args) {
        return $this->requestProfileDeletionAsync(...$args);
    }

    /**
     * Operation requestProfileDeletionAsyncWithHttpInfo
     *
     * Request Profile Deletion
     *
     * @param  \KlaviyoAPI\Model\DataPrivacyCreateDeletionJobQuery $data_privacy_create_deletion_job_query (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function requestProfileDeletionAsyncWithHttpInfo($data_privacy_create_deletion_job_query, $apiKey = null)
    {
        $returnType = '';
        $request = $this->requestProfileDeletionRequest($data_privacy_create_deletion_job_query, $apiKey);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Alias of `requestProfileDeletionAsyncWithHttpInfo`
     *
     * @deprecated use `requestProfileDeletionAsyncWithHttpInfo` instead
     */
    public function createDataPrivacyDeletionJobAsyncWithHttpInfo(...$args) {
        return $this->requestProfileDeletionAsyncWithHttpInfo(...$args);
    }

    /**
     * Create request for operation 'requestProfileDeletion'
     *
     * @param  \KlaviyoAPI\Model\DataPrivacyCreateDeletionJobQuery $data_privacy_create_deletion_job_query (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function requestProfileDeletionRequest($data_privacy_create_deletion_job_query, $apiKey = null)
    {
        // verify the required parameter 'data_privacy_create_deletion_job_query' is set
        if ($data_privacy_create_deletion_job_query === null || (is_array($data_privacy_create_deletion_job_query) && count($data_privacy_create_deletion_job_query) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $data_privacy_create_deletion_job_query when calling requestProfileDeletion'
            );
        }

        $resourcePath = '/api/data-privacy-deletion-jobs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.api+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.api+json'],
                ['application/vnd.api+json']
            );
        }

        // for model (json/xml)
        if (isset($data_privacy_create_deletion_job_query)) {
            if ($headers['Content-Type'] === 'application/json' || $headers['Content-Type'] === 'application/vnd.api+json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($data_privacy_create_deletion_job_query));
            } else {
                $httpBody = $data_privacy_create_deletion_job_query;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json' || $headers['Content-Type'] === 'application/vnd.api+json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        if ($apiKey == null) {
            $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        } else {
            $apiKey = 'Klaviyo-API-Key '.$apiKey;
        }

        $headers['Authorization'] = $apiKey;


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $defaultHeaders['revision'] = ['2025-04-15'];

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Alias of `requestProfileDeletionRequest`
     *
     * @deprecated use `requestProfileDeletionRequest` instead
     */
    public function createDataPrivacyDeletionJobRequest(...$args) {
        return $this->requestProfileDeletionRequest(...$args);
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
