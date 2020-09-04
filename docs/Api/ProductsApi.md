# ShipStation\ProductsApi

All URIs are relative to *https://ssapi.shipstation.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**productsByProductIdGet**](ProductsApi.md#productsByProductIdGet) | **GET** /products/{productId} | Get Product
[**productsByProductIdPut**](ProductsApi.md#productsByProductIdPut) | **PUT** /products/{productId} | Update Product
[**productsGet**](ProductsApi.md#productsGet) | **GET** /products | List Products with parameters


# **productsByProductIdGet**
> \ShipStation\Model\GetProductresponse productsByProductIdGet($productId)

Get Product



### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\ProductsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$productId = 1.2; // double | The system generated identifier for the Product.

try {
    $result = $apiInstance->productsByProductIdGet($productId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProductsApi->productsByProductIdGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **productId** | **double**| The system generated identifier for the Product. |

### Return type

[**\ShipStation\Model\GetProductresponse**](../Model/GetProductresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **productsByProductIdPut**
> \ShipStation\Model\UpdateProductresponse productsByProductIdPut($productId, $contentType, $body)

Update Product

Updates an existing product. This call does not currently support partial updates. The entire resource must be provided in the body of the request.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\ProductsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$productId = 1.2; // double | The system generated identifier for the Product.
$contentType = "contentType_example"; // string | 
$body = new \ShipStation\Model\UpdateProductrequest(); // \ShipStation\Model\UpdateProductrequest | 

try {
    $result = $apiInstance->productsByProductIdPut($productId, $contentType, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProductsApi->productsByProductIdPut: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **productId** | **double**| The system generated identifier for the Product. |
 **contentType** | **string**|  |
 **body** | [**\ShipStation\Model\UpdateProductrequest**](../Model/UpdateProductrequest.md)|  |

### Return type

[**\ShipStation\Model\UpdateProductresponse**](../Model/UpdateProductresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **productsGet**
> \ShipStation\Model\ListProductswithparametersresponse productsGet($sku, $name, $productCategoryId, $productTypeId, $tagId, $startDate, $endDate, $sortBy, $sortDir, $page, $pageSize, $showInactive)

List Products with parameters

Obtains a list of products that match the specified criteria.  All of the available filters are optional.  They do not need to be included in the URL.  If you do include them, here's what the URL may look like: Url format with filters: ``` /products?sku={sku} &name={name} &productCategoryId={productCategoryId} &productTypeId={productTypeId} &tagId={tagId} &startDate={startDate} &endDate={endDate} &showInactive={showInactive} &sortBy={sortBy} &sortDir={sortDir} &page={page} &pageSize={pageSize} ```

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure HTTP basic authorization: auth
$config = ShipStation\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new ShipStation\Api\ProductsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$sku = "sku_example"; // string | Returns products that match the specified SKU.
$name = "name_example"; // string | Returns products that match the specified product name.
$productCategoryId = "productCategoryId_example"; // string | Returns products that match the specified productCategoryId.
$productTypeId = "productTypeId_example"; // string | Returns products that match the specified productTypeId.
$tagId = "tagId_example"; // string | Returns products that match the specified tagId.
$startDate = "startDate_example"; // string | Returns products that were created after the specified date.
$endDate = "endDate_example"; // string | Returns products that were created before the specified date.
$sortBy = "sortBy_example"; // string | Sorts the order of the response based off the specified value.
$sortDir = "sortDir_example"; // string | Sets the direction of the sort order.
$page = "page_example"; // string | Page number.
$pageSize = "pageSize_example"; // string | Requested page size. Max value is 500.
$showInactive = "showInactive_example"; // string | Specifies whether the list should include inactive products.

try {
    $result = $apiInstance->productsGet($sku, $name, $productCategoryId, $productTypeId, $tagId, $startDate, $endDate, $sortBy, $sortDir, $page, $pageSize, $showInactive);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProductsApi->productsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **sku** | **string**| Returns products that match the specified SKU. | [optional]
 **name** | **string**| Returns products that match the specified product name. | [optional]
 **productCategoryId** | **string**| Returns products that match the specified productCategoryId. | [optional]
 **productTypeId** | **string**| Returns products that match the specified productTypeId. | [optional]
 **tagId** | **string**| Returns products that match the specified tagId. | [optional]
 **startDate** | **string**| Returns products that were created after the specified date. | [optional]
 **endDate** | **string**| Returns products that were created before the specified date. | [optional]
 **sortBy** | **string**| Sorts the order of the response based off the specified value. | [optional]
 **sortDir** | **string**| Sets the direction of the sort order. | [optional]
 **page** | **string**| Page number. | [optional]
 **pageSize** | **string**| Requested page size. Max value is 500. | [optional]
 **showInactive** | **string**| Specifies whether the list should include inactive products. | [optional]

### Return type

[**\ShipStation\Model\ListProductswithparametersresponse**](../Model/ListProductswithparametersresponse.md)

### Authorization

[auth](../../README.md#auth)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

