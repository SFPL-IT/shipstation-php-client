# ShipStation\CustomersApi

All URIs are relative to *https://ssapi.shipstation.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**customersByCustomerIdGet**](CustomersApi.md#customersByCustomerIdGet) | **GET** /customers/{customerId} | Get Customer
[**customersGet**](CustomersApi.md#customersGet) | **GET** /customers | List Customers


# **customersByCustomerIdGet**
> \ShipStation\Model\GetCustomerresponse customersByCustomerIdGet($customerId)

Get Customer



### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\CustomersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$customerId = 1.2; // double | The system generated identifier for the Customer.

try {
    $result = $apiInstance->customersByCustomerIdGet($customerId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CustomersApi->customersByCustomerIdGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **customerId** | **double**| The system generated identifier for the Customer. |

### Return type

[**\ShipStation\Model\GetCustomerresponse**](../Model/GetCustomerresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **customersGet**
> \ShipStation\Model\ListCustomersresponse customersGet($stateCode, $countryCode, $marketplaceId, $tagId, $sortBy, $sortDir, $page, $pageSize)

List Customers

Obtains a list of customers that match the specified criteria.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\CustomersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$stateCode = "stateCode_example"; // string | Returns customers that reside in the specified stateCode.
$countryCode = "countryCode_example"; // string | Returns customers that reside in the specified countryCode.
$marketplaceId = 1.2; // double | Returns customers that purchased items from the specified marketplaceId.
$tagId = 1.2; // double | Returns customers that have been tagged with the specified tagId.
$sortBy = "sortBy_example"; // string | Sorts the order of the response based off the specified value.
$sortDir = "sortDir_example"; // string | Sets the direction of the sort order.
$page = 1.2; // double | Page number.
$pageSize = 1.2; // double | Requested page size. Max value is 500.

try {
    $result = $apiInstance->customersGet($stateCode, $countryCode, $marketplaceId, $tagId, $sortBy, $sortDir, $page, $pageSize);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CustomersApi->customersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **stateCode** | **string**| Returns customers that reside in the specified stateCode. | [optional]
 **countryCode** | **string**| Returns customers that reside in the specified countryCode. | [optional]
 **marketplaceId** | **double**| Returns customers that purchased items from the specified marketplaceId. | [optional]
 **tagId** | **double**| Returns customers that have been tagged with the specified tagId. | [optional]
 **sortBy** | **string**| Sorts the order of the response based off the specified value. | [optional]
 **sortDir** | **string**| Sets the direction of the sort order. | [optional]
 **page** | **double**| Page number. | [optional]
 **pageSize** | **double**| Requested page size. Max value is 500. | [optional]

### Return type

[**\ShipStation\Model\ListCustomersresponse**](../Model/ListCustomersresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

