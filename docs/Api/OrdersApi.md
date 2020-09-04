# ShipStation\OrdersApi

All URIs are relative to *https://ssapi.shipstation.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**ordersAddtagPost**](OrdersApi.md#ordersAddtagPost) | **POST** /orders/addtag | Add Tag to Order
[**ordersAssignuserPost**](OrdersApi.md#ordersAssignuserPost) | **POST** /orders/assignuser | Assign User to Order
[**ordersByOrderIdDelete**](OrdersApi.md#ordersByOrderIdDelete) | **DELETE** /orders/{orderId} | Delete Order
[**ordersByOrderIdGet**](OrdersApi.md#ordersByOrderIdGet) | **GET** /orders/{orderId} | Get Order
[**ordersCreatelabelfororderPost**](OrdersApi.md#ordersCreatelabelfororderPost) | **POST** /orders/createlabelfororder | Create Label for Order
[**ordersCreateorderPost**](OrdersApi.md#ordersCreateorderPost) | **POST** /orders/createorder | Create/Update Order
[**ordersCreateordersPost**](OrdersApi.md#ordersCreateordersPost) | **POST** /orders/createorders | Create/Update Multiple Orders
[**ordersGet**](OrdersApi.md#ordersGet) | **GET** /orders | List Orders with parameters
[**ordersHolduntilPost**](OrdersApi.md#ordersHolduntilPost) | **POST** /orders/holduntil | Hold Order Until
[**ordersListbytagGet**](OrdersApi.md#ordersListbytagGet) | **GET** /orders/listbytag | List Orders by Tag
[**ordersMarkasshippedPost**](OrdersApi.md#ordersMarkasshippedPost) | **POST** /orders/markasshipped | Mark an Order as Shipped
[**ordersRemovetagPost**](OrdersApi.md#ordersRemovetagPost) | **POST** /orders/removetag | Remove Tag from Order
[**ordersRestorefromholdPost**](OrdersApi.md#ordersRestorefromholdPost) | **POST** /orders/restorefromhold | Restore Order from On Hold
[**ordersUnassignuserPost**](OrdersApi.md#ordersUnassignuserPost) | **POST** /orders/unassignuser | Unassign User from Order


# **ordersAddtagPost**
> \ShipStation\Model\AddTagtoOrderresponse ordersAddtagPost($contentType, $body)

Add Tag to Order

Adds a tag to an order.  The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|------------------- ``orderId`` | number, required | Identifies the order that will be tagged. ``tagId`` | number, required | Identifies the tag that will be applied to the order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\AddTagtoOrderrequest(); // \ShipStation\Model\AddTagtoOrderrequest | 

try {
    $result = $apiInstance->ordersAddtagPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersAddtagPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\AddTagtoOrderrequest**](../Model/AddTagtoOrderrequest.md)|  |

### Return type

[**\ShipStation\Model\AddTagtoOrderresponse**](../Model/AddTagtoOrderresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersAssignuserPost**
> \ShipStation\Model\AssignUsertoOrderresponse ordersAssignuserPost($contentType, $body)

Assign User to Order

Assigns a user to an order.  The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|------------------- ``orderIds`` | number, required | Identifies set of orders that will be assigned the user.  Please note that if ANY of the orders within the array are not found, no orders will have a user assigned to them. ``userId`` | number, required | Identifies the user that will be applied to the orders.  It should contain a GUID of the user to be assigned to the array of orders.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\AssignUsertoOrderrequest(); // \ShipStation\Model\AssignUsertoOrderrequest | 

try {
    $result = $apiInstance->ordersAssignuserPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersAssignuserPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\AssignUsertoOrderrequest**](../Model/AssignUsertoOrderrequest.md)|  |

### Return type

[**\ShipStation\Model\AssignUsertoOrderresponse**](../Model/AssignUsertoOrderresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersByOrderIdDelete**
> \ShipStation\Model\DeleteOrderresponse ordersByOrderIdDelete($orderId)

Delete Order

Removes order from ShipStation's UI. Note this is a \"soft\" delete action so the order will still exist in the database, but will be set to ``inactive``

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$orderId = 1.2; // double | The system generated identifier for the order.

try {
    $result = $apiInstance->ordersByOrderIdDelete($orderId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersByOrderIdDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **orderId** | **double**| The system generated identifier for the order. |

### Return type

[**\ShipStation\Model\DeleteOrderresponse**](../Model/DeleteOrderresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersByOrderIdGet**
> \ShipStation\Model\GetOrderresponse ordersByOrderIdGet($orderId)

Get Order

Retrieves a single order from the database.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$orderId = 1.2; // double | The system generated identifier for the order.

try {
    $result = $apiInstance->ordersByOrderIdGet($orderId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersByOrderIdGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **orderId** | **double**| The system generated identifier for the order. |

### Return type

[**\ShipStation\Model\GetOrderresponse**](../Model/GetOrderresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersCreatelabelfororderPost**
> \ShipStation\Model\CreateLabelforOrderresponse ordersCreatelabelfororderPost($contentType, $body)

Create Label for Order

Creates a shipping label for a given order.  The ``labelData`` field returned in the response is a base64 encoded PDF value. Simply decode and save the output as a PDF file to retrieve a printable label.  The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|------------------- ``orderId`` | number, required | Identifies the order that will be shipped. ``carrierCode`` | string, required | The code for the carrier that is to be used for the label. ``serviceCode`` | string, required | The code for the shipping service that is to be used for the label. ``confirmation`` | string, required | The type of delivery confirmation that is to be used once the shipment is created.  Possible values: ``none``, ``delivery``, ``signature``, ``adult_signature``, and ``direct_signature``.  ``direct_signature`` is available for FedEx only. ``shipDate`` | string, required | The date the order should be shipped. ``weight`` | Weight, optional | Weight of the order.  Use the [**Weight**](http://www.shipstation.com/developer-api/#/reference/model-weight) model. ``dimensions`` | Dimensions, optional | Dimensions of the order.  Use [**Dimensions**](http://www.shipstation.com/developer-api/#/reference/model-dimensions) model. ``insuranceOptions`` | InsuranceOptions, optional | The shipping insurance information associated with this label.  Use the [**InsuranceOptions**](http://www.shipstation.com/developer-api/#/reference/model-insuranceoptions) model. ``internationalOptions`` | InternationalOptions, optional | Customs information that can be used to generate customs documents for international orders.  Use the [**InternationalOptions**](http://www.shipstation.com/developer-api/#/reference/model-internationaloptions) model. ``advancedOptions`` | AdvancedOptions, optional | Various advanced options that may be available depending on the shipping carrier that is used to ship the order. Use the Customs information that can be used to generate customs documents for international orders.  Use the [**AdvancedOptions**](http://www.shipstation.com/developer-api/#/reference/model-advancedoptions) model. ``testLabel`` | boolean, required | Specifies whether a test label should be created.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\CreateLabelforOrderrequest(); // \ShipStation\Model\CreateLabelforOrderrequest | 

try {
    $result = $apiInstance->ordersCreatelabelfororderPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersCreatelabelfororderPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\CreateLabelforOrderrequest**](../Model/CreateLabelforOrderrequest.md)|  |

### Return type

[**\ShipStation\Model\CreateLabelforOrderresponse**](../Model/CreateLabelforOrderresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersCreateorderPost**
> \ShipStation\Model\Create1UpdateOrderresponse ordersCreateorderPost($contentType, $body)

Create/Update Order

If the ``orderKey`` is specified, the method becomes idempotent and the existing order with that key will be updated. Note: Only orders in an open status in ShipStation (``awaiting_payment``,``awaiting_shipment``, and ``on_hold``) can be updated through this method. ``cancelled`` and ``shipped`` are locked from modification through the API.  The body of this request should specify an [**Order**](https://www.shipstation.com/developer-api/#/reference/model-order) object: Name               |Data Type          |Description -------------------|-------------------|------------------- ``orderNumber`` | string, required | A user-defined order number used to identify an order. ``orderKey`` | string, optional | A user-provided key that should be unique to each order.  If an orderKey is not provided, ShipStation will create a new order and generate a unique orderKey for that order.  If the orderKey *is* provided, the **createorder** method will either: create a new order if the provided orderKey is not found, or, update the existing order if the orderKey is found. ``orderDate`` | string, required | The date the order was placed. ``paymentDate`` | string, optional | The date the order was paid for. ``shipByDate`` | string, optional | The date the order is to be shipped before or on. This field is a suggested value generated by the order source/platform/cart and passed to ShipStation. ``orderStatus`` | string, required | The order's status. Possible values: ``awaiting_payment``, ``awaiting_shipment``, ``shipped``, ``on_hold``, ``cancelled`` ``customerUsername`` | string, optional | The customer's username. ``customerEmail`` | string, optional | The customer's email address. ``billTo`` | Address, required | The recipients billing address. Use the [**Address**](https://www.shipstation.com/developer-api/#/reference/model-address) model. ``shipTo`` | Address, required | The recipient's shipping address. Use the [**Address**](http://www.shipstation.com/developer-api/#/reference/model-address) model. ``items`` | OrderItem, optional | An array of item objects.  Use an array of [**OrderItem**](http://www.shipstation.com/developer-api/#/reference/model-orderitem) models. ``amountPaid`` | number, optional | The total amount paid for the Order. ``taxAmount`` | number, optional | The total tax amount for the Order. ``shippingAmount`` | number, optional | Shipping amount paid by the customer, if any. ``customerNotes`` | string, optional | Notes left by the customer when placing the order. ``internalNotes`` | string, optional | Private notes that are only visible to the seller. ``gift`` | boolean, optional | Specifies whether or not this Order is a gift ``giftMessage`` | string, optional | Gift message left by the customer when placing the order. ``paymentMethod`` | string, optional | Method of payment used by the customer. ``requestedShippingService`` | string, optional |Identifies the shipping service selected by the customer when placing this order. This value is given to ShipStation by the marketplace/cart and helps identify what shipping service the customer selected upon checkout. ``carrierCode`` | string, optional | The code for the carrier that is to be used(or was used) when this order is shipped(was shipped). ``serviceCode`` | string, optional | The code for the shipping service that is to be used(or was used) when this order is shipped(was shipped). ``packageCode`` | string, optional | The code for the package type that is to be used(or was used) when this order is shipped(was shipped). ``confirmation`` | string, optional | The type of delivery confirmation that is to be used(or was used) when this order is shipped(was shipped). Possible values: ``none``, ``delivery``, ``signature``, ``adult_signature``, and ``direct_signature``.  ``direct_signature`` is available for FedEx only.   ``shipDate`` | string, optional | The date the order was shipped. ``weight`` | Weight, optional | Weight of the order.  Use the [**Weight**](http://www.shipstation.com/developer-api/#/reference/model-weight) model. ``dimensions`` | Dimensions, optional | Dimensions of the order.  Use the [**Dimensions**](http://www.shipstation.com/developer-api/#/reference/model-dimensions) model. ``insuranceOptions`` | InsuranceOptions, optional | The shipping insurance information associated with this order.  Use the [**InsuranceOptions**](http://www.shipstation.com/developer-api/#/reference/model-insuranceoptions) model. ``internationalOptions`` | InternationalOptions, optional | Customs information that can be used to generate customs documents for international orders.  Use the [**InternationalOptions**](http://www.shipstation.com/developer-api/#/reference/model-internationaloptions) model. ``advancedOptions`` | AdvancedOptions, optional | Various advanced options that may be available depending on the shipping carrier that is used to ship the order. Use the [**AdvancedOptions**](http://www.shipstation.com/developer-api/#/reference/model-advancedoptions) model. ``tagIds``|number[]|Array of tagIds.  Each tagId identifies a tag that has been associated with this order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\Create1UpdateOrderrequest(); // \ShipStation\Model\Create1UpdateOrderrequest | 

try {
    $result = $apiInstance->ordersCreateorderPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersCreateorderPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\Create1UpdateOrderrequest**](../Model/Create1UpdateOrderrequest.md)|  |

### Return type

[**\ShipStation\Model\Create1UpdateOrderresponse**](../Model/Create1UpdateOrderresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersCreateordersPost**
> \ShipStation\Model\Create1UpdateMultipleOrdersresponse ordersCreateordersPost($contentType, $body)

Create/Update Multiple Orders

This endpoint can be used to create or update multiple orders in one request. If the ``orderKey`` is specified in an order, the existing order with that key will be updated. Note: Only orders in an open status in ShipStation (``awaiting_payment``,``awaiting_shipment``, and ``on_hold``) can be updated through this method. ``cancelled`` and ``shipped`` are locked from modification through the API. Data Type          |Description -------------------|------------------- Order, required | An array of [**Order**](http://www.shipstation.com/developer-api/#/reference/model-order) objects (maximum of 100 per request)

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = array(new \ShipStation\Model\Create1UpdateMultipleOrdersrequest()); // \ShipStation\Model\Create1UpdateMultipleOrdersrequest[] | 

try {
    $result = $apiInstance->ordersCreateordersPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersCreateordersPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\Create1UpdateMultipleOrdersrequest[]**](../Model/Create1UpdateMultipleOrdersrequest.md)|  |

### Return type

[**\ShipStation\Model\Create1UpdateMultipleOrdersresponse**](../Model/Create1UpdateMultipleOrdersresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersGet**
> \ShipStation\Model\ListOrderswithparametersresponse ordersGet($customerName, $itemKeyword, $createDateStart, $createDateEnd, $modifyDateStart, $modifyDateEnd, $orderDateStart, $orderDateEnd, $orderNumber, $orderStatus, $paymentDateStart, $paymentDateEnd, $storeId, $sortBy, $sortDir, $page, $pageSize)

List Orders with parameters

Obtains a list of orders that match the specified criteria.  All of the available filters are optional.  They do not need to be included in the URL.  If you do include them, here's what the URL may look like: Url format with filters: ``` /orders?customerName={customerName} &itemKeyword={itemKeyword} &createDateStart={createDateStart} &createDateEnd={createDateEnd} &modifyDateStart={modifyDateStart} &modifyDateEnd={modifyDateEnd} &orderDateStart={orderDateStart} &orderDateEnd={orderDateEnd} &orderNumber={orderNumber} &orderStatus={orderStatus} &paymentDateStart={paymentDateStart} &paymentDateEnd={paymentDateEnd} &storeId={storeId} &sortBy={sortBy} &sortDir={sortDir} &page={page} &pageSize={pageSize} ```

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$customerName = "customerName_example"; // string | Returns orders that match the specified name.
$itemKeyword = "itemKeyword_example"; // string | Returns orders that contain items that match the specified keyword. Fields searched are Sku, Description, and Options
$createDateStart = "createDateStart_example"; // string | Returns orders that were created in ShipStation after the specified date
$createDateEnd = "createDateEnd_example"; // string | Returns orders that were created in ShipStation before the specified date
$modifyDateStart = "modifyDateStart_example"; // string | Returns orders that were modified after the specified date
$modifyDateEnd = "modifyDateEnd_example"; // string | Returns orders that were modified before the specified date
$orderDateStart = "orderDateStart_example"; // string | Returns orders greater than the specified date
$orderDateEnd = "orderDateEnd_example"; // string | Returns orders less than or equal to the specified date
$orderNumber = "orderNumber_example"; // string | Filter by order number, performs a \"starts with\" search.
$orderStatus = "orderStatus_example"; // string | Filter by order status.  If left empty, orders of all statuses are returned.
$paymentDateStart = "paymentDateStart_example"; // string | Returns orders that were paid after the specified date
$paymentDateEnd = "paymentDateEnd_example"; // string | Returns orders that were paid before the specified date
$storeId = 1.2; // double | Filters orders to a single store. Call List Stores to obtain a list of store Ids.
$sortBy = "sortBy_example"; // string | Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending ``orderId``.
$sortDir = "sortDir_example"; // string | Sets the direction of the sort order.
$page = "page_example"; // string | Page number
$pageSize = "pageSize_example"; // string | Requested page size. Max value is 500.

try {
    $result = $apiInstance->ordersGet($customerName, $itemKeyword, $createDateStart, $createDateEnd, $modifyDateStart, $modifyDateEnd, $orderDateStart, $orderDateEnd, $orderNumber, $orderStatus, $paymentDateStart, $paymentDateEnd, $storeId, $sortBy, $sortDir, $page, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **customerName** | **string**| Returns orders that match the specified name. | [optional]
 **itemKeyword** | **string**| Returns orders that contain items that match the specified keyword. Fields searched are Sku, Description, and Options | [optional]
 **createDateStart** | **string**| Returns orders that were created in ShipStation after the specified date | [optional]
 **createDateEnd** | **string**| Returns orders that were created in ShipStation before the specified date | [optional]
 **modifyDateStart** | **string**| Returns orders that were modified after the specified date | [optional]
 **modifyDateEnd** | **string**| Returns orders that were modified before the specified date | [optional]
 **orderDateStart** | **string**| Returns orders greater than the specified date | [optional]
 **orderDateEnd** | **string**| Returns orders less than or equal to the specified date | [optional]
 **orderNumber** | **string**| Filter by order number, performs a \&quot;starts with\&quot; search. | [optional]
 **orderStatus** | **string**| Filter by order status.  If left empty, orders of all statuses are returned. | [optional]
 **paymentDateStart** | **string**| Returns orders that were paid after the specified date | [optional]
 **paymentDateEnd** | **string**| Returns orders that were paid before the specified date | [optional]
 **storeId** | **double**| Filters orders to a single store. Call List Stores to obtain a list of store Ids. | [optional]
 **sortBy** | **string**| Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;orderId&#x60;&#x60;. | [optional]
 **sortDir** | **string**| Sets the direction of the sort order. | [optional]
 **page** | **string**| Page number | [optional]
 **pageSize** | **string**| Requested page size. Max value is 500. | [optional]

### Return type

[**\ShipStation\Model\ListOrderswithparametersresponse**](../Model/ListOrderswithparametersresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersHolduntilPost**
> \ShipStation\Model\HoldOrderUntilresponse ordersHolduntilPost($contentType, $body)

Hold Order Until

This method will change the status of the given order to On Hold until the date specified, when the status will automatically change to Awaiting Shipment. The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|------------------- ``orderId`` | number, required | Identifies the order that will be held. ``holdUntilDate`` | string, required | Date when order is moved from ``on_hold`` status to ``awaiting_shipment``.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\HoldOrderUntilrequest(); // \ShipStation\Model\HoldOrderUntilrequest | 

try {
    $result = $apiInstance->ordersHolduntilPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersHolduntilPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\HoldOrderUntilrequest**](../Model/HoldOrderUntilrequest.md)|  |

### Return type

[**\ShipStation\Model\HoldOrderUntilresponse**](../Model/HoldOrderUntilresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersListbytagGet**
> \ShipStation\Model\ListOrdersbyTagresponse ordersListbytagGet($orderStatus, $tagId, $page, $pageSize)

List Orders by Tag

Lists all orders that match the specified status and tag ID. Url format with filters: ``` /listbytag?orderStatus={orderStatus} &tagId={tagId} &page={page} &pageSize={pageSize} ```

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$orderStatus = "orderStatus_example"; // string | The order's status.
$tagId = 1.2; // double | ID of the tag. Call Accounts/ListTags to obtain a list of tags for this account.
$page = "page_example"; // string | Page number
$pageSize = "pageSize_example"; // string | Requested page size. Max value is 500.

try {
    $result = $apiInstance->ordersListbytagGet($orderStatus, $tagId, $page, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersListbytagGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **orderStatus** | **string**| The order&#39;s status. |
 **tagId** | **double**| ID of the tag. Call Accounts/ListTags to obtain a list of tags for this account. |
 **page** | **string**| Page number | [optional]
 **pageSize** | **string**| Requested page size. Max value is 500. | [optional]

### Return type

[**\ShipStation\Model\ListOrdersbyTagresponse**](../Model/ListOrdersbyTagresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersMarkasshippedPost**
> \ShipStation\Model\MarkanOrderasShippedresponse ordersMarkasshippedPost($contentType, $body)

Mark an Order as Shipped

Marks an order as shipped without creating a label in ShipStation. The body of this request has the following attributes: Name               |Data Type          |Description -------------------|-------------------|-------------------  ``orderId`` | number, required | Identifies the order that will be marked as shipped.  ``carrierCode`` | string, required | Code of the carrier that is marked as having shipped the order.  ``shipDate`` | string, optional | Date order was shipped.  ``trackingNumber`` | string, optional | Tracking number of shipment.  ``notifyCustomer``  | boolean, optional | Specifies whether the customer should be notified of the shipment. Default value: false  ``notifySalesChannel`` | boolean, optional | Specifies whether the sales channel should be notified of the shipment. Default value: false

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\MarkanOrderasShippedrequest(); // \ShipStation\Model\MarkanOrderasShippedrequest | 

try {
    $result = $apiInstance->ordersMarkasshippedPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersMarkasshippedPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\MarkanOrderasShippedrequest**](../Model/MarkanOrderasShippedrequest.md)|  |

### Return type

[**\ShipStation\Model\MarkanOrderasShippedresponse**](../Model/MarkanOrderasShippedresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersRemovetagPost**
> \ShipStation\Model\RemoveTagfromOrderresponse ordersRemovetagPost($contentType, $body)

Remove Tag from Order

Removes a tag from the specified order.  The body of this request has the following attributes: Name               |Data Type          |Description -------------------|-------------------|------------------- ``orderId`` | number, required | Identifies the order whose tag will be removed. ``tagId`` | number, required | Identifies the tag to remove.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\RemoveTagfromOrderrequest(); // \ShipStation\Model\RemoveTagfromOrderrequest | 

try {
    $result = $apiInstance->ordersRemovetagPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersRemovetagPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\RemoveTagfromOrderrequest**](../Model/RemoveTagfromOrderrequest.md)|  |

### Return type

[**\ShipStation\Model\RemoveTagfromOrderresponse**](../Model/RemoveTagfromOrderresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersRestorefromholdPost**
> \ShipStation\Model\RestoreOrderfromOnHoldresponse ordersRestorefromholdPost($contentType, $body)

Restore Order from On Hold

This method will change the status of the given order from On Hold to Awaiting Shipment. This endpoint is used when a holdUntil Date is attached to an order. The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|------------------- ``orderId`` | number, required | Identifies the order that will be restored to ``awaiting_shipment`` from ``on_hold``.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\RestoreOrderfromOnHoldrequest(); // \ShipStation\Model\RestoreOrderfromOnHoldrequest | 

try {
    $result = $apiInstance->ordersRestorefromholdPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersRestorefromholdPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\RestoreOrderfromOnHoldrequest**](../Model/RestoreOrderfromOnHoldrequest.md)|  |

### Return type

[**\ShipStation\Model\RestoreOrderfromOnHoldresponse**](../Model/RestoreOrderfromOnHoldresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **ordersUnassignuserPost**
> \ShipStation\Model\UnassignUserfromOrderresponse ordersUnassignuserPost($contentType, $body)

Unassign User from Order

Unassigns a user from an order.  The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|------------------- ``orderIds`` | number, required | Identifies set of orders that will have the user unassigned.  Please note that if ANY of the orders within the array are not found, then no orders will have their users unassigned.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\OrdersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\UnassignUserfromOrderrequest(); // \ShipStation\Model\UnassignUserfromOrderrequest | 

try {
    $result = $apiInstance->ordersUnassignuserPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrdersApi->ordersUnassignuserPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\UnassignUserfromOrderrequest**](../Model/UnassignUserfromOrderrequest.md)|  |

### Return type

[**\ShipStation\Model\UnassignUserfromOrderresponse**](../Model/UnassignUserfromOrderresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

