# Comwrap_WebapiAsyncObjectValidation

Increase Bulk API performance, using direct entity publishing as array without creating objects for validation.

## How to use

Extension works for API request to the Bulk API endpoints. Set the custom request header with name 'disable-object-validation'. 
Value for a header could be any, even empty. If header is set, the extension skips objects creation and validation. 
These operations take quite long time among the request duration.