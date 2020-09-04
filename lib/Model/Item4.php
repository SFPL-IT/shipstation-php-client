<?php
/**
 * Item4
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
 * Item4 Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Item4 implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Item4';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'orderItemId' => 'int',
        'lineItemKey' => 'string',
        'sku' => 'string',
        'name' => 'string',
        'imageUrl' => 'string',
        'weight' => '\ShipStation\Model\Weight',
        'quantity' => 'int',
        'unitPrice' => 'double',
        'taxAmount' => 'string',
        'shippingAmount' => 'string',
        'warehouseLocation' => 'string',
        'options' => '\ShipStation\Model\Option[]',
        'productId' => 'int',
        'fulfillmentSku' => 'string',
        'adjustment' => 'bool',
        'upc' => 'string',
        'createDate' => 'string',
        'modifyDate' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'orderItemId' => 'int32',
        'lineItemKey' => null,
        'sku' => null,
        'name' => null,
        'imageUrl' => null,
        'weight' => null,
        'quantity' => 'int32',
        'unitPrice' => 'double',
        'taxAmount' => null,
        'shippingAmount' => null,
        'warehouseLocation' => null,
        'options' => null,
        'productId' => 'int32',
        'fulfillmentSku' => null,
        'adjustment' => null,
        'upc' => null,
        'createDate' => null,
        'modifyDate' => null
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
        'orderItemId' => 'orderItemId',
        'lineItemKey' => 'lineItemKey',
        'sku' => 'sku',
        'name' => 'name',
        'imageUrl' => 'imageUrl',
        'weight' => 'weight',
        'quantity' => 'quantity',
        'unitPrice' => 'unitPrice',
        'taxAmount' => 'taxAmount',
        'shippingAmount' => 'shippingAmount',
        'warehouseLocation' => 'warehouseLocation',
        'options' => 'options',
        'productId' => 'productId',
        'fulfillmentSku' => 'fulfillmentSku',
        'adjustment' => 'adjustment',
        'upc' => 'upc',
        'createDate' => 'createDate',
        'modifyDate' => 'modifyDate'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'orderItemId' => 'setOrderItemId',
        'lineItemKey' => 'setLineItemKey',
        'sku' => 'setSku',
        'name' => 'setName',
        'imageUrl' => 'setImageUrl',
        'weight' => 'setWeight',
        'quantity' => 'setQuantity',
        'unitPrice' => 'setUnitPrice',
        'taxAmount' => 'setTaxAmount',
        'shippingAmount' => 'setShippingAmount',
        'warehouseLocation' => 'setWarehouseLocation',
        'options' => 'setOptions',
        'productId' => 'setProductId',
        'fulfillmentSku' => 'setFulfillmentSku',
        'adjustment' => 'setAdjustment',
        'upc' => 'setUpc',
        'createDate' => 'setCreateDate',
        'modifyDate' => 'setModifyDate'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'orderItemId' => 'getOrderItemId',
        'lineItemKey' => 'getLineItemKey',
        'sku' => 'getSku',
        'name' => 'getName',
        'imageUrl' => 'getImageUrl',
        'weight' => 'getWeight',
        'quantity' => 'getQuantity',
        'unitPrice' => 'getUnitPrice',
        'taxAmount' => 'getTaxAmount',
        'shippingAmount' => 'getShippingAmount',
        'warehouseLocation' => 'getWarehouseLocation',
        'options' => 'getOptions',
        'productId' => 'getProductId',
        'fulfillmentSku' => 'getFulfillmentSku',
        'adjustment' => 'getAdjustment',
        'upc' => 'getUpc',
        'createDate' => 'getCreateDate',
        'modifyDate' => 'getModifyDate'
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
        $this->container['orderItemId'] = isset($data['orderItemId']) ? $data['orderItemId'] : null;
        $this->container['lineItemKey'] = isset($data['lineItemKey']) ? $data['lineItemKey'] : null;
        $this->container['sku'] = isset($data['sku']) ? $data['sku'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['imageUrl'] = isset($data['imageUrl']) ? $data['imageUrl'] : null;
        $this->container['weight'] = isset($data['weight']) ? $data['weight'] : null;
        $this->container['quantity'] = isset($data['quantity']) ? $data['quantity'] : null;
        $this->container['unitPrice'] = isset($data['unitPrice']) ? $data['unitPrice'] : null;
        $this->container['taxAmount'] = isset($data['taxAmount']) ? $data['taxAmount'] : null;
        $this->container['shippingAmount'] = isset($data['shippingAmount']) ? $data['shippingAmount'] : null;
        $this->container['warehouseLocation'] = isset($data['warehouseLocation']) ? $data['warehouseLocation'] : null;
        $this->container['options'] = isset($data['options']) ? $data['options'] : null;
        $this->container['productId'] = isset($data['productId']) ? $data['productId'] : null;
        $this->container['fulfillmentSku'] = isset($data['fulfillmentSku']) ? $data['fulfillmentSku'] : null;
        $this->container['adjustment'] = isset($data['adjustment']) ? $data['adjustment'] : null;
        $this->container['upc'] = isset($data['upc']) ? $data['upc'] : null;
        $this->container['createDate'] = isset($data['createDate']) ? $data['createDate'] : null;
        $this->container['modifyDate'] = isset($data['modifyDate']) ? $data['modifyDate'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['orderItemId'] === null) {
            $invalidProperties[] = "'orderItemId' can't be null";
        }
        if ($this->container['sku'] === null) {
            $invalidProperties[] = "'sku' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['weight'] === null) {
            $invalidProperties[] = "'weight' can't be null";
        }
        if ($this->container['quantity'] === null) {
            $invalidProperties[] = "'quantity' can't be null";
        }
        if ($this->container['unitPrice'] === null) {
            $invalidProperties[] = "'unitPrice' can't be null";
        }
        if ($this->container['warehouseLocation'] === null) {
            $invalidProperties[] = "'warehouseLocation' can't be null";
        }
        if ($this->container['options'] === null) {
            $invalidProperties[] = "'options' can't be null";
        }
        if ($this->container['productId'] === null) {
            $invalidProperties[] = "'productId' can't be null";
        }
        if ($this->container['fulfillmentSku'] === null) {
            $invalidProperties[] = "'fulfillmentSku' can't be null";
        }
        if ($this->container['adjustment'] === null) {
            $invalidProperties[] = "'adjustment' can't be null";
        }
        if ($this->container['createDate'] === null) {
            $invalidProperties[] = "'createDate' can't be null";
        }
        if ($this->container['modifyDate'] === null) {
            $invalidProperties[] = "'modifyDate' can't be null";
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
     * Gets orderItemId
     *
     * @return int
     */
    public function getOrderItemId()
    {
        return $this->container['orderItemId'];
    }

    /**
     * Sets orderItemId
     *
     * @param int $orderItemId orderItemId
     *
     * @return $this
     */
    public function setOrderItemId($orderItemId)
    {
        $this->container['orderItemId'] = $orderItemId;

        return $this;
    }

    /**
     * Gets lineItemKey
     *
     * @return string
     */
    public function getLineItemKey()
    {
        return $this->container['lineItemKey'];
    }

    /**
     * Sets lineItemKey
     *
     * @param string $lineItemKey lineItemKey
     *
     * @return $this
     */
    public function setLineItemKey($lineItemKey)
    {
        $this->container['lineItemKey'] = $lineItemKey;

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
     * Gets imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->container['imageUrl'];
    }

    /**
     * Sets imageUrl
     *
     * @param string $imageUrl imageUrl
     *
     * @return $this
     */
    public function setImageUrl($imageUrl)
    {
        $this->container['imageUrl'] = $imageUrl;

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
     * Gets quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity
     *
     * @param int $quantity quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->container['quantity'] = $quantity;

        return $this;
    }

    /**
     * Gets unitPrice
     *
     * @return double
     */
    public function getUnitPrice()
    {
        return $this->container['unitPrice'];
    }

    /**
     * Sets unitPrice
     *
     * @param double $unitPrice unitPrice
     *
     * @return $this
     */
    public function setUnitPrice($unitPrice)
    {
        $this->container['unitPrice'] = $unitPrice;

        return $this;
    }

    /**
     * Gets taxAmount
     *
     * @return string
     */
    public function getTaxAmount()
    {
        return $this->container['taxAmount'];
    }

    /**
     * Sets taxAmount
     *
     * @param string $taxAmount taxAmount
     *
     * @return $this
     */
    public function setTaxAmount($taxAmount)
    {
        $this->container['taxAmount'] = $taxAmount;

        return $this;
    }

    /**
     * Gets shippingAmount
     *
     * @return string
     */
    public function getShippingAmount()
    {
        return $this->container['shippingAmount'];
    }

    /**
     * Sets shippingAmount
     *
     * @param string $shippingAmount shippingAmount
     *
     * @return $this
     */
    public function setShippingAmount($shippingAmount)
    {
        $this->container['shippingAmount'] = $shippingAmount;

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
     * Gets options
     *
     * @return \ShipStation\Model\Option[]
     */
    public function getOptions()
    {
        return $this->container['options'];
    }

    /**
     * Sets options
     *
     * @param \ShipStation\Model\Option[] $options options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        $this->container['options'] = $options;

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
     * Gets adjustment
     *
     * @return bool
     */
    public function getAdjustment()
    {
        return $this->container['adjustment'];
    }

    /**
     * Sets adjustment
     *
     * @param bool $adjustment adjustment
     *
     * @return $this
     */
    public function setAdjustment($adjustment)
    {
        $this->container['adjustment'] = $adjustment;

        return $this;
    }

    /**
     * Gets upc
     *
     * @return string
     */
    public function getUpc()
    {
        return $this->container['upc'];
    }

    /**
     * Sets upc
     *
     * @param string $upc upc
     *
     * @return $this
     */
    public function setUpc($upc)
    {
        $this->container['upc'] = $upc;

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


