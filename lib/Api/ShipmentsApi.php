<?php
/**
 * ShipmentsApi
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
 * ShipmentsApi Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ShipmentsApi
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
     * Operation shipmentsCreatelabelPost
     *
     * Create Shipment Label
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateShipmentLabelrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\CreateShipmentLabelresponse
     */
    public function shipmentsCreatelabelPost($contentType, $body)
    {
        list($response) = $this->shipmentsCreatelabelPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation shipmentsCreatelabelPostWithHttpInfo
     *
     * Create Shipment Label
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateShipmentLabelrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\CreateShipmentLabelresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function shipmentsCreatelabelPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\CreateShipmentLabelresponse';
        $request = $this->shipmentsCreatelabelPostRequest($contentType, $body);

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
                        '\ShipStation\Model\CreateShipmentLabelresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation shipmentsCreatelabelPostAsync
     *
     * Create Shipment Label
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateShipmentLabelrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shipmentsCreatelabelPostAsync($contentType, $body)
    {
        return $this->shipmentsCreatelabelPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation shipmentsCreatelabelPostAsyncWithHttpInfo
     *
     * Create Shipment Label
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateShipmentLabelrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shipmentsCreatelabelPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\CreateShipmentLabelresponse';
        $request = $this->shipmentsCreatelabelPostRequest($contentType, $body);

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
     * Create request for operation 'shipmentsCreatelabelPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\CreateShipmentLabelrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function shipmentsCreatelabelPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling shipmentsCreatelabelPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling shipmentsCreatelabelPost'
            );
        }

        $resourcePath = '/shipments/createlabel';
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
     * Operation shipmentsGet
     *
     * List Shipments with parameters
     *
     * @param  string $recipientName Returns shipments shipped to the specified recipient name. (optional)
     * @param  string $recipientCountryCode Returns shipments shipped to the specified country code. (optional)
     * @param  string $orderNumber Returns shipments whose orders have the specified order number. (optional)
     * @param  double $orderId Returns shipments whose orders have the specified order ID. (optional)
     * @param  string $carrierCode Returns shipments shipped with the specified carrier. (optional)
     * @param  string $serviceCode Returns shipments shipped with the specified shipping service. (optional)
     * @param  string $trackingNumber Returns shipments with the specified tracking number. (optional)
     * @param  string $createDateStart Returns shipments created on or after the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $createDateEnd Returns shipments created on or before the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $shipDateStart Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or after the specified date (optional)
     * @param  string $shipDateEnd Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or before the specified date (optional)
     * @param  string $voidDateStart Returns shipments voided on or after the specified date (optional)
     * @param  string $voidDateEnd Returns shipments voided on or before the specified date (optional)
     * @param  double $storeId Returns shipments whose orders belong to the specified store ID. (optional)
     * @param  bool $includeShipmentItems Specifies whether to include shipment items with results Default value: false. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;createDate&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  double $page page number. (optional)
     * @param  double $pageSize page size. (optional)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\ListShipmentswithparametersresponse
     */
    public function shipmentsGet($recipientName = null, $recipientCountryCode = null, $orderNumber = null, $orderId = null, $carrierCode = null, $serviceCode = null, $trackingNumber = null, $createDateStart = null, $createDateEnd = null, $shipDateStart = null, $shipDateEnd = null, $voidDateStart = null, $voidDateEnd = null, $storeId = null, $includeShipmentItems = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {
        list($response) = $this->shipmentsGetWithHttpInfo($recipientName, $recipientCountryCode, $orderNumber, $orderId, $carrierCode, $serviceCode, $trackingNumber, $createDateStart, $createDateEnd, $shipDateStart, $shipDateEnd, $voidDateStart, $voidDateEnd, $storeId, $includeShipmentItems, $sortBy, $sortDir, $page, $pageSize);
        return $response;
    }

    /**
     * Operation shipmentsGetWithHttpInfo
     *
     * List Shipments with parameters
     *
     * @param  string $recipientName Returns shipments shipped to the specified recipient name. (optional)
     * @param  string $recipientCountryCode Returns shipments shipped to the specified country code. (optional)
     * @param  string $orderNumber Returns shipments whose orders have the specified order number. (optional)
     * @param  double $orderId Returns shipments whose orders have the specified order ID. (optional)
     * @param  string $carrierCode Returns shipments shipped with the specified carrier. (optional)
     * @param  string $serviceCode Returns shipments shipped with the specified shipping service. (optional)
     * @param  string $trackingNumber Returns shipments with the specified tracking number. (optional)
     * @param  string $createDateStart Returns shipments created on or after the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $createDateEnd Returns shipments created on or before the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $shipDateStart Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or after the specified date (optional)
     * @param  string $shipDateEnd Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or before the specified date (optional)
     * @param  string $voidDateStart Returns shipments voided on or after the specified date (optional)
     * @param  string $voidDateEnd Returns shipments voided on or before the specified date (optional)
     * @param  double $storeId Returns shipments whose orders belong to the specified store ID. (optional)
     * @param  bool $includeShipmentItems Specifies whether to include shipment items with results Default value: false. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;createDate&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  double $page page number. (optional)
     * @param  double $pageSize page size. (optional)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\ListShipmentswithparametersresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function shipmentsGetWithHttpInfo($recipientName = null, $recipientCountryCode = null, $orderNumber = null, $orderId = null, $carrierCode = null, $serviceCode = null, $trackingNumber = null, $createDateStart = null, $createDateEnd = null, $shipDateStart = null, $shipDateEnd = null, $voidDateStart = null, $voidDateEnd = null, $storeId = null, $includeShipmentItems = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {
        $returnType = '\ShipStation\Model\ListShipmentswithparametersresponse';
        $request = $this->shipmentsGetRequest($recipientName, $recipientCountryCode, $orderNumber, $orderId, $carrierCode, $serviceCode, $trackingNumber, $createDateStart, $createDateEnd, $shipDateStart, $shipDateEnd, $voidDateStart, $voidDateEnd, $storeId, $includeShipmentItems, $sortBy, $sortDir, $page, $pageSize);

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
                        '\ShipStation\Model\ListShipmentswithparametersresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation shipmentsGetAsync
     *
     * List Shipments with parameters
     *
     * @param  string $recipientName Returns shipments shipped to the specified recipient name. (optional)
     * @param  string $recipientCountryCode Returns shipments shipped to the specified country code. (optional)
     * @param  string $orderNumber Returns shipments whose orders have the specified order number. (optional)
     * @param  double $orderId Returns shipments whose orders have the specified order ID. (optional)
     * @param  string $carrierCode Returns shipments shipped with the specified carrier. (optional)
     * @param  string $serviceCode Returns shipments shipped with the specified shipping service. (optional)
     * @param  string $trackingNumber Returns shipments with the specified tracking number. (optional)
     * @param  string $createDateStart Returns shipments created on or after the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $createDateEnd Returns shipments created on or before the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $shipDateStart Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or after the specified date (optional)
     * @param  string $shipDateEnd Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or before the specified date (optional)
     * @param  string $voidDateStart Returns shipments voided on or after the specified date (optional)
     * @param  string $voidDateEnd Returns shipments voided on or before the specified date (optional)
     * @param  double $storeId Returns shipments whose orders belong to the specified store ID. (optional)
     * @param  bool $includeShipmentItems Specifies whether to include shipment items with results Default value: false. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;createDate&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  double $page page number. (optional)
     * @param  double $pageSize page size. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shipmentsGetAsync($recipientName = null, $recipientCountryCode = null, $orderNumber = null, $orderId = null, $carrierCode = null, $serviceCode = null, $trackingNumber = null, $createDateStart = null, $createDateEnd = null, $shipDateStart = null, $shipDateEnd = null, $voidDateStart = null, $voidDateEnd = null, $storeId = null, $includeShipmentItems = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {
        return $this->shipmentsGetAsyncWithHttpInfo($recipientName, $recipientCountryCode, $orderNumber, $orderId, $carrierCode, $serviceCode, $trackingNumber, $createDateStart, $createDateEnd, $shipDateStart, $shipDateEnd, $voidDateStart, $voidDateEnd, $storeId, $includeShipmentItems, $sortBy, $sortDir, $page, $pageSize)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation shipmentsGetAsyncWithHttpInfo
     *
     * List Shipments with parameters
     *
     * @param  string $recipientName Returns shipments shipped to the specified recipient name. (optional)
     * @param  string $recipientCountryCode Returns shipments shipped to the specified country code. (optional)
     * @param  string $orderNumber Returns shipments whose orders have the specified order number. (optional)
     * @param  double $orderId Returns shipments whose orders have the specified order ID. (optional)
     * @param  string $carrierCode Returns shipments shipped with the specified carrier. (optional)
     * @param  string $serviceCode Returns shipments shipped with the specified shipping service. (optional)
     * @param  string $trackingNumber Returns shipments with the specified tracking number. (optional)
     * @param  string $createDateStart Returns shipments created on or after the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $createDateEnd Returns shipments created on or before the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $shipDateStart Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or after the specified date (optional)
     * @param  string $shipDateEnd Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or before the specified date (optional)
     * @param  string $voidDateStart Returns shipments voided on or after the specified date (optional)
     * @param  string $voidDateEnd Returns shipments voided on or before the specified date (optional)
     * @param  double $storeId Returns shipments whose orders belong to the specified store ID. (optional)
     * @param  bool $includeShipmentItems Specifies whether to include shipment items with results Default value: false. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;createDate&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  double $page page number. (optional)
     * @param  double $pageSize page size. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shipmentsGetAsyncWithHttpInfo($recipientName = null, $recipientCountryCode = null, $orderNumber = null, $orderId = null, $carrierCode = null, $serviceCode = null, $trackingNumber = null, $createDateStart = null, $createDateEnd = null, $shipDateStart = null, $shipDateEnd = null, $voidDateStart = null, $voidDateEnd = null, $storeId = null, $includeShipmentItems = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {
        $returnType = '\ShipStation\Model\ListShipmentswithparametersresponse';
        $request = $this->shipmentsGetRequest($recipientName, $recipientCountryCode, $orderNumber, $orderId, $carrierCode, $serviceCode, $trackingNumber, $createDateStart, $createDateEnd, $shipDateStart, $shipDateEnd, $voidDateStart, $voidDateEnd, $storeId, $includeShipmentItems, $sortBy, $sortDir, $page, $pageSize);

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
     * Create request for operation 'shipmentsGet'
     *
     * @param  string $recipientName Returns shipments shipped to the specified recipient name. (optional)
     * @param  string $recipientCountryCode Returns shipments shipped to the specified country code. (optional)
     * @param  string $orderNumber Returns shipments whose orders have the specified order number. (optional)
     * @param  double $orderId Returns shipments whose orders have the specified order ID. (optional)
     * @param  string $carrierCode Returns shipments shipped with the specified carrier. (optional)
     * @param  string $serviceCode Returns shipments shipped with the specified shipping service. (optional)
     * @param  string $trackingNumber Returns shipments with the specified tracking number. (optional)
     * @param  string $createDateStart Returns shipments created on or after the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $createDateEnd Returns shipments created on or before the specified &#x60;&#x60;createDate&#x60;&#x60; (optional)
     * @param  string $shipDateStart Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or after the specified date (optional)
     * @param  string $shipDateEnd Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or before the specified date (optional)
     * @param  string $voidDateStart Returns shipments voided on or after the specified date (optional)
     * @param  string $voidDateEnd Returns shipments voided on or before the specified date (optional)
     * @param  double $storeId Returns shipments whose orders belong to the specified store ID. (optional)
     * @param  bool $includeShipmentItems Specifies whether to include shipment items with results Default value: false. (optional)
     * @param  string $sortBy Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;createDate&#x60;&#x60;. (optional)
     * @param  string $sortDir Sets the direction of the sort order. (optional)
     * @param  double $page page number. (optional)
     * @param  double $pageSize page size. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function shipmentsGetRequest($recipientName = null, $recipientCountryCode = null, $orderNumber = null, $orderId = null, $carrierCode = null, $serviceCode = null, $trackingNumber = null, $createDateStart = null, $createDateEnd = null, $shipDateStart = null, $shipDateEnd = null, $voidDateStart = null, $voidDateEnd = null, $storeId = null, $includeShipmentItems = null, $sortBy = null, $sortDir = null, $page = null, $pageSize = null)
    {

        $resourcePath = '/shipments';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($recipientName !== null) {
            $queryParams['recipientName'] = ObjectSerializer::toQueryValue($recipientName);
        }
        // query params
        if ($recipientCountryCode !== null) {
            $queryParams['recipientCountryCode'] = ObjectSerializer::toQueryValue($recipientCountryCode);
        }
        // query params
        if ($orderNumber !== null) {
            $queryParams['orderNumber'] = ObjectSerializer::toQueryValue($orderNumber);
        }
        // query params
        if ($orderId !== null) {
            $queryParams['orderId'] = ObjectSerializer::toQueryValue($orderId);
        }
        // query params
        if ($carrierCode !== null) {
            $queryParams['carrierCode'] = ObjectSerializer::toQueryValue($carrierCode);
        }
        // query params
        if ($serviceCode !== null) {
            $queryParams['serviceCode'] = ObjectSerializer::toQueryValue($serviceCode);
        }
        // query params
        if ($trackingNumber !== null) {
            $queryParams['trackingNumber'] = ObjectSerializer::toQueryValue($trackingNumber);
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
        if ($shipDateStart !== null) {
            $queryParams['shipDateStart'] = ObjectSerializer::toQueryValue($shipDateStart);
        }
        // query params
        if ($shipDateEnd !== null) {
            $queryParams['shipDateEnd'] = ObjectSerializer::toQueryValue($shipDateEnd);
        }
        // query params
        if ($voidDateStart !== null) {
            $queryParams['voidDateStart'] = ObjectSerializer::toQueryValue($voidDateStart);
        }
        // query params
        if ($voidDateEnd !== null) {
            $queryParams['voidDateEnd'] = ObjectSerializer::toQueryValue($voidDateEnd);
        }
        // query params
        if ($storeId !== null) {
            $queryParams['storeId'] = ObjectSerializer::toQueryValue($storeId);
        }
        // query params
        if ($includeShipmentItems !== null) {
            $queryParams['includeShipmentItems'] = ObjectSerializer::toQueryValue($includeShipmentItems);
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
     * Operation shipmentsGetratesPost
     *
     * Get Rates
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\GetRatesrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\GetRatesresponse[]
     */
    public function shipmentsGetratesPost($contentType, $body)
    {
        list($response) = $this->shipmentsGetratesPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation shipmentsGetratesPostWithHttpInfo
     *
     * Get Rates
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\GetRatesrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\GetRatesresponse[], HTTP status code, HTTP response headers (array of strings)
     */
    public function shipmentsGetratesPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\GetRatesresponse[]';
        $request = $this->shipmentsGetratesPostRequest($contentType, $body);

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
                        '\ShipStation\Model\GetRatesresponse[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation shipmentsGetratesPostAsync
     *
     * Get Rates
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\GetRatesrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shipmentsGetratesPostAsync($contentType, $body)
    {
        return $this->shipmentsGetratesPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation shipmentsGetratesPostAsyncWithHttpInfo
     *
     * Get Rates
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\GetRatesrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shipmentsGetratesPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\GetRatesresponse[]';
        $request = $this->shipmentsGetratesPostRequest($contentType, $body);

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
     * Create request for operation 'shipmentsGetratesPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\GetRatesrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function shipmentsGetratesPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling shipmentsGetratesPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling shipmentsGetratesPost'
            );
        }

        $resourcePath = '/shipments/getrates';
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
     * Operation shipmentsVoidlabelPost
     *
     * Void Label
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\VoidLabelrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \ShipStation\Model\VoidLabelresponse
     */
    public function shipmentsVoidlabelPost($contentType, $body)
    {
        list($response) = $this->shipmentsVoidlabelPostWithHttpInfo($contentType, $body);
        return $response;
    }

    /**
     * Operation shipmentsVoidlabelPostWithHttpInfo
     *
     * Void Label
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\VoidLabelrequest $body  (required)
     *
     * @throws \ShipStation\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \ShipStation\Model\VoidLabelresponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function shipmentsVoidlabelPostWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\VoidLabelresponse';
        $request = $this->shipmentsVoidlabelPostRequest($contentType, $body);

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
                        '\ShipStation\Model\VoidLabelresponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation shipmentsVoidlabelPostAsync
     *
     * Void Label
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\VoidLabelrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shipmentsVoidlabelPostAsync($contentType, $body)
    {
        return $this->shipmentsVoidlabelPostAsyncWithHttpInfo($contentType, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation shipmentsVoidlabelPostAsyncWithHttpInfo
     *
     * Void Label
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\VoidLabelrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function shipmentsVoidlabelPostAsyncWithHttpInfo($contentType, $body)
    {
        $returnType = '\ShipStation\Model\VoidLabelresponse';
        $request = $this->shipmentsVoidlabelPostRequest($contentType, $body);

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
     * Create request for operation 'shipmentsVoidlabelPost'
     *
     * @param  string $contentType  (required)
     * @param  \ShipStation\Model\VoidLabelrequest $body  (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function shipmentsVoidlabelPostRequest($contentType, $body)
    {
        // verify the required parameter 'contentType' is set
        if ($contentType === null || (is_array($contentType) && count($contentType) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contentType when calling shipmentsVoidlabelPost'
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling shipmentsVoidlabelPost'
            );
        }

        $resourcePath = '/shipments/voidlabel';
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
