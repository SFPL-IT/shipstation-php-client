# ShipStation
# Integrating with ShipStation  
ShipStation strives to streamline shipping for online sellers, no matter where they sell their products online. We are continuously adding new marketplaces, shopping carts, and integration tools, because we know the e-commerce space is growing.  As a result, we’ve worked hard to provide developer resources to build custom integrations with ShipStation.  If you’re interested in becoming a partner of ours, drop us a line by [filling out this form](http://www.shipstation.com/partners/shipstation-api-custom-store/) and we’ll get in touch.  There are two methods to integrate with ShipStation:  * Custom Store Integration  * ShipStation API  ## Custom Store Integration  Looking for a more 1-to-1 relationship between ShipStation and your chosen selling platform? The Custom Store Integration is the ticket. Our custom store integration is just like any of our other selling channel integration, and could be eligible (based on internal review) as a branded option within the ShipStation admin. It also allows the user to sync orders within ShipStation in a single click, in addition to ShipStation automatically sending shipment status and tracking information  updates back to your cart or marketplace once a label is created. It’s the best way to sync up orders with ShipStation and have the most seamless experience.  The Custom Store allows you to perform two major functions:  * Provide order information to ShipStation, including recipient address, products, customers, etc.  * Receive tracking information when an order is shipped, including shipping method, shipping status, tracking number, and more  To integrate with the Custom Store, you must expose a web page that renders XML that adheres to the specification defined in the Custom Store Integration Guide.  We refer to this page as your “XML Endpoint”. If you can provide us an XML Endpoint, we can *pull* data from your endpoint just like we do with other marketplaces like eBay and Amazon.  **To find out more about our Custom Store Integration, click here: [Custom Store Integration Guide](https://help.shipstation.com/hc/en-us/articles/205928478)**  ## ShipStation API  Our API is available for any plan, and allows for read access to almost all data in your account, and write access to create specific objects, like Orders, Customers, and Products.  The API is a great way to get data directly to and from ShipStation, like creating products, customers, and querying order & shipping data. Please note that an API integration will not allow you to use your own MarketplaceID that could eventually be branded with your company's logo (see the Custom Store Integration above for that functionality).  **This API allows developers to build applications that interface with the ShipStation platform. The API can be used to automate many tasks including:**  + Managing Orders  + Managing Shipments  + Creating Shipping Labels  + Retrieving Shipping Rates  + and more!!!  **To learn more about our API, please review our API documentation below.**  ## Which one should I pick?  The method that's right for your integration very much depends on the type of integration you're planning on implementing. A Custom Store allows ShipStation to *pull* order information from your platform the very same way we *pull* data from marketplaces such as eBay, Amazon, and Shopify. Once an order has been shipped in ShipStation, ShipStation automatically *pushes* tracking information back to your custom store. Though the functionality afforded by this approach is limited to these 2 main functions, much of the *heavy lifting* is performed by ShipStation. Importing orders  and sending tracking information is performed automatically by ShipStation, as long as your XML endpoint is available to receive our data.  An API integration, on the other hand, exposes much more functionality, but requires that the developer do much of the heavy lifting. Orders must be *pushed* to ShipStation by using our \"/orders/CreateOrder\" endpoint.  The API allows developers to perform functions such as tagging an order,  shipping an order, creating a shipping label (without an order), retrieving shipping rates, adding funds to a carrier account, creating a warehouse, listing products, and much more.  The functionality the API affords are typical actions that a user would perform if using the web app.  ### Considerations  * **Will your integration be the main order management tool for the online seller?**  If so, the API's broader range of functionality may be the best option.  * **Would you like your store integration to be a branded marketplace within the ShipStation admin?** When you integrate using the Custom Store Integration, you could be eligible to have your company branded within the ShipStation admin. A branded store could have the plugin's logo in the app, as well as an easier store setup, order sync, and reporting. Please note, ShipStation makes the final decision, based on integration and partner requirements, on which custom stores are branded within our application.  # ShipStation API Requirements  ## End Point  Endpoints are located at the following domain https://ssapi.shipstation.com/ and will need to have a specific reference added to return data. PLEASE NOTE: You cannot access this URL directly and must reference one of the specific endpoints below.  ## Authentication  The ShipStation API uses [Basic HTTP authentication](http://en.wikipedia.org/wiki/Basic_access_authentication). Use your ShipStation ``API Key`` as the username and ``API Secret`` as the password.  You can find your ``API Key`` as the username and ``API Secret`` under Settings at https://ss.shipstation.com/#/settings/api .  The Authorization header is constructed as follows:  + Username (``API KEY``) and password (``API Secret``) are combined into a string \"username:password\"  + The resulting string is then encoded using the RFC2045-MIME variant of Base64, except not limited to 76 char/line  + The authorization method and a space i.e. \"Basic \" is then put before the encoded string.  For example, if the ``API KEY`` given is 'ShipStation' and the ``API Secret`` is 'Rocks' then the header is formed as follows:  + Authorization: Basic U2hpcFN0YXRpb246Um9ja3M=  ## API Rate Limits  In an effort to ensure consistent application performance and increased scalability, we have implemented rate limiting on the ShipStation API.  Your integration will need to be able to handle HTTP rate limiting status messages as defined below:  **Response Headers**  All responses will include headers with status information about rate limiting.  1. X-Rate-Limit-Limit: the maximum number of requests per minute to the endpoint  2. X-Rate-Limit-Remaining: the available requests remaining in the current window  3. X-Rate-Limit-Reset: the number of seconds remaining until the next window begins  **Hitting the Limit**  If your application hits the rate limit, an HTTP 429 will be returned with this body:  ``` {     \"message\": \"Too Many Requests\" } ```  And these headers, assuming it is 40 seconds into the current window:  ``` {     \"X-Rate-Limit-Limit\": 60,     \"X-Rate-Limit-Remaining\": 0,     \"X-Rate-Limit-Reset\": 20 } ```  When the limit is reached, your application should stop making requests until X-Rate-Limit-Reset seconds have elapsed. The current Rate limit for each set of the API Key and Secret is 40 requests per minute.  If you have any issues with the API, please email us at <apisupport@shipstation.com>  ## Server Responses  Status Code | Description ------------|------------- ``200`` | OK - The request was successful (some API calls may return 201 instead). ``201`` | Created - The request was successful and a resource was created. ``204`` | No Content - The request was successful but there is no representation to return (that is, the response is empty). ``400`` | Bad Request -  The request could not be understood or was missing required parameters. ``401`` | Unauthorized -  Authentication failed or user does not have permissions for the requested operation. ``403`` | Forbidden - Access denied. ``404`` | Not Found -  Resource was not found. ``405`` | Method Not Allowed -  Requested method is not supported for the specified resource. ``429`` | Too Many Requests - Exceeded ShipStation API limits. When the limit is reached, your application should stop making requests until X-Rate-Limit-Reset seconds have elapsed. ``500`` | Internal Server Error - ShipStation has encountered an error.  ## DateTime Format and Time Zone  ShipStation uses the ISO 8601 combined format for dateTime stamps being submitted to and returned from the API. Please be sure to submit all dateTime values as follows:  yyyy-mm-dd hh:mm:ss (24 hour notation). Example - ``2016-11-29 23:59:59``  The time zone represented in all API responses is PST/PDT. Similarly, ShipStation asks that you make all time zone convertions and submit any dateTime requests in PST/PDT.

This PHP package is automatically generated by the [Swagger Codegen](https://github.com/swagger-api/swagger-codegen) project:

- API version: 1.0
- Package version: 0.1.0
- Build package: io.swagger.codegen.languages.PhpClientCodegen

## Requirements

PHP 5.5 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/SFPL-IT/shipstation-php-client.git"
    }
  ],
  "require": {
    "sfpl/shipstation-php-client": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/ShipStation/vendor/autoload.php');
```

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## Documentation for API Endpoints

All URIs are relative to *https://ssapi.shipstation.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AccountsApi* | [**accountsListtagsGet**](docs/Api/AccountsApi.md#accountslisttagsget) | **GET** /accounts/listtags | List Tags
*AccountsApi* | [**accountsRegisteraccountPost**](docs/Api/AccountsApi.md#accountsregisteraccountpost) | **POST** /accounts/registeraccount | Register Account
*CarriersApi* | [**carriersAddfundsPost**](docs/Api/CarriersApi.md#carriersaddfundspost) | **POST** /carriers/addfunds | Add Funds
*CarriersApi* | [**carriersGet**](docs/Api/CarriersApi.md#carriersget) | **GET** /carriers | List Carriers
*CarriersApi* | [**carriersGetcarrierByCarrierCodeGet**](docs/Api/CarriersApi.md#carriersgetcarrierbycarriercodeget) | **GET** /carriers/getcarrier | Get Carrier
*CarriersApi* | [**carriersListpackagesByCarrierCodeGet**](docs/Api/CarriersApi.md#carrierslistpackagesbycarriercodeget) | **GET** /carriers/listpackages | List Packages
*CarriersApi* | [**carriersListservicesByCarrierCodeGet**](docs/Api/CarriersApi.md#carrierslistservicesbycarriercodeget) | **GET** /carriers/listservices | List Services
*CustomersApi* | [**customersByCustomerIdGet**](docs/Api/CustomersApi.md#customersbycustomeridget) | **GET** /customers/{customerId} | Get Customer
*CustomersApi* | [**customersGet**](docs/Api/CustomersApi.md#customersget) | **GET** /customers | List Customers
*FulfillmentsApi* | [**fulfillmentsGet**](docs/Api/FulfillmentsApi.md#fulfillmentsget) | **GET** /fulfillments | List Fulfillments with parameters
*OrdersApi* | [**ordersAddtagPost**](docs/Api/OrdersApi.md#ordersaddtagpost) | **POST** /orders/addtag | Add Tag to Order
*OrdersApi* | [**ordersAssignuserPost**](docs/Api/OrdersApi.md#ordersassignuserpost) | **POST** /orders/assignuser | Assign User to Order
*OrdersApi* | [**ordersByOrderIdDelete**](docs/Api/OrdersApi.md#ordersbyorderiddelete) | **DELETE** /orders/{orderId} | Delete Order
*OrdersApi* | [**ordersByOrderIdGet**](docs/Api/OrdersApi.md#ordersbyorderidget) | **GET** /orders/{orderId} | Get Order
*OrdersApi* | [**ordersCreatelabelfororderPost**](docs/Api/OrdersApi.md#orderscreatelabelfororderpost) | **POST** /orders/createlabelfororder | Create Label for Order
*OrdersApi* | [**ordersCreateorderPost**](docs/Api/OrdersApi.md#orderscreateorderpost) | **POST** /orders/createorder | Create/Update Order
*OrdersApi* | [**ordersCreateordersPost**](docs/Api/OrdersApi.md#orderscreateorderspost) | **POST** /orders/createorders | Create/Update Multiple Orders
*OrdersApi* | [**ordersGet**](docs/Api/OrdersApi.md#ordersget) | **GET** /orders | List Orders with parameters
*OrdersApi* | [**ordersHolduntilPost**](docs/Api/OrdersApi.md#ordersholduntilpost) | **POST** /orders/holduntil | Hold Order Until
*OrdersApi* | [**ordersListbytagGet**](docs/Api/OrdersApi.md#orderslistbytagget) | **GET** /orders/listbytag | List Orders by Tag
*OrdersApi* | [**ordersMarkasshippedPost**](docs/Api/OrdersApi.md#ordersmarkasshippedpost) | **POST** /orders/markasshipped | Mark an Order as Shipped
*OrdersApi* | [**ordersRemovetagPost**](docs/Api/OrdersApi.md#ordersremovetagpost) | **POST** /orders/removetag | Remove Tag from Order
*OrdersApi* | [**ordersRestorefromholdPost**](docs/Api/OrdersApi.md#ordersrestorefromholdpost) | **POST** /orders/restorefromhold | Restore Order from On Hold
*OrdersApi* | [**ordersUnassignuserPost**](docs/Api/OrdersApi.md#ordersunassignuserpost) | **POST** /orders/unassignuser | Unassign User from Order
*ProductsApi* | [**productsByProductIdGet**](docs/Api/ProductsApi.md#productsbyproductidget) | **GET** /products/{productId} | Get Product
*ProductsApi* | [**productsByProductIdPut**](docs/Api/ProductsApi.md#productsbyproductidput) | **PUT** /products/{productId} | Update Product
*ProductsApi* | [**productsGet**](docs/Api/ProductsApi.md#productsget) | **GET** /products | List Products with parameters
*ShipmentsApi* | [**shipmentsCreatelabelPost**](docs/Api/ShipmentsApi.md#shipmentscreatelabelpost) | **POST** /shipments/createlabel | Create Shipment Label
*ShipmentsApi* | [**shipmentsGet**](docs/Api/ShipmentsApi.md#shipmentsget) | **GET** /shipments | List Shipments with parameters
*ShipmentsApi* | [**shipmentsGetratesPost**](docs/Api/ShipmentsApi.md#shipmentsgetratespost) | **POST** /shipments/getrates | Get Rates
*ShipmentsApi* | [**shipmentsVoidlabelPost**](docs/Api/ShipmentsApi.md#shipmentsvoidlabelpost) | **POST** /shipments/voidlabel | Void Label
*StoresApi* | [**storesByStoreIdGet**](docs/Api/StoresApi.md#storesbystoreidget) | **GET** /stores/{storeId} | Get Store
*StoresApi* | [**storesByStoreIdPut**](docs/Api/StoresApi.md#storesbystoreidput) | **PUT** /stores/{storeId} | Update Store
*StoresApi* | [**storesDeactivatePost**](docs/Api/StoresApi.md#storesdeactivatepost) | **POST** /stores/deactivate | Deactivate Store
*StoresApi* | [**storesGet**](docs/Api/StoresApi.md#storesget) | **GET** /stores | List Stores
*StoresApi* | [**storesGetrefreshstatusByStoreIdGet**](docs/Api/StoresApi.md#storesgetrefreshstatusbystoreidget) | **GET** /stores/getrefreshstatus | Get Store Refresh Status
*StoresApi* | [**storesMarketplacesGet**](docs/Api/StoresApi.md#storesmarketplacesget) | **GET** /stores/marketplaces | List Marketplaces
*StoresApi* | [**storesReactivatePost**](docs/Api/StoresApi.md#storesreactivatepost) | **POST** /stores/reactivate | Reactivate Store
*StoresApi* | [**storesRefreshstoreByStoreIdAndRefreshDatePost**](docs/Api/StoresApi.md#storesrefreshstorebystoreidandrefreshdatepost) | **POST** /stores/refreshstore | Refresh Store
*UsersApi* | [**usersByShowInactiveGet**](docs/Api/UsersApi.md#usersbyshowinactiveget) | **GET** /users | List Users
*WarehousesApi* | [**warehousesByWarehouseIdDelete**](docs/Api/WarehousesApi.md#warehousesbywarehouseiddelete) | **DELETE** /warehouses/{warehouseId} | Delete Warehouse
*WarehousesApi* | [**warehousesByWarehouseIdGet**](docs/Api/WarehousesApi.md#warehousesbywarehouseidget) | **GET** /warehouses/{warehouseId} | Get Warehouse
*WarehousesApi* | [**warehousesByWarehouseIdPut**](docs/Api/WarehousesApi.md#warehousesbywarehouseidput) | **PUT** /warehouses/{warehouseId} | Update Warehouse
*WarehousesApi* | [**warehousesCreatewarehousePost**](docs/Api/WarehousesApi.md#warehousescreatewarehousepost) | **POST** /warehouses/createwarehouse | Create Warehouse
*WarehousesApi* | [**warehousesGet**](docs/Api/WarehousesApi.md#warehousesget) | **GET** /warehouses | List Warehouses
*WebhooksApi* | [**webhooksByWebhookIdDelete**](docs/Api/WebhooksApi.md#webhooksbywebhookiddelete) | **DELETE** /webhooks/{webhookId} | Unsubscribe to Webhook
*WebhooksApi* | [**webhooksGet**](docs/Api/WebhooksApi.md#webhooksget) | **GET** /webhooks | List Webhooks
*WebhooksApi* | [**webhooksSubscribePost**](docs/Api/WebhooksApi.md#webhookssubscribepost) | **POST** /webhooks/subscribe | Subscribe to Webhook


## Documentation For Models

 - [AddFundsrequest](docs/Model/AddFundsrequest.md)
 - [AddFundsresponse](docs/Model/AddFundsresponse.md)
 - [AddTagtoOrderrequest](docs/Model/AddTagtoOrderrequest.md)
 - [AddTagtoOrderresponse](docs/Model/AddTagtoOrderresponse.md)
 - [AdvancedOptions](docs/Model/AdvancedOptions.md)
 - [AdvancedOptions4](docs/Model/AdvancedOptions4.md)
 - [AssignUsertoOrderrequest](docs/Model/AssignUsertoOrderrequest.md)
 - [AssignUsertoOrderresponse](docs/Model/AssignUsertoOrderresponse.md)
 - [BillTo](docs/Model/BillTo.md)
 - [BillTo1](docs/Model/BillTo1.md)
 - [CreateLabelforOrderrequest](docs/Model/CreateLabelforOrderrequest.md)
 - [CreateLabelforOrderresponse](docs/Model/CreateLabelforOrderresponse.md)
 - [CreateShipmentLabelrequest](docs/Model/CreateShipmentLabelrequest.md)
 - [CreateShipmentLabelresponse](docs/Model/CreateShipmentLabelresponse.md)
 - [CreateUpdateMultipleOrdersrequest](docs/Model/CreateUpdateMultipleOrdersrequest.md)
 - [CreateUpdateMultipleOrdersresponse](docs/Model/CreateUpdateMultipleOrdersresponse.md)
 - [CreateUpdateOrderrequest](docs/Model/CreateUpdateOrderrequest.md)
 - [CreateUpdateOrderresponse](docs/Model/CreateUpdateOrderresponse.md)
 - [CreateWarehouserequest](docs/Model/CreateWarehouserequest.md)
 - [CreateWarehouseresponse](docs/Model/CreateWarehouseresponse.md)
 - [Customer](docs/Model/Customer.md)
 - [CustomsItem](docs/Model/CustomsItem.md)
 - [DeactivateStorerequest](docs/Model/DeactivateStorerequest.md)
 - [DeactivateStoreresponse](docs/Model/DeactivateStoreresponse.md)
 - [DeleteOrderresponse](docs/Model/DeleteOrderresponse.md)
 - [DeleteWarehouseresponse](docs/Model/DeleteWarehouseresponse.md)
 - [Dimensions](docs/Model/Dimensions.md)
 - [Fulfillment](docs/Model/Fulfillment.md)
 - [GetCarrierresponse](docs/Model/GetCarrierresponse.md)
 - [GetCustomerresponse](docs/Model/GetCustomerresponse.md)
 - [GetOrderresponse](docs/Model/GetOrderresponse.md)
 - [GetProductresponse](docs/Model/GetProductresponse.md)
 - [GetRatesrequest](docs/Model/GetRatesrequest.md)
 - [GetRatesresponse](docs/Model/GetRatesresponse.md)
 - [GetStoreRefreshStatusresponse](docs/Model/GetStoreRefreshStatusresponse.md)
 - [GetStoreresponse](docs/Model/GetStoreresponse.md)
 - [GetWarehouseresponse](docs/Model/GetWarehouseresponse.md)
 - [HoldOrderUntilrequest](docs/Model/HoldOrderUntilrequest.md)
 - [HoldOrderUntilresponse](docs/Model/HoldOrderUntilresponse.md)
 - [InsuranceOptions](docs/Model/InsuranceOptions.md)
 - [InsuranceOptions4](docs/Model/InsuranceOptions4.md)
 - [InternationalOptions](docs/Model/InternationalOptions.md)
 - [InternationalOptions1](docs/Model/InternationalOptions1.md)
 - [InternationalOptions4](docs/Model/InternationalOptions4.md)
 - [Item](docs/Model/Item.md)
 - [Item1](docs/Model/Item1.md)
 - [Item2](docs/Model/Item2.md)
 - [Item4](docs/Model/Item4.md)
 - [Item6](docs/Model/Item6.md)
 - [ListCarriersresponse](docs/Model/ListCarriersresponse.md)
 - [ListCustomersresponse](docs/Model/ListCustomersresponse.md)
 - [ListFulfillmentswOparametersresponse](docs/Model/ListFulfillmentswOparametersresponse.md)
 - [ListFulfillmentswithparametersresponse](docs/Model/ListFulfillmentswithparametersresponse.md)
 - [ListMarketplacesresponse](docs/Model/ListMarketplacesresponse.md)
 - [ListOrdersbyTagresponse](docs/Model/ListOrdersbyTagresponse.md)
 - [ListOrderswOparametersresponse](docs/Model/ListOrderswOparametersresponse.md)
 - [ListOrderswithparametersresponse](docs/Model/ListOrderswithparametersresponse.md)
 - [ListPackagesresponse](docs/Model/ListPackagesresponse.md)
 - [ListProductswOparametersresponse](docs/Model/ListProductswOparametersresponse.md)
 - [ListProductswithparametersresponse](docs/Model/ListProductswithparametersresponse.md)
 - [ListServicesresponse](docs/Model/ListServicesresponse.md)
 - [ListShipmentswOparametersresponse](docs/Model/ListShipmentswOparametersresponse.md)
 - [ListShipmentswithparametersresponse](docs/Model/ListShipmentswithparametersresponse.md)
 - [ListStoresresponse](docs/Model/ListStoresresponse.md)
 - [ListTagsresponse](docs/Model/ListTagsresponse.md)
 - [ListUsersresponse](docs/Model/ListUsersresponse.md)
 - [ListWarehousesresponse](docs/Model/ListWarehousesresponse.md)
 - [ListWebhooksresponse](docs/Model/ListWebhooksresponse.md)
 - [MarkanOrderasShippedrequest](docs/Model/MarkanOrderasShippedrequest.md)
 - [MarkanOrderasShippedresponse](docs/Model/MarkanOrderasShippedresponse.md)
 - [MarketplaceUsername](docs/Model/MarketplaceUsername.md)
 - [Option](docs/Model/Option.md)
 - [Order](docs/Model/Order.md)
 - [Order2](docs/Model/Order2.md)
 - [OrderStatus](docs/Model/OrderStatus.md)
 - [OriginAddress](docs/Model/OriginAddress.md)
 - [OriginAddress3](docs/Model/OriginAddress3.md)
 - [OriginAddress4](docs/Model/OriginAddress4.md)
 - [Product](docs/Model/Product.md)
 - [ProductCategory](docs/Model/ProductCategory.md)
 - [ReactivateStorerequest](docs/Model/ReactivateStorerequest.md)
 - [ReactivateStoreresponse](docs/Model/ReactivateStoreresponse.md)
 - [RefreshStorerequest](docs/Model/RefreshStorerequest.md)
 - [RefreshStoreresponse](docs/Model/RefreshStoreresponse.md)
 - [RegisterAccountrequest](docs/Model/RegisterAccountrequest.md)
 - [RegisterAccountresponse](docs/Model/RegisterAccountresponse.md)
 - [RemoveTagfromOrderrequest](docs/Model/RemoveTagfromOrderrequest.md)
 - [RemoveTagfromOrderresponse](docs/Model/RemoveTagfromOrderresponse.md)
 - [RestoreOrderfromOnHoldrequest](docs/Model/RestoreOrderfromOnHoldrequest.md)
 - [RestoreOrderfromOnHoldresponse](docs/Model/RestoreOrderfromOnHoldresponse.md)
 - [Result](docs/Model/Result.md)
 - [ReturnAddress](docs/Model/ReturnAddress.md)
 - [ReturnAddress3](docs/Model/ReturnAddress3.md)
 - [ShipFrom](docs/Model/ShipFrom.md)
 - [ShipTo](docs/Model/ShipTo.md)
 - [ShipTo11](docs/Model/ShipTo11.md)
 - [ShipTo2](docs/Model/ShipTo2.md)
 - [ShipTo3](docs/Model/ShipTo3.md)
 - [ShipTo6](docs/Model/ShipTo6.md)
 - [ShipTo9](docs/Model/ShipTo9.md)
 - [Shipment](docs/Model/Shipment.md)
 - [ShipmentItem](docs/Model/ShipmentItem.md)
 - [SortBy](docs/Model/SortBy.md)
 - [SortBy1](docs/Model/SortBy1.md)
 - [SortBy2](docs/Model/SortBy2.md)
 - [SortBy3](docs/Model/SortBy3.md)
 - [SortDir](docs/Model/SortDir.md)
 - [StatusMapping](docs/Model/StatusMapping.md)
 - [SubscribetoWebhookrequest](docs/Model/SubscribetoWebhookrequest.md)
 - [SubscribetoWebhookresponse](docs/Model/SubscribetoWebhookresponse.md)
 - [Tag](docs/Model/Tag.md)
 - [UnassignUserfromOrderrequest](docs/Model/UnassignUserfromOrderrequest.md)
 - [UnassignUserfromOrderresponse](docs/Model/UnassignUserfromOrderresponse.md)
 - [UpdateProductrequest](docs/Model/UpdateProductrequest.md)
 - [UpdateProductresponse](docs/Model/UpdateProductresponse.md)
 - [UpdateStorerequest](docs/Model/UpdateStorerequest.md)
 - [UpdateStoreresponse](docs/Model/UpdateStoreresponse.md)
 - [UpdateWarehouserequest](docs/Model/UpdateWarehouserequest.md)
 - [UpdateWarehouseresponse](docs/Model/UpdateWarehouseresponse.md)
 - [VoidLabelrequest](docs/Model/VoidLabelrequest.md)
 - [VoidLabelresponse](docs/Model/VoidLabelresponse.md)
 - [Webhook](docs/Model/Webhook.md)
 - [Weight](docs/Model/Weight.md)


## Documentation For Authorization


## auth

- **Type**: HTTP basic authentication


## Author

