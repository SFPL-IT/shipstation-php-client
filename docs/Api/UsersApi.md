# ShipStation\UsersApi

All URIs are relative to *https://ssapi.shipstation.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**usersByShowInactiveGet**](UsersApi.md#usersByShowInactiveGet) | **GET** /users | List Users


# **usersByShowInactiveGet**
> \ShipStation\Model\ListUsersresponse usersByShowInactiveGet($showInactive)

List Users



### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$showInactive = true; // bool | Determines whether inactive users will be returned in the response.

try {
    $result = $apiInstance->usersByShowInactiveGet($showInactive);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersByShowInactiveGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **showInactive** | **bool**| Determines whether inactive users will be returned in the response. | [optional]

### Return type

[**\ShipStation\Model\ListUsersresponse**](../Model/ListUsersresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

