# Klaviyo PHP SDK

- SDK version: 13.0.0
- API Revision: 2025-01-15

## Helpful Resources

- [API Reference](https://developers.klaviyo.com/en/v2025-01-15/reference)
- [API Guides](https://developers.klaviyo.com/en/v2025-01-15/docs)
- [Postman Workspace](https://www.postman.com/klaviyo/workspace/klaviyo-developers)

## Design & Approach

This SDK is a thin wrapper around our API. See our API Reference for full documentation on behavior.

This SDK mirrors the organization and naming convention of the above language-agnostic resources, with a few namespace changes to conform to PHP idioms (details in Appendix).

## Organization

This SDK is organized into the following resources:



- Accounts



- Campaigns



- Catalogs



- Coupons



- DataPrivacy



- Events



- Flows



- Forms



- Images



- Lists



- Metrics



- Profiles



- Reporting



- Reviews



- Segments



- Tags



- Templates



- TrackingSettings



- Webhooks



## Installation

You can install this package using [our Packagist package](https://packagist.org/packages/klaviyo/api):

```bash
composer require klaviyo/api
```

## Usage Example

> **Note**: The following examples use [named arguments](https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments), which were introduced in PHP 8. If using an older version of PHP, you may need to explicitly pass omitted positional arguments. For example, if a given function has the following optional parameters `someFunction($a=1, $b=2, $c=3)`, and you wish to only set `$b`, you must pass in `someFunction($a=null, $b=$YOUR_VALUE)`.

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use KlaviyoAPI\KlaviyoAPI;

$klaviyo = new KlaviyoAPI(
    'YOUR_API_KEY',
    num_retries: 3,
    guzzle_options: [],
    user_agent_suffix: "/YOUR_APP_NAME");

$response = $klaviyo->Metrics->getMetrics();
```

### Use Case Examples

#### How to use filtering, sorting, and spare fieldset JSON API features

**Use Case**: Get events associated with a specific metric, then return just the event properties sorted by oldest to newest datetime.

```php
$klaviyo->Events->getEvents(
    fields_event: ['event_properties'],
    filter: "equals(metric_id,\"UMTLbD\")",
    sort: '-datetime'
);
```

NOTE: the filter param values need to be url-encoded

#### How to filter based on datetime

**Use Case**: Get profiles that have been updated between two datetimes.

```php
$klaviyo->Profiles->getProfiles(
    filter: 'less-than(updated,2023-04-26T00:00:00Z),greater-than(updated,2023-04-19T00:00:00Z)'
);
```

#### How to use pagination and the page[size] param

**Use Case**: Use cursor-based pagination to get the next 20 profile records.

```php
$klaviyo->Profiles->getProfiles(
    page_cursor: "https://a.klaviyo.com/api/profiles/?page%5Bcursor%5D=bmV4dDo6aWQ6OjAxRjNaWk5ITlRYMUtFVEhQMzJTUzRBN0ZY", 
    page_size: 20
);
```

NOTE: This page cursor value is exactly what is returned in the `self`/`next`/`prev` response values

#### How to add additional information to your API response via additional-fields and the `includes` parameter

**Use Case**: Get a specific profile, return an additional predictive analytics field, and also return the list objects associated with the profile.

```php
$klaviyo->Profiles->getProfile(
    '01F3ZZNHPY4YZFVGNBH5THCNXE', 
    additional_fields_profile: ['predictive_analytics'],
    include: ['lists']
);
```

#### How to use our relationship endpoints to see related resources

**Use Case**: Get all list memberships for a profile with the given `profile_id`.

```php
$klaviyo->Profiles->getProfileRelationshipsLists('01GDDKASAP8TKDDA2GRZDSVP4H');
```

#### How to see what Klaviyo objects are associated with a specific tag

**Use Case**: Get all campaigns associated with the given `tag_id`.

```php
$klaviyo->Tags->getTagRelationshipsCampaigns('f4bc6670-1aa5-47df-827a-d30a7e543088');
```

#### Uploading Image From File

When using `$klaviyo->Images->uploadImageFromFile($file, $name)`, `$file` can be either a file path string OR a `SplFileObject`.

*as a file path*
```php
$filepath = '/path/to/image.png';
$klaviyo->Images->uploadImageFromFile($filepath);
```

*as a `SplFileObject`*
```php
$filepath = '/path/to/image.png';
$file = new SplFileObject($filepath);
$klaviyo->Images->uploadImageFromFile($file);
```


## Retry behavior

* The SDK retries on resolvable errors, namely: rate limits (common) and server errors on Klaviyo's end (rare).
* The keyword arguments in the example above define retry behavior
  * The time interval between retries is calculated using exponential backoff and the `Retry-After` header
  * If you wish to disable retries, set `$num_retries = 0`
  * the example is populated with the default values
* non-resolvable errors and resolvable errors which have timed out throw an `ApiException`, detailed below.

## Error Handling

This SDK throws an `ApiException` error when the server returns a non resolvable response, or a resolvable non-`2XX` response times out. 

If you'd like to extend error handling beyond what the SDK supports natively, you can use the following methods to retrieve the corresponding attributes from the `ApiException` object:

* `getCode() : int`
* `getMessage() : str`
* `getResponseBody() : bytes`
* `getResponseHeaders() : string[]`

For example:

```php
try { 
  $klaviyo.Metrics.getMetrics();
} catch (Exception $e) {
  if ($e->getCode() == SOME_INTEGER) {
    doSomething();
  }
}
```

## Important Notes

- The main difference between this SDK and the language-agnostic API Docs that the below endpoints link to is that this SDK automatically adds the `revision` header corresponding to the SDK version.
- Organization: Resource groups and functions are listed in alphabetical order, first by Resource name, then by **OpenAPI Summary**. Operation summaries are those listed in the right side bar of the [API Reference](https://developers.klaviyo.com/en/v2025-01-15/reference/get_events). These summaries link directly to the corresponding section of the API reference.
- For example values / data types, as well as whether parameters are required/optional, please reference the corresponding API Reference link.
- Some keyword args are required for the API call to succeed, the API docs above are the source of truth regarding which keyword args are required.
- JSON payloads should be passed in as associative arrays
- `$api_key` is optional, as it is set at client-level. However, you can override the client key wherever by passing in `$api_key` as the LAST optional param. Reminder: **DO NOT** use private API keys client-side / onsite.
- Paging: Where applicable, `$page_cursor` can be passed in either as a parsed string, or as the entire `self.link` response returned by paged API endpoints.

# Comprehensive list of Operations & Parameters





## Accounts

#### [Get Account](https://developers.klaviyo.com/en/v2025-01-15/reference/get_account)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_account | string[]

$klaviyo->Accounts->getAccount($id, fields_account: $fields_account);
```




#### [Get Accounts](https://developers.klaviyo.com/en/v2025-01-15/reference/get_accounts)

```php

## Keyword Arguments

# $fields_account | string[]

$klaviyo->Accounts->getAccounts(fields_account: $fields_account);
```






## Campaigns

#### [Assign Template to Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/assign_template_to_campaign_message)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->assignTemplateToCampaignMessage($body);
```
##### Method alias:
```php
$klaviyo->Campaigns->createCampaignMessageAssignTemplate($body);
```




#### [Cancel Campaign Send](https://developers.klaviyo.com/en/v2025-01-15/reference/cancel_campaign_send)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->cancelCampaignSend($id, $body);
```
##### Method alias:
```php
$klaviyo->Campaigns->updateCampaignSendJob($id, $body);
```




#### [Create Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/create_campaign)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaign($body);
```




#### [Create Campaign Clone](https://developers.klaviyo.com/en/v2025-01-15/reference/create_campaign_clone)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignClone($body);
```
##### Method alias:
```php
$klaviyo->Campaigns->cloneCampaign($body);
```




#### [Delete Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_campaign)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->deleteCampaign($id);
```




#### [Get Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaign)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_message | string[]
# $fields_campaign | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Campaigns->getCampaign($id, fields_campaign_message: $fields_campaign_message, fields_campaign: $fields_campaign, fields_tag: $fields_tag, include: $include);
```




#### [Get Campaign for Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaign_for_campaign_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign | string[]

$klaviyo->Campaigns->getCampaignForCampaignMessage($id, fields_campaign: $fields_campaign);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignMessageCampaign($id, fields_campaign: $fields_campaign);
```




#### [Get Campaign ID for Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaign_id_for_campaign_message)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getCampaignIdForCampaignMessage($id);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignMessageRelationshipsCampaign($id);
```




#### [Get Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaign_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_message | string[]
# $fields_campaign | string[]
# $fields_image | string[]
# $fields_template | string[]
# $include | string[]

$klaviyo->Campaigns->getCampaignMessage($id, fields_campaign_message: $fields_campaign_message, fields_campaign: $fields_campaign, fields_image: $fields_image, fields_template: $fields_template, include: $include);
```




#### [Get Campaign Recipient Estimation](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaign_recipient_estimation)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_recipient_estimation | string[]

$klaviyo->Campaigns->getCampaignRecipientEstimation($id, fields_campaign_recipient_estimation: $fields_campaign_recipient_estimation);
```




#### [Get Campaign Recipient Estimation Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaign_recipient_estimation_job)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_recipient_estimation_job | string[]

$klaviyo->Campaigns->getCampaignRecipientEstimationJob($id, fields_campaign_recipient_estimation_job: $fields_campaign_recipient_estimation_job);
```




#### [Get Campaign Send Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaign_send_job)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_send_job | string[]

$klaviyo->Campaigns->getCampaignSendJob($id, fields_campaign_send_job: $fields_campaign_send_job);
```




#### [Get Campaigns](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaigns)

```php
## Positional Arguments

# $filter | string

## Keyword Arguments

# $fields_campaign_message | string[]
# $fields_campaign | string[]
# $fields_tag | string[]
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Campaigns->getCampaigns($filter, fields_campaign_message: $fields_campaign_message, fields_campaign: $fields_campaign, fields_tag: $fields_tag, include: $include, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Image for Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_image_for_campaign_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_image | string[]

$klaviyo->Campaigns->getImageForCampaignMessage($id, fields_image: $fields_image);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignMessageImage($id, fields_image: $fields_image);
```




#### [Get Image ID for Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_image_id_for_campaign_message)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getImageIdForCampaignMessage($id);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignMessageRelationshipsImage($id);
```




#### [Get Message IDs for Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/get_message_ids_for_campaign)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getMessageIdsForCampaign($id);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignRelationshipsCampaignMessages($id);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignRelationshipsMessages($id);
```




#### [Get Messages for Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/get_messages_for_campaign)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_message | string[]
# $fields_campaign | string[]
# $fields_image | string[]
# $fields_template | string[]
# $include | string[]

$klaviyo->Campaigns->getMessagesForCampaign($id, fields_campaign_message: $fields_campaign_message, fields_campaign: $fields_campaign, fields_image: $fields_image, fields_template: $fields_template, include: $include);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignCampaignMessages($id, fields_campaign_message: $fields_campaign_message, fields_campaign: $fields_campaign, fields_image: $fields_image, fields_template: $fields_template, include: $include);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignMessages($id, fields_campaign_message: $fields_campaign_message, fields_campaign: $fields_campaign, fields_image: $fields_image, fields_template: $fields_template, include: $include);
```




#### [Get Tag IDs for Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_ids_for_campaign)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getTagIdsForCampaign($id);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignRelationshipsTags($id);
```




#### [Get Tags for Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tags_for_campaign)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Campaigns->getTagsForCampaign($id, fields_tag: $fields_tag);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignTags($id, fields_tag: $fields_tag);
```




#### [Get Template for Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_template_for_campaign_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_template | string[]

$klaviyo->Campaigns->getTemplateForCampaignMessage($id, fields_template: $fields_template);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignMessageTemplate($id, fields_template: $fields_template);
```




#### [Get Template ID for Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_template_id_for_campaign_message)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getTemplateIdForCampaignMessage($id);
```
##### Method alias:
```php
$klaviyo->Campaigns->getCampaignMessageRelationshipsTemplate($id);
```




#### [Refresh Campaign Recipient Estimation](https://developers.klaviyo.com/en/v2025-01-15/reference/refresh_campaign_recipient_estimation)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->refreshCampaignRecipientEstimation($body);
```
##### Method alias:
```php
$klaviyo->Campaigns->createCampaignRecipientEstimationJob($body);
```




#### [Send Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/send_campaign)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->sendCampaign($body);
```
##### Method alias:
```php
$klaviyo->Campaigns->createCampaignSendJob($body);
```




#### [Update Campaign](https://developers.klaviyo.com/en/v2025-01-15/reference/update_campaign)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateCampaign($id, $body);
```




#### [Update Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/update_campaign_message)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateCampaignMessage($id, $body);
```




#### [Update Image for Campaign Message](https://developers.klaviyo.com/en/v2025-01-15/reference/update_image_for_campaign_message)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateImageForCampaignMessage($id, $body);
```
##### Method alias:
```php
$klaviyo->Campaigns->updateCampaignMessageRelationshipsImage($id, $body);
```






## Catalogs

#### [Add Categories to Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/add_categories_to_catalog_item)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->addCategoriesToCatalogItem($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->addCategoryToCatalogItem($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogItemRelationshipsCategory($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogItemRelationshipsCategories($id, $body);
```




#### [Add Items to Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/add_items_to_catalog_category)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->addItemsToCatalogCategory($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogCategoryRelationshipsItem($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogCategoryRelationshipsItems($id, $body);
```




#### [Bulk Create Catalog Categories](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_create_catalog_categories)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkCreateCatalogCategories($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnCreateCategoriesJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogCategoryBulkCreateJob($body);
```




#### [Bulk Create Catalog Items](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_create_catalog_items)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkCreateCatalogItems($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnCreateItemsJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogItemBulkCreateJob($body);
```




#### [Bulk Create Catalog Variants](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_create_catalog_variants)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkCreateCatalogVariants($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnCreateVariantsJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogVariantBulkCreateJob($body);
```




#### [Bulk Delete Catalog Categories](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_delete_catalog_categories)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkDeleteCatalogCategories($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnDeleteCategoriesJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogCategoryBulkDeleteJob($body);
```




#### [Bulk Delete Catalog Items](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_delete_catalog_items)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkDeleteCatalogItems($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnDeleteItemsJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogItemBulkDeleteJob($body);
```




#### [Bulk Delete Catalog Variants](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_delete_catalog_variants)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkDeleteCatalogVariants($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnDeleteVariantsJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogVariantBulkDeleteJob($body);
```




#### [Bulk Update Catalog Categories](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_update_catalog_categories)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkUpdateCatalogCategories($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnUpdateCategoriesJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogCategoryBulkUpdateJob($body);
```




#### [Bulk Update Catalog Items](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_update_catalog_items)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkUpdateCatalogItems($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnUpdateItemsJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogItemBulkUpdateJob($body);
```




#### [Bulk Update Catalog Variants](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_update_catalog_variants)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->bulkUpdateCatalogVariants($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->spawnUpdateVariantsJob($body);
```
##### Method alias:
```php
$klaviyo->Catalogs->createCatalogVariantBulkUpdateJob($body);
```




#### [Create Back In Stock Subscription](https://developers.klaviyo.com/en/v2025-01-15/reference/create_back_in_stock_subscription)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createBackInStockSubscription($body);
```




#### [Create Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/create_catalog_category)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogCategory($body);
```




#### [Create Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/create_catalog_item)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogItem($body);
```




#### [Create Catalog Variant](https://developers.klaviyo.com/en/v2025-01-15/reference/create_catalog_variant)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogVariant($body);
```




#### [Delete Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_catalog_category)

```php
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogCategory($id);
```




#### [Delete Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_catalog_item)

```php
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogItem($id);
```




#### [Delete Catalog Variant](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_catalog_variant)

```php
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogVariant($id);
```




#### [Get Bulk Create Catalog Items Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_create_catalog_items_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_create_job | string[]
# $fields_catalog_item | string[]
# $include | string[]

$klaviyo->Catalogs->getBulkCreateCatalogItemsJob($job_id, fields_catalog_item_bulk_create_job: $fields_catalog_item_bulk_create_job, fields_catalog_item: $fields_catalog_item, include: $include);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCreateItemsJob($job_id, fields_catalog_item_bulk_create_job: $fields_catalog_item_bulk_create_job, fields_catalog_item: $fields_catalog_item, include: $include);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemBulkCreateJob($job_id, fields_catalog_item_bulk_create_job: $fields_catalog_item_bulk_create_job, fields_catalog_item: $fields_catalog_item, include: $include);
```




#### [Get Bulk Create Catalog Items Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_create_catalog_items_jobs)

```php

## Keyword Arguments

# $fields_catalog_item_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getBulkCreateCatalogItemsJobs(fields_catalog_item_bulk_create_job: $fields_catalog_item_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCreateItemsJobs(fields_catalog_item_bulk_create_job: $fields_catalog_item_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemBulkCreateJobs(fields_catalog_item_bulk_create_job: $fields_catalog_item_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Bulk Delete Catalog Items Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_delete_catalog_items_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_delete_job | string[]

$klaviyo->Catalogs->getBulkDeleteCatalogItemsJob($job_id, fields_catalog_item_bulk_delete_job: $fields_catalog_item_bulk_delete_job);
```
##### Method alias:
```php
$klaviyo->Catalogs->getDeleteItemsJob($job_id, fields_catalog_item_bulk_delete_job: $fields_catalog_item_bulk_delete_job);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemBulkDeleteJob($job_id, fields_catalog_item_bulk_delete_job: $fields_catalog_item_bulk_delete_job);
```




#### [Get Bulk Delete Catalog Items Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_delete_catalog_items_jobs)

```php

## Keyword Arguments

# $fields_catalog_item_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getBulkDeleteCatalogItemsJobs(fields_catalog_item_bulk_delete_job: $fields_catalog_item_bulk_delete_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getDeleteItemsJobs(fields_catalog_item_bulk_delete_job: $fields_catalog_item_bulk_delete_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemBulkDeleteJobs(fields_catalog_item_bulk_delete_job: $fields_catalog_item_bulk_delete_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Bulk Update Catalog Items Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_update_catalog_items_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_update_job | string[]
# $fields_catalog_item | string[]
# $include | string[]

$klaviyo->Catalogs->getBulkUpdateCatalogItemsJob($job_id, fields_catalog_item_bulk_update_job: $fields_catalog_item_bulk_update_job, fields_catalog_item: $fields_catalog_item, include: $include);
```
##### Method alias:
```php
$klaviyo->Catalogs->getUpdateItemsJob($job_id, fields_catalog_item_bulk_update_job: $fields_catalog_item_bulk_update_job, fields_catalog_item: $fields_catalog_item, include: $include);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemBulkUpdateJob($job_id, fields_catalog_item_bulk_update_job: $fields_catalog_item_bulk_update_job, fields_catalog_item: $fields_catalog_item, include: $include);
```




#### [Get Bulk Update Catalog Items Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_update_catalog_items_jobs)

```php

## Keyword Arguments

# $fields_catalog_item_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getBulkUpdateCatalogItemsJobs(fields_catalog_item_bulk_update_job: $fields_catalog_item_bulk_update_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getUpdateItemsJobs(fields_catalog_item_bulk_update_job: $fields_catalog_item_bulk_update_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemBulkUpdateJobs(fields_catalog_item_bulk_update_job: $fields_catalog_item_bulk_update_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Catalog Categories](https://developers.klaviyo.com/en/v2025-01-15/reference/get_catalog_categories)

```php

## Keyword Arguments

# $fields_catalog_category | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogCategories(fields_catalog_category: $fields_catalog_category, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/get_catalog_category)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_category | string[]

$klaviyo->Catalogs->getCatalogCategory($id, fields_catalog_category: $fields_catalog_category);
```




#### [Get Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/get_catalog_item)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_item | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getCatalogItem($id, fields_catalog_item: $fields_catalog_item, fields_catalog_variant: $fields_catalog_variant, include: $include);
```




#### [Get Catalog Items](https://developers.klaviyo.com/en/v2025-01-15/reference/get_catalog_items)

```php

## Keyword Arguments

# $fields_catalog_item | string[]
# $fields_catalog_variant | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogItems(fields_catalog_item: $fields_catalog_item, fields_catalog_variant: $fields_catalog_variant, filter: $filter, include: $include, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Catalog Variant](https://developers.klaviyo.com/en/v2025-01-15/reference/get_catalog_variant)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_variant | string[]

$klaviyo->Catalogs->getCatalogVariant($id, fields_catalog_variant: $fields_catalog_variant);
```




#### [Get Catalog Variants](https://developers.klaviyo.com/en/v2025-01-15/reference/get_catalog_variants)

```php

## Keyword Arguments

# $fields_catalog_variant | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogVariants(fields_catalog_variant: $fields_catalog_variant, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Categories for Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/get_categories_for_catalog_item)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_category | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCategoriesForCatalogItem($id, fields_catalog_category: $fields_catalog_category, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemCategories($id, fields_catalog_category: $fields_catalog_category, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Category IDs for Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/get_category_ids_for_catalog_item)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCategoryIdsForCatalogItem($id, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemRelationshipsCategories($id, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Create Categories Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_create_categories_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_create_job | string[]
# $fields_catalog_category | string[]
# $include | string[]

$klaviyo->Catalogs->getCreateCategoriesJob($job_id, fields_catalog_category_bulk_create_job: $fields_catalog_category_bulk_create_job, fields_catalog_category: $fields_catalog_category, include: $include);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogCategoryBulkCreateJob($job_id, fields_catalog_category_bulk_create_job: $fields_catalog_category_bulk_create_job, fields_catalog_category: $fields_catalog_category, include: $include);
```




#### [Get Create Categories Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_create_categories_jobs)

```php

## Keyword Arguments

# $fields_catalog_category_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getCreateCategoriesJobs(fields_catalog_category_bulk_create_job: $fields_catalog_category_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogCategoryBulkCreateJobs(fields_catalog_category_bulk_create_job: $fields_catalog_category_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Create Variants Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_create_variants_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_create_job | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getCreateVariantsJob($job_id, fields_catalog_variant_bulk_create_job: $fields_catalog_variant_bulk_create_job, fields_catalog_variant: $fields_catalog_variant, include: $include);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogVariantBulkCreateJob($job_id, fields_catalog_variant_bulk_create_job: $fields_catalog_variant_bulk_create_job, fields_catalog_variant: $fields_catalog_variant, include: $include);
```




#### [Get Create Variants Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_create_variants_jobs)

```php

## Keyword Arguments

# $fields_catalog_variant_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getCreateVariantsJobs(fields_catalog_variant_bulk_create_job: $fields_catalog_variant_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogVariantBulkCreateJobs(fields_catalog_variant_bulk_create_job: $fields_catalog_variant_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Delete Categories Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_delete_categories_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_delete_job | string[]

$klaviyo->Catalogs->getDeleteCategoriesJob($job_id, fields_catalog_category_bulk_delete_job: $fields_catalog_category_bulk_delete_job);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogCategoryBulkDeleteJob($job_id, fields_catalog_category_bulk_delete_job: $fields_catalog_category_bulk_delete_job);
```




#### [Get Delete Categories Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_delete_categories_jobs)

```php

## Keyword Arguments

# $fields_catalog_category_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getDeleteCategoriesJobs(fields_catalog_category_bulk_delete_job: $fields_catalog_category_bulk_delete_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogCategoryBulkDeleteJobs(fields_catalog_category_bulk_delete_job: $fields_catalog_category_bulk_delete_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Delete Variants Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_delete_variants_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_delete_job | string[]

$klaviyo->Catalogs->getDeleteVariantsJob($job_id, fields_catalog_variant_bulk_delete_job: $fields_catalog_variant_bulk_delete_job);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogVariantBulkDeleteJob($job_id, fields_catalog_variant_bulk_delete_job: $fields_catalog_variant_bulk_delete_job);
```




#### [Get Delete Variants Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_delete_variants_jobs)

```php

## Keyword Arguments

# $fields_catalog_variant_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getDeleteVariantsJobs(fields_catalog_variant_bulk_delete_job: $fields_catalog_variant_bulk_delete_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogVariantBulkDeleteJobs(fields_catalog_variant_bulk_delete_job: $fields_catalog_variant_bulk_delete_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Item IDs for Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/get_item_ids_for_catalog_category)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getItemIdsForCatalogCategory($id, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogCategoryRelationshipsItems($id, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Items for Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/get_items_for_catalog_category)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_item | string[]
# $fields_catalog_variant | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getItemsForCatalogCategory($id, fields_catalog_item: $fields_catalog_item, fields_catalog_variant: $fields_catalog_variant, filter: $filter, include: $include, page_cursor: $page_cursor, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogCategoryItems($id, fields_catalog_item: $fields_catalog_item, fields_catalog_variant: $fields_catalog_variant, filter: $filter, include: $include, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Update Categories Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_update_categories_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_update_job | string[]
# $fields_catalog_category | string[]
# $include | string[]

$klaviyo->Catalogs->getUpdateCategoriesJob($job_id, fields_catalog_category_bulk_update_job: $fields_catalog_category_bulk_update_job, fields_catalog_category: $fields_catalog_category, include: $include);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogCategoryBulkUpdateJob($job_id, fields_catalog_category_bulk_update_job: $fields_catalog_category_bulk_update_job, fields_catalog_category: $fields_catalog_category, include: $include);
```




#### [Get Update Categories Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_update_categories_jobs)

```php

## Keyword Arguments

# $fields_catalog_category_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getUpdateCategoriesJobs(fields_catalog_category_bulk_update_job: $fields_catalog_category_bulk_update_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogCategoryBulkUpdateJobs(fields_catalog_category_bulk_update_job: $fields_catalog_category_bulk_update_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Update Variants Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_update_variants_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_update_job | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getUpdateVariantsJob($job_id, fields_catalog_variant_bulk_update_job: $fields_catalog_variant_bulk_update_job, fields_catalog_variant: $fields_catalog_variant, include: $include);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogVariantBulkUpdateJob($job_id, fields_catalog_variant_bulk_update_job: $fields_catalog_variant_bulk_update_job, fields_catalog_variant: $fields_catalog_variant, include: $include);
```




#### [Get Update Variants Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_update_variants_jobs)

```php

## Keyword Arguments

# $fields_catalog_variant_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getUpdateVariantsJobs(fields_catalog_variant_bulk_update_job: $fields_catalog_variant_bulk_update_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogVariantBulkUpdateJobs(fields_catalog_variant_bulk_update_job: $fields_catalog_variant_bulk_update_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Variant IDs for Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/get_variant_ids_for_catalog_item)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getVariantIdsForCatalogItem($id, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemRelationshipsVariants($id, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Variants for Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/get_variants_for_catalog_item)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_variant | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getVariantsForCatalogItem($id, fields_catalog_variant: $fields_catalog_variant, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Catalogs->getCatalogItemVariants($id, fields_catalog_variant: $fields_catalog_variant, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Remove Categories from Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/remove_categories_from_catalog_item)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->removeCategoriesFromCatalogItem($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->deleteCatalogItemRelationshipsCategories($id, $body);
```




#### [Remove Items from Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/remove_items_from_catalog_category)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->removeItemsFromCatalogCategory($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->deleteCatalogCategoryRelationshipsItems($id, $body);
```




#### [Update Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/update_catalog_category)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogCategory($id, $body);
```




#### [Update Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/update_catalog_item)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogItem($id, $body);
```




#### [Update Catalog Variant](https://developers.klaviyo.com/en/v2025-01-15/reference/update_catalog_variant)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogVariant($id, $body);
```




#### [Update Categories for Catalog Item](https://developers.klaviyo.com/en/v2025-01-15/reference/update_categories_for_catalog_item)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCategoriesForCatalogItem($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->updateCatalogItemRelationshipsCategories($id, $body);
```




#### [Update Items for Catalog Category](https://developers.klaviyo.com/en/v2025-01-15/reference/update_items_for_catalog_category)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateItemsForCatalogCategory($id, $body);
```
##### Method alias:
```php
$klaviyo->Catalogs->updateCatalogCategoryRelationshipsItems($id, $body);
```






## Coupons

#### [Bulk Create Coupon Codes](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_create_coupon_codes)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Coupons->bulkCreateCouponCodes($body);
```
##### Method alias:
```php
$klaviyo->Coupons->spawnCouponCodeBulkCreateJob($body);
```
##### Method alias:
```php
$klaviyo->Coupons->createCouponCodeBulkCreateJob($body);
```




#### [Create Coupon](https://developers.klaviyo.com/en/v2025-01-15/reference/create_coupon)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Coupons->createCoupon($body);
```




#### [Create Coupon Code](https://developers.klaviyo.com/en/v2025-01-15/reference/create_coupon_code)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Coupons->createCouponCode($body);
```




#### [Delete Coupon](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_coupon)

```php
## Positional Arguments

# $id | string

$klaviyo->Coupons->deleteCoupon($id);
```




#### [Delete Coupon Code](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_coupon_code)

```php
## Positional Arguments

# $id | string

$klaviyo->Coupons->deleteCouponCode($id);
```




#### [Get Bulk Create Coupon Code Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_create_coupon_code_jobs)

```php

## Keyword Arguments

# $fields_coupon_code_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Coupons->getBulkCreateCouponCodeJobs(fields_coupon_code_bulk_create_job: $fields_coupon_code_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Coupons->getCouponCodeBulkCreateJobs(fields_coupon_code_bulk_create_job: $fields_coupon_code_bulk_create_job, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Bulk Create Coupon Codes Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_create_coupon_codes_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_coupon_code_bulk_create_job | string[]
# $fields_coupon_code | string[]
# $include | string[]

$klaviyo->Coupons->getBulkCreateCouponCodesJob($job_id, fields_coupon_code_bulk_create_job: $fields_coupon_code_bulk_create_job, fields_coupon_code: $fields_coupon_code, include: $include);
```
##### Method alias:
```php
$klaviyo->Coupons->getCouponCodeBulkCreateJob($job_id, fields_coupon_code_bulk_create_job: $fields_coupon_code_bulk_create_job, fields_coupon_code: $fields_coupon_code, include: $include);
```




#### [Get Coupon](https://developers.klaviyo.com/en/v2025-01-15/reference/get_coupon)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_coupon | string[]

$klaviyo->Coupons->getCoupon($id, fields_coupon: $fields_coupon);
```




#### [Get Coupon Code](https://developers.klaviyo.com/en/v2025-01-15/reference/get_coupon_code)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_coupon_code | string[]
# $fields_coupon | string[]
# $include | string[]

$klaviyo->Coupons->getCouponCode($id, fields_coupon_code: $fields_coupon_code, fields_coupon: $fields_coupon, include: $include);
```




#### [Get Coupon Code IDs for Coupon](https://developers.klaviyo.com/en/v2025-01-15/reference/get_coupon_code_ids_for_coupon)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string

$klaviyo->Coupons->getCouponCodeIdsForCoupon($id, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Coupons->getCouponCodeRelationshipsCoupon($id, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Coupons->getCodeIdsForCoupon($id, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Coupons->getCouponRelationshipsCodes($id, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Coupon Codes](https://developers.klaviyo.com/en/v2025-01-15/reference/get_coupon_codes)

```php

## Keyword Arguments

# $fields_coupon_code | string[]
# $fields_coupon | string[]
# $filter | string
# $include | string[]
# $page_cursor | string

$klaviyo->Coupons->getCouponCodes(fields_coupon_code: $fields_coupon_code, fields_coupon: $fields_coupon, filter: $filter, include: $include, page_cursor: $page_cursor);
```




#### [Get Coupon Codes for Coupon](https://developers.klaviyo.com/en/v2025-01-15/reference/get_coupon_codes_for_coupon)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_coupon_code | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Coupons->getCouponCodesForCoupon($id, fields_coupon_code: $fields_coupon_code, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Coupons->getCouponCouponCodes($id, fields_coupon_code: $fields_coupon_code, filter: $filter, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Coupons->getCodesForCoupon($id, fields_coupon_code: $fields_coupon_code, filter: $filter, page_cursor: $page_cursor);
```




#### [Get Coupon For Coupon Code](https://developers.klaviyo.com/en/v2025-01-15/reference/get_coupon_for_coupon_code)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_coupon | string[]

$klaviyo->Coupons->getCouponForCouponCode($id, fields_coupon: $fields_coupon);
```
##### Method alias:
```php
$klaviyo->Coupons->getCouponCodeCoupon($id, fields_coupon: $fields_coupon);
```




#### [Get Coupon ID for Coupon Code](https://developers.klaviyo.com/en/v2025-01-15/reference/get_coupon_id_for_coupon_code)

```php
## Positional Arguments

# $id | string

$klaviyo->Coupons->getCouponIdForCouponCode($id);
```
##### Method alias:
```php
$klaviyo->Coupons->getCouponRelationshipsCouponCodes($id);
```




#### [Get Coupons](https://developers.klaviyo.com/en/v2025-01-15/reference/get_coupons)

```php

## Keyword Arguments

# $fields_coupon | string[]
# $page_cursor | string

$klaviyo->Coupons->getCoupons(fields_coupon: $fields_coupon, page_cursor: $page_cursor);
```




#### [Update Coupon](https://developers.klaviyo.com/en/v2025-01-15/reference/update_coupon)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Coupons->updateCoupon($id, $body);
```




#### [Update Coupon Code](https://developers.klaviyo.com/en/v2025-01-15/reference/update_coupon_code)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Coupons->updateCouponCode($id, $body);
```






## DataPrivacy

#### [Request Profile Deletion](https://developers.klaviyo.com/en/v2025-01-15/reference/request_profile_deletion)

```php
## Positional Arguments

# $body | associative array

$klaviyo->DataPrivacy->requestProfileDeletion($body);
```
##### Method alias:
```php
$klaviyo->DataPrivacy->createDataPrivacyDeletionJob($body);
```






## Events

#### [Bulk Create Events](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_create_events)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Events->bulkCreateEvents($body);
```
##### Method alias:
```php
$klaviyo->Events->createEventBulkCreateJob($body);
```




#### [Create Event](https://developers.klaviyo.com/en/v2025-01-15/reference/create_event)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Events->createEvent($body);
```




#### [Get Event](https://developers.klaviyo.com/en/v2025-01-15/reference/get_event)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_event | string[]
# $fields_metric | string[]
# $fields_profile | string[]
# $include | string[]

$klaviyo->Events->getEvent($id, fields_event: $fields_event, fields_metric: $fields_metric, fields_profile: $fields_profile, include: $include);
```




#### [Get Events](https://developers.klaviyo.com/en/v2025-01-15/reference/get_events)

```php

## Keyword Arguments

# $fields_event | string[]
# $fields_metric | string[]
# $fields_profile | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Events->getEvents(fields_event: $fields_event, fields_metric: $fields_metric, fields_profile: $fields_profile, filter: $filter, include: $include, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Metric for Event](https://developers.klaviyo.com/en/v2025-01-15/reference/get_metric_for_event)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_metric | string[]

$klaviyo->Events->getMetricForEvent($id, fields_metric: $fields_metric);
```
##### Method alias:
```php
$klaviyo->Events->getEventMetric($id, fields_metric: $fields_metric);
```




#### [Get Metric ID for Event](https://developers.klaviyo.com/en/v2025-01-15/reference/get_metric_id_for_event)

```php
## Positional Arguments

# $id | string

$klaviyo->Events->getMetricIdForEvent($id);
```
##### Method alias:
```php
$klaviyo->Events->getEventRelationshipsMetric($id);
```




#### [Get Profile for Event](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profile_for_event)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]

$klaviyo->Events->getProfileForEvent($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile);
```
##### Method alias:
```php
$klaviyo->Events->getEventProfile($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile);
```




#### [Get Profile ID for Event](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profile_id_for_event)

```php
## Positional Arguments

# $id | string

$klaviyo->Events->getProfileIdForEvent($id);
```
##### Method alias:
```php
$klaviyo->Events->getEventRelationshipsProfile($id);
```






## Flows

#### [Create Flow](https://developers.klaviyo.com/en/v2025-01-15/reference/create_flow)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $additional_fields_flow | string[]

$klaviyo->Flows->createFlow($body, additional_fields_flow: $additional_fields_flow);
```




#### [Delete Flow](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_flow)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->deleteFlow($id);
```




#### [Get Action for Flow Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_action_for_flow_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]

$klaviyo->Flows->getActionForFlowMessage($id, fields_flow_action: $fields_flow_action);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowMessageAction($id, fields_flow_action: $fields_flow_action);
```




#### [Get Action ID for Flow Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_action_id_for_flow_message)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->getActionIdForFlowMessage($id);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowMessageRelationshipsAction($id);
```




#### [Get Action IDs for Flow](https://developers.klaviyo.com/en/v2025-01-15/reference/get_action_ids_for_flow)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getActionIdsForFlow($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowRelationshipsFlowActions($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowRelationshipsActions($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Actions for Flow](https://developers.klaviyo.com/en/v2025-01-15/reference/get_actions_for_flow)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getActionsForFlow($id, fields_flow_action: $fields_flow_action, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowFlowActions($id, fields_flow_action: $fields_flow_action, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowActions($id, fields_flow_action: $fields_flow_action, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Flow](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flow)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_flow | string[]
# $fields_flow_action | string[]
# $fields_flow | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Flows->getFlow($id, additional_fields_flow: $additional_fields_flow, fields_flow_action: $fields_flow_action, fields_flow: $fields_flow, fields_tag: $fields_tag, include: $include);
```




#### [Get Flow Action](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flow_action)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow_message | string[]
# $fields_flow | string[]
# $include | string[]

$klaviyo->Flows->getFlowAction($id, fields_flow_action: $fields_flow_action, fields_flow_message: $fields_flow_message, fields_flow: $fields_flow, include: $include);
```




#### [Get Messages For Flow Action](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flow_action_messages)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_message | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowActionMessages($id, fields_flow_message: $fields_flow_message, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Flows->getMessagesForFlowAction($id, fields_flow_message: $fields_flow_message, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Flow for Flow Action](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flow_for_flow_action)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow | string[]

$klaviyo->Flows->getFlowForFlowAction($id, fields_flow: $fields_flow);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowActionFlow($id, fields_flow: $fields_flow);
```




#### [Get Flow ID for Flow Action](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flow_id_for_flow_action)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->getFlowIdForFlowAction($id);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowActionRelationshipsFlow($id);
```




#### [Get Flow Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flow_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow_message | string[]
# $fields_template | string[]
# $include | string[]

$klaviyo->Flows->getFlowMessage($id, fields_flow_action: $fields_flow_action, fields_flow_message: $fields_flow_message, fields_template: $fields_template, include: $include);
```




#### [Get Flows](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flows)

```php

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow | string[]
# $fields_tag | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlows(fields_flow_action: $fields_flow_action, fields_flow: $fields_flow, fields_tag: $fields_tag, filter: $filter, include: $include, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Message IDs for Flow Action](https://developers.klaviyo.com/en/v2025-01-15/reference/get_message_ids_for_flow_action)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getMessageIdsForFlowAction($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowActionRelationshipsMessages($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Tag IDs for Flow](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_ids_for_flow)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->getTagIdsForFlow($id);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowRelationshipsTags($id);
```




#### [Get Tags for Flow](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tags_for_flow)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Flows->getTagsForFlow($id, fields_tag: $fields_tag);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowTags($id, fields_tag: $fields_tag);
```




#### [Get Template for Flow Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_template_for_flow_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_template | string[]

$klaviyo->Flows->getTemplateForFlowMessage($id, fields_template: $fields_template);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowMessageTemplate($id, fields_template: $fields_template);
```




#### [Get Template ID for Flow Message](https://developers.klaviyo.com/en/v2025-01-15/reference/get_template_id_for_flow_message)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->getTemplateIdForFlowMessage($id);
```
##### Method alias:
```php
$klaviyo->Flows->getFlowMessageRelationshipsTemplate($id);
```




#### [Update Flow Status](https://developers.klaviyo.com/en/v2025-01-15/reference/update_flow)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Flows->updateFlow($id, $body);
```






## Forms

#### [Get Form](https://developers.klaviyo.com/en/v2025-01-15/reference/get_form)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_form_version | string[]
# $fields_form | string[]
# $include | string[]

$klaviyo->Forms->getForm($id, fields_form_version: $fields_form_version, fields_form: $fields_form, include: $include);
```




#### [Get Form for Form Version](https://developers.klaviyo.com/en/v2025-01-15/reference/get_form_for_form_version)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_form | string[]

$klaviyo->Forms->getFormForFormVersion($id, fields_form: $fields_form);
```
##### Method alias:
```php
$klaviyo->Forms->getFormVersionForm($id, fields_form: $fields_form);
```




#### [Get Form ID for Form Version](https://developers.klaviyo.com/en/v2025-01-15/reference/get_form_id_for_form_version)

```php
## Positional Arguments

# $id | string

$klaviyo->Forms->getFormIdForFormVersion($id);
```
##### Method alias:
```php
$klaviyo->Forms->getFormVersionRelationshipsForm($id);
```




#### [Get Form Version](https://developers.klaviyo.com/en/v2025-01-15/reference/get_form_version)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_form_version | string[]

$klaviyo->Forms->getFormVersion($id, fields_form_version: $fields_form_version);
```




#### [Get Forms](https://developers.klaviyo.com/en/v2025-01-15/reference/get_forms)

```php

## Keyword Arguments

# $fields_form | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Forms->getForms(fields_form: $fields_form, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Version IDs for Form](https://developers.klaviyo.com/en/v2025-01-15/reference/get_version_ids_for_form)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Forms->getVersionIdsForForm($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Forms->getFormRelationshipsFormVersions($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Forms->getFormRelationshipsVersions($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Versions for Form](https://developers.klaviyo.com/en/v2025-01-15/reference/get_versions_for_form)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_form_version | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Forms->getVersionsForForm($id, fields_form_version: $fields_form_version, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Forms->getFormFormVersions($id, fields_form_version: $fields_form_version, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Forms->getFormVersions($id, fields_form_version: $fields_form_version, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```






## Images

#### [Get Image](https://developers.klaviyo.com/en/v2025-01-15/reference/get_image)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_image | string[]

$klaviyo->Images->getImage($id, fields_image: $fields_image);
```




#### [Get Images](https://developers.klaviyo.com/en/v2025-01-15/reference/get_images)

```php

## Keyword Arguments

# $fields_image | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Images->getImages(fields_image: $fields_image, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Update Image](https://developers.klaviyo.com/en/v2025-01-15/reference/update_image)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Images->updateImage($id, $body);
```




#### [Upload Image From File](https://developers.klaviyo.com/en/v2025-01-15/reference/upload_image_from_file)

```php
## Positional Arguments

# $file | \SplFileObject

## Keyword Arguments

# $name | string
# $hidden | bool

$klaviyo->Images->uploadImageFromFile($file, name: $name, hidden: $hidden);
```
##### Method alias:
```php
$klaviyo->Images->createImageUpload($file, name: $name, hidden: $hidden);
```




#### [Upload Image From URL](https://developers.klaviyo.com/en/v2025-01-15/reference/upload_image_from_url)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Images->uploadImageFromUrl($body);
```
##### Method alias:
```php
$klaviyo->Images->createImage($body);
```






## Lists

#### [Add Profiles to List](https://developers.klaviyo.com/en/v2025-01-15/reference/add_profiles_to_list)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->addProfilesToList($id, $body);
```
##### Method alias:
```php
$klaviyo->Lists->createListRelationships($id, $body);
```
##### Method alias:
```php
$klaviyo->Lists->createListRelationshipsProfile($id, $body);
```
##### Method alias:
```php
$klaviyo->Lists->createListRelationshipsProfiles($id, $body);
```




#### [Create List](https://developers.klaviyo.com/en/v2025-01-15/reference/create_list)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Lists->createList($body);
```




#### [Delete List](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_list)

```php
## Positional Arguments

# $id | string

$klaviyo->Lists->deleteList($id);
```




#### [Get Flows Triggered by List](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flows_triggered_by_list)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow | string[]

$klaviyo->Lists->getFlowsTriggeredByList($id, fields_flow: $fields_flow);
```
##### Method alias:
```php
$klaviyo->Lists->getFlowTriggersForList($id, fields_flow: $fields_flow);
```
##### Method alias:
```php
$klaviyo->Lists->getListFlowTriggers($id, fields_flow: $fields_flow);
```




#### [Get IDs for Flows Triggered by List](https://developers.klaviyo.com/en/v2025-01-15/reference/get_ids_for_flows_triggered_by_list)

```php
## Positional Arguments

# $id | string

$klaviyo->Lists->getIdsForFlowsTriggeredByList($id);
```
##### Method alias:
```php
$klaviyo->Lists->getFlowTriggerIdsForList($id);
```
##### Method alias:
```php
$klaviyo->Lists->getListRelationshipsFlowTriggers($id);
```




#### [Get List](https://developers.klaviyo.com/en/v2025-01-15/reference/get_list)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_list | string[]
# $fields_flow | string[]
# $fields_list | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Lists->getList($id, additional_fields_list: $additional_fields_list, fields_flow: $fields_flow, fields_list: $fields_list, fields_tag: $fields_tag, include: $include);
```




#### [Get Lists](https://developers.klaviyo.com/en/v2025-01-15/reference/get_lists)

```php

## Keyword Arguments

# $fields_flow | string[]
# $fields_list | string[]
# $fields_tag | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Lists->getLists(fields_flow: $fields_flow, fields_list: $fields_list, fields_tag: $fields_tag, filter: $filter, include: $include, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Profile IDs for List](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profile_ids_for_list)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Lists->getProfileIdsForList($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Lists->getListRelationshipsProfiles($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Profiles for List](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profiles_for_list)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Lists->getProfilesForList($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Lists->getListProfiles($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Tag IDs for List](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_ids_for_list)

```php
## Positional Arguments

# $id | string

$klaviyo->Lists->getTagIdsForList($id);
```
##### Method alias:
```php
$klaviyo->Lists->getListRelationshipsTags($id);
```




#### [Get Tags for List](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tags_for_list)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Lists->getTagsForList($id, fields_tag: $fields_tag);
```
##### Method alias:
```php
$klaviyo->Lists->getListTags($id, fields_tag: $fields_tag);
```




#### [Remove Profiles from List](https://developers.klaviyo.com/en/v2025-01-15/reference/remove_profiles_from_list)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->removeProfilesFromList($id, $body);
```
##### Method alias:
```php
$klaviyo->Lists->deleteListRelationships($id, $body);
```
##### Method alias:
```php
$klaviyo->Lists->deleteListRelationshipsProfiles($id, $body);
```




#### [Update List](https://developers.klaviyo.com/en/v2025-01-15/reference/update_list)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->updateList($id, $body);
```






## Metrics

#### [Get Flows Triggered by Metric](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flows_triggered_by_metric)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow | string[]

$klaviyo->Metrics->getFlowsTriggeredByMetric($id, fields_flow: $fields_flow);
```
##### Method alias:
```php
$klaviyo->Metrics->getFlowTriggersForMetric($id, fields_flow: $fields_flow);
```
##### Method alias:
```php
$klaviyo->Metrics->getMetricFlowTriggers($id, fields_flow: $fields_flow);
```




#### [Get IDs for Flows Triggered by Metric](https://developers.klaviyo.com/en/v2025-01-15/reference/get_ids_for_flows_triggered_by_metric)

```php
## Positional Arguments

# $id | string

$klaviyo->Metrics->getIdsForFlowsTriggeredByMetric($id);
```
##### Method alias:
```php
$klaviyo->Metrics->getFlowTriggerIdsForMetric($id);
```
##### Method alias:
```php
$klaviyo->Metrics->getMetricRelationshipsFlowTriggers($id);
```




#### [Get Metric](https://developers.klaviyo.com/en/v2025-01-15/reference/get_metric)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow | string[]
# $fields_metric | string[]
# $include | string[]

$klaviyo->Metrics->getMetric($id, fields_flow: $fields_flow, fields_metric: $fields_metric, include: $include);
```




#### [Get Metric for Metric Property](https://developers.klaviyo.com/en/v2025-01-15/reference/get_metric_for_metric_property)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_metric | string[]

$klaviyo->Metrics->getMetricForMetricProperty($id, fields_metric: $fields_metric);
```
##### Method alias:
```php
$klaviyo->Metrics->getMetricPropertyMetric($id, fields_metric: $fields_metric);
```




#### [Get Metric ID for Metric Property](https://developers.klaviyo.com/en/v2025-01-15/reference/get_metric_id_for_metric_property)

```php
## Positional Arguments

# $id | string

$klaviyo->Metrics->getMetricIdForMetricProperty($id);
```
##### Method alias:
```php
$klaviyo->Metrics->getMetricPropertyRelationshipsMetric($id);
```




#### [Get Metric Property](https://developers.klaviyo.com/en/v2025-01-15/reference/get_metric_property)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_metric_property | string[]
# $fields_metric_property | string[]
# $fields_metric | string[]
# $include | string[]

$klaviyo->Metrics->getMetricProperty($id, additional_fields_metric_property: $additional_fields_metric_property, fields_metric_property: $fields_metric_property, fields_metric: $fields_metric, include: $include);
```




#### [Get Metrics](https://developers.klaviyo.com/en/v2025-01-15/reference/get_metrics)

```php

## Keyword Arguments

# $fields_flow | string[]
# $fields_metric | string[]
# $filter | string
# $include | string[]
# $page_cursor | string

$klaviyo->Metrics->getMetrics(fields_flow: $fields_flow, fields_metric: $fields_metric, filter: $filter, include: $include, page_cursor: $page_cursor);
```




#### [Get Properties for Metric](https://developers.klaviyo.com/en/v2025-01-15/reference/get_properties_for_metric)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_metric_property | string[]
# $fields_metric_property | string[]

$klaviyo->Metrics->getPropertiesForMetric($id, additional_fields_metric_property: $additional_fields_metric_property, fields_metric_property: $fields_metric_property);
```
##### Method alias:
```php
$klaviyo->Metrics->getMetricMetricProperties($id, additional_fields_metric_property: $additional_fields_metric_property, fields_metric_property: $fields_metric_property);
```
##### Method alias:
```php
$klaviyo->Metrics->getMetricProperties($id, additional_fields_metric_property: $additional_fields_metric_property, fields_metric_property: $fields_metric_property);
```




#### [Get Property IDs for Metric](https://developers.klaviyo.com/en/v2025-01-15/reference/get_property_ids_for_metric)

```php
## Positional Arguments

# $id | string

$klaviyo->Metrics->getPropertyIdsForMetric($id);
```
##### Method alias:
```php
$klaviyo->Metrics->getMetricRelationshipsMetricProperties($id);
```
##### Method alias:
```php
$klaviyo->Metrics->getMetricRelationshipsProperties($id);
```




#### [Query Metric Aggregates](https://developers.klaviyo.com/en/v2025-01-15/reference/query_metric_aggregates)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Metrics->queryMetricAggregates($body);
```
##### Method alias:
```php
$klaviyo->Metrics->createMetricAggregate($body);
```






## Profiles

#### [Bulk Import Profiles](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_import_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->bulkImportProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->spawnBulkProfileImportJob($body);
```
##### Method alias:
```php
$klaviyo->Profiles->createProfileBulkImportJob($body);
```




#### [Bulk Subscribe Profiles](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_subscribe_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->bulkSubscribeProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->subscribeProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->createProfileSubscriptionBulkCreateJob($body);
```




#### [Bulk Suppress Profiles](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_suppress_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->bulkSuppressProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->suppressProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->createProfileSuppressionBulkCreateJob($body);
```




#### [Bulk Unsubscribe Profiles](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_unsubscribe_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->bulkUnsubscribeProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->unsubscribeProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->createProfileSubscriptionBulkDeleteJob($body);
```




#### [Bulk Unsuppress Profiles](https://developers.klaviyo.com/en/v2025-01-15/reference/bulk_unsuppress_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->bulkUnsuppressProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->unsuppressProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->createProfileSuppressionBulkDeleteJob($body);
```




#### [Create or Update Profile](https://developers.klaviyo.com/en/v2025-01-15/reference/create_or_update_profile)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $additional_fields_profile | string[]

$klaviyo->Profiles->createOrUpdateProfile($body, additional_fields_profile: $additional_fields_profile);
```
##### Method alias:
```php
$klaviyo->Profiles->createProfileImport($body, additional_fields_profile: $additional_fields_profile);
```




#### [Create Profile](https://developers.klaviyo.com/en/v2025-01-15/reference/create_profile)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $additional_fields_profile | string[]

$klaviyo->Profiles->createProfile($body, additional_fields_profile: $additional_fields_profile);
```




#### [Create or Update Push Token](https://developers.klaviyo.com/en/v2025-01-15/reference/create_push_token)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->createPushToken($body);
```




#### [Get Bulk Import Profiles Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_import_profiles_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_list | string[]
# $fields_profile_bulk_import_job | string[]
# $include | string[]

$klaviyo->Profiles->getBulkImportProfilesJob($job_id, fields_list: $fields_list, fields_profile_bulk_import_job: $fields_profile_bulk_import_job, include: $include);
```
##### Method alias:
```php
$klaviyo->Profiles->getBulkProfileImportJob($job_id, fields_list: $fields_list, fields_profile_bulk_import_job: $fields_profile_bulk_import_job, include: $include);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileBulkImportJob($job_id, fields_list: $fields_list, fields_profile_bulk_import_job: $fields_profile_bulk_import_job, include: $include);
```




#### [Get Bulk Import Profiles Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_import_profiles_jobs)

```php

## Keyword Arguments

# $fields_profile_bulk_import_job | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Profiles->getBulkImportProfilesJobs(fields_profile_bulk_import_job: $fields_profile_bulk_import_job, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Profiles->getBulkProfileImportJobs(fields_profile_bulk_import_job: $fields_profile_bulk_import_job, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileBulkImportJobs(fields_profile_bulk_import_job: $fields_profile_bulk_import_job, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Bulk Suppress Profiles Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_suppress_profiles_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_profile_suppression_bulk_create_job | string[]

$klaviyo->Profiles->getBulkSuppressProfilesJob($job_id, fields_profile_suppression_bulk_create_job: $fields_profile_suppression_bulk_create_job);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileSuppressionBulkCreateJob($job_id, fields_profile_suppression_bulk_create_job: $fields_profile_suppression_bulk_create_job);
```




#### [Get Bulk Suppress Profiles Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_suppress_profiles_jobs)

```php

## Keyword Arguments

# $fields_profile_suppression_bulk_create_job | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Profiles->getBulkSuppressProfilesJobs(fields_profile_suppression_bulk_create_job: $fields_profile_suppression_bulk_create_job, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileSuppressionBulkCreateJobs(fields_profile_suppression_bulk_create_job: $fields_profile_suppression_bulk_create_job, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Bulk Unsuppress Profiles Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_unsuppress_profiles_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_profile_suppression_bulk_delete_job | string[]

$klaviyo->Profiles->getBulkUnsuppressProfilesJob($job_id, fields_profile_suppression_bulk_delete_job: $fields_profile_suppression_bulk_delete_job);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileSuppressionBulkDeleteJob($job_id, fields_profile_suppression_bulk_delete_job: $fields_profile_suppression_bulk_delete_job);
```




#### [Get Bulk Unsuppress Profiles Jobs](https://developers.klaviyo.com/en/v2025-01-15/reference/get_bulk_unsuppress_profiles_jobs)

```php

## Keyword Arguments

# $fields_profile_suppression_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Profiles->getBulkUnsuppressProfilesJobs(fields_profile_suppression_bulk_delete_job: $fields_profile_suppression_bulk_delete_job, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileSuppressionBulkDeleteJobs(fields_profile_suppression_bulk_delete_job: $fields_profile_suppression_bulk_delete_job, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Errors for Bulk Import Profiles Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_errors_for_bulk_import_profiles_job)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_import_error | string[]
# $page_cursor | string
# $page_size | int

$klaviyo->Profiles->getErrorsForBulkImportProfilesJob($id, fields_import_error: $fields_import_error, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getBulkProfileImportJobImportErrors($id, fields_import_error: $fields_import_error, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getImportErrorsForProfileBulkImportJob($id, fields_import_error: $fields_import_error, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileBulkImportJobImportErrors($id, fields_import_error: $fields_import_error, page_cursor: $page_cursor, page_size: $page_size);
```




#### [Get List for Bulk Import Profiles Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_list_for_bulk_import_profiles_job)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_list | string[]

$klaviyo->Profiles->getListForBulkImportProfilesJob($id, fields_list: $fields_list);
```
##### Method alias:
```php
$klaviyo->Profiles->getBulkProfileImportJobLists($id, fields_list: $fields_list);
```
##### Method alias:
```php
$klaviyo->Profiles->getListsForProfileBulkImportJob($id, fields_list: $fields_list);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileBulkImportJobLists($id, fields_list: $fields_list);
```




#### [Get List IDs for Bulk Import Profiles Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_list_ids_for_bulk_import_profiles_job)

```php
## Positional Arguments

# $id | string

$klaviyo->Profiles->getListIdsForBulkImportProfilesJob($id);
```
##### Method alias:
```php
$klaviyo->Profiles->getBulkProfileImportJobRelationshipsLists($id);
```
##### Method alias:
```php
$klaviyo->Profiles->getListIdsForProfileBulkImportJob($id);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileBulkImportJobRelationshipsLists($id);
```




#### [Get List IDs for Profile](https://developers.klaviyo.com/en/v2025-01-15/reference/get_list_ids_for_profile)

```php
## Positional Arguments

# $id | string

$klaviyo->Profiles->getListIdsForProfile($id);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileRelationshipsLists($id);
```




#### [Get Lists for Profile](https://developers.klaviyo.com/en/v2025-01-15/reference/get_lists_for_profile)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_list | string[]

$klaviyo->Profiles->getListsForProfile($id, fields_list: $fields_list);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileLists($id, fields_list: $fields_list);
```




#### [Get Profile](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profile)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_list | string[]
# $fields_profile | string[]
# $fields_segment | string[]
# $include | string[]

$klaviyo->Profiles->getProfile($id, additional_fields_profile: $additional_fields_profile, fields_list: $fields_list, fields_profile: $fields_profile, fields_segment: $fields_segment, include: $include);
```




#### [Get Profile IDs for Bulk Import Profiles Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profile_ids_for_bulk_import_profiles_job)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string
# $page_size | int

$klaviyo->Profiles->getProfileIdsForBulkImportProfilesJob($id, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getBulkProfileImportJobRelationshipsProfiles($id, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileBulkImportJobRelationshipsProfiles($id, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileIdsForProfileBulkImportJob($id, page_cursor: $page_cursor, page_size: $page_size);
```




#### [Get Profiles](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profiles)

```php

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Profiles->getProfiles(additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Profiles for Bulk Import Profiles Job](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profiles_for_bulk_import_profiles_job)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $page_cursor | string
# $page_size | int

$klaviyo->Profiles->getProfilesForBulkImportProfilesJob($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getBulkProfileImportJobProfiles($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileBulkImportJobProfiles($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, page_cursor: $page_cursor, page_size: $page_size);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfilesForProfileBulkImportJob($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, page_cursor: $page_cursor, page_size: $page_size);
```




#### [Get Segment IDs for Profile](https://developers.klaviyo.com/en/v2025-01-15/reference/get_segment_ids_for_profile)

```php
## Positional Arguments

# $id | string

$klaviyo->Profiles->getSegmentIdsForProfile($id);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileRelationshipsSegments($id);
```




#### [Get Segments for Profile](https://developers.klaviyo.com/en/v2025-01-15/reference/get_segments_for_profile)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_segment | string[]

$klaviyo->Profiles->getSegmentsForProfile($id, fields_segment: $fields_segment);
```
##### Method alias:
```php
$klaviyo->Profiles->getProfileSegments($id, fields_segment: $fields_segment);
```




#### [Merge Profiles](https://developers.klaviyo.com/en/v2025-01-15/reference/merge_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->mergeProfiles($body);
```
##### Method alias:
```php
$klaviyo->Profiles->createProfileMerge($body);
```




#### [Update Profile](https://developers.klaviyo.com/en/v2025-01-15/reference/update_profile)

```php
## Positional Arguments

# $id | string
# $body | associative array

## Keyword Arguments

# $additional_fields_profile | string[]

$klaviyo->Profiles->updateProfile($id, $body, additional_fields_profile: $additional_fields_profile);
```






## Reporting

#### [Query Campaign Values](https://developers.klaviyo.com/en/v2025-01-15/reference/query_campaign_values)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $page_cursor | string

$klaviyo->Reporting->queryCampaignValues($body, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Reporting->createCampaignValueReport($body, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Reporting->createCampaignValuesReport($body, page_cursor: $page_cursor);
```




#### [Query Flow Series](https://developers.klaviyo.com/en/v2025-01-15/reference/query_flow_series)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $page_cursor | string

$klaviyo->Reporting->queryFlowSeries($body, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Reporting->createFlowSeryReport($body, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Reporting->createFlowSeriesReport($body, page_cursor: $page_cursor);
```




#### [Query Flow Values](https://developers.klaviyo.com/en/v2025-01-15/reference/query_flow_values)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $page_cursor | string

$klaviyo->Reporting->queryFlowValues($body, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Reporting->createFlowValueReport($body, page_cursor: $page_cursor);
```
##### Method alias:
```php
$klaviyo->Reporting->createFlowValuesReport($body, page_cursor: $page_cursor);
```




#### [Query Form Series](https://developers.klaviyo.com/en/v2025-01-15/reference/query_form_series)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Reporting->queryFormSeries($body);
```
##### Method alias:
```php
$klaviyo->Reporting->createFormSeryReport($body);
```
##### Method alias:
```php
$klaviyo->Reporting->createFormSeriesReport($body);
```




#### [Query Form Values](https://developers.klaviyo.com/en/v2025-01-15/reference/query_form_values)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Reporting->queryFormValues($body);
```
##### Method alias:
```php
$klaviyo->Reporting->createFormValueReport($body);
```
##### Method alias:
```php
$klaviyo->Reporting->createFormValuesReport($body);
```




#### [Query Segment Series](https://developers.klaviyo.com/en/v2025-01-15/reference/query_segment_series)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Reporting->querySegmentSeries($body);
```
##### Method alias:
```php
$klaviyo->Reporting->createSegmentSeryReport($body);
```
##### Method alias:
```php
$klaviyo->Reporting->createSegmentSeriesReport($body);
```




#### [Query Segment Values](https://developers.klaviyo.com/en/v2025-01-15/reference/query_segment_values)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Reporting->querySegmentValues($body);
```
##### Method alias:
```php
$klaviyo->Reporting->createSegmentValueReport($body);
```
##### Method alias:
```php
$klaviyo->Reporting->createSegmentValuesReport($body);
```






## Reviews

#### [Get Review](https://developers.klaviyo.com/en/v2025-01-15/reference/get_review)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_event | string[]
# $fields_review | string[]
# $include | string[]

$klaviyo->Reviews->getReview($id, fields_event: $fields_event, fields_review: $fields_review, include: $include);
```




#### [Get Reviews](https://developers.klaviyo.com/en/v2025-01-15/reference/get_reviews)

```php

## Keyword Arguments

# $fields_event | string[]
# $fields_review | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Reviews->getReviews(fields_event: $fields_event, fields_review: $fields_review, filter: $filter, include: $include, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Update Review](https://developers.klaviyo.com/en/v2025-01-15/reference/update_review)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Reviews->updateReview($id, $body);
```






## Segments

#### [Create Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/create_segment)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Segments->createSegment($body);
```




#### [Delete Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_segment)

```php
## Positional Arguments

# $id | string

$klaviyo->Segments->deleteSegment($id);
```




#### [Get Flows Triggered by Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flows_triggered_by_segment)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow | string[]

$klaviyo->Segments->getFlowsTriggeredBySegment($id, fields_flow: $fields_flow);
```
##### Method alias:
```php
$klaviyo->Segments->getFlowTriggersForSegment($id, fields_flow: $fields_flow);
```
##### Method alias:
```php
$klaviyo->Segments->getSegmentFlowTriggers($id, fields_flow: $fields_flow);
```




#### [Get IDs for Flows Triggered by Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/get_ids_for_flows_triggered_by_segment)

```php
## Positional Arguments

# $id | string

$klaviyo->Segments->getIdsForFlowsTriggeredBySegment($id);
```
##### Method alias:
```php
$klaviyo->Segments->getFlowTriggerIdsForSegment($id);
```
##### Method alias:
```php
$klaviyo->Segments->getSegmentRelationshipsFlowTriggers($id);
```




#### [Get Profile IDs for Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profile_ids_for_segment)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Segments->getProfileIdsForSegment($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Segments->getSegmentRelationshipsProfiles($id, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Profiles for Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/get_profiles_for_segment)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Segments->getProfilesForSegment($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Segments->getSegmentProfiles($id, additional_fields_profile: $additional_fields_profile, fields_profile: $fields_profile, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/get_segment)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_segment | string[]
# $fields_flow | string[]
# $fields_segment | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Segments->getSegment($id, additional_fields_segment: $additional_fields_segment, fields_flow: $fields_flow, fields_segment: $fields_segment, fields_tag: $fields_tag, include: $include);
```




#### [Get Segments](https://developers.klaviyo.com/en/v2025-01-15/reference/get_segments)

```php

## Keyword Arguments

# $fields_flow | string[]
# $fields_segment | string[]
# $fields_tag | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Segments->getSegments(fields_flow: $fields_flow, fields_segment: $fields_segment, fields_tag: $fields_tag, filter: $filter, include: $include, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Tag IDs for Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_ids_for_segment)

```php
## Positional Arguments

# $id | string

$klaviyo->Segments->getTagIdsForSegment($id);
```
##### Method alias:
```php
$klaviyo->Segments->getSegmentRelationshipsTags($id);
```




#### [Get Tags for Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tags_for_segment)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Segments->getTagsForSegment($id, fields_tag: $fields_tag);
```
##### Method alias:
```php
$klaviyo->Segments->getSegmentTags($id, fields_tag: $fields_tag);
```




#### [Update Segment](https://developers.klaviyo.com/en/v2025-01-15/reference/update_segment)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Segments->updateSegment($id, $body);
```






## Tags

#### [Create Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/create_tag)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Tags->createTag($body);
```




#### [Create Tag Group](https://developers.klaviyo.com/en/v2025-01-15/reference/create_tag_group)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Tags->createTagGroup($body);
```




#### [Delete Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_tag)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->deleteTag($id);
```




#### [Delete Tag Group](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_tag_group)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->deleteTagGroup($id);
```




#### [Get Campaign IDs for Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/get_campaign_ids_for_tag)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getCampaignIdsForTag($id);
```
##### Method alias:
```php
$klaviyo->Tags->getTagRelationshipsCampaigns($id);
```




#### [Get Flow IDs for Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/get_flow_ids_for_tag)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getFlowIdsForTag($id);
```
##### Method alias:
```php
$klaviyo->Tags->getTagRelationshipsFlows($id);
```




#### [Get List IDs for Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/get_list_ids_for_tag)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getListIdsForTag($id);
```
##### Method alias:
```php
$klaviyo->Tags->getTagRelationshipsLists($id);
```




#### [Get Segment IDs for Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/get_segment_ids_for_tag)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getSegmentIdsForTag($id);
```
##### Method alias:
```php
$klaviyo->Tags->getTagRelationshipsSegments($id);
```




#### [Get Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag_group | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Tags->getTag($id, fields_tag_group: $fields_tag_group, fields_tag: $fields_tag, include: $include);
```




#### [Get Tag Group](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_group)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag_group | string[]

$klaviyo->Tags->getTagGroup($id, fields_tag_group: $fields_tag_group);
```




#### [Get Tag Group for Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_group_for_tag)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag_group | string[]

$klaviyo->Tags->getTagGroupForTag($id, fields_tag_group: $fields_tag_group);
```
##### Method alias:
```php
$klaviyo->Tags->getTagTagGroup($id, fields_tag_group: $fields_tag_group);
```
##### Method alias:
```php
$klaviyo->Tags->getGroupForTag($id, fields_tag_group: $fields_tag_group);
```




#### [Get Tag Group ID for Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_group_id_for_tag)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagGroupIdForTag($id);
```
##### Method alias:
```php
$klaviyo->Tags->getTagRelationshipsTagGroup($id);
```
##### Method alias:
```php
$klaviyo->Tags->getGroupIdForTag($id);
```
##### Method alias:
```php
$klaviyo->Tags->getTagRelationshipsGroup($id);
```




#### [Get Tag Groups](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_groups)

```php

## Keyword Arguments

# $fields_tag_group | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Tags->getTagGroups(fields_tag_group: $fields_tag_group, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Tag IDs for Tag Group](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tag_ids_for_tag_group)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagIdsForTagGroup($id);
```
##### Method alias:
```php
$klaviyo->Tags->getTagGroupRelationshipsTags($id);
```




#### [Get Tags](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tags)

```php

## Keyword Arguments

# $fields_tag_group | string[]
# $fields_tag | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Tags->getTags(fields_tag_group: $fields_tag_group, fields_tag: $fields_tag, filter: $filter, include: $include, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Tags for Tag Group](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tags_for_tag_group)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Tags->getTagsForTagGroup($id, fields_tag: $fields_tag);
```
##### Method alias:
```php
$klaviyo->Tags->getTagGroupTags($id, fields_tag: $fields_tag);
```




#### [Remove Tag from Campaigns](https://developers.klaviyo.com/en/v2025-01-15/reference/remove_tag_from_campaigns)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->removeTagFromCampaigns($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->deleteTagRelationshipsCampaigns($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->removeCampaignsFromTag($id, $body);
```




#### [Remove Tag from Flows](https://developers.klaviyo.com/en/v2025-01-15/reference/remove_tag_from_flows)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->removeTagFromFlows($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->deleteTagRelationshipsFlows($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->removeFlowsFromTag($id, $body);
```




#### [Remove Tag from Lists](https://developers.klaviyo.com/en/v2025-01-15/reference/remove_tag_from_lists)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->removeTagFromLists($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->deleteTagRelationshipsLists($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->removeListsFromTag($id, $body);
```




#### [Remove Tag from Segments](https://developers.klaviyo.com/en/v2025-01-15/reference/remove_tag_from_segments)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->removeTagFromSegments($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->deleteTagRelationshipsSegments($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->removeSegmentsFromTag($id, $body);
```




#### [Tag Campaigns](https://developers.klaviyo.com/en/v2025-01-15/reference/tag_campaigns)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->tagCampaigns($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->createTagRelationshipsCampaign($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->addCampaignsToTag($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->createTagRelationshipsCampaigns($id, $body);
```




#### [Tag Flows](https://developers.klaviyo.com/en/v2025-01-15/reference/tag_flows)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->tagFlows($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->createTagRelationshipsFlow($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->addFlowsToTag($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->createTagRelationshipsFlows($id, $body);
```




#### [Tag Lists](https://developers.klaviyo.com/en/v2025-01-15/reference/tag_lists)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->tagLists($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->createTagRelationshipsList($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->addListsToTag($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->createTagRelationshipsLists($id, $body);
```




#### [Tag Segments](https://developers.klaviyo.com/en/v2025-01-15/reference/tag_segments)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->tagSegments($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->createTagRelationshipsSegment($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->addSegmentsToTag($id, $body);
```
##### Method alias:
```php
$klaviyo->Tags->createTagRelationshipsSegments($id, $body);
```




#### [Update Tag](https://developers.klaviyo.com/en/v2025-01-15/reference/update_tag)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->updateTag($id, $body);
```




#### [Update Tag Group](https://developers.klaviyo.com/en/v2025-01-15/reference/update_tag_group)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->updateTagGroup($id, $body);
```






## Templates

#### [Clone Template](https://developers.klaviyo.com/en/v2025-01-15/reference/clone_template)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Templates->cloneTemplate($body);
```
##### Method alias:
```php
$klaviyo->Templates->createTemplateClone($body);
```




#### [Create Template](https://developers.klaviyo.com/en/v2025-01-15/reference/create_template)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Templates->createTemplate($body);
```




#### [Create Universal Content](https://developers.klaviyo.com/en/v2025-01-15/reference/create_universal_content)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Templates->createUniversalContent($body);
```
##### Method alias:
```php
$klaviyo->Templates->createTemplateUniversalContent($body);
```




#### [Delete Template](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_template)

```php
## Positional Arguments

# $id | string

$klaviyo->Templates->deleteTemplate($id);
```




#### [Delete Universal Content](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_universal_content)

```php
## Positional Arguments

# $id | string

$klaviyo->Templates->deleteUniversalContent($id);
```
##### Method alias:
```php
$klaviyo->Templates->deleteTemplateUniversalContent($id);
```




#### [Get All Universal Content](https://developers.klaviyo.com/en/v2025-01-15/reference/get_all_universal_content)

```php

## Keyword Arguments

# $fields_template_universal_content | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Templates->getAllUniversalContent(fields_template_universal_content: $fields_template_universal_content, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```
##### Method alias:
```php
$klaviyo->Templates->getTemplateUniversalContent(fields_template_universal_content: $fields_template_universal_content, filter: $filter, page_cursor: $page_cursor, page_size: $page_size, sort: $sort);
```




#### [Get Template](https://developers.klaviyo.com/en/v2025-01-15/reference/get_template)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_template | string[]

$klaviyo->Templates->getTemplate($id, fields_template: $fields_template);
```




#### [Get Templates](https://developers.klaviyo.com/en/v2025-01-15/reference/get_templates)

```php

## Keyword Arguments

# $fields_template | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Templates->getTemplates(fields_template: $fields_template, filter: $filter, page_cursor: $page_cursor, sort: $sort);
```




#### [Get Universal Content](https://developers.klaviyo.com/en/v2025-01-15/reference/get_universal_content)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_template_universal_content | string[]

$klaviyo->Templates->getUniversalContent($id, fields_template_universal_content: $fields_template_universal_content);
```




#### [Render Template](https://developers.klaviyo.com/en/v2025-01-15/reference/render_template)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Templates->renderTemplate($body);
```
##### Method alias:
```php
$klaviyo->Templates->createTemplateRender($body);
```




#### [Update Template](https://developers.klaviyo.com/en/v2025-01-15/reference/update_template)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Templates->updateTemplate($id, $body);
```




#### [Update Universal Content](https://developers.klaviyo.com/en/v2025-01-15/reference/update_universal_content)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Templates->updateUniversalContent($id, $body);
```
##### Method alias:
```php
$klaviyo->Templates->updateTemplateUniversalContent($id, $body);
```






## TrackingSettings

#### [Get Tracking Setting](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tracking_setting)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tracking_setting | string[]

$klaviyo->TrackingSettings->getTrackingSetting($id, fields_tracking_setting: $fields_tracking_setting);
```




#### [Get Tracking Settings](https://developers.klaviyo.com/en/v2025-01-15/reference/get_tracking_settings)

```php

## Keyword Arguments

# $fields_tracking_setting | string[]
# $page_cursor | string
# $page_size | int

$klaviyo->TrackingSettings->getTrackingSettings(fields_tracking_setting: $fields_tracking_setting, page_cursor: $page_cursor, page_size: $page_size);
```




#### [Update Tracking Setting](https://developers.klaviyo.com/en/v2025-01-15/reference/update_tracking_setting)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->TrackingSettings->updateTrackingSetting($id, $body);
```






## Webhooks

#### [Create Webhook](https://developers.klaviyo.com/en/v2025-01-15/reference/create_webhook)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Webhooks->createWebhook($body);
```




#### [Delete Webhook](https://developers.klaviyo.com/en/v2025-01-15/reference/delete_webhook)

```php
## Positional Arguments

# $id | string

$klaviyo->Webhooks->deleteWebhook($id);
```




#### [Get Webhook](https://developers.klaviyo.com/en/v2025-01-15/reference/get_webhook)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_webhook | string[]
# $include | string[]

$klaviyo->Webhooks->getWebhook($id, fields_webhook: $fields_webhook, include: $include);
```




#### [Get Webhook Topic](https://developers.klaviyo.com/en/v2025-01-15/reference/get_webhook_topic)

```php
## Positional Arguments

# $id | string

$klaviyo->Webhooks->getWebhookTopic($id);
```




#### [Get Webhook Topics](https://developers.klaviyo.com/en/v2025-01-15/reference/get_webhook_topics)

```php

$klaviyo->Webhooks->getWebhookTopics();
```




#### [Get Webhooks](https://developers.klaviyo.com/en/v2025-01-15/reference/get_webhooks)

```php

## Keyword Arguments

# $fields_webhook | string[]
# $include | string[]

$klaviyo->Webhooks->getWebhooks(fields_webhook: $fields_webhook, include: $include);
```




#### [Update Webhook](https://developers.klaviyo.com/en/v2025-01-15/reference/update_webhook)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Webhooks->updateWebhook($id, $body);
```




# Appendix

## Global Keyword args

NOTES: 
- These are arguments that you can apply to any endpoint call, and which are unique to the SDK.
- They come LAST, AFTER ALL the endpoint-specific keyword args listed above, in the same order they are listed below.
- They are subject to the same quirks as any other PHP keyword args, in that to be included, they need to be preceeded by all keyword args listed before them. This includes all endpoint-specific keyword args for a given endpoint, along with any preceeding global keyword args listed below, if applicable. This holds even if those other keyword args are not being used; in that case, set those to `null`, but again, they must be included.

We currently support the following global keyword args:
- `$apiKey` :  use this to override the client-level `api_key`, which you define upon client instantiation.


## Namespace

In the interest of making the SDK conform to PHP idioms, we made the following namespace changes *relative* to the language agnostic resources up top (API Docs, Guides, etc).

- Underscores are stripped from function names (operation IDs)
- Function names use camelCase (e.g. `getMetrics`)
- Resource names use PascalCase (e.g. `Metrics`)
- Parameter names remain unchanged

## Parameters & Arguments

We stick to the following convention for parameters/arguments

1. All parameters are passed as function args.
2. All optional params, as well as all Body and Form Data params (including required ones), are passed as keyword args.
3. All query and path params that are tagged as `required` in the docs are passed as positional args.
4. `$api_key` is optional, as it is set at client level. However, you can override the client key wherever by passing in `$api_key` as the LAST optional param. Reminder: don't do this client-side.
