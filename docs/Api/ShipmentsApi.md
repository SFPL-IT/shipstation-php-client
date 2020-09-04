# ShipStation\ShipmentsApi

All URIs are relative to *https://ssapi.shipstation.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**shipmentsCreatelabelPost**](ShipmentsApi.md#shipmentsCreatelabelPost) | **POST** /shipments/createlabel | Create Shipment Label
[**shipmentsGet**](ShipmentsApi.md#shipmentsGet) | **GET** /shipments | List Shipments with parameters
[**shipmentsGetratesPost**](ShipmentsApi.md#shipmentsGetratesPost) | **POST** /shipments/getrates | Get Rates
[**shipmentsVoidlabelPost**](ShipmentsApi.md#shipmentsVoidlabelPost) | **POST** /shipments/voidlabel | Void Label


# **shipmentsCreatelabelPost**
> \ShipStation\Model\CreateShipmentLabelresponse shipmentsCreatelabelPost($contentType, $body)

Create Shipment Label

Creates a shipping label.  The ``labelData`` field returned in the response is a base64 encoded PDF value. Simply decode and save the output as a PDF file to retrieve a printable label.  The body of this request has the following attributes: Name               |Data Type          |Description -------------------|-------------------|-------------------  ``carrierCode`` | string, required | Identifies the carrier to be used for this label.  ``serviceCode`` | string, required | Identifies the shipping service to be used for this label.  ``packageCode`` | string, required | Identifies the packing type that should be used for this label.  ``confirmation`` | string, optional | The type of delivery confirmation that is to be used once the shipment is created.  Possible values: ``none``, ``delivery``, ``signature``, ``adult_signature``, and ``direct_signature``.  ``direct_signature`` is available for FedEx only.  ``shipDate`` | string, required | The date the shipment will be shipped.  ``weight`` | Weight, required | Shipment's weight.  Use the [**Weight**](https://www.shipstation.com/developer-api/#/reference/model-weight) model.  ``dimensions`` | Dimensions, optional | Shipment's dimensions.  Use the [**Dimensions**](https://www.shipstation.com/developer-api/#/reference/model-dimensions) model.  ``shipFrom`` | Address, required | Address indicating shipment's origin.  Use the [**Address**](https://www.shipstation.com/developer-api/#/reference/model-address) model.  ``shipTo`` | Address, required | Address indicating shipment's destination.  Use the [**Address**](https://www.shipstation.com/developer-api/#/reference/model-address) model.  ``returnTo`` | Address, optional | Address indicating return address displayed on the label.  Use the [**Address**](https://www.shipstation.com/developer-api/#/reference/model-address) model.  ``insuranceOptions`` | InsuranceOptions, optional | The shipping insurance information associated with this order.    ``internationalOptions`` | InternationalOptions, optional | Customs information that can be used to generate customs documents for international orders.  Use the [**InternationalOptions**](https://www.shipstation.com/developer-api/#/reference/model-internationaloptions) model.  ``advancedOptions`` | AdvancedOptions, optional | Various advanced options that may be available depending on the shipping carrier that is used to ship the order.  Use the [**AdvancedOptions**](https://www.shipstation.com/developer-api/#/reference/model-advancedoptions) model.   ``testLabel`` | boolean, optional | Specifies whether a test label should be created. Default value: false.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\ShipmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\CreateShipmentLabelrequest(); // \ShipStation\Model\CreateShipmentLabelrequest | 

try {
    $result = $apiInstance->shipmentsCreatelabelPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ShipmentsApi->shipmentsCreatelabelPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\CreateShipmentLabelrequest**](../Model/CreateShipmentLabelrequest.md)|  |

### Return type

[**\ShipStation\Model\CreateShipmentLabelresponse**](../Model/CreateShipmentLabelresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **shipmentsGet**
> \ShipStation\Model\ListShipmentswithparametersresponse shipmentsGet($recipientName, $recipientCountryCode, $orderNumber, $orderId, $carrierCode, $serviceCode, $trackingNumber, $createDateStart, $createDateEnd, $shipDateStart, $shipDateEnd, $voidDateStart, $voidDateEnd, $storeId, $includeShipmentItems, $sortBy, $sortDir, $page, $pageSize)

List Shipments with parameters

Obtains a list of shipments that match the specified criteria.  Please note the following: - Only valid shipments with labels generated in ShipStation will be returned in the response. Orders that have been marked as shipped either through the UI or the API will not appear as they are considered external shipments. - To include every shipment's associated shipmentItems in the response, be sure to set the `includeShipmentItems` parameter to `true`. All of the available filters are optional.  They do not need to be included in the URL.  If you do include them, here's what the URL may look like: Url format with filters: ``` shipments?recipientName={recipientName} &recipientCountryCode={recipientCountryCode} &orderNumber={orderNumber} &orderId={orderId} &carrierCode={carrierCode} &serviceCode={serviceCode} &trackingNumber={trackingNumber} &createDateStart={createDateStart} &createDateEnd={createDateEnd} &shipDateStart={shipDateStart} &shipDateEnd={shipDateEnd} &voidDateStart={voidDateStart} &voidDateEnd={voidDateEnd} &storeId={storeId} &includeShipmentItems={includeShipmentItems} &sortBy={sortBy} &sortDir={sortDir} &page={page} &pageSize={pageSize} ```

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\ShipmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$recipientName = "recipientName_example"; // string | Returns shipments shipped to the specified recipient name.
$recipientCountryCode = "recipientCountryCode_example"; // string | Returns shipments shipped to the specified country code.
$orderNumber = "orderNumber_example"; // string | Returns shipments whose orders have the specified order number.
$orderId = 1.2; // double | Returns shipments whose orders have the specified order ID.
$carrierCode = "carrierCode_example"; // string | Returns shipments shipped with the specified carrier.
$serviceCode = "serviceCode_example"; // string | Returns shipments shipped with the specified shipping service.
$trackingNumber = "trackingNumber_example"; // string | Returns shipments with the specified tracking number.
$createDateStart = "createDateStart_example"; // string | Returns shipments created on or after the specified ``createDate``
$createDateEnd = "createDateEnd_example"; // string | Returns shipments created on or before the specified ``createDate``
$shipDateStart = "shipDateStart_example"; // string | Returns shipments with the ``shipDate`` on or after the specified date
$shipDateEnd = "shipDateEnd_example"; // string | Returns shipments with the ``shipDate`` on or before the specified date
$voidDateStart = "voidDateStart_example"; // string | Returns shipments voided on or after the specified date
$voidDateEnd = "voidDateEnd_example"; // string | Returns shipments voided on or before the specified date
$storeId = 1.2; // double | Returns shipments whose orders belong to the specified store ID.
$includeShipmentItems = true; // bool | Specifies whether to include shipment items with results Default value: false.
$sortBy = "sortBy_example"; // string | Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending ``createDate``.
$sortDir = "sortDir_example"; // string | Sets the direction of the sort order.
$page = 1.2; // double | page number.
$pageSize = 1.2; // double | page size.

try {
    $result = $apiInstance->shipmentsGet($recipientName, $recipientCountryCode, $orderNumber, $orderId, $carrierCode, $serviceCode, $trackingNumber, $createDateStart, $createDateEnd, $shipDateStart, $shipDateEnd, $voidDateStart, $voidDateEnd, $storeId, $includeShipmentItems, $sortBy, $sortDir, $page, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ShipmentsApi->shipmentsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **recipientName** | **string**| Returns shipments shipped to the specified recipient name. | [optional]
 **recipientCountryCode** | **string**| Returns shipments shipped to the specified country code. | [optional]
 **orderNumber** | **string**| Returns shipments whose orders have the specified order number. | [optional]
 **orderId** | **double**| Returns shipments whose orders have the specified order ID. | [optional]
 **carrierCode** | **string**| Returns shipments shipped with the specified carrier. | [optional]
 **serviceCode** | **string**| Returns shipments shipped with the specified shipping service. | [optional]
 **trackingNumber** | **string**| Returns shipments with the specified tracking number. | [optional]
 **createDateStart** | **string**| Returns shipments created on or after the specified &#x60;&#x60;createDate&#x60;&#x60; | [optional]
 **createDateEnd** | **string**| Returns shipments created on or before the specified &#x60;&#x60;createDate&#x60;&#x60; | [optional]
 **shipDateStart** | **string**| Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or after the specified date | [optional]
 **shipDateEnd** | **string**| Returns shipments with the &#x60;&#x60;shipDate&#x60;&#x60; on or before the specified date | [optional]
 **voidDateStart** | **string**| Returns shipments voided on or after the specified date | [optional]
 **voidDateEnd** | **string**| Returns shipments voided on or before the specified date | [optional]
 **storeId** | **double**| Returns shipments whose orders belong to the specified store ID. | [optional]
 **includeShipmentItems** | **bool**| Specifies whether to include shipment items with results Default value: false. | [optional]
 **sortBy** | **string**| Sort the responses by a set value.  The response will be sorted based off the ascending dates (oldest to most current.)  If left empty, the response will be sorted by ascending &#x60;&#x60;createDate&#x60;&#x60;. | [optional]
 **sortDir** | **string**| Sets the direction of the sort order. | [optional]
 **page** | **double**| page number. | [optional]
 **pageSize** | **double**| page size. | [optional]

### Return type

[**\ShipStation\Model\ListShipmentswithparametersresponse**](../Model/ListShipmentswithparametersresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **shipmentsGetratesPost**
> \ShipStation\Model\GetRatesresponse[] shipmentsGetratesPost($contentType, $body)

Get Rates

Retrieves shipping rates for the specified shipping details.  The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|-------------------  ``carrierCode`` | string, required | Returns rates for the specified carrier.  ``serviceCode`` | string, optional | Returns rates for the specified shipping service.  ``packageCode`` | string, optional | Returns rates for the specified package type.  ``fromPostalCode`` | string, required | Originating postal code.  ``toState`` | string, optional | Destination State/Province. Please use two-character state/province abbreviation. Note this field is required for the following carriers: UPS  ``toCountry`` | string, required | Destination Country.  Please use the two-character ISO country code.  ``toPostalCode`` | string, required | Destination Postal Code.  ``toCity`` | string, optional | Destination City.  ``weight`` | Weight, required | Shipment's weight.  Use ``Weight`` object.  ``dimensions`` | Dimensions, optional | Shipment's dimensions.  Use ``Dimensions`` object.   ``confirmation`` | string, optional | The type of delivery confirmation that is to be used once the shipment is created.  Possible values: ``none``, ``delivery``, ``signature``, ``adult_signature``, and ``direct_signature``.  ``direct_signature`` is available for FedEx only.  ``residential`` | boolean, optional | Returns rates that account for the specified delivery confirmation type. Default value: false

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\ShipmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\GetRatesrequest(); // \ShipStation\Model\GetRatesrequest | 

try {
    $result = $apiInstance->shipmentsGetratesPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ShipmentsApi->shipmentsGetratesPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\GetRatesrequest**](../Model/GetRatesrequest.md)|  |

### Return type

[**\ShipStation\Model\GetRatesresponse[]**](../Model/GetRatesresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **shipmentsVoidlabelPost**
> \ShipStation\Model\VoidLabelresponse shipmentsVoidlabelPost($contentType, $body)

Void Label

Voids the specified label by shipmentId.  The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|-------------------  ``shipmentId`` | number, required | ID of the shipment to void.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\ShipmentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\VoidLabelrequest(); // \ShipStation\Model\VoidLabelrequest | 

try {
    $result = $apiInstance->shipmentsVoidlabelPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ShipmentsApi->shipmentsVoidlabelPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\VoidLabelrequest**](../Model/VoidLabelrequest.md)|  |

### Return type

[**\ShipStation\Model\VoidLabelresponse**](../Model/VoidLabelresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

