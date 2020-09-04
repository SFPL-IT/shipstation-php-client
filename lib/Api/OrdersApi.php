<?php
/**
 * OrdersApi
 * PHP version 5
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * ShipStation Developer Portal
 *
 * # Integrating with ShipStation  ShipStation strives to streamline shipping for online sellers, no matter where they sell their products online. We are continuously adding new marketplaces, shopping carts, and integration tools, because we know the e-commerce space is growing.  As a result, we’ve worked hard to provide developer resources to build custom integrations with ShipStation.  If you’re interested in becoming a partner of ours, drop us a line by [filling out this form](http://www.shipstation.com/partners/shipstation-api-custom-store/) and we’ll get in touch.  There are two methods to integrate with ShipStation:  * Custom Store Integration  * ShipStation API  ## Custom Store Integration  Looking for a more 1-to-1 relationship between ShipStation and your chosen selling platform? The Custom Store Integration is the ticket. Our custom store integration is just like any of our other selling channel integration, and could be eligible (based on internal review) as a branded option within the ShipStation admin. It also allows the user to sync orders within ShipStation in a single click, in addition to ShipStation automatically sending shipment status and tracking information  updates back to your cart or marketplace once a label is created. It’s the best way to sync up orders with ShipStation and have the most seamless experience.  The Custom Store allows you to perform two major functions:  * Provide order information to ShipStation, including recipient address, products, customers, etc.  * Receive tracking information when an order is shipped, including shipping method, shipping status, tracking number, and more  To integrate with the Custom Store, you must expose a web page that renders XML that adheres to the specification defined in the Custom Store Integration Guide.  We refer to this page as your “XML Endpoint”. If you can provide us an XML Endpoint, we can *pull* data from your endpoint just like we do with other marketplaces like eBay and Amazon.  **To find out more about our Custom Store Integration, click here: [Custom Store Integration Guide](https://help.shipstation.com/hc/en-us/articles/205928478)**  ## ShipStation API  Our API is available for any plan, and allows for read access to almost all data in your account, and write access to create specific objects, like Orders, Customers, and Products.  The API is a great way to get data directly to and from ShipStation, like creating products, customers, and querying order & shipping data. Please note that an API integration will not allow you to use your own MarketplaceID that could eventually be branded with your company's logo (see the Custom Store Integration above for that functionality).  **This API allows developers to build applications that interface with the ShipStation platform. The API can be used to automate many tasks including:**  + Managing Orders  + Managing Shipments  + Creating Shipping Labels  + Retrieving Shipping Rates  + and more!!!  **To learn more about our API, please review our API documentation below.**  ## Which one should I pick?  The method that's right for your integration very much depends on the type of integration you're planning on implementing. A Custom Store allows ShipStation to *pull* order information from your platform the very same way we *pull* data from marketplaces such as eBay, Amazon, and Shopify. Once an order has been shipped in ShipStation, ShipStation automatically *pushes* tracking information back to your custom store. Though the functionality afforded by this approach is limited to these 2 main functions, much of the *heavy lifting* is performed by ShipStation. Importing orders  and sending tracking information is performed automatically by ShipStation, as long as your XML endpoint is available to receive our data.  An API integration, on the other hand, exposes much more functionality, but requires that the developer do much of the heavy lifting. Orders must be *pushed* to ShipStation by using our \"/orders/CreateOrder\" endpoint.  The API allows developers to perform functions such as tagging an order,  shipping an order, creating a shipping label (without an order), retrieving shipping rates, adding funds to a carrier account, creating a warehouse, listing products, and much more.  The functionality the API affords are typical actions that a user would perform if using the web app.  ### Considerations  * **Will your integration be the main order management tool for the online seller?**  If so, the API's broader range of functionality may be the best option.  * **Would you like your store integration to be a branded marketplace within the ShipStation admin?** When you integrate using the Custom Store Integration, you could be eligible to have your company branded within the ShipStation admin. A branded store could have the plugin's logo in the app, as well as an easier store setup, order sync, and reporting. Please note, ShipStation makes the final decision, based on integration and partner requirements, on which custom stores are branded within our application.  # ShipStation API Requirements  ## End Point  Endpoints are located at the following domain https://ssapi.shipstation.com/ and will need to have a specific reference added to return data. PLEASE NOTE: You cannot access this URL directly and must reference one of the specific endpoints below.  ## Authentication  The ShipStation API uses [Basic HTTP authentication](http://en.wikipedia.org/wiki/Basic_access_authentication). Use your ShipStation ``API Key`` as the username and ``API Secret`` as the password.  You can find your ``API Key`` as the username and ``API Secret`` under Settings at https://ss.shipstation.com/#/settings/api .  The Authorization header is constructed as follows:  + Username (``API KEY``) and password (``API Secret``) are combined into a string \"username:password\"  + The resulting string is then encoded using the RFC2045-MIME variant of Base64, except not limited to 76 char/line  + The authorization method and a space i.e. \"Basic \" is then put before the encoded string.  For example, if the ``API KEY`` given is 'ShipStation' and the ``API Secret`` is 'Rocks' then the header is formed as follows:  + Authorization: Basic U2hpcFN0YXRpb246Um9ja3M=  ## API Rate Limits  In an effort to ensure consistent application performance and increased scalability, we have implemented rate limiting on the ShipStation API.  Your integration will need to be able to handle HTTP rate limiting status messages as defined below:  **Response Headers**  All responses will include headers with status information about rate limiting.  1. X-Rate-Limit-Limit: the maximum number of requests per minute to the endpoint  2. X-Rate-Limit-Remaining: the available requests remaining in the current window  3. X-Rate-Limit-Reset: the number of seconds remaining until the next window begins  **Hitting the Limit**  If your application hits the rate limit, an HTTP 429 will be returned with this body:  ``` {     \"message\": \"Too Many Requests\" } ```  And these headers, assuming it is 40 seconds into the current window:  ``` {     \"X-Rate-Limit-Limit\": 60,     \"X-Rate-Limit-Remaining\": 0,     \"X-Rate-Limit-Reset\": 20 } ```  When the limit is reached, your application should stop making requests until X-Rate-Limit-Reset seconds have elapsed. The current Rate limit for each set of the API Key and Secret is 40 requests per minute.  If you have any issues with the API, please email us at <apisupport@shipstation.com>  ## Server Responses  Status Code | Description ------------|------------- ``200`` | OK - The request was successful (some API calls may return 201 instead). ``201`` | Created - The request was successful and a resource was created. ``204`` | No Content - The request was successful but there is no representation to return (that is, the response is empty). ``400`` | Bad Request -  The request could not be understood or was missing required parameters. ``401`` | Unauthorized -  Authentication failed or user does not have permissions for the requested operation. ``403`` | Forbidden - Access denied. ``404`` | Not Found -  Resource was not found. ``405`` | Method Not Allowed -  Requested method is not supported for the specified resource. ``429`` | Too Many Requests - Exceeded ShipStation API limits. When the limit is reached, your application should stop making requests until X-Rate-Limit-Reset seconds have elapsed. ``500`` | Internal Server Error - ShipStation has encountered an error.  ## DateTime Format and Time Zone  ShipStation uses the ISO 8601 combined format for dateTime stamps being submitted to and returned from the API. Please be sure to submit all dateTime values as follows:  yyyy-mm-dd hh:mm:ss (24 hour notation). Example - ``2016-11-29 23:59:59``  The time zone represented in all API responses is PST/PDT. Similarly, ShipStation asks that you make all time zone convertions and submit any dateTime requests in PST/PDT.
 *
 * OpenAPI spec version: 1.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.15
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace ShipStation\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use ShipStation\ApiException;
use ShipStation\Configuration;
use ShipStation\HeaderSelector;
use ShipStation\ObjectSerializer;

/**
 * OrdersApi Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class OrdersApi
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
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation ordersAddtagPost
     *
     * Add Tag to Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AddTagtoOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\AddTagtoOrderresponse
     */
    public function ordersAddtagPost($contentType, $body)
    {
        list($response) = $this->ordersAddtagPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersAddtagPostWithHttpInfo
     *
     * Add Tag to Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AddTagtoOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\AddTagtoOrderresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersAddtagPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\AddTagtoOrderresponse';
        $request = $this->ordersAddtagPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\AddTagtoOrderresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersAddtagPostAsync
     *
     * Add Tag to Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AddTagtoOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersAddtagPostAsync($contentType, $body)
    {
        return $this->ordersAddtagPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersAddtagPostAsyncWithHttpInfo
     *
     * Add Tag to Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AddTagtoOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersAddtagPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\AddTagtoOrderresponse';
        $request = $this->ordersAddtagPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersAddtagPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AddTagtoOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersAddtagPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersAddtagPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersAddtagPost'
            );
        }

        $resourcePath = '/orders/addtag';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersAssignuserPost
     *
     * Assign User to Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AssignUsertoOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\AssignUsertoOrderresponse
     */
    public function ordersAssignuserPost($contentType, $body)
    {
        list($response) = $this->ordersAssignuserPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersAssignuserPostWithHttpInfo
     *
     * Assign User to Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AssignUsertoOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\AssignUsertoOrderresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersAssignuserPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\AssignUsertoOrderresponse';
        $request = $this->ordersAssignuserPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\AssignUsertoOrderresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersAssignuserPostAsync
     *
     * Assign User to Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AssignUsertoOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersAssignuserPostAsync($contentType, $body)
    {
        return $this->ordersAssignuserPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersAssignuserPostAsyncWithHttpInfo
     *
     * Assign User to Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AssignUsertoOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersAssignuserPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\AssignUsertoOrderresponse';
        $request = $this->ordersAssignuserPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersAssignuserPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\AssignUsertoOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersAssignuserPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersAssignuserPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersAssignuserPost'
            );
        }

        $resourcePath = '/orders/assignuser';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersByOrderIdDelete
     *
     * Delete Order
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\DeleteOrderresponse
     */
    public function ordersByOrderIdDelete($orderId)
    {
        list($response) = $this->ordersByOrderIdDeleteWithHttpInfo($orderId);
        return $response;
    }

    /**
     * Operation ordersByOrderIdDeleteWithHttpInfo
     *
     * Delete Order
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\DeleteOrderresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersByOrderIdDeleteWithHttpInfo($orderId)
    {
        $returnType = '\ShipStation\Model\DeleteOrderresponse';
        $request = $this->ordersByOrderIdDeleteRequest($orderId);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\DeleteOrderresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersByOrderIdDeleteAsync
     *
     * Delete Order
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersByOrderIdDeleteAsync($orderId)
    {
        return $this->ordersByOrderIdDeleteAsyncWithHttpInfo($orderId)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersByOrderIdDeleteAsyncWithHttpInfo
     *
     * Delete Order
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersByOrderIdDeleteAsyncWithHttpInfo($orderId)
    {
        $returnType = '\ShipStation\Model\DeleteOrderresponse';
        $request = $this->ordersByOrderIdDeleteRequest($orderId);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersByOrderIdDelete'
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersByOrderIdDeleteRequest($orderId)
    {
        // verify the required parameter 'orderId' is set
        if ($orderId === null || (is_array($orderId) && count($orderId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $orderId when calling ordersByOrderIdDelete'
            );
        }

        $resourcePath = '/orders/{orderId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($orderId !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($orderId),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersByOrderIdGet
     *
     * Get Order
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\GetOrderresponse
     */
    public function ordersByOrderIdGet($orderId)
    {
        list($response) = $this->ordersByOrderIdGetWithHttpInfo($orderId);
        return $response;
    }

    /**
     * Operation ordersByOrderIdGetWithHttpInfo
     *
     * Get Order
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\GetOrderresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersByOrderIdGetWithHttpInfo($orderId)
    {
        $returnType = '\ShipStation\Model\GetOrderresponse';
        $request = $this->ordersByOrderIdGetRequest($orderId);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\GetOrderresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersByOrderIdGetAsync
     *
     * Get Order
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersByOrderIdGetAsync($orderId)
    {
        return $this->ordersByOrderIdGetAsyncWithHttpInfo($orderId)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersByOrderIdGetAsyncWithHttpInfo
     *
     * Get Order
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersByOrderIdGetAsyncWithHttpInfo($orderId)
    {
        $returnType = '\ShipStation\Model\GetOrderresponse';
        $request = $this->ordersByOrderIdGetRequest($orderId);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersByOrderIdGet'
     *
     * @param  double $orderId The system generated identifier for the order. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersByOrderIdGetRequest($orderId)
    {
        // verify the required parameter 'orderId' is set
        if ($orderId === null || (is_array($orderId) && count($orderId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $orderId when calling ordersByOrderIdGet'
            );
        }

        $resourcePath = '/orders/{orderId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($orderId !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($orderId),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersCreatelabelfororderPost
     *
     * Create Label for Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateLabelforOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\CreateLabelforOrderresponse
     */
    public function ordersCreatelabelfororderPost($contentType, $body)
    {
        list($response) = $this->ordersCreatelabelfororderPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersCreatelabelfororderPostWithHttpInfo
     *
     * Create Label for Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateLabelforOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\CreateLabelforOrderresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersCreatelabelfororderPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\CreateLabelforOrderresponse';
        $request = $this->ordersCreatelabelfororderPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\CreateLabelforOrderresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersCreatelabelfororderPostAsync
     *
     * Create Label for Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateLabelforOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersCreatelabelfororderPostAsync($contentType, $body)
    {
        return $this->ordersCreatelabelfororderPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersCreatelabelfororderPostAsyncWithHttpInfo
     *
     * Create Label for Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateLabelforOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersCreatelabelfororderPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\CreateLabelforOrderresponse';
        $request = $this->ordersCreatelabelfororderPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersCreatelabelfororderPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateLabelforOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersCreatelabelfororderPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersCreatelabelfororderPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersCreatelabelfororderPost'
            );
        }

        $resourcePath = '/orders/createlabelfororder';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersCreateorderPost
     *
     * Create/Update Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\Create1UpdateOrderresponse
     */
    public function ordersCreateorderPost($contentType, $body)
    {
        list($response) = $this->ordersCreateorderPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersCreateorderPostWithHttpInfo
     *
     * Create/Update Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\Create1UpdateOrderresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersCreateorderPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\Create1UpdateOrderresponse';
        $request = $this->ordersCreateorderPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\Create1UpdateOrderresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersCreateorderPostAsync
     *
     * Create/Update Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersCreateorderPostAsync($contentType, $body)
    {
        return $this->ordersCreateorderPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersCreateorderPostAsyncWithHttpInfo
     *
     * Create/Update Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersCreateorderPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\Create1UpdateOrderresponse';
        $request = $this->ordersCreateorderPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersCreateorderPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersCreateorderPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersCreateorderPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersCreateorderPost'
            );
        }

        $resourcePath = '/orders/createorder';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersCreateordersPost
     *
     * Create/Update Multiple Orders
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateMultipleOrdersrequest[] $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\Create1UpdateMultipleOrdersresponse
     */
    public function ordersCreateordersPost($contentType, $body)
    {
        list($response) = $this->ordersCreateordersPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersCreateordersPostWithHttpInfo
     *
     * Create/Update Multiple Orders
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateMultipleOrdersrequest[] $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\Create1UpdateMultipleOrdersresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersCreateordersPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\Create1UpdateMultipleOrdersresponse';
        $request = $this->ordersCreateordersPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\Create1UpdateMultipleOrdersresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersCreateordersPostAsync
     *
     * Create/Update Multiple Orders
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateMultipleOrdersrequest[] $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersCreateordersPostAsync($contentType, $body)
    {
        return $this->ordersCreateordersPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersCreateordersPostAsyncWithHttpInfo
     *
     * Create/Update Multiple Orders
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateMultipleOrdersrequest[] $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersCreateordersPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\Create1UpdateMultipleOrdersresponse';
        $request = $this->ordersCreateordersPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersCreateordersPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\Create1UpdateMultipleOrdersrequest[] $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersCreateordersPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersCreateordersPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersCreateordersPost'
            );
        }

        $resourcePath = '/orders/createorders';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersGet
     *
     * List Orders with parameters
     *
     * @param  string $customerName Returns orders that match the specified name. (optional)
     * @param  string $itemKeyword Returns orders that contain items that match the specified keyword. Fields searched are Sku, Description, and Options (optional)
     * @param  string $createDateStart Returns orders that were created in ShipStation after the specified date (optional)
     * @param  string $createDateEnd Returns orders that were created in ShipStation before the specified date (optional)
     * @param  string $modifyDateStart Returns orders that were modified after the specified date (optional)
     * @param  string $modifyDateEnd Returns orders that were modified before the specified date (optional)
     * @param  string $orderDateStart Returns orders greater than the specified date (optional)
     * @param  string $orderDateEnd Returns orders less than or equal to the specified date (optional)
     * @param  string $orderNumber Filter by order number, performs a \&quot;starts with\&quot; search. (optional)
     * @param  string $orderStatus Filter by order status.  If left empty, orders of all statuses are returned. (optional)
     * @param  string $paymentDateStart Returns orders that were paid after the specified date (optional)
     * @param  string $paymentDateEnd Returns orders that were paid before the specified date (optional)
     * @param  double $storeId Filters orders to a single store. Call List Stores to obtain a list of store Ids. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;orderId&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\ListOrderswithparametersresponse
     */
    public function ordersGet($customerName = null, $itemKeyword = null, $createDateStart = null, $createDateEnd = null, $modifyDateStart = null, $modifyDateEnd = null, $orderDateStart = null, $orderDateEnd = null, $orderNumber = null, $orderStatus = null, $paymentDateStart = null, $paymentDateEnd = null, $storeId = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {
        list($response) = $this->ordersGetWithHttpInfo($customerName, $itemKeyword, $createDateStart, $createDateEnd, $modifyDateStart, $modifyDateEnd, $orderDateStart, $orderDateEnd, $orderNumber, $orderStatus, $paymentDateStart, $paymentDateEnd, $storeId, $sortBy, $sortDir, $page, $pageSize);
        return $response;
    }

    /**
     * Operation ordersGetWithHttpInfo
     *
     * List Orders with parameters
     *
     * @param  string $customerName Returns orders that match the specified name. (optional)
     * @param  string $itemKeyword Returns orders that contain items that match the specified keyword. Fields searched are Sku, Description, and Options (optional)
     * @param  string $createDateStart Returns orders that were created in ShipStation after the specified date (optional)
     * @param  string $createDateEnd Returns orders that were created in ShipStation before the specified date (optional)
     * @param  string $modifyDateStart Returns orders that were modified after the specified date (optional)
     * @param  string $modifyDateEnd Returns orders that were modified before the specified date (optional)
     * @param  string $orderDateStart Returns orders greater than the specified date (optional)
     * @param  string $orderDateEnd Returns orders less than or equal to the specified date (optional)
     * @param  string $orderNumber Filter by order number, performs a \&quot;starts with\&quot; search. (optional)
     * @param  string $orderStatus Filter by order status.  If left empty, orders of all statuses are returned. (optional)
     * @param  string $paymentDateStart Returns orders that were paid after the specified date (optional)
     * @param  string $paymentDateEnd Returns orders that were paid before the specified date (optional)
     * @param  double $storeId Filters orders to a single store. Call List Stores to obtain a list of store Ids. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;orderId&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\ListOrderswithparametersresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersGetWithHttpInfo($customerName = null, $itemKeyword = null, $createDateStart = null, $createDateEnd = null, $modifyDateStart = null, $modifyDateEnd = null, $orderDateStart = null, $orderDateEnd = null, $orderNumber = null, $orderStatus = null, $paymentDateStart = null, $paymentDateEnd = null, $storeId = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {
        $returnType = '\ShipStation\Model\ListOrderswithparametersresponse';
        $request = $this->ordersGetRequest($customerName, $itemKeyword, $createDateStart, $createDateEnd, $modifyDateStart, $modifyDateEnd, $orderDateStart, $orderDateEnd, $orderNumber, $orderStatus, $paymentDateStart, $paymentDateEnd, $storeId, $sortBy, $sortDir, $page, $pageSize);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\ListOrderswithparametersresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersGetAsync
     *
     * List Orders with parameters
     *
     * @param  string $customerName Returns orders that match the specified name. (optional)
     * @param  string $itemKeyword Returns orders that contain items that match the specified keyword. Fields searched are Sku, Description, and Options (optional)
     * @param  string $createDateStart Returns orders that were created in ShipStation after the specified date (optional)
     * @param  string $createDateEnd Returns orders that were created in ShipStation before the specified date (optional)
     * @param  string $modifyDateStart Returns orders that were modified after the specified date (optional)
     * @param  string $modifyDateEnd Returns orders that were modified before the specified date (optional)
     * @param  string $orderDateStart Returns orders greater than the specified date (optional)
     * @param  string $orderDateEnd Returns orders less than or equal to the specified date (optional)
     * @param  string $orderNumber Filter by order number, performs a \&quot;starts with\&quot; search. (optional)
     * @param  string $orderStatus Filter by order status.  If left empty, orders of all statuses are returned. (optional)
     * @param  string $paymentDateStart Returns orders that were paid after the specified date (optional)
     * @param  string $paymentDateEnd Returns orders that were paid before the specified date (optional)
     * @param  double $storeId Filters orders to a single store. Call List Stores to obtain a list of store Ids. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;orderId&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersGetAsync($customerName = null, $itemKeyword = null, $createDateStart = null, $createDateEnd = null, $modifyDateStart = null, $modifyDateEnd = null, $orderDateStart = null, $orderDateEnd = null, $orderNumber = null, $orderStatus = null, $paymentDateStart = null, $paymentDateEnd = null, $storeId = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {
        return $this->ordersGetAsyncWithHttpInfo($customerName, $itemKeyword, $createDateStart, $createDateEnd, $modifyDateStart, $modifyDateEnd, $orderDateStart, $orderDateEnd, $orderNumber, $orderStatus, $paymentDateStart, $paymentDateEnd, $storeId, $sortBy, $sortDir, $page, $pageSize)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersGetAsyncWithHttpInfo
     *
     * List Orders with parameters
     *
     * @param  string $customerName Returns orders that match the specified name. (optional)
     * @param  string $itemKeyword Returns orders that contain items that match the specified keyword. Fields searched are Sku, Description, and Options (optional)
     * @param  string $createDateStart Returns orders that were created in ShipStation after the specified date (optional)
     * @param  string $createDateEnd Returns orders that were created in ShipStation before the specified date (optional)
     * @param  string $modifyDateStart Returns orders that were modified after the specified date (optional)
     * @param  string $modifyDateEnd Returns orders that were modified before the specified date (optional)
     * @param  string $orderDateStart Returns orders greater than the specified date (optional)
     * @param  string $orderDateEnd Returns orders less than or equal to the specified date (optional)
     * @param  string $orderNumber Filter by order number, performs a \&quot;starts with\&quot; search. (optional)
     * @param  string $orderStatus Filter by order status.  If left empty, orders of all statuses are returned. (optional)
     * @param  string $paymentDateStart Returns orders that were paid after the specified date (optional)
     * @param  string $paymentDateEnd Returns orders that were paid before the specified date (optional)
     * @param  double $storeId Filters orders to a single store. Call List Stores to obtain a list of store Ids. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;orderId&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersGetAsyncWithHttpInfo($customerName = null, $itemKeyword = null, $createDateStart = null, $createDateEnd = null, $modifyDateStart = null, $modifyDateEnd = null, $orderDateStart = null, $orderDateEnd = null, $orderNumber = null, $orderStatus = null, $paymentDateStart = null, $paymentDateEnd = null, $storeId = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {
        $returnType = '\ShipStation\Model\ListOrderswithparametersresponse';
        $request = $this->ordersGetRequest($customerName, $itemKeyword, $createDateStart, $createDateEnd, $modifyDateStart, $modifyDateEnd, $orderDateStart, $orderDateEnd, $orderNumber, $orderStatus, $paymentDateStart, $paymentDateEnd, $storeId, $sortBy, $sortDir, $page, $pageSize);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersGet'
     *
     * @param  string $customerName Returns orders that match the specified name. (optional)
     * @param  string $itemKeyword Returns orders that contain items that match the specified keyword. Fields searched are Sku, Description, and Options (optional)
     * @param  string $createDateStart Returns orders that were created in ShipStation after the specified date (optional)
     * @param  string $createDateEnd Returns orders that were created in ShipStation before the specified date (optional)
     * @param  string $modifyDateStart Returns orders that were modified after the specified date (optional)
     * @param  string $modifyDateEnd Returns orders that were modified before the specified date (optional)
     * @param  string $orderDateStart Returns orders greater than the specified date (optional)
     * @param  string $orderDateEnd Returns orders less than or equal to the specified date (optional)
     * @param  string $orderNumber Filter by order number, performs a \&quot;starts with\&quot; search. (optional)
     * @param  string $orderStatus Filter by order status.  If left empty, orders of all statuses are returned. (optional)
     * @param  string $paymentDateStart Returns orders that were paid after the specified date (optional)
     * @param  string $paymentDateEnd Returns orders that were paid before the specified date (optional)
     * @param  double $storeId Filters orders to a single store. Call List Stores to obtain a list of store Ids. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;orderId&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersGetRequest($customerName = null, $itemKeyword = null, $createDateStart = null, $createDateEnd = null, $modifyDateStart = null, $modifyDateEnd = null, $orderDateStart = null, $orderDateEnd = null, $orderNumber = null, $orderStatus = null, $paymentDateStart = null, $paymentDateEnd = null, $storeId = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {

        $resourcePath = '/orders';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($customerName !== null) {
            $queryParams['customerName'] = ObjectSerializer::toQueryValue($customerName);
        }
        // query params
        if ($itemKeyword !== null) {
            $queryParams['itemKeyword'] = ObjectSerializer::toQueryValue($itemKeyword);
        }
        // query params
        if ($createDateStart !== null) {
            $queryParams['createDateStart'] = ObjectSerializer::toQueryValue($createDateStart);
        }
        // query params
        if ($createDateEnd !== null) {
            $queryParams['createDateEnd'] = ObjectSerializer::toQueryValue($createDateEnd);
        }
        // query params
        if ($modifyDateStart !== null) {
            $queryParams['modifyDateStart'] = ObjectSerializer::toQueryValue($modifyDateStart);
        }
        // query params
        if ($modifyDateEnd !== null) {
            $queryParams['modifyDateEnd'] = ObjectSerializer::toQueryValue($modifyDateEnd);
        }
        // query params
        if ($orderDateStart !== null) {
            $queryParams['orderDateStart'] = ObjectSerializer::toQueryValue($orderDateStart);
        }
        // query params
        if ($orderDateEnd !== null) {
            $queryParams['orderDateEnd'] = ObjectSerializer::toQueryValue($orderDateEnd);
        }
        // query params
        if ($orderNumber !== null) {
            $queryParams['orderNumber'] = ObjectSerializer::toQueryValue($orderNumber);
        }
        // query params
        if ($orderStatus !== null) {
            $queryParams['orderStatus'] = ObjectSerializer::toQueryValue($orderStatus);
        }
        // query params
        if ($paymentDateStart !== null) {
            $queryParams['paymentDateStart'] = ObjectSerializer::toQueryValue($paymentDateStart);
        }
        // query params
        if ($paymentDateEnd !== null) {
            $queryParams['paymentDateEnd'] = ObjectSerializer::toQueryValue($paymentDateEnd);
        }
        // query params
        if ($storeId !== null) {
            $queryParams['storeId'] = ObjectSerializer::toQueryValue($storeId);
        }
        // query params
        if ($sortBy !== null) {
            $queryParams['sortBy'] = ObjectSerializer::toQueryValue($sortBy);
        }
        // query params
        if ($sortDir !== null) {
            $queryParams['sortDir'] = ObjectSerializer::toQueryValue($sortDir);
        }
        // query params
        if ($page !== null) {
            $queryParams['page'] = ObjectSerializer::toQueryValue($page);
        }
        // query params
        if ($pageSize !== null) {
            $queryParams['pageSize'] = ObjectSerializer::toQueryValue($pageSize);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersHolduntilPost
     *
     * Hold Order Until
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\HoldOrderUntilrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\HoldOrderUntilresponse
     */
    public function ordersHolduntilPost($contentType, $body)
    {
        list($response) = $this->ordersHolduntilPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersHolduntilPostWithHttpInfo
     *
     * Hold Order Until
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\HoldOrderUntilrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\HoldOrderUntilresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersHolduntilPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\HoldOrderUntilresponse';
        $request = $this->ordersHolduntilPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\HoldOrderUntilresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersHolduntilPostAsync
     *
     * Hold Order Until
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\HoldOrderUntilrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersHolduntilPostAsync($contentType, $body)
    {
        return $this->ordersHolduntilPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersHolduntilPostAsyncWithHttpInfo
     *
     * Hold Order Until
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\HoldOrderUntilrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersHolduntilPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\HoldOrderUntilresponse';
        $request = $this->ordersHolduntilPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersHolduntilPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\HoldOrderUntilrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersHolduntilPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersHolduntilPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersHolduntilPost'
            );
        }

        $resourcePath = '/orders/holduntil';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersListbytagGet
     *
     * List Orders by Tag
     *
     * @param  string $orderStatus The order&#39;s status. (required)
     * @param  double $tagId ID of the tag. Call Accounts/ListTags to obtain a list of tags for this account. (required)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\ListOrdersbyTagresponse
     */
    public function ordersListbytagGet($orderStatus, $tagId, $page = null, $pageSize = null)
    {
        list($response) = $this->ordersListbytagGetWithHttpInfo($orderStatus, $tagId, $page, $pageSize);
        return $response;
    }

    /**
     * Operation ordersListbytagGetWithHttpInfo
     *
     * List Orders by Tag
     *
     * @param  string $orderStatus The order&#39;s status. (required)
     * @param  double $tagId ID of the tag. Call Accounts/ListTags to obtain a list of tags for this account. (required)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\ListOrdersbyTagresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersListbytagGetWithHttpInfo($orderStatus, $tagId, $page = null, $pageSize = null)
    {
        $returnType = '\ShipStation\Model\ListOrdersbyTagresponse';
        $request = $this->ordersListbytagGetRequest($orderStatus, $tagId, $page, $pageSize);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\ListOrdersbyTagresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersListbytagGetAsync
     *
     * List Orders by Tag
     *
     * @param  string $orderStatus The order&#39;s status. (required)
     * @param  double $tagId ID of the tag. Call Accounts/ListTags to obtain a list of tags for this account. (required)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersListbytagGetAsync($orderStatus, $tagId, $page = null, $pageSize = null)
    {
        return $this->ordersListbytagGetAsyncWithHttpInfo($orderStatus, $tagId, $page, $pageSize)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersListbytagGetAsyncWithHttpInfo
     *
     * List Orders by Tag
     *
     * @param  string $orderStatus The order&#39;s status. (required)
     * @param  double $tagId ID of the tag. Call Accounts/ListTags to obtain a list of tags for this account. (required)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersListbytagGetAsyncWithHttpInfo($orderStatus, $tagId, $page = null, $pageSize = null)
    {
        $returnType = '\ShipStation\Model\ListOrdersbyTagresponse';
        $request = $this->ordersListbytagGetRequest($orderStatus, $tagId, $page, $pageSize);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersListbytagGet'
     *
     * @param  string $orderStatus The order&#39;s status. (required)
     * @param  double $tagId ID of the tag. Call Accounts/ListTags to obtain a list of tags for this account. (required)
     * @param  string $page Page number (optional)
     * @param  string $pageSize Requested page size. Max value is 500. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersListbytagGetRequest($orderStatus, $tagId, $page = null, $pageSize = null)
    {
        // verify the required parameter 'orderStatus' is set
        if ($orderStatus === null || (is_array($orderStatus) && count($orderStatus) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $orderStatus when calling ordersListbytagGet'
            );
        }
        // verify the required parameter 'tagId' is set
        if ($tagId === null || (is_array($tagId) && count($tagId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $tagId when calling ordersListbytagGet'
            );
        }

        $resourcePath = '/orders/listbytag';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($orderStatus !== null) {
            $queryParams['orderStatus'] = ObjectSerializer::toQueryValue($orderStatus);
        }
        // query params
        if ($tagId !== null) {
            $queryParams['tagId'] = ObjectSerializer::toQueryValue($tagId);
        }
        // query params
        if ($page !== null) {
            $queryParams['page'] = ObjectSerializer::toQueryValue($page);
        }
        // query params
        if ($pageSize !== null) {
            $queryParams['pageSize'] = ObjectSerializer::toQueryValue($pageSize);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersMarkasshippedPost
     *
     * Mark an Order as Shipped
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\MarkanOrderasShippedrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\MarkanOrderasShippedresponse
     */
    public function ordersMarkasshippedPost($contentType, $body)
    {
        list($response) = $this->ordersMarkasshippedPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersMarkasshippedPostWithHttpInfo
     *
     * Mark an Order as Shipped
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\MarkanOrderasShippedrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\MarkanOrderasShippedresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersMarkasshippedPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\MarkanOrderasShippedresponse';
        $request = $this->ordersMarkasshippedPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\MarkanOrderasShippedresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersMarkasshippedPostAsync
     *
     * Mark an Order as Shipped
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\MarkanOrderasShippedrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersMarkasshippedPostAsync($contentType, $body)
    {
        return $this->ordersMarkasshippedPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersMarkasshippedPostAsyncWithHttpInfo
     *
     * Mark an Order as Shipped
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\MarkanOrderasShippedrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersMarkasshippedPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\MarkanOrderasShippedresponse';
        $request = $this->ordersMarkasshippedPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersMarkasshippedPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\MarkanOrderasShippedrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersMarkasshippedPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersMarkasshippedPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersMarkasshippedPost'
            );
        }

        $resourcePath = '/orders/markasshipped';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersRemovetagPost
     *
     * Remove Tag from Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RemoveTagfromOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\RemoveTagfromOrderresponse
     */
    public function ordersRemovetagPost($contentType, $body)
    {
        list($response) = $this->ordersRemovetagPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersRemovetagPostWithHttpInfo
     *
     * Remove Tag from Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RemoveTagfromOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\RemoveTagfromOrderresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersRemovetagPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\RemoveTagfromOrderresponse';
        $request = $this->ordersRemovetagPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\RemoveTagfromOrderresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersRemovetagPostAsync
     *
     * Remove Tag from Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RemoveTagfromOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersRemovetagPostAsync($contentType, $body)
    {
        return $this->ordersRemovetagPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersRemovetagPostAsyncWithHttpInfo
     *
     * Remove Tag from Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RemoveTagfromOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersRemovetagPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\RemoveTagfromOrderresponse';
        $request = $this->ordersRemovetagPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersRemovetagPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RemoveTagfromOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersRemovetagPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersRemovetagPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersRemovetagPost'
            );
        }

        $resourcePath = '/orders/removetag';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersRestorefromholdPost
     *
     * Restore Order from On Hold
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RestoreOrderfromOnHoldrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\RestoreOrderfromOnHoldresponse
     */
    public function ordersRestorefromholdPost($contentType, $body)
    {
        list($response) = $this->ordersRestorefromholdPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersRestorefromholdPostWithHttpInfo
     *
     * Restore Order from On Hold
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RestoreOrderfromOnHoldrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\RestoreOrderfromOnHoldresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersRestorefromholdPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\RestoreOrderfromOnHoldresponse';
        $request = $this->ordersRestorefromholdPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\RestoreOrderfromOnHoldresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersRestorefromholdPostAsync
     *
     * Restore Order from On Hold
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RestoreOrderfromOnHoldrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersRestorefromholdPostAsync($contentType, $body)
    {
        return $this->ordersRestorefromholdPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersRestorefromholdPostAsyncWithHttpInfo
     *
     * Restore Order from On Hold
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RestoreOrderfromOnHoldrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersRestorefromholdPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\RestoreOrderfromOnHoldresponse';
        $request = $this->ordersRestorefromholdPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersRestorefromholdPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\RestoreOrderfromOnHoldrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersRestorefromholdPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersRestorefromholdPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersRestorefromholdPost'
            );
        }

        $resourcePath = '/orders/restorefromhold';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation ordersUnassignuserPost
     *
     * Unassign User from Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\UnassignUserfromOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\UnassignUserfromOrderresponse
     */
    public function ordersUnassignuserPost($contentType, $body)
    {
        list($response) = $this->ordersUnassignuserPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation ordersUnassignuserPostWithHttpInfo
     *
     * Unassign User from Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\UnassignUserfromOrderrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\UnassignUserfromOrderresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function ordersUnassignuserPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\UnassignUserfromOrderresponse';
        $request = $this->ordersUnassignuserPostRequest($contentType, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\ShipStation\Model\UnassignUserfromOrderresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation ordersUnassignuserPostAsync
     *
     * Unassign User from Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\UnassignUserfromOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersUnassignuserPostAsync($contentType, $body)
    {
        return $this->ordersUnassignuserPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ordersUnassignuserPostAsyncWithHttpInfo
     *
     * Unassign User from Order
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\UnassignUserfromOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ordersUnassignuserPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\UnassignUserfromOrderresponse';
        $request = $this->ordersUnassignuserPostRequest($contentType, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
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
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'ordersUnassignuserPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\UnassignUserfromOrderrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function ordersUnassignuserPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling ordersUnassignuserPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling ordersUnassignuserPost'
            );
        }

        $resourcePath = '/orders/unassignuser';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // header params
        if ($contentType !== null) {
            $headerParams['Content-Type'] = ObjectSerializer::toHeaderValue($contentType);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            
            if($headers['Content-Type'] === 'application/json') {
                // \stdClass has no __toString(), so we should encode it manually
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                // array has no __toString(), so we should encode it manually
                if(is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
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
