<?php
/**
 * Shipment
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
 * Shipment Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Shipment implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Shipment';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'shipmentId' => 'int',
        'orderId' => 'int',
        'orderKey' => 'string',
        'userId' => 'string',
        'orderNumber' => 'string',
        'createDate' => 'string',
        'shipDate' => 'string',
        'shipmentCost' => 'double',
        'insuranceCost' => 'int',
        'trackingNumber' => 'string',
        'isReturnLabel' => 'bool',
        'batchNumber' => 'string',
        'carrierCode' => 'string',
        'serviceCode' => 'string',
        'packageCode' => 'string',
        'confirmation' => 'string',
        'warehouseId' => 'int',
        'voided' => 'bool',
        'voidDate' => 'string',
        'marketplaceNotified' => 'bool',
        'notifyErrorMessage' => 'string',
        'shipTo' => '\ShipStation\Model\ShipTo9',
        'weight' => '\ShipStation\Model\Weight',
        'dimensions' => 'string',
        'insuranceOptions' => '\ShipStation\Model\InsuranceOptions4',
        'advancedOptions' => 'string',
        'shipmentItems' => '\ShipStation\Model\ShipmentItem[]',
        'labelData' => 'string',
        'formData' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'shipmentId' => 'int32',
        'orderId' => 'int32',
        'orderKey' => null,
        'userId' => null,
        'orderNumber' => null,
        'createDate' => null,
        'shipDate' => null,
        'shipmentCost' => 'double',
        'insuranceCost' => 'int32',
        'trackingNumber' => null,
        'isReturnLabel' => null,
        'batchNumber' => null,
        'carrierCode' => null,
        'serviceCode' => null,
        'packageCode' => null,
        'confirmation' => null,
        'warehouseId' => 'int32',
        'voided' => null,
        'voidDate' => null,
        'marketplaceNotified' => null,
        'notifyErrorMessage' => null,
        'shipTo' => null,
        'weight' => null,
        'dimensions' => null,
        'insuranceOptions' => null,
        'advancedOptions' => null,
        'shipmentItems' => null,
        'labelData' => null,
        'formData' => null
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
        'shipmentId' => 'shipmentId',
        'orderId' => 'orderId',
        'orderKey' => 'orderKey',
        'userId' => 'userId',
        'orderNumber' => 'orderNumber',
        'createDate' => 'createDate',
        'shipDate' => 'shipDate',
        'shipmentCost' => 'shipmentCost',
        'insuranceCost' => 'insuranceCost',
        'trackingNumber' => 'trackingNumber',
        'isReturnLabel' => 'isReturnLabel',
        'batchNumber' => 'batchNumber',
        'carrierCode' => 'carrierCode',
        'serviceCode' => 'serviceCode',
        'packageCode' => 'packageCode',
        'confirmation' => 'confirmation',
        'warehouseId' => 'warehouseId',
        'voided' => 'voided',
        'voidDate' => 'voidDate',
        'marketplaceNotified' => 'marketplaceNotified',
        'notifyErrorMessage' => 'notifyErrorMessage',
        'shipTo' => 'shipTo',
        'weight' => 'weight',
        'dimensions' => 'dimensions',
        'insuranceOptions' => 'insuranceOptions',
        'advancedOptions' => 'advancedOptions',
        'shipmentItems' => 'shipmentItems',
        'labelData' => 'labelData',
        'formData' => 'formData'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'shipmentId' => 'setShipmentId',
        'orderId' => 'setOrderId',
        'orderKey' => 'setOrderKey',
        'userId' => 'setUserId',
        'orderNumber' => 'setOrderNumber',
        'createDate' => 'setCreateDate',
        'shipDate' => 'setShipDate',
        'shipmentCost' => 'setShipmentCost',
        'insuranceCost' => 'setInsuranceCost',
        'trackingNumber' => 'setTrackingNumber',
        'isReturnLabel' => 'setIsReturnLabel',
        'batchNumber' => 'setBatchNumber',
        'carrierCode' => 'setCarrierCode',
        'serviceCode' => 'setServiceCode',
        'packageCode' => 'setPackageCode',
        'confirmation' => 'setConfirmation',
        'warehouseId' => 'setWarehouseId',
        'voided' => 'setVoided',
        'voidDate' => 'setVoidDate',
        'marketplaceNotified' => 'setMarketplaceNotified',
        'notifyErrorMessage' => 'setNotifyErrorMessage',
        'shipTo' => 'setShipTo',
        'weight' => 'setWeight',
        'dimensions' => 'setDimensions',
        'insuranceOptions' => 'setInsuranceOptions',
        'advancedOptions' => 'setAdvancedOptions',
        'shipmentItems' => 'setShipmentItems',
        'labelData' => 'setLabelData',
        'formData' => 'setFormData'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'shipmentId' => 'getShipmentId',
        'orderId' => 'getOrderId',
        'orderKey' => 'getOrderKey',
        'userId' => 'getUserId',
        'orderNumber' => 'getOrderNumber',
        'createDate' => 'getCreateDate',
        'shipDate' => 'getShipDate',
        'shipmentCost' => 'getShipmentCost',
        'insuranceCost' => 'getInsuranceCost',
        'trackingNumber' => 'getTrackingNumber',
        'isReturnLabel' => 'getIsReturnLabel',
        'batchNumber' => 'getBatchNumber',
        'carrierCode' => 'getCarrierCode',
        'serviceCode' => 'getServiceCode',
        'packageCode' => 'getPackageCode',
        'confirmation' => 'getConfirmation',
        'warehouseId' => 'getWarehouseId',
        'voided' => 'getVoided',
        'voidDate' => 'getVoidDate',
        'marketplaceNotified' => 'getMarketplaceNotified',
        'notifyErrorMessage' => 'getNotifyErrorMessage',
        'shipTo' => 'getShipTo',
        'weight' => 'getWeight',
        'dimensions' => 'getDimensions',
        'insuranceOptions' => 'getInsuranceOptions',
        'advancedOptions' => 'getAdvancedOptions',
        'shipmentItems' => 'getShipmentItems',
        'labelData' => 'getLabelData',
        'formData' => 'getFormData'
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
        $this->container['shipmentId'] = isset($data['shipmentId']) ? $data['shipmentId'] : null;
        $this->container['orderId'] = isset($data['orderId']) ? $data['orderId'] : null;
        $this->container['orderKey'] = isset($data['orderKey']) ? $data['orderKey'] : null;
        $this->container['userId'] = isset($data['userId']) ? $data['userId'] : null;
        $this->container['orderNumber'] = isset($data['orderNumber']) ? $data['orderNumber'] : null;
        $this->container['createDate'] = isset($data['createDate']) ? $data['createDate'] : null;
        $this->container['shipDate'] = isset($data['shipDate']) ? $data['shipDate'] : null;
        $this->container['shipmentCost'] = isset($data['shipmentCost']) ? $data['shipmentCost'] : null;
        $this->container['insuranceCost'] = isset($data['insuranceCost']) ? $data['insuranceCost'] : null;
        $this->container['trackingNumber'] = isset($data['trackingNumber']) ? $data['trackingNumber'] : null;
        $this->container['isReturnLabel'] = isset($data['isReturnLabel']) ? $data['isReturnLabel'] : null;
        $this->container['batchNumber'] = isset($data['batchNumber']) ? $data['batchNumber'] : null;
        $this->container['carrierCode'] = isset($data['carrierCode']) ? $data['carrierCode'] : null;
        $this->container['serviceCode'] = isset($data['serviceCode']) ? $data['serviceCode'] : null;
        $this->container['packageCode'] = isset($data['packageCode']) ? $data['packageCode'] : null;
        $this->container['confirmation'] = isset($data['confirmation']) ? $data['confirmation'] : null;
        $this->container['warehouseId'] = isset($data['warehouseId']) ? $data['warehouseId'] : null;
        $this->container['voided'] = isset($data['voided']) ? $data['voided'] : null;
        $this->container['voidDate'] = isset($data['voidDate']) ? $data['voidDate'] : null;
        $this->container['marketplaceNotified'] = isset($data['marketplaceNotified']) ? $data['marketplaceNotified'] : null;
        $this->container['notifyErrorMessage'] = isset($data['notifyErrorMessage']) ? $data['notifyErrorMessage'] : null;
        $this->container['shipTo'] = isset($data['shipTo']) ? $data['shipTo'] : null;
        $this->container['weight'] = isset($data['weight']) ? $data['weight'] : null;
        $this->container['dimensions'] = isset($data['dimensions']) ? $data['dimensions'] : null;
        $this->container['insuranceOptions'] = isset($data['insuranceOptions']) ? $data['insuranceOptions'] : null;
        $this->container['advancedOptions'] = isset($data['advancedOptions']) ? $data['advancedOptions'] : null;
        $this->container['shipmentItems'] = isset($data['shipmentItems']) ? $data['shipmentItems'] : null;
        $this->container['labelData'] = isset($data['labelData']) ? $data['labelData'] : null;
        $this->container['formData'] = isset($data['formData']) ? $data['formData'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['shipmentId'] === null) {
            $invalidProperties[] = "'shipmentId' can't be null";
        }
        if ($this->container['orderId'] === null) {
            $invalidProperties[] = "'orderId' can't be null";
        }
        if ($this->container['userId'] === null) {
            $invalidProperties[] = "'userId' can't be null";
        }
        if ($this->container['orderNumber'] === null) {
            $invalidProperties[] = "'orderNumber' can't be null";
        }
        if ($this->container['createDate'] === null) {
            $invalidProperties[] = "'createDate' can't be null";
        }
        if ($this->container['shipDate'] === null) {
            $invalidProperties[] = "'shipDate' can't be null";
        }
        if ($this->container['shipmentCost'] === null) {
            $invalidProperties[] = "'shipmentCost' can't be null";
        }
        if ($this->container['insuranceCost'] === null) {
            $invalidProperties[] = "'insuranceCost' can't be null";
        }
        if ($this->container['trackingNumber'] === null) {
            $invalidProperties[] = "'trackingNumber' can't be null";
        }
        if ($this->container['isReturnLabel'] === null) {
            $invalidProperties[] = "'isReturnLabel' can't be null";
        }
        if ($this->container['batchNumber'] === null) {
            $invalidProperties[] = "'batchNumber' can't be null";
        }
        if ($this->container['carrierCode'] === null) {
            $invalidProperties[] = "'carrierCode' can't be null";
        }
        if ($this->container['serviceCode'] === null) {
            $invalidProperties[] = "'serviceCode' can't be null";
        }
        if ($this->container['packageCode'] === null) {
            $invalidProperties[] = "'packageCode' can't be null";
        }
        if ($this->container['confirmation'] === null) {
            $invalidProperties[] = "'confirmation' can't be null";
        }
        if ($this->container['warehouseId'] === null) {
            $invalidProperties[] = "'warehouseId' can't be null";
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
        if ($this->container['weight'] === null) {
            $invalidProperties[] = "'weight' can't be null";
        }
        if ($this->container['insuranceOptions'] === null) {
            $invalidProperties[] = "'insuranceOptions' can't be null";
        }
        if ($this->container['shipmentItems'] === null) {
            $invalidProperties[] = "'shipmentItems' can't be null";
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
     * Gets shipmentId
     *
     * @return int
     */
    public function getShipmentId()
    {
        return $this->container['shipmentId'];
    }

    /**
     * Sets shipmentId
     *
     * @param int $shipmentId shipmentId
     *
     * @return $this
     */
    public function setShipmentId($shipmentId)
    {
        $this->container['shipmentId'] = $shipmentId;

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
     * Gets orderKey
     *
     * @return string
     */
    public function getOrderKey()
    {
        return $this->container['orderKey'];
    }

    /**
     * Sets orderKey
     *
     * @param string $orderKey orderKey
     *
     * @return $this
     */
    public function setOrderKey($orderKey)
    {
        $this->container['orderKey'] = $orderKey;

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
     * Gets shipmentCost
     *
     * @return double
     */
    public function getShipmentCost()
    {
        return $this->container['shipmentCost'];
    }

    /**
     * Sets shipmentCost
     *
     * @param double $shipmentCost shipmentCost
     *
     * @return $this
     */
    public function setShipmentCost($shipmentCost)
    {
        $this->container['shipmentCost'] = $shipmentCost;

        return $this;
    }

    /**
     * Gets insuranceCost
     *
     * @return int
     */
    public function getInsuranceCost()
    {
        return $this->container['insuranceCost'];
    }

    /**
     * Sets insuranceCost
     *
     * @param int $insuranceCost insuranceCost
     *
     * @return $this
     */
    public function setInsuranceCost($insuranceCost)
    {
        $this->container['insuranceCost'] = $insuranceCost;

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
     * Gets isReturnLabel
     *
     * @return bool
     */
    public function getIsReturnLabel()
    {
        return $this->container['isReturnLabel'];
    }

    /**
     * Sets isReturnLabel
     *
     * @param bool $isReturnLabel isReturnLabel
     *
     * @return $this
     */
    public function setIsReturnLabel($isReturnLabel)
    {
        $this->container['isReturnLabel'] = $isReturnLabel;

        return $this;
    }

    /**
     * Gets batchNumber
     *
     * @return string
     */
    public function getBatchNumber()
    {
        return $this->container['batchNumber'];
    }

    /**
     * Sets batchNumber
     *
     * @param string $batchNumber batchNumber
     *
     * @return $this
     */
    public function setBatchNumber($batchNumber)
    {
        $this->container['batchNumber'] = $batchNumber;

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
     * Gets serviceCode
     *
     * @return string
     */
    public function getServiceCode()
    {
        return $this->container['serviceCode'];
    }

    /**
     * Sets serviceCode
     *
     * @param string $serviceCode serviceCode
     *
     * @return $this
     */
    public function setServiceCode($serviceCode)
    {
        $this->container['serviceCode'] = $serviceCode;

        return $this;
    }

    /**
     * Gets packageCode
     *
     * @return string
     */
    public function getPackageCode()
    {
        return $this->container['packageCode'];
    }

    /**
     * Sets packageCode
     *
     * @param string $packageCode packageCode
     *
     * @return $this
     */
    public function setPackageCode($packageCode)
    {
        $this->container['packageCode'] = $packageCode;

        return $this;
    }

    /**
     * Gets confirmation
     *
     * @return string
     */
    public function getConfirmation()
    {
        return $this->container['confirmation'];
    }

    /**
     * Sets confirmation
     *
     * @param string $confirmation confirmation
     *
     * @return $this
     */
    public function setConfirmation($confirmation)
    {
        $this->container['confirmation'] = $confirmation;

        return $this;
    }

    /**
     * Gets warehouseId
     *
     * @return int
     */
    public function getWarehouseId()
    {
        return $this->container['warehouseId'];
    }

    /**
     * Sets warehouseId
     *
     * @param int $warehouseId warehouseId
     *
     * @return $this
     */
    public function setWarehouseId($warehouseId)
    {
        $this->container['warehouseId'] = $warehouseId;

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
     * @return \ShipStation\Model\ShipTo9
     */
    public function getShipTo()
    {
        return $this->container['shipTo'];
    }

    /**
     * Sets shipTo
     *
     * @param \ShipStation\Model\ShipTo9 $shipTo shipTo
     *
     * @return $this
     */
    public function setShipTo($shipTo)
    {
        $this->container['shipTo'] = $shipTo;

        return $this;
    }

    /**
     * Gets weight
     *
     * @return \ShipStation\Model\Weight
     */
    public function getWeight()
    {
        return $this->container['weight'];
    }

    /**
     * Sets weight
     *
     * @param \ShipStation\Model\Weight $weight weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->container['weight'] = $weight;

        return $this;
    }

    /**
     * Gets dimensions
     *
     * @return string
     */
    public function getDimensions()
    {
        return $this->container['dimensions'];
    }

    /**
     * Sets dimensions
     *
     * @param string $dimensions dimensions
     *
     * @return $this
     */
    public function setDimensions($dimensions)
    {
        $this->container['dimensions'] = $dimensions;

        return $this;
    }

    /**
     * Gets insuranceOptions
     *
     * @return \ShipStation\Model\InsuranceOptions4
     */
    public function getInsuranceOptions()
    {
        return $this->container['insuranceOptions'];
    }

    /**
     * Sets insuranceOptions
     *
     * @param \ShipStation\Model\InsuranceOptions4 $insuranceOptions insuranceOptions
     *
     * @return $this
     */
    public function setInsuranceOptions($insuranceOptions)
    {
        $this->container['insuranceOptions'] = $insuranceOptions;

        return $this;
    }

    /**
     * Gets advancedOptions
     *
     * @return string
     */
    public function getAdvancedOptions()
    {
        return $this->container['advancedOptions'];
    }

    /**
     * Sets advancedOptions
     *
     * @param string $advancedOptions advancedOptions
     *
     * @return $this
     */
    public function setAdvancedOptions($advancedOptions)
    {
        $this->container['advancedOptions'] = $advancedOptions;

        return $this;
    }

    /**
     * Gets shipmentItems
     *
     * @return \ShipStation\Model\ShipmentItem[]
     */
    public function getShipmentItems()
    {
        return $this->container['shipmentItems'];
    }

    /**
     * Sets shipmentItems
     *
     * @param \ShipStation\Model\ShipmentItem[] $shipmentItems shipmentItems
     *
     * @return $this
     */
    public function setShipmentItems($shipmentItems)
    {
        $this->container['shipmentItems'] = $shipmentItems;

        return $this;
    }

    /**
     * Gets labelData
     *
     * @return string
     */
    public function getLabelData()
    {
        return $this->container['labelData'];
    }

    /**
     * Sets labelData
     *
     * @param string $labelData labelData
     *
     * @return $this
     */
    public function setLabelData($labelData)
    {
        $this->container['labelData'] = $labelData;

        return $this;
    }

    /**
     * Gets formData
     *
     * @return string
     */
    public function getFormData()
    {
        return $this->container['formData'];
    }

    /**
     * Sets formData
     *
     * @param string $formData formData
     *
     * @return $this
     */
    public function setFormData($formData)
    {
        $this->container['formData'] = $formData;

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


