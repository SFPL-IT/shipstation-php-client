# ShipStation\CarriersApi

All URIs are relative to *https://ssapi.shipstation.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**carriersAddfundsPost**](CarriersApi.md#carriersAddfundsPost) | **POST** /carriers/addfunds | Add Funds
[**carriersGet**](CarriersApi.md#carriersGet) | **GET** /carriers | List Carriers
[**carriersGetcarrierByCarrierCodeGet**](CarriersApi.md#carriersGetcarrierByCarrierCodeGet) | **GET** /carriers/getcarrier | Get Carrier
[**carriersListpackagesByCarrierCodeGet**](CarriersApi.md#carriersListpackagesByCarrierCodeGet) | **GET** /carriers/listpackages | List Packages
[**carriersListservicesByCarrierCodeGet**](CarriersApi.md#carriersListservicesByCarrierCodeGet) | **GET** /carriers/listservices | List Services


# **carriersAddfundsPost**
> \ShipStation\Model\AddFundsresponse carriersAddfundsPost($body)

Add Funds

Adds funds to a carrier account using the payment information on file. The body of this request should specify the following attributes: Name               |Data Type          |Description -------------------|-------------------|-------------------  ``carrierCode`` | string, required |  The carrier to add funds to.  ``amount`` | number, required | The dollar amount to add to the account.  The minimum value that can be added is $10.00.  The maximum value is $10,000.00.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\CarriersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \ShipStation\Model\AddFundsrequest(); // \ShipStation\Model\AddFundsrequest | 

try {
    $result = $apiInstance->carriersAddfundsPost($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarriersApi->carriersAddfundsPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\ShipStation\Model\AddFundsrequest**](../Model/AddFundsrequest.md)|  |

### Return type

[**\ShipStation\Model\AddFundsresponse**](../Model/AddFundsresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **carriersGet**
> \ShipStation\Model\ListCarriersresponse[] carriersGet()

List Carriers

Lists all shipping providers connected to this account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\CarriersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->carriersGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarriersApi->carriersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\ShipStation\Model\ListCarriersresponse[]**](../Model/ListCarriersresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **carriersGetcarrierByCarrierCodeGet**
> \ShipStation\Model\GetCarrierresponse carriersGetcarrierByCarrierCodeGet($carrierCode)

Get Carrier

Retrieves the shipping carrier account details for the specified carrierCode. Use this method to determine a carrier's account balance.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\CarriersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$carrierCode = "carrierCode_example"; // string | The code for the carrier account to retrieve.

try {
    $result = $apiInstance->carriersGetcarrierByCarrierCodeGet($carrierCode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarriersApi->carriersGetcarrierByCarrierCodeGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **carrierCode** | **string**| The code for the carrier account to retrieve. |

### Return type

[**\ShipStation\Model\GetCarrierresponse**](../Model/GetCarrierresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **carriersListpackagesByCarrierCodeGet**
> \ShipStation\Model\ListPackagesresponse[] carriersListpackagesByCarrierCodeGet($carrierCode)

List Packages

Retrieves a list of packages for the specified carrier

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\CarriersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$carrierCode = "carrierCode_example"; // string | The carrier's code

try {
    $result = $apiInstance->carriersListpackagesByCarrierCodeGet($carrierCode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarriersApi->carriersListpackagesByCarrierCodeGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **carrierCode** | **string**| The carrier&#39;s code |

### Return type

[**\ShipStation\Model\ListPackagesresponse[]**](../Model/ListPackagesresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **carriersListservicesByCarrierCodeGet**
> \ShipStation\Model\ListServicesresponse[] carriersListservicesByCarrierCodeGet($carrierCode)

List Services

Retrieves the list of available shipping services provided by the specified carrier

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\CarriersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$carrierCode = "carrierCode_example"; // string | The carrier's code

try {
    $result = $apiInstance->carriersListservicesByCarrierCodeGet($carrierCode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CarriersApi->carriersListservicesByCarrierCodeGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **carrierCode** | **string**| The carrier&#39;s code |

### Return type

[**\ShipStation\Model\ListServicesresponse[]**](../Model/ListServicesresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

