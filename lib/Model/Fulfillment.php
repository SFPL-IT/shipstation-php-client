<?php
/**
 * Fulfillment
 *
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

namespace ShipStation\Model;

use \ArrayAccess;
use \ShipStation\ObjectSerializer;

/**
 * Fulfillment Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Fulfillment implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Fulfillment';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'fulfillmentId' => 'int',
        'orderId' => 'int',
        'orderNumber' => 'string',
        'userId' => 'string',
        'customerEmail' => 'string',
        'trackingNumber' => 'string',
        'createDate' => 'string',
        'shipDate' => 'string',
        'voidDate' => 'string',
        'deliveryDate' => 'string',
        'carrierCode' => 'string',
        'fulfillmentProviderCode' => 'string',
        'fulfillmentServiceCode' => 'string',
        'fulfillmentFee' => 'int',
        'voidRequested' => 'bool',
        'voided' => 'bool',
        'marketplaceNotified' => 'bool',
        'notifyErrorMessage' => 'string',
        'shipTo' => '\ShipStation\Model\ShipTo'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'fulfillmentId' => 'int32',
        'orderId' => 'int32',
        'orderNumber' => null,
        'userId' => null,
        'customerEmail' => null,
        'trackingNumber' => null,
        'createDate' => null,
        'shipDate' => null,
        'voidDate' => null,
        'deliveryDate' => null,
        'carrierCode' => null,
        'fulfillmentProviderCode' => null,
        'fulfillmentServiceCode' => null,
        'fulfillmentFee' => 'int32',
        'voidRequested' => null,
        'voided' => null,
        'marketplaceNotified' => null,
        'notifyErrorMessage' => null,
        'shipTo' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'fulfillmentId' => 'fulfillmentId',
        'orderId' => 'orderId',
        'orderNumber' => 'orderNumber',
        'userId' => 'userId',
        'customerEmail' => 'customerEmail',
        'trackingNumber' => 'trackingNumber',
        'createDate' => 'createDate',
        'shipDate' => 'shipDate',
        'voidDate' => 'voidDate',
        'deliveryDate' => 'deliveryDate',
        'carrierCode' => 'carrierCode',
        'fulfillmentProviderCode' => 'fulfillmentProviderCode',
        'fulfillmentServiceCode' => 'fulfillmentServiceCode',
        'fulfillmentFee' => 'fulfillmentFee',
        'voidRequested' => 'voidRequested',
        'voided' => 'voided',
        'marketplaceNotified' => 'marketplaceNotified',
        'notifyErrorMessage' => 'notifyErrorMessage',
        'shipTo' => 'shipTo'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'fulfillmentId' => 'setFulfillmentId',
        'orderId' => 'setOrderId',
        'orderNumber' => 'setOrderNumber',
        'userId' => 'setUserId',
        'customerEmail' => 'setCustomerEmail',
        'trackingNumber' => 'setTrackingNumber',
        'createDate' => 'setCreateDate',
        'shipDate' => 'setShipDate',
        'voidDate' => 'setVoidDate',
        'deliveryDate' => 'setDeliveryDate',
        'carrierCode' => 'setCarrierCode',
        'fulfillmentProviderCode' => 'setFulfillmentProviderCode',
        'fulfillmentServiceCode' => 'setFulfillmentServiceCode',
        'fulfillmentFee' => 'setFulfillmentFee',
        'voidRequested' => 'setVoidRequested',
        'voided' => 'setVoided',
        'marketplaceNotified' => 'setMarketplaceNotified',
        'notifyErrorMessage' => 'setNotifyErrorMessage',
        'shipTo' => 'setShipTo'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'fulfillmentId' => 'getFulfillmentId',
        'orderId' => 'getOrderId',
        'orderNumber' => 'getOrderNumber',
        'userId' => 'getUserId',
        'customerEmail' => 'getCustomerEmail',
        'trackingNumber' => 'getTrackingNumber',
        'createDate' => 'getCreateDate',
        'shipDate' => 'getShipDate',
        'voidDate' => 'getVoidDate',
        'deliveryDate' => 'getDeliveryDate',
        'carrierCode' => 'getCarrierCode',
        'fulfillmentProviderCode' => 'getFulfillmentProviderCode',
        'fulfillmentServiceCode' => 'getFulfillmentServiceCode',
        'fulfillmentFee' => 'getFulfillmentFee',
        'voidRequested' => 'getVoidRequested',
        'voided' => 'getVoided',
        'marketplaceNotified' => 'getMarketplaceNotified',
        'notifyErrorMessage' => 'getNotifyErrorMessage',
        'shipTo' => 'getShipTo'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['fulfillmentId'] = isset($data['fulfillmentId']) ? $data['fulfillmentId'] : null;
        $this->container['orderId'] = isset($data['orderId']) ? $data['orderId'] : null;
        $this->container['orderNumber'] = isset($data['orderNumber']) ? $data['orderNumber'] : null;
        $this->container['userId'] = isset($data['userId']) ? $data['userId'] : null;
        $this->container['customerEmail'] = isset($data['customerEmail']) ? $data['customerEmail'] : null;
        $this->container['trackingNumber'] = isset($data['trackingNumber']) ? $data['trackingNumber'] : null;
        $this->container['createDate'] = isset($data['createDate']) ? $data['createDate'] : null;
        $this->container['shipDate'] = isset($data['shipDate']) ? $data['shipDate'] : null;
        $this->container['voidDate'] = isset($data['voidDate']) ? $data['voidDate'] : null;
        $this->container['deliveryDate'] = isset($data['deliveryDate']) ? $data['deliveryDate'] : null;
        $this->container['carrierCode'] = isset($data['carrierCode']) ? $data['carrierCode'] : null;
        $this->container['fulfillmentProviderCode'] = isset($data['fulfillmentProviderCode']) ? $data['fulfillmentProviderCode'] : null;
        $this->container['fulfillmentServiceCode'] = isset($data['fulfillmentServiceCode']) ? $data['fulfillmentServiceCode'] : null;
        $this->container['fulfillmentFee'] = isset($data['fulfillmentFee']) ? $data['fulfillmentFee'] : null;
        $this->container['voidRequested'] = isset($data['voidRequested']) ? $data['voidRequested'] : null;
        $this->container['voided'] = isset($data['voided']) ? $data['voided'] : null;
        $this->container['marketplaceNotified'] = isset($data['marketplaceNotified']) ? $data['marketplaceNotified'] : null;
        $this->container['notifyErrorMessage'] = isset($data['notifyErrorMessage']) ? $data['notifyErrorMessage'] : null;
        $this->container['shipTo'] = isset($data['shipTo']) ? $data['shipTo'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['fulfillmentId'] === null) {
            $invalidProperties[] = "'fulfillmentId' can't be null";
        }
        if ($this->container['orderId'] === null) {
            $invalidProperties[] = "'orderId' can't be null";
        }
        if ($this->container['orderNumber'] === null) {
            $invalidProperties[] = "'orderNumber' can't be null";
        }
        if ($this->container['userId'] === null) {
            $invalidProperties[] = "'userId' can't be null";
        }
        if ($this->container['customerEmail'] === null) {
            $invalidProperties[] = "'customerEmail' can't be null";
        }
        if ($this->container['trackingNumber'] === null) {
            $invalidProperties[] = "'trackingNumber' can't be null";
        }
        if ($this->container['createDate'] === null) {
            $invalidProperties[] = "'createDate' can't be null";
        }
        if ($this->container['shipDate'] === null) {
            $invalidProperties[] = "'shipDate' can't be null";
        }
        if ($this->container['carrierCode'] === null) {
            $invalidProperties[] = "'carrierCode' can't be null";
        }
        if ($this->container['fulfillmentFee'] === null) {
            $invalidProperties[] = "'fulfillmentFee' can't be null";
        }
        if ($this->container['voidRequested'] === null) {
            $invalidProperties[] = "'voidRequested' can't be null";
        }
        if ($this->container['voided'] === null) {
            $invalidProperties[] = "'voided' can't be null";
        }
        if ($this->container['marketplaceNotified'] === null) {
            $invalidProperties[] = "'marketplaceNotified' can't be null";
        }
        if ($this->container['shipTo'] === null) {
            $invalidProperties[] = "'shipTo' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets fulfillmentId
     *
     * @return int
     */
    public function getFulfillmentId()
    {
        return $this->container['fulfillmentId'];
    }

    /**
     * Sets fulfillmentId
     *
     * @param int $fulfillmentId fulfillmentId
     *
     * @return $this
     */
    public function setFulfillmentId($fulfillmentId)
    {
        $this->container['fulfillmentId'] = $fulfillmentId;

        return $this;
    }

    /**
     * Gets orderId
     *
     * @return int
     */
    public function getOrderId()
    {
        return $this->container['orderId'];
    }

    /**
     * Sets orderId
     *
     * @param int $orderId orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->container['orderId'] = $orderId;

        return $this;
    }

    /**
     * Gets orderNumber
     *
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->container['orderNumber'];
    }

    /**
     * Sets orderNumber
     *
     * @param string $orderNumber orderNumber
     *
     * @return $this
     */
    public function setOrderNumber($orderNumber)
    {
        $this->container['orderNumber'] = $orderNumber;

        return $this;
    }

    /**
     * Gets userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->container['userId'];
    }

    /**
     * Sets userId
     *
     * @param string $userId userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->container['userId'] = $userId;

        return $this;
    }

    /**
     * Gets customerEmail
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->container['customerEmail'];
    }

    /**
     * Sets customerEmail
     *
     * @param string $customerEmail customerEmail
     *
     * @return $this
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->container['customerEmail'] = $customerEmail;

        return $this;
    }

    /**
     * Gets trackingNumber
     *
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->container['trackingNumber'];
    }

    /**
     * Sets trackingNumber
     *
     * @param string $trackingNumber trackingNumber
     *
     * @return $this
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->container['trackingNumber'] = $trackingNumber;

        return $this;
    }

    /**
     * Gets createDate
     *
     * @return string
     */
    public function getCreateDate()
    {
        return $this->container['createDate'];
    }

    /**
     * Sets createDate
     *
     * @param string $createDate createDate
     *
     * @return $this
     */
    public function setCreateDate($createDate)
    {
        $this->container['createDate'] = $createDate;

        return $this;
    }

    /**
     * Gets shipDate
     *
     * @return string
     */
    public function getShipDate()
    {
        return $this->container['shipDate'];
    }

    /**
     * Sets shipDate
     *
     * @param string $shipDate shipDate
     *
     * @return $this
     */
    public function setShipDate($shipDate)
    {
        $this->container['shipDate'] = $shipDate;

        return $this;
    }

    /**
     * Gets voidDate
     *
     * @return string
     */
    public function getVoidDate()
    {
        return $this->container['voidDate'];
    }

    /**
     * Sets voidDate
     *
     * @param string $voidDate voidDate
     *
     * @return $this
     */
    public function setVoidDate($voidDate)
    {
        $this->container['voidDate'] = $voidDate;

        return $this;
    }

    /**
     * Gets deliveryDate
     *
     * @return string
     */
    public function getDeliveryDate()
    {
        return $this->container['deliveryDate'];
    }

    /**
     * Sets deliveryDate
     *
     * @param string $deliveryDate deliveryDate
     *
     * @return $this
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->container['deliveryDate'] = $deliveryDate;

        return $this;
    }

    /**
     * Gets carrierCode
     *
     * @return string
     */
    public function getCarrierCode()
    {
        return $this->container['carrierCode'];
    }

    /**
     * Sets carrierCode
     *
     * @param string $carrierCode carrierCode
     *
     * @return $this
     */
    public function setCarrierCode($carrierCode)
    {
        $this->container['carrierCode'] = $carrierCode;

        return $this;
    }

    /**
     * Gets fulfillmentProviderCode
     *
     * @return string
     */
    public function getFulfillmentProviderCode()
    {
        return $this->container['fulfillmentProviderCode'];
    }

    /**
     * Sets fulfillmentProviderCode
     *
     * @param string $fulfillmentProviderCode fulfillmentProviderCode
     *
     * @return $this
     */
    public function setFulfillmentProviderCode($fulfillmentProviderCode)
    {
        $this->container['fulfillmentProviderCode'] = $fulfillmentProviderCode;

        return $this;
    }

    /**
     * Gets fulfillmentServiceCode
     *
     * @return string
     */
    public function getFulfillmentServiceCode()
    {
        return $this->container['fulfillmentServiceCode'];
    }

    /**
     * Sets fulfillmentServiceCode
     *
     * @param string $fulfillmentServiceCode fulfillmentServiceCode
     *
     * @return $this
     */
    public function setFulfillmentServiceCode($fulfillmentServiceCode)
    {
        $this->container['fulfillmentServiceCode'] = $fulfillmentServiceCode;

        return $this;
    }

    /**
     * Gets fulfillmentFee
     *
     * @return int
     */
    public function getFulfillmentFee()
    {
        return $this->container['fulfillmentFee'];
    }

    /**
     * Sets fulfillmentFee
     *
     * @param int $fulfillmentFee fulfillmentFee
     *
     * @return $this
     */
    public function setFulfillmentFee($fulfillmentFee)
    {
        $this->container['fulfillmentFee'] = $fulfillmentFee;

        return $this;
    }

    /**
     * Gets voidRequested
     *
     * @return bool
     */
    public function getVoidRequested()
    {
        return $this->container['voidRequested'];
    }

    /**
     * Sets voidRequested
     *
     * @param bool $voidRequested voidRequested
     *
     * @return $this
     */
    public function setVoidRequested($voidRequested)
    {
        $this->container['voidRequested'] = $voidRequested;

        return $this;
    }

    /**
     * Gets voided
     *
     * @return bool
     */
    public function getVoided()
    {
        return $this->container['voided'];
    }

    /**
     * Sets voided
     *
     * @param bool $voided voided
     *
     * @return $this
     */
    public function setVoided($voided)
    {
        $this->container['voided'] = $voided;

        return $this;
    }

    /**
     * Gets marketplaceNotified
     *
     * @return bool
     */
    public function getMarketplaceNotified()
    {
        return $this->container['marketplaceNotified'];
    }

    /**
     * Sets marketplaceNotified
     *
     * @param bool $marketplaceNotified marketplaceNotified
     *
     * @return $this
     */
    public function setMarketplaceNotified($marketplaceNotified)
    {
        $this->container['marketplaceNotified'] = $marketplaceNotified;

        return $this;
    }

    /**
     * Gets notifyErrorMessage
     *
     * @return string
     */
    public function getNotifyErrorMessage()
    {
        return $this->container['notifyErrorMessage'];
    }

    /**
     * Sets notifyErrorMessage
     *
     * @param string $notifyErrorMessage notifyErrorMessage
     *
     * @return $this
     */
    public function setNotifyErrorMessage($notifyErrorMessage)
    {
        $this->container['notifyErrorMessage'] = $notifyErrorMessage;

        return $this;
    }

    /**
     * Gets shipTo
     *
     * @return \ShipStation\Model\ShipTo
     */
    public function getShipTo()
    {
        return $this->container['shipTo'];
    }

    /**
     * Sets shipTo
     *
     * @param \ShipStation\Model\ShipTo $shipTo shipTo
     *
     * @return $this
     */
    public function setShipTo($shipTo)
    {
        $this->container['shipTo'] = $shipTo;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


