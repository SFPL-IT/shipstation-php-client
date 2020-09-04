<?php
/**
 * Webhook
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
 * Webhook Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Webhook implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Webhook';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'isLabelAPIHook' => 'bool',
        'webHookID' => 'int',
        'sellerID' => 'int',
        'storeID' => 'int',
        'hookType' => 'string',
        'messageFormat' => 'string',
        'url' => 'string',
        'name' => 'string',
        'bulkCopyBatchID' => 'string',
        'bulkCopyRecordID' => 'string',
        'active' => 'bool',
        'webhookLogs' => 'string[]',
        'seller' => 'string',
        'store' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'isLabelAPIHook' => null,
        'webHookID' => 'int32',
        'sellerID' => 'int32',
        'storeID' => 'int32',
        'hookType' => null,
        'messageFormat' => null,
        'url' => null,
        'name' => null,
        'bulkCopyBatchID' => null,
        'bulkCopyRecordID' => null,
        'active' => null,
        'webhookLogs' => null,
        'seller' => null,
        'store' => null
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
        'isLabelAPIHook' => 'IsLabelAPIHook',
        'webHookID' => 'WebHookID',
        'sellerID' => 'SellerID',
        'storeID' => 'StoreID',
        'hookType' => 'HookType',
        'messageFormat' => 'MessageFormat',
        'url' => 'Url',
        'name' => 'Name',
        'bulkCopyBatchID' => 'BulkCopyBatchID',
        'bulkCopyRecordID' => 'BulkCopyRecordID',
        'active' => 'Active',
        'webhookLogs' => 'WebhookLogs',
        'seller' => 'Seller',
        'store' => 'Store'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'isLabelAPIHook' => 'setIsLabelAPIHook',
        'webHookID' => 'setWebHookID',
        'sellerID' => 'setSellerID',
        'storeID' => 'setStoreID',
        'hookType' => 'setHookType',
        'messageFormat' => 'setMessageFormat',
        'url' => 'setUrl',
        'name' => 'setName',
        'bulkCopyBatchID' => 'setBulkCopyBatchID',
        'bulkCopyRecordID' => 'setBulkCopyRecordID',
        'active' => 'setActive',
        'webhookLogs' => 'setWebhookLogs',
        'seller' => 'setSeller',
        'store' => 'setStore'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'isLabelAPIHook' => 'getIsLabelAPIHook',
        'webHookID' => 'getWebHookID',
        'sellerID' => 'getSellerID',
        'storeID' => 'getStoreID',
        'hookType' => 'getHookType',
        'messageFormat' => 'getMessageFormat',
        'url' => 'getUrl',
        'name' => 'getName',
        'bulkCopyBatchID' => 'getBulkCopyBatchID',
        'bulkCopyRecordID' => 'getBulkCopyRecordID',
        'active' => 'getActive',
        'webhookLogs' => 'getWebhookLogs',
        'seller' => 'getSeller',
        'store' => 'getStore'
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
        $this->container['isLabelAPIHook'] = isset($data['isLabelAPIHook']) ? $data['isLabelAPIHook'] : null;
        $this->container['webHookID'] = isset($data['webHookID']) ? $data['webHookID'] : null;
        $this->container['sellerID'] = isset($data['sellerID']) ? $data['sellerID'] : null;
        $this->container['storeID'] = isset($data['storeID']) ? $data['storeID'] : null;
        $this->container['hookType'] = isset($data['hookType']) ? $data['hookType'] : null;
        $this->container['messageFormat'] = isset($data['messageFormat']) ? $data['messageFormat'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['bulkCopyBatchID'] = isset($data['bulkCopyBatchID']) ? $data['bulkCopyBatchID'] : null;
        $this->container['bulkCopyRecordID'] = isset($data['bulkCopyRecordID']) ? $data['bulkCopyRecordID'] : null;
        $this->container['active'] = isset($data['active']) ? $data['active'] : null;
        $this->container['webhookLogs'] = isset($data['webhookLogs']) ? $data['webhookLogs'] : null;
        $this->container['seller'] = isset($data['seller']) ? $data['seller'] : null;
        $this->container['store'] = isset($data['store']) ? $data['store'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['isLabelAPIHook'] === null) {
            $invalidProperties[] = "'isLabelAPIHook' can't be null";
        }
        if ($this->container['webHookID'] === null) {
            $invalidProperties[] = "'webHookID' can't be null";
        }
        if ($this->container['sellerID'] === null) {
            $invalidProperties[] = "'sellerID' can't be null";
        }
        if ($this->container['storeID'] === null) {
            $invalidProperties[] = "'storeID' can't be null";
        }
        if ($this->container['hookType'] === null) {
            $invalidProperties[] = "'hookType' can't be null";
        }
        if ($this->container['messageFormat'] === null) {
            $invalidProperties[] = "'messageFormat' can't be null";
        }
        if ($this->container['url'] === null) {
            $invalidProperties[] = "'url' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['active'] === null) {
            $invalidProperties[] = "'active' can't be null";
        }
        if ($this->container['webhookLogs'] === null) {
            $invalidProperties[] = "'webhookLogs' can't be null";
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
     * Gets isLabelAPIHook
     *
     * @return bool
     */
    public function getIsLabelAPIHook()
    {
        return $this->container['isLabelAPIHook'];
    }

    /**
     * Sets isLabelAPIHook
     *
     * @param bool $isLabelAPIHook isLabelAPIHook
     *
     * @return $this
     */
    public function setIsLabelAPIHook($isLabelAPIHook)
    {
        $this->container['isLabelAPIHook'] = $isLabelAPIHook;

        return $this;
    }

    /**
     * Gets webHookID
     *
     * @return int
     */
    public function getWebHookID()
    {
        return $this->container['webHookID'];
    }

    /**
     * Sets webHookID
     *
     * @param int $webHookID webHookID
     *
     * @return $this
     */
    public function setWebHookID($webHookID)
    {
        $this->container['webHookID'] = $webHookID;

        return $this;
    }

    /**
     * Gets sellerID
     *
     * @return int
     */
    public function getSellerID()
    {
        return $this->container['sellerID'];
    }

    /**
     * Sets sellerID
     *
     * @param int $sellerID sellerID
     *
     * @return $this
     */
    public function setSellerID($sellerID)
    {
        $this->container['sellerID'] = $sellerID;

        return $this;
    }

    /**
     * Gets storeID
     *
     * @return int
     */
    public function getStoreID()
    {
        return $this->container['storeID'];
    }

    /**
     * Sets storeID
     *
     * @param int $storeID storeID
     *
     * @return $this
     */
    public function setStoreID($storeID)
    {
        $this->container['storeID'] = $storeID;

        return $this;
    }

    /**
     * Gets hookType
     *
     * @return string
     */
    public function getHookType()
    {
        return $this->container['hookType'];
    }

    /**
     * Sets hookType
     *
     * @param string $hookType hookType
     *
     * @return $this
     */
    public function setHookType($hookType)
    {
        $this->container['hookType'] = $hookType;

        return $this;
    }

    /**
     * Gets messageFormat
     *
     * @return string
     */
    public function getMessageFormat()
    {
        return $this->container['messageFormat'];
    }

    /**
     * Sets messageFormat
     *
     * @param string $messageFormat messageFormat
     *
     * @return $this
     */
    public function setMessageFormat($messageFormat)
    {
        $this->container['messageFormat'] = $messageFormat;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string $url url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

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
     * Gets bulkCopyBatchID
     *
     * @return string
     */
    public function getBulkCopyBatchID()
    {
        return $this->container['bulkCopyBatchID'];
    }

    /**
     * Sets bulkCopyBatchID
     *
     * @param string $bulkCopyBatchID bulkCopyBatchID
     *
     * @return $this
     */
    public function setBulkCopyBatchID($bulkCopyBatchID)
    {
        $this->container['bulkCopyBatchID'] = $bulkCopyBatchID;

        return $this;
    }

    /**
     * Gets bulkCopyRecordID
     *
     * @return string
     */
    public function getBulkCopyRecordID()
    {
        return $this->container['bulkCopyRecordID'];
    }

    /**
     * Sets bulkCopyRecordID
     *
     * @param string $bulkCopyRecordID bulkCopyRecordID
     *
     * @return $this
     */
    public function setBulkCopyRecordID($bulkCopyRecordID)
    {
        $this->container['bulkCopyRecordID'] = $bulkCopyRecordID;

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
     * Gets webhookLogs
     *
     * @return string[]
     */
    public function getWebhookLogs()
    {
        return $this->container['webhookLogs'];
    }

    /**
     * Sets webhookLogs
     *
     * @param string[] $webhookLogs webhookLogs
     *
     * @return $this
     */
    public function setWebhookLogs($webhookLogs)
    {
        $this->container['webhookLogs'] = $webhookLogs;

        return $this;
    }

    /**
     * Gets seller
     *
     * @return string
     */
    public function getSeller()
    {
        return $this->container['seller'];
    }

    /**
     * Sets seller
     *
     * @param string $seller seller
     *
     * @return $this
     */
    public function setSeller($seller)
    {
        $this->container['seller'] = $seller;

        return $this;
    }

    /**
     * Gets store
     *
     * @return string
     */
    public function getStore()
    {
        return $this->container['store'];
    }

    /**
     * Sets store
     *
     * @param string $store store
     *
     * @return $this
     */
    public function setStore($store)
    {
        $this->container['store'] = $store;

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


