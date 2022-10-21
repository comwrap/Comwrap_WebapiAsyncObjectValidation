# Comwrap_WebapiAsyncObjectValidation

Increase Bulk API performance, using direct entity publishing as array without creating objects for validation.

## How to use

Extension works for API request to the Bulk API endpoints. Set the custom request header with name 'disable-object-validation'. 
Value for a header could be any, even empty. If header is set, the extension skips objects creation and validation. 
These operations take quite long time among the request duration.

## Additional improvements

Additionally, there was implemented the functionality, related to the bulk model loading.
For this purpose, the custom resource and data model were created for the `magento_bulk` table.
Following models are used in custom `Entity Manager`, which rewrites CRUD operations for standard
entity manager. Custom `Entity Manager` is passed to the Magento BulkManagement model as entityManager
argument and performs CRUD operations via resource model. This increases performance of the Bulk API operations.