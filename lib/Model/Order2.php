<?php
/**
 * Order2
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
 * Order2 Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Order2 implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Order2';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'orderId' => 'int',
        'orderNumber' => 'string',
        'orderKey' => 'string',
        'orderDate' => 'string',
        'createDate' => 'string',
        'modifyDate' => 'string',
        'paymentDate' => 'string',
        'shipByDate' => 'string',
        'orderStatus' => 'string',
        'customerId' => 'int',
        'customerUsername' => 'string',
        'customerEmail' => 'string',
        'billTo' => '\ShipStation\Model\BillTo',
        'shipTo' => '\ShipStation\Model\ShipTo2',
        'items' => '\ShipStation\Model\Item6[]',
        'orderTotal' => 'double',
        'amountPaid' => 'double',
        'taxAmount' => 'int',
        'shippingAmount' => 'int',
        'customerNotes' => 'string',
        'internalNotes' => 'string',
        'gift' => 'bool',
        'giftMessage' => 'string',
        'paymentMethod' => 'string',
        'requestedShippingService' => 'string',
        'carrierCode' => 'string',
        'serviceCode' => 'string',
        'packageCode' => 'string',
        'confirmation' => 'string',
        'shipDate' => 'string',
        'holdUntilDate' => 'string',
        'weight' => '\ShipStation\Model\Weight',
        'dimensions' => '\ShipStation\Model\Dimensions',
        'insuranceOptions' => '\ShipStation\Model\InsuranceOptions',
        'internationalOptions' => '\ShipStation\Model\InternationalOptions',
        'advancedOptions' => '\ShipStation\Model\AdvancedOptions',
        'tagIds' => 'int[]',
        'userId' => 'string',
        'externallyFulfilled' => 'bool',
        'externallyFulfilledBy' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'orderId' => 'int32',
        'orderNumber' => null,
        'orderKey' => null,
        'orderDate' => null,
        'createDate' => null,
        'modifyDate' => null,
        'paymentDate' => null,
        'shipByDate' => null,
        'orderStatus' => null,
        'customerId' => 'int32',
        'customerUsername' => null,
        'customerEmail' => null,
        'billTo' => null,
        'shipTo' => null,
        'items' => null,
        'orderTotal' => 'double',
        'amountPaid' => 'double',
        'taxAmount' => 'int32',
        'shippingAmount' => 'int32',
        'customerNotes' => null,
        'internalNotes' => null,
        'gift' => null,
        'giftMessage' => null,
        'paymentMethod' => null,
        'requestedShippingService' => null,
        'carrierCode' => null,
        'serviceCode' => null,
        'packageCode' => null,
        'confirmation' => null,
        'shipDate' => null,
        'holdUntilDate' => null,
        'weight' => null,
        'dimensions' => null,
        'insuranceOptions' => null,
        'internationalOptions' => null,
        'advancedOptions' => null,
        'tagIds' => 'int32',
        'userId' => null,
        'externallyFulfilled' => null,
        'externallyFulfilledBy' => null
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
        'orderId' => 'orderId',
        'orderNumber' => 'orderNumber',
        'orderKey' => 'orderKey',
        'orderDate' => 'orderDate',
        'createDate' => 'createDate',
        'modifyDate' => 'modifyDate',
        'paymentDate' => 'paymentDate',
        'shipByDate' => 'shipByDate',
        'orderStatus' => 'orderStatus',
        'customerId' => 'customerId',
        'customerUsername' => 'customerUsername',
        'customerEmail' => 'customerEmail',
        'billTo' => 'billTo',
        'shipTo' => 'shipTo',
        'items' => 'items',
        'orderTotal' => 'orderTotal',
        'amountPaid' => 'amountPaid',
        'taxAmount' => 'taxAmount',
        'shippingAmount' => 'shippingAmount',
        'customerNotes' => 'customerNotes',
        'internalNotes' => 'internalNotes',
        'gift' => 'gift',
        'giftMessage' => 'giftMessage',
        'paymentMethod' => 'paymentMethod',
        'requestedShippingService' => 'requestedShippingService',
        'carrierCode' => 'carrierCode',
        'serviceCode' => 'serviceCode',
        'packageCode' => 'packageCode',
        'confirmation' => 'confirmation',
        'shipDate' => 'shipDate',
        'holdUntilDate' => 'holdUntilDate',
        'weight' => 'weight',
        'dimensions' => 'dimensions',
        'insuranceOptions' => 'insuranceOptions',
        'internationalOptions' => 'internationalOptions',
        'advancedOptions' => 'advancedOptions',
        'tagIds' => 'tagIds',
        'userId' => 'userId',
        'externallyFulfilled' => 'externallyFulfilled',
        'externallyFulfilledBy' => 'externallyFulfilledBy'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'orderId' => 'setOrderId',
        'orderNumber' => 'setOrderNumber',
        'orderKey' => 'setOrderKey',
        'orderDate' => 'setOrderDate',
        'createDate' => 'setCreateDate',
        'modifyDate' => 'setModifyDate',
        'paymentDate' => 'setPaymentDate',
        'shipByDate' => 'setShipByDate',
        'orderStatus' => 'setOrderStatus',
        'customerId' => 'setCustomerId',
        'customerUsername' => 'setCustomerUsername',
        'customerEmail' => 'setCustomerEmail',
        'billTo' => 'setBillTo',
        'shipTo' => 'setShipTo',
        'items' => 'setItems',
        'orderTotal' => 'setOrderTotal',
        'amountPaid' => 'setAmountPaid',
        'taxAmount' => 'setTaxAmount',
        'shippingAmount' => 'setShippingAmount',
        'customerNotes' => 'setCustomerNotes',
        'internalNotes' => 'setInternalNotes',
        'gift' => 'setGift',
        'giftMessage' => 'setGiftMessage',
        'paymentMethod' => 'setPaymentMethod',
        'requestedShippingService' => 'setRequestedShippingService',
        'carrierCode' => 'setCarrierCode',
        'serviceCode' => 'setServiceCode',
        'packageCode' => 'setPackageCode',
        'confirmation' => 'setConfirmation',
        'shipDate' => 'setShipDate',
        'holdUntilDate' => 'setHoldUntilDate',
        'weight' => 'setWeight',
        'dimensions' => 'setDimensions',
        'insuranceOptions' => 'setInsuranceOptions',
        'internationalOptions' => 'setInternationalOptions',
        'advancedOptions' => 'setAdvancedOptions',
        'tagIds' => 'setTagIds',
        'userId' => 'setUserId',
        'externallyFulfilled' => 'setExternallyFulfilled',
        'externallyFulfilledBy' => 'setExternallyFulfilledBy'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'orderId' => 'getOrderId',
        'orderNumber' => 'getOrderNumber',
        'orderKey' => 'getOrderKey',
        'orderDate' => 'getOrderDate',
        'createDate' => 'getCreateDate',
        'modifyDate' => 'getModifyDate',
        'paymentDate' => 'getPaymentDate',
        'shipByDate' => 'getShipByDate',
        'orderStatus' => 'getOrderStatus',
        'customerId' => 'getCustomerId',
        'customerUsername' => 'getCustomerUsername',
        'customerEmail' => 'getCustomerEmail',
        'billTo' => 'getBillTo',
        'shipTo' => 'getShipTo',
        'items' => 'getItems',
        'orderTotal' => 'getOrderTotal',
        'amountPaid' => 'getAmountPaid',
        'taxAmount' => 'getTaxAmount',
        'shippingAmount' => 'getShippingAmount',
        'customerNotes' => 'getCustomerNotes',
        'internalNotes' => 'getInternalNotes',
        'gift' => 'getGift',
        'giftMessage' => 'getGiftMessage',
        'paymentMethod' => 'getPaymentMethod',
        'requestedShippingService' => 'getRequestedShippingService',
        'carrierCode' => 'getCarrierCode',
        'serviceCode' => 'getServiceCode',
        'packageCode' => 'getPackageCode',
        'confirmation' => 'getConfirmation',
        'shipDate' => 'getShipDate',
        'holdUntilDate' => 'getHoldUntilDate',
        'weight' => 'getWeight',
        'dimensions' => 'getDimensions',
        'insuranceOptions' => 'getInsuranceOptions',
        'internationalOptions' => 'getInternationalOptions',
        'advancedOptions' => 'getAdvancedOptions',
        'tagIds' => 'getTagIds',
        'userId' => 'getUserId',
        'externallyFulfilled' => 'getExternallyFulfilled',
        'externallyFulfilledBy' => 'getExternallyFulfilledBy'
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
        $this->container['orderId'] = isset($data['orderId']) ? $data['orderId'] : null;
        $this->container['orderNumber'] = isset($data['orderNumber']) ? $data['orderNumber'] : null;
        $this->container['orderKey'] = isset($data['orderKey']) ? $data['orderKey'] : null;
        $this->container['orderDate'] = isset($data['orderDate']) ? $data['orderDate'] : null;
        $this->container['createDate'] = isset($data['createDate']) ? $data['createDate'] : null;
        $this->container['modifyDate'] = isset($data['modifyDate']) ? $data['modifyDate'] : null;
        $this->container['paymentDate'] = isset($data['paymentDate']) ? $data['paymentDate'] : null;
        $this->container['shipByDate'] = isset($data['shipByDate']) ? $data['shipByDate'] : null;
        $this->container['orderStatus'] = isset($data['orderStatus']) ? $data['orderStatus'] : null;
        $this->container['customerId'] = isset($data['customerId']) ? $data['customerId'] : null;
        $this->container['customerUsername'] = isset($data['customerUsername']) ? $data['customerUsername'] : null;
        $this->container['customerEmail'] = isset($data['customerEmail']) ? $data['customerEmail'] : null;
        $this->container['billTo'] = isset($data['billTo']) ? $data['billTo'] : null;
        $this->container['shipTo'] = isset($data['shipTo']) ? $data['shipTo'] : null;
        $this->container['items'] = isset($data['items']) ? $data['items'] : null;
        $this->container['orderTotal'] = isset($data['orderTotal']) ? $data['orderTotal'] : null;
        $this->container['amountPaid'] = isset($data['amountPaid']) ? $data['amountPaid'] : null;
        $this->container['taxAmount'] = isset($data['taxAmount']) ? $data['taxAmount'] : null;
        $this->container['shippingAmount'] = isset($data['shippingAmount']) ? $data['shippingAmount'] : null;
        $this->container['customerNotes'] = isset($data['customerNotes']) ? $data['customerNotes'] : null;
        $this->container['internalNotes'] = isset($data['internalNotes']) ? $data['internalNotes'] : null;
        $this->container['gift'] = isset($data['gift']) ? $data['gift'] : null;
        $this->container['giftMessage'] = isset($data['giftMessage']) ? $data['giftMessage'] : null;
        $this->container['paymentMethod'] = isset($data['paymentMethod']) ? $data['paymentMethod'] : null;
        $this->container['requestedShippingService'] = isset($data['requestedShippingService']) ? $data['requestedShippingService'] : null;
        $this->container['carrierCode'] = isset($data['carrierCode']) ? $data['carrierCode'] : null;
        $this->container['serviceCode'] = isset($data['serviceCode']) ? $data['serviceCode'] : null;
        $this->container['packageCode'] = isset($data['packageCode']) ? $data['packageCode'] : null;
        $this->container['confirmation'] = isset($data['confirmation']) ? $data['confirmation'] : null;
        $this->container['shipDate'] = isset($data['shipDate']) ? $data['shipDate'] : null;
        $this->container['holdUntilDate'] = isset($data['holdUntilDate']) ? $data['holdUntilDate'] : null;
        $this->container['weight'] = isset($data['weight']) ? $data['weight'] : null;
        $this->container['dimensions'] = isset($data['dimensions']) ? $data['dimensions'] : null;
        $this->container['insuranceOptions'] = isset($data['insuranceOptions']) ? $data['insuranceOptions'] : null;
        $this->container['internationalOptions'] = isset($data['internationalOptions']) ? $data['internationalOptions'] : null;
        $this->container['advancedOptions'] = isset($data['advancedOptions']) ? $data['advancedOptions'] : null;
        $this->container['tagIds'] = isset($data['tagIds']) ? $data['tagIds'] : null;
        $this->container['userId'] = isset($data['userId']) ? $data['userId'] : null;
        $this->container['externallyFulfilled'] = isset($data['externallyFulfilled']) ? $data['externallyFulfilled'] : null;
        $this->container['externallyFulfilledBy'] = isset($data['externallyFulfilledBy']) ? $data['externallyFulfilledBy'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['orderId'] === null) {
            $invalidProperties[] = "'orderId' can't be null";
        }
        if ($this->container['orderNumber'] === null) {
            $invalidProperties[] = "'orderNumber' can't be null";
        }
        if ($this->container['orderKey'] === null) {
            $invalidProperties[] = "'orderKey' can't be null";
        }
        if ($this->container['orderDate'] === null) {
            $invalidProperties[] = "'orderDate' can't be null";
        }
        if ($this->container['createDate'] === null) {
            $invalidProperties[] = "'createDate' can't be null";
        }
        if ($this->container['modifyDate'] === null) {
            $invalidProperties[] = "'modifyDate' can't be null";
        }
        if ($this->container['paymentDate'] === null) {
            $invalidProperties[] = "'paymentDate' can't be null";
        }
        if ($this->container['shipByDate'] === null) {
            $invalidProperties[] = "'shipByDate' can't be null";
        }
        if ($this->container['orderStatus'] === null) {
            $invalidProperties[] = "'orderStatus' can't be null";
        }
        if ($this->container['customerId'] === null) {
            $invalidProperties[] = "'customerId' can't be null";
        }
        if ($this->container['customerUsername'] === null) {
            $invalidProperties[] = "'customerUsername' can't be null";
        }
        if ($this->container['customerEmail'] === null) {
            $invalidProperties[] = "'customerEmail' can't be null";
        }
        if ($this->container['billTo'] === null) {
            $invalidProperties[] = "'billTo' can't be null";
        }
        if ($this->container['shipTo'] === null) {
            $invalidProperties[] = "'shipTo' can't be null";
        }
        if ($this->container['items'] === null) {
            $invalidProperties[] = "'items' can't be null";
        }
        if ($this->container['orderTotal'] === null) {
            $invalidProperties[] = "'orderTotal' can't be null";
        }
        if ($this->container['amountPaid'] === null) {
            $invalidProperties[] = "'amountPaid' can't be null";
        }
        if ($this->container['taxAmount'] === null) {
            $invalidProperties[] = "'taxAmount' can't be null";
        }
        if ($this->container['shippingAmount'] === null) {
            $invalidProperties[] = "'shippingAmount' can't be null";
        }
        if ($this->container['customerNotes'] === null) {
            $invalidProperties[] = "'customerNotes' can't be null";
        }
        if ($this->container['internalNotes'] === null) {
            $invalidProperties[] = "'internalNotes' can't be null";
        }
        if ($this->container['gift'] === null) {
            $invalidProperties[] = "'gift' can't be null";
        }
        if ($this->container['giftMessage'] === null) {
            $invalidProperties[] = "'giftMessage' can't be null";
        }
        if ($this->container['paymentMethod'] === null) {
            $invalidProperties[] = "'paymentMethod' can't be null";
        }
        if ($this->container['requestedShippingService'] === null) {
            $invalidProperties[] = "'requestedShippingService' can't be null";
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
        if ($this->container['shipDate'] === null) {
            $invalidProperties[] = "'shipDate' can't be null";
        }
        if ($this->container['weight'] === null) {
            $invalidProperties[] = "'weight' can't be null";
        }
        if ($this->container['dimensions'] === null) {
            $invalidProperties[] = "'dimensions' can't be null";
        }
        if ($this->container['insuranceOptions'] === null) {
            $invalidProperties[] = "'insuranceOptions' can't be null";
        }
        if ($this->container['internationalOptions'] === null) {
            $invalidProperties[] = "'internationalOptions' can't be null";
        }
        if ($this->container['advancedOptions'] === null) {
            $invalidProperties[] = "'advancedOptions' can't be null";
        }
        if ($this->container['tagIds'] === null) {
            $invalidProperties[] = "'tagIds' can't be null";
        }
        if ($this->container['userId'] === null) {
            $invalidProperties[] = "'userId' can't be null";
        }
        if ($this->container['externallyFulfilled'] === null) {
            $invalidProperties[] = "'externallyFulfilled' can't be null";
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
     * Gets orderDate
     *
     * @return string
     */
    public function getOrderDate()
    {
        return $this->container['orderDate'];
    }

    /**
     * Sets orderDate
     *
     * @param string $orderDate orderDate
     *
     * @return $this
     */
    public function setOrderDate($orderDate)
    {
        $this->container['orderDate'] = $orderDate;

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
     * Gets paymentDate
     *
     * @return string
     */
    public function getPaymentDate()
    {
        return $this->container['paymentDate'];
    }

    /**
     * Sets paymentDate
     *
     * @param string $paymentDate paymentDate
     *
     * @return $this
     */
    public function setPaymentDate($paymentDate)
    {
        $this->container['paymentDate'] = $paymentDate;

        return $this;
    }

    /**
     * Gets shipByDate
     *
     * @return string
     */
    public function getShipByDate()
    {
        return $this->container['shipByDate'];
    }

    /**
     * Sets shipByDate
     *
     * @param string $shipByDate shipByDate
     *
     * @return $this
     */
    public function setShipByDate($shipByDate)
    {
        $this->container['shipByDate'] = $shipByDate;

        return $this;
    }

    /**
     * Gets orderStatus
     *
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->container['orderStatus'];
    }

    /**
     * Sets orderStatus
     *
     * @param string $orderStatus orderStatus
     *
     * @return $this
     */
    public function setOrderStatus($orderStatus)
    {
        $this->container['orderStatus'] = $orderStatus;

        return $this;
    }

    /**
     * Gets customerId
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->container['customerId'];
    }

    /**
     * Sets customerId
     *
     * @param int $customerId customerId
     *
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $this->container['customerId'] = $customerId;

        return $this;
    }

    /**
     * Gets customerUsername
     *
     * @return string
     */
    public function getCustomerUsername()
    {
        return $this->container['customerUsername'];
    }

    /**
     * Sets customerUsername
     *
     * @param string $customerUsername customerUsername
     *
     * @return $this
     */
    public function setCustomerUsername($customerUsername)
    {
        $this->container['customerUsername'] = $customerUsername;

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
     * Gets billTo
     *
     * @return \ShipStation\Model\BillTo
     */
    public function getBillTo()
    {
        return $this->container['billTo'];
    }

    /**
     * Sets billTo
     *
     * @param \ShipStation\Model\BillTo $billTo billTo
     *
     * @return $this
     */
    public function setBillTo($billTo)
    {
        $this->container['billTo'] = $billTo;

        return $this;
    }

    /**
     * Gets shipTo
     *
     * @return \ShipStation\Model\ShipTo2
     */
    public function getShipTo()
    {
        return $this->container['shipTo'];
    }

    /**
     * Sets shipTo
     *
     * @param \ShipStation\Model\ShipTo2 $shipTo shipTo
     *
     * @return $this
     */
    public function setShipTo($shipTo)
    {
        $this->container['shipTo'] = $shipTo;

        return $this;
    }

    /**
     * Gets items
     *
     * @return \ShipStation\Model\Item6[]
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \ShipStation\Model\Item6[] $items items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets orderTotal
     *
     * @return double
     */
    public function getOrderTotal()
    {
        return $this->container['orderTotal'];
    }

    /**
     * Sets orderTotal
     *
     * @param double $orderTotal orderTotal
     *
     * @return $this
     */
    public function setOrderTotal($orderTotal)
    {
        $this->container['orderTotal'] = $orderTotal;

        return $this;
    }

    /**
     * Gets amountPaid
     *
     * @return double
     */
    public function getAmountPaid()
    {
        return $this->container['amountPaid'];
    }

    /**
     * Sets amountPaid
     *
     * @param double $amountPaid amountPaid
     *
     * @return $this
     */
    public function setAmountPaid($amountPaid)
    {
        $this->container['amountPaid'] = $amountPaid;

        return $this;
    }

    /**
     * Gets taxAmount
     *
     * @return int
     */
    public function getTaxAmount()
    {
        return $this->container['taxAmount'];
    }

    /**
     * Sets taxAmount
     *
     * @param int $taxAmount taxAmount
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
     * @return int
     */
    public function getShippingAmount()
    {
        return $this->container['shippingAmount'];
    }

    /**
     * Sets shippingAmount
     *
     * @param int $shippingAmount shippingAmount
     *
     * @return $this
     */
    public function setShippingAmount($shippingAmount)
    {
        $this->container['shippingAmount'] = $shippingAmount;

        return $this;
    }

    /**
     * Gets customerNotes
     *
     * @return string
     */
    public function getCustomerNotes()
    {
        return $this->container['customerNotes'];
    }

    /**
     * Sets customerNotes
     *
     * @param string $customerNotes customerNotes
     *
     * @return $this
     */
    public function setCustomerNotes($customerNotes)
    {
        $this->container['customerNotes'] = $customerNotes;

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
     * Gets gift
     *
     * @return bool
     */
    public function getGift()
    {
        return $this->container['gift'];
    }

    /**
     * Sets gift
     *
     * @param bool $gift gift
     *
     * @return $this
     */
    public function setGift($gift)
    {
        $this->container['gift'] = $gift;

        return $this;
    }

    /**
     * Gets giftMessage
     *
     * @return string
     */
    public function getGiftMessage()
    {
        return $this->container['giftMessage'];
    }

    /**
     * Sets giftMessage
     *
     * @param string $giftMessage giftMessage
     *
     * @return $this
     */
    public function setGiftMessage($giftMessage)
    {
        $this->container['giftMessage'] = $giftMessage;

        return $this;
    }

    /**
     * Gets paymentMethod
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->container['paymentMethod'];
    }

    /**
     * Sets paymentMethod
     *
     * @param string $paymentMethod paymentMethod
     *
     * @return $this
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->container['paymentMethod'] = $paymentMethod;

        return $this;
    }

    /**
     * Gets requestedShippingService
     *
     * @return string
     */
    public function getRequestedShippingService()
    {
        return $this->container['requestedShippingService'];
    }

    /**
     * Sets requestedShippingService
     *
     * @param string $requestedShippingService requestedShippingService
     *
     * @return $this
     */
    public function setRequestedShippingService($requestedShippingService)
    {
        $this->container['requestedShippingService'] = $requestedShippingService;

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
     * Gets holdUntilDate
     *
     * @return string
     */
    public function getHoldUntilDate()
    {
        return $this->container['holdUntilDate'];
    }

    /**
     * Sets holdUntilDate
     *
     * @param string $holdUntilDate holdUntilDate
     *
     * @return $this
     */
    public function setHoldUntilDate($holdUntilDate)
    {
        $this->container['holdUntilDate'] = $holdUntilDate;

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
     * @return \ShipStation\Model\Dimensions
     */
    public function getDimensions()
    {
        return $this->container['dimensions'];
    }

    /**
     * Sets dimensions
     *
     * @param \ShipStation\Model\Dimensions $dimensions dimensions
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
     * @return \ShipStation\Model\InsuranceOptions
     */
    public function getInsuranceOptions()
    {
        return $this->container['insuranceOptions'];
    }

    /**
     * Sets insuranceOptions
     *
     * @param \ShipStation\Model\InsuranceOptions $insuranceOptions insuranceOptions
     *
     * @return $this
     */
    public function setInsuranceOptions($insuranceOptions)
    {
        $this->container['insuranceOptions'] = $insuranceOptions;

        return $this;
    }

    /**
     * Gets internationalOptions
     *
     * @return \ShipStation\Model\InternationalOptions
     */
    public function getInternationalOptions()
    {
        return $this->container['internationalOptions'];
    }

    /**
     * Sets internationalOptions
     *
     * @param \ShipStation\Model\InternationalOptions $internationalOptions internationalOptions
     *
     * @return $this
     */
    public function setInternationalOptions($internationalOptions)
    {
        $this->container['internationalOptions'] = $internationalOptions;

        return $this;
    }

    /**
     * Gets advancedOptions
     *
     * @return \ShipStation\Model\AdvancedOptions
     */
    public function getAdvancedOptions()
    {
        return $this->container['advancedOptions'];
    }

    /**
     * Sets advancedOptions
     *
     * @param \ShipStation\Model\AdvancedOptions $advancedOptions advancedOptions
     *
     * @return $this
     */
    public function setAdvancedOptions($advancedOptions)
    {
        $this->container['advancedOptions'] = $advancedOptions;

        return $this;
    }

    /**
     * Gets tagIds
     *
     * @return int[]
     */
    public function getTagIds()
    {
        return $this->container['tagIds'];
    }

    /**
     * Sets tagIds
     *
     * @param int[] $tagIds tagIds
     *
     * @return $this
     */
    public function setTagIds($tagIds)
    {
        $this->container['tagIds'] = $tagIds;

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
     * Gets externallyFulfilled
     *
     * @return bool
     */
    public function getExternallyFulfilled()
    {
        return $this->container['externallyFulfilled'];
    }

    /**
     * Sets externallyFulfilled
     *
     * @param bool $externallyFulfilled externallyFulfilled
     *
     * @return $this
     */
    public function setExternallyFulfilled($externallyFulfilled)
    {
        $this->container['externallyFulfilled'] = $externallyFulfilled;

        return $this;
    }

    /**
     * Gets externallyFulfilledBy
     *
     * @return string
     */
    public function getExternallyFulfilledBy()
    {
        return $this->container['externallyFulfilledBy'];
    }

    /**
     * Sets externallyFulfilledBy
     *
     * @param string $externallyFulfilledBy externallyFulfilledBy
     *
     * @return $this
     */
    public function setExternallyFulfilledBy($externallyFulfilledBy)
    {
        $this->container['externallyFulfilledBy'] = $externallyFulfilledBy;

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


