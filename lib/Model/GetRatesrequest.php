<?php
/**
 * GetRatesrequest
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
 * GetRatesrequest Class Doc Comment
 *
 * @category Class
 * @package  ShipStation
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GetRatesrequest implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'GetRatesrequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'carrierCode' => 'string',
        'serviceCode' => 'string',
        'packageCode' => 'string',
        'fromPostalCode' => 'string',
        'toState' => 'string',
        'toCountry' => 'string',
        'toPostalCode' => 'string',
        'toCity' => 'string',
        'weight' => '\ShipStation\Model\Weight',
        'dimensions' => '\ShipStation\Model\Dimensions',
        'confirmation' => 'string',
        'residential' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'carrierCode' => null,
        'serviceCode' => null,
        'packageCode' => null,
        'fromPostalCode' => null,
        'toState' => null,
        'toCountry' => null,
        'toPostalCode' => null,
        'toCity' => null,
        'weight' => null,
        'dimensions' => null,
        'confirmation' => null,
        'residential' => null
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
        'carrierCode' => 'carrierCode',
        'serviceCode' => 'serviceCode',
        'packageCode' => 'packageCode',
        'fromPostalCode' => 'fromPostalCode',
        'toState' => 'toState',
        'toCountry' => 'toCountry',
        'toPostalCode' => 'toPostalCode',
        'toCity' => 'toCity',
        'weight' => 'weight',
        'dimensions' => 'dimensions',
        'confirmation' => 'confirmation',
        'residential' => 'residential'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'carrierCode' => 'setCarrierCode',
        'serviceCode' => 'setServiceCode',
        'packageCode' => 'setPackageCode',
        'fromPostalCode' => 'setFromPostalCode',
        'toState' => 'setToState',
        'toCountry' => 'setToCountry',
        'toPostalCode' => 'setToPostalCode',
        'toCity' => 'setToCity',
        'weight' => 'setWeight',
        'dimensions' => 'setDimensions',
        'confirmation' => 'setConfirmation',
        'residential' => 'setResidential'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'carrierCode' => 'getCarrierCode',
        'serviceCode' => 'getServiceCode',
        'packageCode' => 'getPackageCode',
        'fromPostalCode' => 'getFromPostalCode',
        'toState' => 'getToState',
        'toCountry' => 'getToCountry',
        'toPostalCode' => 'getToPostalCode',
        'toCity' => 'getToCity',
        'weight' => 'getWeight',
        'dimensions' => 'getDimensions',
        'confirmation' => 'getConfirmation',
        'residential' => 'getResidential'
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
        $this->container['carrierCode'] = isset($data['carrierCode']) ? $data['carrierCode'] : null;
        $this->container['serviceCode'] = isset($data['serviceCode']) ? $data['serviceCode'] : null;
        $this->container['packageCode'] = isset($data['packageCode']) ? $data['packageCode'] : null;
        $this->container['fromPostalCode'] = isset($data['fromPostalCode']) ? $data['fromPostalCode'] : null;
        $this->container['toState'] = isset($data['toState']) ? $data['toState'] : null;
        $this->container['toCountry'] = isset($data['toCountry']) ? $data['toCountry'] : null;
        $this->container['toPostalCode'] = isset($data['toPostalCode']) ? $data['toPostalCode'] : null;
        $this->container['toCity'] = isset($data['toCity']) ? $data['toCity'] : null;
        $this->container['weight'] = isset($data['weight']) ? $data['weight'] : null;
        $this->container['dimensions'] = isset($data['dimensions']) ? $data['dimensions'] : null;
        $this->container['confirmation'] = isset($data['confirmation']) ? $data['confirmation'] : null;
        $this->container['residential'] = isset($data['residential']) ? $data['residential'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['carrierCode'] === null) {
            $invalidProperties[] = "'carrierCode' can't be null";
        }
        if ($this->container['fromPostalCode'] === null) {
            $invalidProperties[] = "'fromPostalCode' can't be null";
        }
        if ($this->container['toState'] === null) {
            $invalidProperties[] = "'toState' can't be null";
        }
        if ($this->container['toCountry'] === null) {
            $invalidProperties[] = "'toCountry' can't be null";
        }
        if ($this->container['toPostalCode'] === null) {
            $invalidProperties[] = "'toPostalCode' can't be null";
        }
        if ($this->container['toCity'] === null) {
            $invalidProperties[] = "'toCity' can't be null";
        }
        if ($this->container['weight'] === null) {
            $invalidProperties[] = "'weight' can't be null";
        }
        if ($this->container['dimensions'] === null) {
            $invalidProperties[] = "'dimensions' can't be null";
        }
        if ($this->container['confirmation'] === null) {
            $invalidProperties[] = "'confirmation' can't be null";
        }
        if ($this->container['residential'] === null) {
            $invalidProperties[] = "'residential' can't be null";
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
     * Gets fromPostalCode
     *
     * @return string
     */
    public function getFromPostalCode()
    {
        return $this->container['fromPostalCode'];
    }

    /**
     * Sets fromPostalCode
     *
     * @param string $fromPostalCode fromPostalCode
     *
     * @return $this
     */
    public function setFromPostalCode($fromPostalCode)
    {
        $this->container['fromPostalCode'] = $fromPostalCode;

        return $this;
    }

    /**
     * Gets toState
     *
     * @return string
     */
    public function getToState()
    {
        return $this->container['toState'];
    }

    /**
     * Sets toState
     *
     * @param string $toState toState
     *
     * @return $this
     */
    public function setToState($toState)
    {
        $this->container['toState'] = $toState;

        return $this;
    }

    /**
     * Gets toCountry
     *
     * @return string
     */
    public function getToCountry()
    {
        return $this->container['toCountry'];
    }

    /**
     * Sets toCountry
     *
     * @param string $toCountry toCountry
     *
     * @return $this
     */
    public function setToCountry($toCountry)
    {
        $this->container['toCountry'] = $toCountry;

        return $this;
    }

    /**
     * Gets toPostalCode
     *
     * @return string
     */
    public function getToPostalCode()
    {
        return $this->container['toPostalCode'];
    }

    /**
     * Sets toPostalCode
     *
     * @param string $toPostalCode toPostalCode
     *
     * @return $this
     */
    public function setToPostalCode($toPostalCode)
    {
        $this->container['toPostalCode'] = $toPostalCode;

        return $this;
    }

    /**
     * Gets toCity
     *
     * @return string
     */
    public function getToCity()
    {
        return $this->container['toCity'];
    }

    /**
     * Sets toCity
     *
     * @param string $toCity toCity
     *
     * @return $this
     */
    public function setToCity($toCity)
    {
        $this->container['toCity'] = $toCity;

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
     * Gets residential
     *
     * @return bool
     */
    public function getResidential()
    {
        return $this->container['residential'];
    }

    /**
     * Sets residential
     *
     * @param bool $residential residential
     *
     * @return $this
     */
    public function setResidential($residential)
    {
        $this->container['residential'] = $residential;

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


