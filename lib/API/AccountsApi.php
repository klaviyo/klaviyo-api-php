<?php
/**
 * AccountsApi
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
 * The version of the OpenAPI document: 2025-04-15
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
 * AccountsApi Class Doc Comment
 *
 * @category Class
 * @package  KlaviyoAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class AccountsApi
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
     * Operation getAccount
     *
     * Get Account
     *
     * @param  string $id The ID of the account (required)
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \KlaviyoAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array<string,mixed>|\KlaviyoAPI\Model\GetAccounts400Response|\KlaviyoAPI\Model\GetAccounts400Response
     */
    public function getAccount($id, $fields_account = null, $apiKey = null)
    {
        list($response) = $this->getAccountWithHttpInfo($id, $fields_account, $apiKey);
        return $response;
    }

    /**
     * Operation getAccountWithHttpInfo
     *
     * Get Account
     *
     * @param  string $id The ID of the account (required)
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \KlaviyoAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of array<string,mixed>|\KlaviyoAPI\Model\GetAccounts400Response|\KlaviyoAPI\Model\GetAccounts400Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAccountWithHttpInfo($id, $fields_account = null, $apiKey = null)
    {
        $request = $this->getAccountRequest($id, $fields_account, $apiKey);

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

            switch($statusCode) {
                case 200:
                    if ('array<string,mixed>' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('array&lt;string,mixed&gt;' !== 'string') {
                            $content = json_decode($content);
                        }
                    }


                    $parsed_content = json_decode(json_encode($content), TRUE);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        $parsed_content = $content;
                    }

                    return [
                        $parsed_content,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\KlaviyoAPI\Model\GetAccounts400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\KlaviyoAPI\Model\GetAccounts400Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }


                    $parsed_content = json_decode(json_encode($content), TRUE);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        $parsed_content = $content;
                    }

                    return [
                        $parsed_content,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\KlaviyoAPI\Model\GetAccounts400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\KlaviyoAPI\Model\GetAccounts400Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }


                    $parsed_content = json_decode(json_encode($content), TRUE);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        $parsed_content = $content;
                    }

                    return [
                        $parsed_content,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'array<string,mixed>';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            $parsed_content = json_decode(json_encode($content), TRUE);
            if (json_last_error() != JSON_ERROR_NONE) {
                $parsed_content = $content;
            }

            return [
                $parsed_content,
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'array<string,mixed>',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
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
     * Operation getAccountAsync
     *
     * Get Account
     *
     * @param  string $id The ID of the account (required)
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAccountAsync($id, $fields_account = null, $apiKey = null)
    {
        return $this->getAccountAsyncWithHttpInfo($id, $fields_account, $apiKey)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAccountAsyncWithHttpInfo
     *
     * Get Account
     *
     * @param  string $id The ID of the account (required)
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAccountAsyncWithHttpInfo($id, $fields_account = null, $apiKey = null)
    {
        $returnType = 'array<string,mixed>';
        $request = $this->getAccountRequest($id, $fields_account, $apiKey);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    $parsed_content = json_decode(json_encode($content), TRUE);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        $parsed_content = $content;
                    }

                    return [
                        $parsed_content,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
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
     * Create request for operation 'getAccount'
     *
     * @param  string $id The ID of the account (required)
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getAccountRequest($id, $fields_account = null, $apiKey = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getAccount'
            );
        }

        $resourcePath = '/api/accounts/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $fields_account,
            'fields[account]', // param base name
            'array', // openApiType
            'form', // style
            false, // explode
            false // required
        ) ?? []);


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.api+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.api+json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
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
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getAccounts
     *
     * Get Accounts
     *
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \KlaviyoAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array<string,mixed>|\KlaviyoAPI\Model\GetAccounts400Response|\KlaviyoAPI\Model\GetAccounts400Response
     */
    public function getAccounts($fields_account = null, $apiKey = null)
    {
        list($response) = $this->getAccountsWithHttpInfo($fields_account, $apiKey);
        return $response;
    }

    /**
     * Operation getAccountsWithHttpInfo
     *
     * Get Accounts
     *
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \KlaviyoAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of array<string,mixed>|\KlaviyoAPI\Model\GetAccounts400Response|\KlaviyoAPI\Model\GetAccounts400Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAccountsWithHttpInfo($fields_account = null, $apiKey = null)
    {
        $request = $this->getAccountsRequest($fields_account, $apiKey);

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

            switch($statusCode) {
                case 200:
                    if ('array<string,mixed>' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('array&lt;string,mixed&gt;' !== 'string') {
                            $content = json_decode($content);
                        }
                    }


                    $parsed_content = json_decode(json_encode($content), TRUE);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        $parsed_content = $content;
                    }

                    return [
                        $parsed_content,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\KlaviyoAPI\Model\GetAccounts400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\KlaviyoAPI\Model\GetAccounts400Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }


                    $parsed_content = json_decode(json_encode($content), TRUE);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        $parsed_content = $content;
                    }

                    return [
                        $parsed_content,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\KlaviyoAPI\Model\GetAccounts400Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\KlaviyoAPI\Model\GetAccounts400Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }


                    $parsed_content = json_decode(json_encode($content), TRUE);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        $parsed_content = $content;
                    }

                    return [
                        $parsed_content,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'array<string,mixed>';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            $parsed_content = json_decode(json_encode($content), TRUE);
            if (json_last_error() != JSON_ERROR_NONE) {
                $parsed_content = $content;
            }

            return [
                $parsed_content,
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'array<string,mixed>',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
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
     * Operation getAccountsAsync
     *
     * Get Accounts
     *
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAccountsAsync($fields_account = null, $apiKey = null)
    {
        return $this->getAccountsAsyncWithHttpInfo($fields_account, $apiKey)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAccountsAsyncWithHttpInfo
     *
     * Get Accounts
     *
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAccountsAsyncWithHttpInfo($fields_account = null, $apiKey = null)
    {
        $returnType = 'array<string,mixed>';
        $request = $this->getAccountsRequest($fields_account, $apiKey);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    $parsed_content = json_decode(json_encode($content), TRUE);
                    if (json_last_error() != JSON_ERROR_NONE) {
                        $parsed_content = $content;
                    }

                    return [
                        $parsed_content,
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
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
     * Create request for operation 'getAccounts'
     *
     * @param  string[] $fields_account For more information please visit https://developers.klaviyo.com/en/v2025-04-15/reference/api-overview#sparse-fieldsets (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getAccountsRequest($fields_account = null, $apiKey = null)
    {

        $resourcePath = '/api/accounts';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $fields_account,
            'fields[account]', // param base name
            'array', // openApiType
            'form', // style
            false, // explode
            false // required
        ) ?? []);




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/vnd.api+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/vnd.api+json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
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
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
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
