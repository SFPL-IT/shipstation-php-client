# ShipStation\AccountsApi

All URIs are relative to *https://ssapi.shipstation.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**accountsListtagsGet**](AccountsApi.md#accountsListtagsGet) | **GET** /accounts/listtags | List Tags
[**accountsRegisteraccountPost**](AccountsApi.md#accountsRegisteraccountPost) | **POST** /accounts/registeraccount | Register Account


# **accountsListtagsGet**
> \ShipStation\Model\ListTagsresponse[] accountsListtagsGet()

List Tags

Lists all tags defined for this account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\AccountsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->accountsListtagsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountsApi->accountsListtagsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\ShipStation\Model\ListTagsresponse[]**](../Model/ListTagsresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **accountsRegisteraccountPost**
> \ShipStation\Model\RegisterAccountresponse accountsRegisteraccountPost($contentType, $body)

Register Account

Creates a new ShipStation account and generates an apiKey and apiSecret to be used by the newly created account. PLEASE NOTE: This endpoint does not require API key and API Secret credentials.  The Authorization header can be left off. Use of this specific endpoint requires approval, and is meant only for direct partners of ShipStation. This is the only endpoint to require approval. All other endpoints listed in this document can be accessed by submitting proper authorization credentials in the header of the request. To become a direct partner of ShipStation, or to request more information on becoming a direct partner, we recommend reaching out to our Partners and Integrations team here: https://info.shipstation.com/become-a-partner-api-and-custom-store-integrations The body of this request has the following attributes: Name               |Data Type          |Description -------------------|-------------------|------------------- ``firstName``  | string, required | First Name ``lastName`` | string, required | Last Name ``email`` | string, required | Email address. This will also be the username of the account. ``password`` | string, required | Password to set for account access. ``companyName`` | string, optional | Name of Company. ``addr1`` | string, optional | Company Address - Street 1 ``addr2`` | string, optional | Company Address - Street 2 ``city`` | string, optional | Company Address - City ``state`` | string, optional | Company Address - State  ``zip`` | string, optional | Company Address - Zip Code ``countryCode`` |string, optional | Company Address - Country.  Please use a 2-character country code. ``phone`` | string, optional | Company Phone number.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\AccountsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\RegisterAccountrequest(); // \ShipStation\Model\RegisterAccountrequest | 

try {
    $result = $apiInstance->accountsRegisteraccountPost($contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountsApi->accountsRegisteraccountPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\RegisterAccountrequest**](../Model/RegisterAccountrequest.md)|  |

### Return type

[**\ShipStation\Model\RegisterAccountresponse**](../Model/RegisterAccountresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

