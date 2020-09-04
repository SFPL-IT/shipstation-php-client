# ShipStation\FulfillmentsApi

All URIs are relative to *https://ssapi.shipstation.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**fulfillmentsGet**](FulfillmentsApi.md#fulfillmentsGet) | **GET** /fulfillments | List Fulfillments with parameters


# **fulfillmentsGet**
> \ShipStation\Model\ListFulfillmentswithparametersresponse fulfillmentsGet($fulfillmentId, $orderId, $orderNumber, $trackingNumber, $recipientName, $createDateStart, $createDateEnd, $shipDateStart, $shipDateEnd, $sortBy, $sortDir, $page, $pageSize)

List Fulfillments with parameters

Obtains a list of fulfillments that match the specified criteria.  Please note the following: - Orders that have been marked as shipped either through the UI or the API will appear in the response as they are considered fulfillments. All of the available filters are optional.  They do not need to be included in the URL.  If you do include them, here's what the URL may look like: Url format with filters: ``` fulfillments?fulfillmentId={fulfillmentId} &orderId={orderId} &orderNumber={orderNumber} &trackingNumber={trackingNumber} &recipientName={recipientName} &createDateStart={createDateStart} &createDateEnd={createDateEnd} &shipDateStart={shipDateStart} &shipDateEnd={shipDateEnd} &sortBy={sortBy} &sortDir={sortDir} &page={page} &pageSize={pageSize} ```

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\FulfillmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fulfillmentId = 1.2; // double | Returns the fulfillment with the specified fulfillment ID.
$orderId = 1.2; // double | Returns fulfillments whose orders have the specified order ID.
$orderNumber = "orderNumber_example"; // string | Returns fulfillments whose orders have the specified order number.
$trackingNumber = "trackingNumber_example"; // string | Returns fulfillments with the specified tracking number.
$recipientName = "recipientName_example"; // string | Returns fulfillments shipped to the specified recipient name.
$createDateStart = "createDateStart_example"; // string | Returns fulfillments created on or after the specified ``createDate``
$createDateEnd = "createDateEnd_example"; // string | Returns fulfillments created on or before the specified ``createDate``
$shipDateStart = "shipDateStart_example"; // string | Returns fulfillments with the ``shipDate`` on or after the specified date
$shipDateEnd = "shipDateEnd_example"; // string | Returns fulfillments with the ``shipDate`` on or before the specified date
$sortBy = "sortBy_example"; // string | Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending ``createDate``.
$sortDir = "sortDir_example"; // string | Sets the direction of the sort order.
$page = 1.2; // double | page number.
$pageSize = 1.2; // double | page size.

try {
    $result = $apiInstance->fulfillmentsGet($fulfillmentId, $orderId, $orderNumber, $trackingNumber, $recipientName, $createDateStart, $createDateEnd, $shipDateStart, $shipDateEnd, $sortBy, $sortDir, $page, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FulfillmentsApi->fulfillmentsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **fulfillmentId** | **double**| Returns the fulfillment with the specified fulfillment ID. | [optional]
 **orderId** | **double**| Returns fulfillments whose orders have the specified order ID. | [optional]
 **orderNumber** | **string**| Returns fulfillments whose orders have the specified order number. | [optional]
 **trackingNumber** | **string**| Returns fulfillments with the specified tracking number. | [optional]
 **recipientName** | **string**| Returns fulfillments shipped to the specified recipient name. | [optional]
 **createDateStart** | **string**| Returns fulfillments created on or after the specified &#x60;&#x60;createDate&#x60;&#x60; | [optional]
 **createDateEnd** | **string**| Returns fulfillments created on or before the specified &#x60;&#x60;createDate&#x60;&#x60; | [optional]
 **shipDateStart** | **string**| Returns fulfillments with the &#x60;&#x60;shipDate&#x60;&#x60; on or after the specified date | [optional]
 **shipDateEnd** | **string**| Returns fulfillments with the &#x60;&#x60;shipDate&#x60;&#x60; on or before the specified date | [optional]
 **sortBy** | **string**| Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;createDate&#x60;&#x60;. | [optional]
 **sortDir** | **string**| Sets the direction of the sort order. | [optional]
 **page** | **double**| page number. | [optional]
 **pageSize** | **double**| page size. | [optional]

### Return type

[**\ShipStation\Model\ListFulfillmentswithparametersresponse**](../Model/ListFulfillmentswithparametersresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

