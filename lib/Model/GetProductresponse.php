<?php
/**
 * GetProductresponse
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
 * GetProductresponse Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetProductresponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'GetProductresponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'aliases' => 'string',
        'productId' => 'int',
        'sku' => 'string',
        'name' => 'string',
        'price' => 'int',
        'defaultCost' => 'int',
        'length' => 'int',
        'width' => 'int',
        'height' => 'int',
        'weightOz' => 'int',
        'internalNotes' => 'string',
        'fulfillmentSku' => 'string',
        'createDate' => 'string',
        'modifyDate' => 'string',
        'active' => 'bool',
        'productCategory' => '\ShipStation\Model\ProductCategory',
        'productType' => 'string',
        'warehouseLocation' => 'string',
        'defaultCarrierCode' => 'string',
        'defaultServiceCode' => 'string',
        'defaultPackageCode' => 'string',
        'defaultIntlCarrierCode' => 'string',
        'defaultIntlServiceCode' => 'string',
        'defaultIntlPackageCode' => 'string',
        'defaultConfirmation' => 'string',
        'defaultIntlConfirmation' => 'string',
        'customsDescription' => 'string',
        'customsValue' => 'string',
        'customsTariffNo' => 'string',
        'customsCountryCode' => 'string',
        'noCustoms' => 'string',
        'tags' => '\ShipStation\Model\Tag[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'aliases' => null,
        'productId' => 'int32',
        'sku' => null,
        'name' => null,
        'price' => 'int32',
        'defaultCost' => 'int32',
        'length' => 'int32',
        'width' => 'int32',
        'height' => 'int32',
        'weightOz' => 'int32',
        'internalNotes' => null,
        'fulfillmentSku' => null,
        'createDate' => null,
        'modifyDate' => null,
        'active' => null,
        'productCategory' => null,
        'productType' => null,
        'warehouseLocation' => null,
        'defaultCarrierCode' => null,
        'defaultServiceCode' => null,
        'defaultPackageCode' => null,
        'defaultIntlCarrierCode' => null,
        'defaultIntlServiceCode' => null,
        'defaultIntlPackageCode' => null,
        'defaultConfirmation' => null,
        'defaultIntlConfirmation' => null,
        'customsDescription' => null,
        'customsValue' => null,
        'customsTariffNo' => null,
        'customsCountryCode' => null,
        'noCustoms' => null,
        'tags' => null
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
        'aliases' => 'aliases',
        'productId' => 'productId',
        'sku' => 'sku',
        'name' => 'name',
        'price' => 'price',
        'defaultCost' => 'defaultCost',
        'length' => 'length',
        'width' => 'width',
        'height' => 'height',
        'weightOz' => 'weightOz',
        'internalNotes' => 'internalNotes',
        'fulfillmentSku' => 'fulfillmentSku',
        'createDate' => 'createDate',
        'modifyDate' => 'modifyDate',
        'active' => 'active',
        'productCategory' => 'productCategory',
        'productType' => 'productType',
        'warehouseLocation' => 'warehouseLocation',
        'defaultCarrierCode' => 'defaultCarrierCode',
        'defaultServiceCode' => 'defaultServiceCode',
        'defaultPackageCode' => 'defaultPackageCode',
        'defaultIntlCarrierCode' => 'defaultIntlCarrierCode',
        'defaultIntlServiceCode' => 'defaultIntlServiceCode',
        'defaultIntlPackageCode' => 'defaultIntlPackageCode',
        'defaultConfirmation' => 'defaultConfirmation',
        'defaultIntlConfirmation' => 'defaultIntlConfirmation',
        'customsDescription' => 'customsDescription',
        'customsValue' => 'customsValue',
        'customsTariffNo' => 'customsTariffNo',
        'customsCountryCode' => 'customsCountryCode',
        'noCustoms' => 'noCustoms',
        'tags' => 'tags'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'aliases' => 'setAliases',
        'productId' => 'setProductId',
        'sku' => 'setSku',
        'name' => 'setName',
        'price' => 'setPrice',
        'defaultCost' => 'setDefaultCost',
        'length' => 'setLength',
        'width' => 'setWidth',
        'height' => 'setHeight',
        'weightOz' => 'setWeightOz',
        'internalNotes' => 'setInternalNotes',
        'fulfillmentSku' => 'setFulfillmentSku',
        'createDate' => 'setCreateDate',
        'modifyDate' => 'setModifyDate',
        'active' => 'setActive',
        'productCategory' => 'setProductCategory',
        'productType' => 'setProductType',
        'warehouseLocation' => 'setWarehouseLocation',
        'defaultCarrierCode' => 'setDefaultCarrierCode',
        'defaultServiceCode' => 'setDefaultServiceCode',
        'defaultPackageCode' => 'setDefaultPackageCode',
        'defaultIntlCarrierCode' => 'setDefaultIntlCarrierCode',
        'defaultIntlServiceCode' => 'setDefaultIntlServiceCode',
        'defaultIntlPackageCode' => 'setDefaultIntlPackageCode',
        'defaultConfirmation' => 'setDefaultConfirmation',
        'defaultIntlConfirmation' => 'setDefaultIntlConfirmation',
        'customsDescription' => 'setCustomsDescription',
        'customsValue' => 'setCustomsValue',
        'customsTariffNo' => 'setCustomsTariffNo',
        'customsCountryCode' => 'setCustomsCountryCode',
        'noCustoms' => 'setNoCustoms',
        'tags' => 'setTags'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'aliases' => 'getAliases',
        'productId' => 'getProductId',
        'sku' => 'getSku',
        'name' => 'getName',
        'price' => 'getPrice',
        'defaultCost' => 'getDefaultCost',
        'length' => 'getLength',
        'width' => 'getWidth',
        'height' => 'getHeight',
        'weightOz' => 'getWeightOz',
        'internalNotes' => 'getInternalNotes',
        'fulfillmentSku' => 'getFulfillmentSku',
        'createDate' => 'getCreateDate',
        'modifyDate' => 'getModifyDate',
        'active' => 'getActive',
        'productCategory' => 'getProductCategory',
        'productType' => 'getProductType',
        'warehouseLocation' => 'getWarehouseLocation',
        'defaultCarrierCode' => 'getDefaultCarrierCode',
        'defaultServiceCode' => 'getDefaultServiceCode',
        'defaultPackageCode' => 'getDefaultPackageCode',
        'defaultIntlCarrierCode' => 'getDefaultIntlCarrierCode',
        'defaultIntlServiceCode' => 'getDefaultIntlServiceCode',
        'defaultIntlPackageCode' => 'getDefaultIntlPackageCode',
        'defaultConfirmation' => 'getDefaultConfirmation',
        'defaultIntlConfirmation' => 'getDefaultIntlConfirmation',
        'customsDescription' => 'getCustomsDescription',
        'customsValue' => 'getCustomsValue',
        'customsTariffNo' => 'getCustomsTariffNo',
        'customsCountryCode' => 'getCustomsCountryCode',
        'noCustoms' => 'getNoCustoms',
        'tags' => 'getTags'
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
        $this->container['aliases'] = isset($data['aliases']) ? $data['aliases'] : null;
        $this->container['productId'] = isset($data['productId']) ? $data['productId'] : null;
        $this->container['sku'] = isset($data['sku']) ? $data['sku'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['price'] = isset($data['price']) ? $data['price'] : null;
        $this->container['defaultCost'] = isset($data['defaultCost']) ? $data['defaultCost'] : null;
        $this->container['length'] = isset($data['length']) ? $data['length'] : null;
        $this->container['width'] = isset($data['width']) ? $data['width'] : null;
        $this->container['height'] = isset($data['height']) ? $data['height'] : null;
        $this->container['weightOz'] = isset($data['weightOz']) ? $data['weightOz'] : null;
        $this->container['internalNotes'] = isset($data['internalNotes']) ? $data['internalNotes'] : null;
        $this->container['fulfillmentSku'] = isset($data['fulfillmentSku']) ? $data['fulfillmentSku'] : null;
        $this->container['createDate'] = isset($data['createDate']) ? $data['createDate'] : null;
        $this->container['modifyDate'] = isset($data['modifyDate']) ? $data['modifyDate'] : null;
        $this->container['active'] = isset($data['active']) ? $data['active'] : null;
        $this->container['productCategory'] = isset($data['productCategory']) ? $data['productCategory'] : null;
        $this->container['productType'] = isset($data['productType']) ? $data['productType'] : null;
        $this->container['warehouseLocation'] = isset($data['warehouseLocation']) ? $data['warehouseLocation'] : null;
        $this->container['defaultCarrierCode'] = isset($data['defaultCarrierCode']) ? $data['defaultCarrierCode'] : null;
        $this->container['defaultServiceCode'] = isset($data['defaultServiceCode']) ? $data['defaultServiceCode'] : null;
        $this->container['defaultPackageCode'] = isset($data['defaultPackageCode']) ? $data['defaultPackageCode'] : null;
        $this->container['defaultIntlCarrierCode'] = isset($data['defaultIntlCarrierCode']) ? $data['defaultIntlCarrierCode'] : null;
        $this->container['defaultIntlServiceCode'] = isset($data['defaultIntlServiceCode']) ? $data['defaultIntlServiceCode'] : null;
        $this->container['defaultIntlPackageCode'] = isset($data['defaultIntlPackageCode']) ? $data['defaultIntlPackageCode'] : null;
        $this->container['defaultConfirmation'] = isset($data['defaultConfirmation']) ? $data['defaultConfirmation'] : null;
        $this->container['defaultIntlConfirmation'] = isset($data['defaultIntlConfirmation']) ? $data['defaultIntlConfirmation'] : null;
        $this->container['customsDescription'] = isset($data['customsDescription']) ? $data['customsDescription'] : null;
        $this->container['customsValue'] = isset($data['customsValue']) ? $data['customsValue'] : null;
        $this->container['customsTariffNo'] = isset($data['customsTariffNo']) ? $data['customsTariffNo'] : null;
        $this->container['customsCountryCode'] = isset($data['customsCountryCode']) ? $data['customsCountryCode'] : null;
        $this->container['noCustoms'] = isset($data['noCustoms']) ? $data['noCustoms'] : null;
        $this->container['tags'] = isset($data['tags']) ? $data['tags'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['productId'] === null) {
            $invalidProperties[] = "'productId' can't be null";
        }
        if ($this->container['sku'] === null) {
            $invalidProperties[] = "'sku' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['price'] === null) {
            $invalidProperties[] = "'price' can't be null";
        }
        if ($this->container['defaultCost'] === null) {
            $invalidProperties[] = "'defaultCost' can't be null";
        }
        if ($this->container['length'] === null) {
            $invalidProperties[] = "'length' can't be null";
        }
        if ($this->container['width'] === null) {
            $invalidProperties[] = "'width' can't be null";
        }
        if ($this->container['height'] === null) {
            $invalidProperties[] = "'height' can't be null";
        }
        if ($this->container['weightOz'] === null) {
            $invalidProperties[] = "'weightOz' can't be null";
        }
        if ($this->container['fulfillmentSku'] === null) {
            $invalidProperties[] = "'fulfillmentSku' can't be null";
        }
        if ($this->container['createDate'] === null) {
            $invalidProperties[] = "'createDate' can't be null";
        }
        if ($this->container['modifyDate'] === null) {
            $invalidProperties[] = "'modifyDate' can't be null";
        }
        if ($this->container['active'] === null) {
            $invalidProperties[] = "'active' can't be null";
        }
        if ($this->container['productCategory'] === null) {
            $invalidProperties[] = "'productCategory' can't be null";
        }
        if ($this->container['warehouseLocation'] === null) {
            $invalidProperties[] = "'warehouseLocation' can't be null";
        }
        if ($this->container['defaultCarrierCode'] === null) {
            $invalidProperties[] = "'defaultCarrierCode' can't be null";
        }
        if ($this->container['defaultServiceCode'] === null) {
            $invalidProperties[] = "'defaultServiceCode' can't be null";
        }
        if ($this->container['defaultPackageCode'] === null) {
            $invalidProperties[] = "'defaultPackageCode' can't be null";
        }
        if ($this->container['defaultIntlCarrierCode'] === null) {
            $invalidProperties[] = "'defaultIntlCarrierCode' can't be null";
        }
        if ($this->container['defaultIntlServiceCode'] === null) {
            $invalidProperties[] = "'defaultIntlServiceCode' can't be null";
        }
        if ($this->container['defaultIntlPackageCode'] === null) {
            $invalidProperties[] = "'defaultIntlPackageCode' can't be null";
        }
        if ($this->container['defaultConfirmation'] === null) {
            $invalidProperties[] = "'defaultConfirmation' can't be null";
        }
        if ($this->container['defaultIntlConfirmation'] === null) {
            $invalidProperties[] = "'defaultIntlConfirmation' can't be null";
        }
        if ($this->container['tags'] === null) {
            $invalidProperties[] = "'tags' can't be null";
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
     * Gets aliases
     *
     * @return string
     */
    public function getAliases()
    {
        return $this->container['aliases'];
    }

    /**
     * Sets aliases
     *
     * @param string $aliases aliases
     *
     * @return $this
     */
    public function setAliases($aliases)
    {
        $this->container['aliases'] = $aliases;

        return $this;
    }

    /**
     * Gets productId
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->container['productId'];
    }

    /**
     * Sets productId
     *
     * @param int $productId productId
     *
     * @return $this
     */
    public function setProductId($productId)
    {
        $this->container['productId'] = $productId;

        return $this;
    }

    /**
     * Gets sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->container['sku'];
    }

    /**
     * Sets sku
     *
     * @param string $sku sku
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->container['sku'] = $sku;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     *
     * @param int $price price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->container['price'] = $price;

        return $this;
    }

    /**
     * Gets defaultCost
     *
     * @return int
     */
    public function getDefaultCost()
    {
        return $this->container['defaultCost'];
    }

    /**
     * Sets defaultCost
     *
     * @param int $defaultCost defaultCost
     *
     * @return $this
     */
    public function setDefaultCost($defaultCost)
    {
        $this->container['defaultCost'] = $defaultCost;

        return $this;
    }

    /**
     * Gets length
     *
     * @return int
     */
    public function getLength()
    {
        return $this->container['length'];
    }

    /**
     * Sets length
     *
     * @param int $length length
     *
     * @return $this
     */
    public function setLength($length)
    {
        $this->container['length'] = $length;

        return $this;
    }

    /**
     * Gets width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->container['width'];
    }

    /**
     * Sets width
     *
     * @param int $width width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->container['width'] = $width;

        return $this;
    }

    /**
     * Gets height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->container['height'];
    }

    /**
     * Sets height
     *
     * @param int $height height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->container['height'] = $height;

        return $this;
    }

    /**
     * Gets weightOz
     *
     * @return int
     */
    public function getWeightOz()
    {
        return $this->container['weightOz'];
    }

    /**
     * Sets weightOz
     *
     * @param int $weightOz weightOz
     *
     * @return $this
     */
    public function setWeightOz($weightOz)
    {
        $this->container['weightOz'] = $weightOz;

        return $this;
    }

    /**
     * Gets internalNotes
     *
     * @return string
     */
    public function getInternalNotes()
    {
        return $this->container['internalNotes'];
    }

    /**
     * Sets internalNotes
     *
     * @param string $internalNotes internalNotes
     *
     * @return $this
     */
    public function setInternalNotes($internalNotes)
    {
        $this->container['internalNotes'] = $internalNotes;

        return $this;
    }

    /**
     * Gets fulfillmentSku
     *
     * @return string
     */
    public function getFulfillmentSku()
    {
        return $this->container['fulfillmentSku'];
    }

    /**
     * Sets fulfillmentSku
     *
     * @param string $fulfillmentSku fulfillmentSku
     *
     * @return $this
     */
    public function setFulfillmentSku($fulfillmentSku)
    {
        $this->container['fulfillmentSku'] = $fulfillmentSku;

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
     * Gets modifyDate
     *
     * @return string
     */
    public function getModifyDate()
    {
        return $this->container['modifyDate'];
    }

    /**
     * Sets modifyDate
     *
     * @param string $modifyDate modifyDate
     *
     * @return $this
     */
    public function setModifyDate($modifyDate)
    {
        $this->container['modifyDate'] = $modifyDate;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool $active active
     *
     * @return $this
     */
    public function setActive($active)
    {
        $this->container['active'] = $active;

        return $this;
    }

    /**
     * Gets productCategory
     *
     * @return \ShipStation\Model\ProductCategory
     */
    public function getProductCategory()
    {
        return $this->container['productCategory'];
    }

    /**
     * Sets productCategory
     *
     * @param \ShipStation\Model\ProductCategory $productCategory productCategory
     *
     * @return $this
     */
    public function setProductCategory($productCategory)
    {
        $this->container['productCategory'] = $productCategory;

        return $this;
    }

    /**
     * Gets productType
     *
     * @return string
     */
    public function getProductType()
    {
        return $this->container['productType'];
    }

    /**
     * Sets productType
     *
     * @param string $productType productType
     *
     * @return $this
     */
    public function setProductType($productType)
    {
        $this->container['productType'] = $productType;

        return $this;
    }

    /**
     * Gets warehouseLocation
     *
     * @return string
     */
    public function getWarehouseLocation()
    {
        return $this->container['warehouseLocation'];
    }

    /**
     * Sets warehouseLocation
     *
     * @param string $warehouseLocation warehouseLocation
     *
     * @return $this
     */
    public function setWarehouseLocation($warehouseLocation)
    {
        $this->container['warehouseLocation'] = $warehouseLocation;

        return $this;
    }

    /**
     * Gets defaultCarrierCode
     *
     * @return string
     */
    public function getDefaultCarrierCode()
    {
        return $this->container['defaultCarrierCode'];
    }

    /**
     * Sets defaultCarrierCode
     *
     * @param string $defaultCarrierCode defaultCarrierCode
     *
     * @return $this
     */
    public function setDefaultCarrierCode($defaultCarrierCode)
    {
        $this->container['defaultCarrierCode'] = $defaultCarrierCode;

        return $this;
    }

    /**
     * Gets defaultServiceCode
     *
     * @return string
     */
    public function getDefaultServiceCode()
    {
        return $this->container['defaultServiceCode'];
    }

    /**
     * Sets defaultServiceCode
     *
     * @param string $defaultServiceCode defaultServiceCode
     *
     * @return $this
     */
    public function setDefaultServiceCode($defaultServiceCode)
    {
        $this->container['defaultServiceCode'] = $defaultServiceCode;

        return $this;
    }

    /**
     * Gets defaultPackageCode
     *
     * @return string
     */
    public function getDefaultPackageCode()
    {
        return $this->container['defaultPackageCode'];
    }

    /**
     * Sets defaultPackageCode
     *
     * @param string $defaultPackageCode defaultPackageCode
     *
     * @return $this
     */
    public function setDefaultPackageCode($defaultPackageCode)
    {
        $this->container['defaultPackageCode'] = $defaultPackageCode;

        return $this;
    }

    /**
     * Gets defaultIntlCarrierCode
     *
     * @return string
     */
    public function getDefaultIntlCarrierCode()
    {
        return $this->container['defaultIntlCarrierCode'];
    }

    /**
     * Sets defaultIntlCarrierCode
     *
     * @param string $defaultIntlCarrierCode defaultIntlCarrierCode
     *
     * @return $this
     */
    public function setDefaultIntlCarrierCode($defaultIntlCarrierCode)
    {
        $this->container['defaultIntlCarrierCode'] = $defaultIntlCarrierCode;

        return $this;
    }

    /**
     * Gets defaultIntlServiceCode
     *
     * @return string
     */
    public function getDefaultIntlServiceCode()
    {
        return $this->container['defaultIntlServiceCode'];
    }

    /**
     * Sets defaultIntlServiceCode
     *
     * @param string $defaultIntlServiceCode defaultIntlServiceCode
     *
     * @return $this
     */
    public function setDefaultIntlServiceCode($defaultIntlServiceCode)
    {
        $this->container['defaultIntlServiceCode'] = $defaultIntlServiceCode;

        return $this;
    }

    /**
     * Gets defaultIntlPackageCode
     *
     * @return string
     */
    public function getDefaultIntlPackageCode()
    {
        return $this->container['defaultIntlPackageCode'];
    }

    /**
     * Sets defaultIntlPackageCode
     *
     * @param string $defaultIntlPackageCode defaultIntlPackageCode
     *
     * @return $this
     */
    public function setDefaultIntlPackageCode($defaultIntlPackageCode)
    {
        $this->container['defaultIntlPackageCode'] = $defaultIntlPackageCode;

        return $this;
    }

    /**
     * Gets defaultConfirmation
     *
     * @return string
     */
    public function getDefaultConfirmation()
    {
        return $this->container['defaultConfirmation'];
    }

    /**
     * Sets defaultConfirmation
     *
     * @param string $defaultConfirmation defaultConfirmation
     *
     * @return $this
     */
    public function setDefaultConfirmation($defaultConfirmation)
    {
        $this->container['defaultConfirmation'] = $defaultConfirmation;

        return $this;
    }

    /**
     * Gets defaultIntlConfirmation
     *
     * @return string
     */
    public function getDefaultIntlConfirmation()
    {
        return $this->container['defaultIntlConfirmation'];
    }

    /**
     * Sets defaultIntlConfirmation
     *
     * @param string $defaultIntlConfirmation defaultIntlConfirmation
     *
     * @return $this
     */
    public function setDefaultIntlConfirmation($defaultIntlConfirmation)
    {
        $this->container['defaultIntlConfirmation'] = $defaultIntlConfirmation;

        return $this;
    }

    /**
     * Gets customsDescription
     *
     * @return string
     */
    public function getCustomsDescription()
    {
        return $this->container['customsDescription'];
    }

    /**
     * Sets customsDescription
     *
     * @param string $customsDescription customsDescription
     *
     * @return $this
     */
    public function setCustomsDescription($customsDescription)
    {
        $this->container['customsDescription'] = $customsDescription;

        return $this;
    }

    /**
     * Gets customsValue
     *
     * @return string
     */
    public function getCustomsValue()
    {
        return $this->container['customsValue'];
    }

    /**
     * Sets customsValue
     *
     * @param string $customsValue customsValue
     *
     * @return $this
     */
    public function setCustomsValue($customsValue)
    {
        $this->container['customsValue'] = $customsValue;

        return $this;
    }

    /**
     * Gets customsTariffNo
     *
     * @return string
     */
    public function getCustomsTariffNo()
    {
        return $this->container['customsTariffNo'];
    }

    /**
     * Sets customsTariffNo
     *
     * @param string $customsTariffNo customsTariffNo
     *
     * @return $this
     */
    public function setCustomsTariffNo($customsTariffNo)
    {
        $this->container['customsTariffNo'] = $customsTariffNo;

        return $this;
    }

    /**
     * Gets customsCountryCode
     *
     * @return string
     */
    public function getCustomsCountryCode()
    {
        return $this->container['customsCountryCode'];
    }

    /**
     * Sets customsCountryCode
     *
     * @param string $customsCountryCode customsCountryCode
     *
     * @return $this
     */
    public function setCustomsCountryCode($customsCountryCode)
    {
        $this->container['customsCountryCode'] = $customsCountryCode;

        return $this;
    }

    /**
     * Gets noCustoms
     *
     * @return string
     */
    public function getNoCustoms()
    {
        return $this->container['noCustoms'];
    }

    /**
     * Sets noCustoms
     *
     * @param string $noCustoms noCustoms
     *
     * @return $this
     */
    public function setNoCustoms($noCustoms)
    {
        $this->container['noCustoms'] = $noCustoms;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return \ShipStation\Model\Tag[]
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param \ShipStation\Model\Tag[] $tags tags
     *
     * @return $this
     */
    public function setTags($tags)
    {
        $this->container['tags'] = $tags;

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


