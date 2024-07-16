# Klaviyo PHP SDK

- SDK version: 9.0.1
- API Revision: 2024-07-15

## Helpful Resources

- [API Reference](https://developers.klaviyo.com/en/v2024-07-15/reference)
- [API Guides](https://developers.klaviyo.com/en/v2024-07-15/docs)
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



- Segments



- Tags



- Templates



- Webhooks



## Installation

You can install this package using [our Packagist package](https://packagist.org/packages/klaviyo/api):

```bash
composer require klaviyo/api
```

## Usage Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use KlaviyoAPI\KlaviyoAPI;

$klaviyo = new KlaviyoAPI(
    'YOUR_API_KEY', 
    $num_retries = 3, 
    $wait_seconds = 3,
    $guzzle_options = [],
    $user_agent_suffix = "/YOUR_APP_NAME");

$response = $klaviyo->Metrics->getMetrics();
```

### Use Case Examples

#### How to use filtering, sorting, and spare fieldset JSON API features

**Use Case**: Get events associated with a specific metric, then return just the event properties sorted by oldest to newest datetime.

```php
$klaviyo->Events->getEvents(
    $fields_event=['event_properties'], 
    $fields_metric=NULL, 
    $fields_profile=NULL, 
    $filter="equals(metric_id,\"UMTLbD\")", 
    $include=NULL, 
    $page_cursor=NULL, 
    $sort='-datetime'
);
```

NOTE: the filter param values need to be url-encoded

#### How to filter based on datetime

**Use Case**: Get profiles that have been updated between two datetimes.

```php
$klaviyo->Profiles->getProfiles(
    $additional_fields_profile=NULL, 
    $fields_profile=NULL, 
    $filter='less-than(updated,2023-04-26T00:00:00Z),greater-than(updated,2023-04-19T00:00:00Z)', 
);
```

#### How to use pagination and the page[size] param

**Use Case**: Use cursor-based pagination to get the next 20 profile records.

```php
$klaviyo->Profiles->getProfiles(
    $additional_fields_profile=NULL, 
    $fields_profile=NULL, 
    $filter=NULL,
    $page_cursor="https://a.klaviyo.com/api/profiles/?page%5Bcursor%5D=bmV4dDo6aWQ6OjAxRjNaWk5ITlRYMUtFVEhQMzJTUzRBN0ZY", 
    $page_size=20, 
);
```

NOTE: This page cursor value is exactly what is returned in the `self`/`next`/`prev` response values

#### How to add additional information to your API response via additional-fields and the `includes` parameter

**Use Case**: Get a specific profile, return an additional predictive analytics field, and also return the list objects associated with the profile.

```php
$klaviyo->Profiles->getProfile(
    '01F3ZZNHPY4YZFVGNBH5THCNXE', 
    $additional_fields_profile=['predictive_analytics'], 
    $fields_list=NULL, 
    $fields_profile=NULL, 
    $fields_segment=NULL, 
    $include=['lists']
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

When using `Images.uploadImageFromFile(file, name=name)`, `file`` can be either a file path string OR a bytearray.

NOTE: when file is a bytearray, you will need to use the optional `name` parameter to specify the file name, else name will default to `unnamed_image_from_python_sdk`

*as a file path*
```python
filepath = '/path/to/image.png'
klaviyo.Images.upload_image_from_file(file, name=name)
```

*as a bytearray*
```python
filepath = '/path/to/image.png'
with open(filepath, 'rb') as f:
    file = f.read()
klaviyo.Images.upload_image_from_file(file, name=name)
```


## Retry behavior

* The SDK retries on resolvable errors, namely: rate limits (common) and server errors on Klaviyo's end (rare).
* The keyword arguments in the example above define retry behavior
  * `wait_seconds` denotes how long to wait per retry, in *seconds*
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
- Organization: Resource groups and functions are listed in alphabetical order, first by Resource name, then by **OpenAPI Summary**. Operation summaries are those listed in the right side bar of the [API Reference](https://developers.klaviyo.com/en/v2024-07-15/reference/get_events). These summaries link directly to the corresponding section of the API reference.
- For example values / data types, as well as whether parameters are required/optional, please reference the corresponding API Reference link.
- Some keyword args are required for the API call to succeed, the API docs above are the source of truth regarding which keyword args are required.
- JSON payloads should be passed in as associative arrays
- A strange quirk of PHP is that default/optional arguments must be passed in in order, and MUST be included and set as `null`, at least up to the last default value you wish to use. 
  - For example, if a given function has the following optional parameters `someFunction($a=1, $b=2, $c=3)`, and you wish to only set `$b`, you MUST pass in `someFunction($a=null, $b=$YOUR_VALUE)`
  - Otherwise, if you pass in something such as `someFunction($b=$YOUR_VALUE)`, PHP will actually assign the `$YOUR_VALUE` to parameter `$a`, which is wrong.
- `$api_key` is optional, as it is set at client-level. However, you can override the client key wherever by passing in `$api_key` as the LAST optional param. Reminder: **DO NOT** use private API keys client-side / onsite.
- Paging: Where applicable, `$page_cursor` can be passed in either as a parsed string, or as the entire `self.link` response returned by paged API endpoints.

# Comprehensive list of Operations & Parameters





## Accounts

#### [Get Account](https://developers.klaviyo.com/en/v2024-07-15/reference/get_account)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_account | string[]

$klaviyo->Accounts->getAccount($id, $fields_account=$fields_account);
```




#### [Get Accounts](https://developers.klaviyo.com/en/v2024-07-15/reference/get_accounts)

```php

## Keyword Arguments

# $fields_account | string[]

$klaviyo->Accounts->getAccounts($fields_account=$fields_account);
```






## Campaigns

#### [Create Campaign](https://developers.klaviyo.com/en/v2024-07-15/reference/create_campaign)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaign($body);
```




#### [Create Campaign Clone](https://developers.klaviyo.com/en/v2024-07-15/reference/create_campaign_clone)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignClone($body);
```




#### [Assign Campaign Message Template](https://developers.klaviyo.com/en/v2024-07-15/reference/create_campaign_message_assign_template)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignMessageAssignTemplate($body);
```




#### [Create Campaign Recipient Estimation Job](https://developers.klaviyo.com/en/v2024-07-15/reference/create_campaign_recipient_estimation_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignRecipientEstimationJob($body);
```




#### [Create Campaign Send Job](https://developers.klaviyo.com/en/v2024-07-15/reference/create_campaign_send_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignSendJob($body);
```




#### [Delete Campaign](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_campaign)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->deleteCampaign($id);
```




#### [Get Campaign](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_message | string[]
# $fields_campaign | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Campaigns->getCampaign($id, $fields_campaign_message=$fields_campaign_message, $fields_campaign=$fields_campaign, $fields_tag=$fields_tag, $include=$include);
```




#### [Get Campaign Campaign Messages](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_campaign_messages)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_message | string[]
# $fields_campaign | string[]
# $fields_template | string[]
# $include | string[]

$klaviyo->Campaigns->getCampaignCampaignMessages($id, $fields_campaign_message=$fields_campaign_message, $fields_campaign=$fields_campaign, $fields_template=$fields_template, $include=$include);
```




#### [Get Campaign Message](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_message | string[]
# $fields_campaign | string[]
# $fields_template | string[]
# $include | string[]

$klaviyo->Campaigns->getCampaignMessage($id, $fields_campaign_message=$fields_campaign_message, $fields_campaign=$fields_campaign, $fields_template=$fields_template, $include=$include);
```




#### [Get Campaign Message Campaign](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_message_campaign)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign | string[]

$klaviyo->Campaigns->getCampaignMessageCampaign($id, $fields_campaign=$fields_campaign);
```




#### [Get Campaign Message Relationships Campaign](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_message_relationships_campaign)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getCampaignMessageRelationshipsCampaign($id);
```




#### [Get Campaign Message Relationships Template](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_message_relationships_template)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getCampaignMessageRelationshipsTemplate($id);
```




#### [Get Campaign Message Template](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_message_template)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_template | string[]

$klaviyo->Campaigns->getCampaignMessageTemplate($id, $fields_template=$fields_template);
```




#### [Get Campaign Recipient Estimation](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_recipient_estimation)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_recipient_estimation | string[]

$klaviyo->Campaigns->getCampaignRecipientEstimation($id, $fields_campaign_recipient_estimation=$fields_campaign_recipient_estimation);
```




#### [Get Campaign Recipient Estimation Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_recipient_estimation_job)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_recipient_estimation_job | string[]

$klaviyo->Campaigns->getCampaignRecipientEstimationJob($id, $fields_campaign_recipient_estimation_job=$fields_campaign_recipient_estimation_job);
```




#### [Get Campaign Relationships Campaign Messages](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_relationships_campaign_messages)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getCampaignRelationshipsCampaignMessages($id);
```




#### [Get Campaign Relationships Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_relationships_tags)

```php
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getCampaignRelationshipsTags($id);
```




#### [Get Campaign Send Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_send_job)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_send_job | string[]

$klaviyo->Campaigns->getCampaignSendJob($id, $fields_campaign_send_job=$fields_campaign_send_job);
```




#### [Get Campaign Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaign_tags)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Campaigns->getCampaignTags($id, $fields_tag=$fields_tag);
```




#### [Get Campaigns](https://developers.klaviyo.com/en/v2024-07-15/reference/get_campaigns)

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

$klaviyo->Campaigns->getCampaigns($filter, $fields_campaign_message=$fields_campaign_message, $fields_campaign=$fields_campaign, $fields_tag=$fields_tag, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Update Campaign](https://developers.klaviyo.com/en/v2024-07-15/reference/update_campaign)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateCampaign($id, $body);
```




#### [Update Campaign Message](https://developers.klaviyo.com/en/v2024-07-15/reference/update_campaign_message)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateCampaignMessage($id, $body);
```




#### [Update Campaign Send Job](https://developers.klaviyo.com/en/v2024-07-15/reference/update_campaign_send_job)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateCampaignSendJob($id, $body);
```






## Catalogs

#### [Create Back In Stock Subscription](https://developers.klaviyo.com/en/v2024-07-15/reference/create_back_in_stock_subscription)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createBackInStockSubscription($body);
```




#### [Create Catalog Category](https://developers.klaviyo.com/en/v2024-07-15/reference/create_catalog_category)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogCategory($body);
```




#### [Create Catalog Category Relationships Items](https://developers.klaviyo.com/en/v2024-07-15/reference/create_catalog_category_relationships_items)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->createCatalogCategoryRelationshipsItems($id, $body);
```




#### [Create Catalog Item](https://developers.klaviyo.com/en/v2024-07-15/reference/create_catalog_item)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogItem($body);
```




#### [Create Catalog Item Relationships Categories](https://developers.klaviyo.com/en/v2024-07-15/reference/create_catalog_item_relationships_categories)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->createCatalogItemRelationshipsCategories($id, $body);
```




#### [Create Catalog Variant](https://developers.klaviyo.com/en/v2024-07-15/reference/create_catalog_variant)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogVariant($body);
```




#### [Delete Catalog Category](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_catalog_category)

```php
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogCategory($id);
```




#### [Delete Catalog Category Relationships Items](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_catalog_category_relationships_items)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->deleteCatalogCategoryRelationshipsItems($id, $body);
```




#### [Delete Catalog Item](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_catalog_item)

```php
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogItem($id);
```




#### [Delete Catalog Item Relationships Categories](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_catalog_item_relationships_categories)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->deleteCatalogItemRelationshipsCategories($id, $body);
```




#### [Delete Catalog Variant](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_catalog_variant)

```php
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogVariant($id);
```




#### [Get Catalog Categories](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_categories)

```php

## Keyword Arguments

# $fields_catalog_category | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogCategories($fields_catalog_category=$fields_catalog_category, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Category](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_category)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_category | string[]

$klaviyo->Catalogs->getCatalogCategory($id, $fields_catalog_category=$fields_catalog_category);
```




#### [Get Catalog Category Items](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_category_items)

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

$klaviyo->Catalogs->getCatalogCategoryItems($id, $fields_catalog_item=$fields_catalog_item, $fields_catalog_variant=$fields_catalog_variant, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Category Relationships Items](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_category_relationships_items)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string

$klaviyo->Catalogs->getCatalogCategoryRelationshipsItems($id, $page_cursor=$page_cursor);
```




#### [Get Catalog Item](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_item)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_item | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getCatalogItem($id, $fields_catalog_item=$fields_catalog_item, $fields_catalog_variant=$fields_catalog_variant, $include=$include);
```




#### [Get Catalog Item Categories](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_item_categories)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_category | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogItemCategories($id, $fields_catalog_category=$fields_catalog_category, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Item Relationships Categories](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_item_relationships_categories)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string

$klaviyo->Catalogs->getCatalogItemRelationshipsCategories($id, $page_cursor=$page_cursor);
```




#### [Get Catalog Item Variants](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_item_variants)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_variant | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogItemVariants($id, $fields_catalog_variant=$fields_catalog_variant, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Items](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_items)

```php

## Keyword Arguments

# $fields_catalog_item | string[]
# $fields_catalog_variant | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogItems($fields_catalog_item=$fields_catalog_item, $fields_catalog_variant=$fields_catalog_variant, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Variant](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_variant)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_variant | string[]

$klaviyo->Catalogs->getCatalogVariant($id, $fields_catalog_variant=$fields_catalog_variant);
```




#### [Get Catalog Variants](https://developers.klaviyo.com/en/v2024-07-15/reference/get_catalog_variants)

```php

## Keyword Arguments

# $fields_catalog_variant | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogVariants($fields_catalog_variant=$fields_catalog_variant, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Create Categories Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_create_categories_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_create_job | string[]
# $fields_catalog_category | string[]
# $include | string[]

$klaviyo->Catalogs->getCreateCategoriesJob($job_id, $fields_catalog_category_bulk_create_job=$fields_catalog_category_bulk_create_job, $fields_catalog_category=$fields_catalog_category, $include=$include);
```




#### [Get Create Categories Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_create_categories_jobs)

```php

## Keyword Arguments

# $fields_catalog_category_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getCreateCategoriesJobs($fields_catalog_category_bulk_create_job=$fields_catalog_category_bulk_create_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Create Items Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_create_items_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_create_job | string[]
# $fields_catalog_item | string[]
# $include | string[]

$klaviyo->Catalogs->getCreateItemsJob($job_id, $fields_catalog_item_bulk_create_job=$fields_catalog_item_bulk_create_job, $fields_catalog_item=$fields_catalog_item, $include=$include);
```




#### [Get Create Items Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_create_items_jobs)

```php

## Keyword Arguments

# $fields_catalog_item_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getCreateItemsJobs($fields_catalog_item_bulk_create_job=$fields_catalog_item_bulk_create_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Create Variants Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_create_variants_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_create_job | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getCreateVariantsJob($job_id, $fields_catalog_variant_bulk_create_job=$fields_catalog_variant_bulk_create_job, $fields_catalog_variant=$fields_catalog_variant, $include=$include);
```




#### [Get Create Variants Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_create_variants_jobs)

```php

## Keyword Arguments

# $fields_catalog_variant_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getCreateVariantsJobs($fields_catalog_variant_bulk_create_job=$fields_catalog_variant_bulk_create_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Delete Categories Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_delete_categories_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_delete_job | string[]

$klaviyo->Catalogs->getDeleteCategoriesJob($job_id, $fields_catalog_category_bulk_delete_job=$fields_catalog_category_bulk_delete_job);
```




#### [Get Delete Categories Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_delete_categories_jobs)

```php

## Keyword Arguments

# $fields_catalog_category_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getDeleteCategoriesJobs($fields_catalog_category_bulk_delete_job=$fields_catalog_category_bulk_delete_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Delete Items Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_delete_items_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_delete_job | string[]

$klaviyo->Catalogs->getDeleteItemsJob($job_id, $fields_catalog_item_bulk_delete_job=$fields_catalog_item_bulk_delete_job);
```




#### [Get Delete Items Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_delete_items_jobs)

```php

## Keyword Arguments

# $fields_catalog_item_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getDeleteItemsJobs($fields_catalog_item_bulk_delete_job=$fields_catalog_item_bulk_delete_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Delete Variants Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_delete_variants_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_delete_job | string[]

$klaviyo->Catalogs->getDeleteVariantsJob($job_id, $fields_catalog_variant_bulk_delete_job=$fields_catalog_variant_bulk_delete_job);
```




#### [Get Delete Variants Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_delete_variants_jobs)

```php

## Keyword Arguments

# $fields_catalog_variant_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getDeleteVariantsJobs($fields_catalog_variant_bulk_delete_job=$fields_catalog_variant_bulk_delete_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Update Categories Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_update_categories_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_update_job | string[]
# $fields_catalog_category | string[]
# $include | string[]

$klaviyo->Catalogs->getUpdateCategoriesJob($job_id, $fields_catalog_category_bulk_update_job=$fields_catalog_category_bulk_update_job, $fields_catalog_category=$fields_catalog_category, $include=$include);
```




#### [Get Update Categories Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_update_categories_jobs)

```php

## Keyword Arguments

# $fields_catalog_category_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getUpdateCategoriesJobs($fields_catalog_category_bulk_update_job=$fields_catalog_category_bulk_update_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Update Items Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_update_items_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_update_job | string[]
# $fields_catalog_item | string[]
# $include | string[]

$klaviyo->Catalogs->getUpdateItemsJob($job_id, $fields_catalog_item_bulk_update_job=$fields_catalog_item_bulk_update_job, $fields_catalog_item=$fields_catalog_item, $include=$include);
```




#### [Get Update Items Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_update_items_jobs)

```php

## Keyword Arguments

# $fields_catalog_item_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getUpdateItemsJobs($fields_catalog_item_bulk_update_job=$fields_catalog_item_bulk_update_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Update Variants Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_update_variants_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_update_job | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getUpdateVariantsJob($job_id, $fields_catalog_variant_bulk_update_job=$fields_catalog_variant_bulk_update_job, $fields_catalog_variant=$fields_catalog_variant, $include=$include);
```




#### [Get Update Variants Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_update_variants_jobs)

```php

## Keyword Arguments

# $fields_catalog_variant_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getUpdateVariantsJobs($fields_catalog_variant_bulk_update_job=$fields_catalog_variant_bulk_update_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Spawn Create Categories Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_create_categories_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnCreateCategoriesJob($body);
```




#### [Spawn Create Items Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_create_items_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnCreateItemsJob($body);
```




#### [Spawn Create Variants Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_create_variants_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnCreateVariantsJob($body);
```




#### [Spawn Delete Categories Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_delete_categories_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnDeleteCategoriesJob($body);
```




#### [Spawn Delete Items Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_delete_items_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnDeleteItemsJob($body);
```




#### [Spawn Delete Variants Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_delete_variants_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnDeleteVariantsJob($body);
```




#### [Spawn Update Categories Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_update_categories_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnUpdateCategoriesJob($body);
```




#### [Spawn Update Items Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_update_items_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnUpdateItemsJob($body);
```




#### [Spawn Update Variants Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_update_variants_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnUpdateVariantsJob($body);
```




#### [Update Catalog Category](https://developers.klaviyo.com/en/v2024-07-15/reference/update_catalog_category)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogCategory($id, $body);
```




#### [Update Catalog Category Relationships Items](https://developers.klaviyo.com/en/v2024-07-15/reference/update_catalog_category_relationships_items)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogCategoryRelationshipsItems($id, $body);
```




#### [Update Catalog Item](https://developers.klaviyo.com/en/v2024-07-15/reference/update_catalog_item)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogItem($id, $body);
```




#### [Update Catalog Item Relationships Categories](https://developers.klaviyo.com/en/v2024-07-15/reference/update_catalog_item_relationships_categories)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogItemRelationshipsCategories($id, $body);
```




#### [Update Catalog Variant](https://developers.klaviyo.com/en/v2024-07-15/reference/update_catalog_variant)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogVariant($id, $body);
```






## Coupons

#### [Create Coupon](https://developers.klaviyo.com/en/v2024-07-15/reference/create_coupon)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Coupons->createCoupon($body);
```




#### [Create Coupon Code](https://developers.klaviyo.com/en/v2024-07-15/reference/create_coupon_code)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Coupons->createCouponCode($body);
```




#### [Delete Coupon](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_coupon)

```php
## Positional Arguments

# $id | string

$klaviyo->Coupons->deleteCoupon($id);
```




#### [Delete Coupon Code](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_coupon_code)

```php
## Positional Arguments

# $id | string

$klaviyo->Coupons->deleteCouponCode($id);
```




#### [Get Coupon](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_coupon | string[]

$klaviyo->Coupons->getCoupon($id, $fields_coupon=$fields_coupon);
```




#### [Get Coupon Code](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon_code)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_coupon_code | string[]
# $fields_coupon | string[]
# $include | string[]

$klaviyo->Coupons->getCouponCode($id, $fields_coupon_code=$fields_coupon_code, $fields_coupon=$fields_coupon, $include=$include);
```




#### [Get Coupon Code Bulk Create Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon_code_bulk_create_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_coupon_code_bulk_create_job | string[]
# $fields_coupon_code | string[]
# $include | string[]

$klaviyo->Coupons->getCouponCodeBulkCreateJob($job_id, $fields_coupon_code_bulk_create_job=$fields_coupon_code_bulk_create_job, $fields_coupon_code=$fields_coupon_code, $include=$include);
```




#### [Get Coupon Code Bulk Create Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon_code_bulk_create_jobs)

```php

## Keyword Arguments

# $fields_coupon_code_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Coupons->getCouponCodeBulkCreateJobs($fields_coupon_code_bulk_create_job=$fields_coupon_code_bulk_create_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Coupon Code Relationships Coupon](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon_code_relationships_coupon)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string

$klaviyo->Coupons->getCouponCodeRelationshipsCoupon($id, $page_cursor=$page_cursor);
```




#### [Get Coupon Codes](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon_codes)

```php

## Keyword Arguments

# $fields_coupon_code | string[]
# $fields_coupon | string[]
# $filter | string
# $include | string[]
# $page_cursor | string

$klaviyo->Coupons->getCouponCodes($fields_coupon_code=$fields_coupon_code, $fields_coupon=$fields_coupon, $filter=$filter, $include=$include, $page_cursor=$page_cursor);
```




#### [Get Coupon Codes For Coupon](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon_codes_for_coupon)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_coupon_code | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Coupons->getCouponCodesForCoupon($id, $fields_coupon_code=$fields_coupon_code, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Coupon For Coupon Code](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon_for_coupon_code)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_coupon | string[]

$klaviyo->Coupons->getCouponForCouponCode($id, $fields_coupon=$fields_coupon);
```




#### [Get Coupon Relationships Coupon Codes](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupon_relationships_coupon_codes)

```php
## Positional Arguments

# $id | string

$klaviyo->Coupons->getCouponRelationshipsCouponCodes($id);
```




#### [Get Coupons](https://developers.klaviyo.com/en/v2024-07-15/reference/get_coupons)

```php

## Keyword Arguments

# $fields_coupon | string[]
# $page_cursor | string

$klaviyo->Coupons->getCoupons($fields_coupon=$fields_coupon, $page_cursor=$page_cursor);
```




#### [Spawn Coupon Code Bulk Create Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_coupon_code_bulk_create_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Coupons->spawnCouponCodeBulkCreateJob($body);
```




#### [Update Coupon](https://developers.klaviyo.com/en/v2024-07-15/reference/update_coupon)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Coupons->updateCoupon($id, $body);
```




#### [Update Coupon Code](https://developers.klaviyo.com/en/v2024-07-15/reference/update_coupon_code)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Coupons->updateCouponCode($id, $body);
```






## DataPrivacy

#### [Request Profile Deletion](https://developers.klaviyo.com/en/v2024-07-15/reference/request_profile_deletion)

```php
## Positional Arguments

# $body | associative array

$klaviyo->DataPrivacy->requestProfileDeletion($body);
```






## Events

#### [Bulk Create Events](https://developers.klaviyo.com/en/v2024-07-15/reference/bulk_create_events)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Events->bulkCreateEvents($body);
```




#### [Create Event](https://developers.klaviyo.com/en/v2024-07-15/reference/create_event)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Events->createEvent($body);
```




#### [Get Event](https://developers.klaviyo.com/en/v2024-07-15/reference/get_event)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_event | string[]
# $fields_metric | string[]
# $fields_profile | string[]
# $include | string[]

$klaviyo->Events->getEvent($id, $fields_event=$fields_event, $fields_metric=$fields_metric, $fields_profile=$fields_profile, $include=$include);
```




#### [Get Event Metric](https://developers.klaviyo.com/en/v2024-07-15/reference/get_event_metric)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_metric | string[]

$klaviyo->Events->getEventMetric($id, $fields_metric=$fields_metric);
```




#### [Get Event Profile](https://developers.klaviyo.com/en/v2024-07-15/reference/get_event_profile)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]

$klaviyo->Events->getEventProfile($id, $additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile);
```




#### [Get Event Relationships Metric](https://developers.klaviyo.com/en/v2024-07-15/reference/get_event_relationships_metric)

```php
## Positional Arguments

# $id | string

$klaviyo->Events->getEventRelationshipsMetric($id);
```




#### [Get Event Relationships Profile](https://developers.klaviyo.com/en/v2024-07-15/reference/get_event_relationships_profile)

```php
## Positional Arguments

# $id | string

$klaviyo->Events->getEventRelationshipsProfile($id);
```




#### [Get Events](https://developers.klaviyo.com/en/v2024-07-15/reference/get_events)

```php

## Keyword Arguments

# $fields_event | string[]
# $fields_metric | string[]
# $fields_profile | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Events->getEvents($fields_event=$fields_event, $fields_metric=$fields_metric, $fields_profile=$fields_profile, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```






## Flows

#### [Delete Flow](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_flow)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->deleteFlow($id);
```




#### [Get Flow](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Flows->getFlow($id, $fields_flow_action=$fields_flow_action, $fields_flow=$fields_flow, $fields_tag=$fields_tag, $include=$include);
```




#### [Get Flow Action](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_action)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow_message | string[]
# $fields_flow | string[]
# $include | string[]

$klaviyo->Flows->getFlowAction($id, $fields_flow_action=$fields_flow_action, $fields_flow_message=$fields_flow_message, $fields_flow=$fields_flow, $include=$include);
```




#### [Get Flow For Flow Action](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_action_flow)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow | string[]

$klaviyo->Flows->getFlowActionFlow($id, $fields_flow=$fields_flow);
```




#### [Get Flow Action Messages](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_action_messages)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_message | string[]
# $filter | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowActionMessages($id, $fields_flow_message=$fields_flow_message, $filter=$filter, $page_size=$page_size, $sort=$sort);
```




#### [Get Flow Action Relationships Flow](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_action_relationships_flow)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->getFlowActionRelationshipsFlow($id);
```




#### [Get Flow Action Relationships Messages](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_action_relationships_messages)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowActionRelationshipsMessages($id, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Flow Flow Actions](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_flow_actions)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowFlowActions($id, $fields_flow_action=$fields_flow_action, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Flow Message](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_message)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow_message | string[]
# $fields_template | string[]
# $include | string[]

$klaviyo->Flows->getFlowMessage($id, $fields_flow_action=$fields_flow_action, $fields_flow_message=$fields_flow_message, $fields_template=$fields_template, $include=$include);
```




#### [Get Flow Action For Message](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_message_action)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]

$klaviyo->Flows->getFlowMessageAction($id, $fields_flow_action=$fields_flow_action);
```




#### [Get Flow Message Relationships Action](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_message_relationships_action)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->getFlowMessageRelationshipsAction($id);
```




#### [Get Flow Message Relationships Template](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_message_relationships_template)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->getFlowMessageRelationshipsTemplate($id);
```




#### [Get Flow Message Template](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_message_template)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_template | string[]

$klaviyo->Flows->getFlowMessageTemplate($id, $fields_template=$fields_template);
```




#### [Get Flow Relationships Flow Actions](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_relationships_flow_actions)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowRelationshipsFlowActions($id, $filter=$filter, $page_size=$page_size, $sort=$sort);
```




#### [Get Flow Relationships Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_relationships_tags)

```php
## Positional Arguments

# $id | string

$klaviyo->Flows->getFlowRelationshipsTags($id);
```




#### [Get Flow Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flow_tags)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Flows->getFlowTags($id, $fields_tag=$fields_tag);
```




#### [Get Flows](https://developers.klaviyo.com/en/v2024-07-15/reference/get_flows)

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

$klaviyo->Flows->getFlows($fields_flow_action=$fields_flow_action, $fields_flow=$fields_flow, $fields_tag=$fields_tag, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Update Flow Status](https://developers.klaviyo.com/en/v2024-07-15/reference/update_flow)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Flows->updateFlow($id, $body);
```






## Forms

#### [Get Form](https://developers.klaviyo.com/en/v2024-07-15/reference/get_form)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_form_version | string[]
# $fields_form | string[]
# $include | string[]

$klaviyo->Forms->getForm($id, $fields_form_version=$fields_form_version, $fields_form=$fields_form, $include=$include);
```




#### [Get Form for Form Version](https://developers.klaviyo.com/en/v2024-07-15/reference/get_form_for_form_version)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_form | string[]

$klaviyo->Forms->getFormForFormVersion($id, $fields_form=$fields_form);
```




#### [Get Form ID for Form Version](https://developers.klaviyo.com/en/v2024-07-15/reference/get_form_id_for_form_version)

```php
## Positional Arguments

# $id | string

$klaviyo->Forms->getFormIdForFormVersion($id);
```




#### [Get Form Version](https://developers.klaviyo.com/en/v2024-07-15/reference/get_form_version)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_form_version | string[]

$klaviyo->Forms->getFormVersion($id, $fields_form_version=$fields_form_version);
```




#### [Get Forms](https://developers.klaviyo.com/en/v2024-07-15/reference/get_forms)

```php

## Keyword Arguments

# $fields_form | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Forms->getForms($fields_form=$fields_form, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Version IDs for Form](https://developers.klaviyo.com/en/v2024-07-15/reference/get_version_ids_for_form)

```php
## Positional Arguments

# $id | string

$klaviyo->Forms->getVersionIdsForForm($id);
```




#### [Get Versions for Form](https://developers.klaviyo.com/en/v2024-07-15/reference/get_versions_for_form)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_form_version | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Forms->getVersionsForForm($id, $fields_form_version=$fields_form_version, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```






## Images

#### [Get Image](https://developers.klaviyo.com/en/v2024-07-15/reference/get_image)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_image | string[]

$klaviyo->Images->getImage($id, $fields_image=$fields_image);
```




#### [Get Images](https://developers.klaviyo.com/en/v2024-07-15/reference/get_images)

```php

## Keyword Arguments

# $fields_image | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Images->getImages($fields_image=$fields_image, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Update Image](https://developers.klaviyo.com/en/v2024-07-15/reference/update_image)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Images->updateImage($id, $body);
```




#### [Upload Image From File](https://developers.klaviyo.com/en/v2024-07-15/reference/upload_image_from_file)

```php
## Positional Arguments

# $file | \SplFileObject

## Keyword Arguments

# $name | string
# $hidden | bool

$klaviyo->Images->uploadImageFromFile($file, $name=$name, $hidden=$hidden);
```




#### [Upload Image From URL](https://developers.klaviyo.com/en/v2024-07-15/reference/upload_image_from_url)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Images->uploadImageFromUrl($body);
```






## Lists

#### [Create List](https://developers.klaviyo.com/en/v2024-07-15/reference/create_list)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Lists->createList($body);
```




#### [Add Profile To List](https://developers.klaviyo.com/en/v2024-07-15/reference/create_list_relationships)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->createListRelationships($id, $body);
```




#### [Delete List](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_list)

```php
## Positional Arguments

# $id | string

$klaviyo->Lists->deleteList($id);
```




#### [Remove Profile From List](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_list_relationships)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->deleteListRelationships($id, $body);
```




#### [Get List](https://developers.klaviyo.com/en/v2024-07-15/reference/get_list)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_list | string[]
# $fields_list | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Lists->getList($id, $additional_fields_list=$additional_fields_list, $fields_list=$fields_list, $fields_tag=$fields_tag, $include=$include);
```




#### [Get List Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/get_list_profiles)

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

$klaviyo->Lists->getListProfiles($id, $additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get List Relationships Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/get_list_relationships_profiles)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Lists->getListRelationshipsProfiles($id, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get List Relationships Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_list_relationships_tags)

```php
## Positional Arguments

# $id | string

$klaviyo->Lists->getListRelationshipsTags($id);
```




#### [Get List Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_list_tags)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Lists->getListTags($id, $fields_tag=$fields_tag);
```




#### [Get Lists](https://developers.klaviyo.com/en/v2024-07-15/reference/get_lists)

```php

## Keyword Arguments

# $fields_list | string[]
# $fields_tag | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Lists->getLists($fields_list=$fields_list, $fields_tag=$fields_tag, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Update List](https://developers.klaviyo.com/en/v2024-07-15/reference/update_list)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->updateList($id, $body);
```






## Metrics

#### [Get Metric](https://developers.klaviyo.com/en/v2024-07-15/reference/get_metric)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_metric | string[]

$klaviyo->Metrics->getMetric($id, $fields_metric=$fields_metric);
```




#### [Get Metrics](https://developers.klaviyo.com/en/v2024-07-15/reference/get_metrics)

```php

## Keyword Arguments

# $fields_metric | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Metrics->getMetrics($fields_metric=$fields_metric, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Query Metric Aggregates](https://developers.klaviyo.com/en/v2024-07-15/reference/query_metric_aggregates)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Metrics->queryMetricAggregates($body);
```






## Profiles

#### [Create or Update Profile](https://developers.klaviyo.com/en/v2024-07-15/reference/create_or_update_profile)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->createOrUpdateProfile($body);
```




#### [Create Profile](https://developers.klaviyo.com/en/v2024-07-15/reference/create_profile)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->createProfile($body);
```




#### [Create or Update Push Token](https://developers.klaviyo.com/en/v2024-07-15/reference/create_push_token)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->createPushToken($body);
```




#### [Get Bulk Profile Import Job](https://developers.klaviyo.com/en/v2024-07-15/reference/get_bulk_profile_import_job)

```php
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_list | string[]
# $fields_profile_bulk_import_job | string[]
# $include | string[]

$klaviyo->Profiles->getBulkProfileImportJob($job_id, $fields_list=$fields_list, $fields_profile_bulk_import_job=$fields_profile_bulk_import_job, $include=$include);
```




#### [Get Bulk Profile Import Job Errors](https://developers.klaviyo.com/en/v2024-07-15/reference/get_bulk_profile_import_job_import_errors)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_import_error | string[]
# $page_cursor | string
# $page_size | int

$klaviyo->Profiles->getBulkProfileImportJobImportErrors($id, $fields_import_error=$fields_import_error, $page_cursor=$page_cursor, $page_size=$page_size);
```




#### [Get Bulk Profile Import Job Lists](https://developers.klaviyo.com/en/v2024-07-15/reference/get_bulk_profile_import_job_lists)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_list | string[]

$klaviyo->Profiles->getBulkProfileImportJobLists($id, $fields_list=$fields_list);
```




#### [Get Bulk Profile Import Job Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/get_bulk_profile_import_job_profiles)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $page_cursor | string
# $page_size | int

$klaviyo->Profiles->getBulkProfileImportJobProfiles($id, $additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile, $page_cursor=$page_cursor, $page_size=$page_size);
```




#### [Get Bulk Profile Import Job Relationships Lists](https://developers.klaviyo.com/en/v2024-07-15/reference/get_bulk_profile_import_job_relationships_lists)

```php
## Positional Arguments

# $id | string

$klaviyo->Profiles->getBulkProfileImportJobRelationshipsLists($id);
```




#### [Get Bulk Profile Import Job Relationships Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/get_bulk_profile_import_job_relationships_profiles)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string
# $page_size | int

$klaviyo->Profiles->getBulkProfileImportJobRelationshipsProfiles($id, $page_cursor=$page_cursor, $page_size=$page_size);
```




#### [Get Bulk Profile Import Jobs](https://developers.klaviyo.com/en/v2024-07-15/reference/get_bulk_profile_import_jobs)

```php

## Keyword Arguments

# $fields_profile_bulk_import_job | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Profiles->getBulkProfileImportJobs($fields_profile_bulk_import_job=$fields_profile_bulk_import_job, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Profile](https://developers.klaviyo.com/en/v2024-07-15/reference/get_profile)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_list | string[]
# $fields_profile | string[]
# $fields_segment | string[]
# $include | string[]

$klaviyo->Profiles->getProfile($id, $additional_fields_profile=$additional_fields_profile, $fields_list=$fields_list, $fields_profile=$fields_profile, $fields_segment=$fields_segment, $include=$include);
```




#### [Get Profile Lists](https://developers.klaviyo.com/en/v2024-07-15/reference/get_profile_lists)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_list | string[]

$klaviyo->Profiles->getProfileLists($id, $fields_list=$fields_list);
```




#### [Get Profile Relationships Lists](https://developers.klaviyo.com/en/v2024-07-15/reference/get_profile_relationships_lists)

```php
## Positional Arguments

# $id | string

$klaviyo->Profiles->getProfileRelationshipsLists($id);
```




#### [Get Profile Relationships Segments](https://developers.klaviyo.com/en/v2024-07-15/reference/get_profile_relationships_segments)

```php
## Positional Arguments

# $id | string

$klaviyo->Profiles->getProfileRelationshipsSegments($id);
```




#### [Get Profile Segments](https://developers.klaviyo.com/en/v2024-07-15/reference/get_profile_segments)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_segment | string[]

$klaviyo->Profiles->getProfileSegments($id, $fields_segment=$fields_segment);
```




#### [Get Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/get_profiles)

```php

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Profiles->getProfiles($additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Merge Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/merge_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->mergeProfiles($body);
```




#### [Spawn Bulk Profile Import Job](https://developers.klaviyo.com/en/v2024-07-15/reference/spawn_bulk_profile_import_job)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->spawnBulkProfileImportJob($body);
```




#### [Subscribe Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/subscribe_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->subscribeProfiles($body);
```




#### [Suppress Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/suppress_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->suppressProfiles($body);
```




#### [Unsubscribe Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/unsubscribe_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->unsubscribeProfiles($body);
```




#### [Unsuppress Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/unsuppress_profiles)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->unsuppressProfiles($body);
```




#### [Update Profile](https://developers.klaviyo.com/en/v2024-07-15/reference/update_profile)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Profiles->updateProfile($id, $body);
```






## Reporting

#### [Query Campaign Values](https://developers.klaviyo.com/en/v2024-07-15/reference/query_campaign_values)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $page_cursor | string

$klaviyo->Reporting->queryCampaignValues($body, $page_cursor=$page_cursor);
```




#### [Query Flow Series](https://developers.klaviyo.com/en/v2024-07-15/reference/query_flow_series)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $page_cursor | string

$klaviyo->Reporting->queryFlowSeries($body, $page_cursor=$page_cursor);
```




#### [Query Flow Values](https://developers.klaviyo.com/en/v2024-07-15/reference/query_flow_values)

```php
## Positional Arguments

# $body | associative array

## Keyword Arguments

# $page_cursor | string

$klaviyo->Reporting->queryFlowValues($body, $page_cursor=$page_cursor);
```






## Segments

#### [Create Segment](https://developers.klaviyo.com/en/v2024-07-15/reference/create_segment)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Segments->createSegment($body);
```




#### [Delete Segment](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_segment)

```php
## Positional Arguments

# $id | string

$klaviyo->Segments->deleteSegment($id);
```




#### [Get Segment](https://developers.klaviyo.com/en/v2024-07-15/reference/get_segment)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_segment | string[]
# $fields_segment | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Segments->getSegment($id, $additional_fields_segment=$additional_fields_segment, $fields_segment=$fields_segment, $fields_tag=$fields_tag, $include=$include);
```




#### [Get Segment Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/get_segment_profiles)

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

$klaviyo->Segments->getSegmentProfiles($id, $additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Segment Relationships Profiles](https://developers.klaviyo.com/en/v2024-07-15/reference/get_segment_relationships_profiles)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Segments->getSegmentRelationshipsProfiles($id, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Segment Relationships Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_segment_relationships_tags)

```php
## Positional Arguments

# $id | string

$klaviyo->Segments->getSegmentRelationshipsTags($id);
```




#### [Get Segment Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_segment_tags)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Segments->getSegmentTags($id, $fields_tag=$fields_tag);
```




#### [Get Segments](https://developers.klaviyo.com/en/v2024-07-15/reference/get_segments)

```php

## Keyword Arguments

# $fields_segment | string[]
# $fields_tag | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Segments->getSegments($fields_segment=$fields_segment, $fields_tag=$fields_tag, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Update Segment](https://developers.klaviyo.com/en/v2024-07-15/reference/update_segment)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Segments->updateSegment($id, $body);
```






## Tags

#### [Create Tag](https://developers.klaviyo.com/en/v2024-07-15/reference/create_tag)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Tags->createTag($body);
```




#### [Create Tag Group](https://developers.klaviyo.com/en/v2024-07-15/reference/create_tag_group)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Tags->createTagGroup($body);
```




#### [Create Tag Relationships Campaigns](https://developers.klaviyo.com/en/v2024-07-15/reference/create_tag_relationships_campaigns)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->createTagRelationshipsCampaigns($id, $body);
```




#### [Create Tag Relationships Flows](https://developers.klaviyo.com/en/v2024-07-15/reference/create_tag_relationships_flows)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->createTagRelationshipsFlows($id, $body);
```




#### [Create Tag Relationships Lists](https://developers.klaviyo.com/en/v2024-07-15/reference/create_tag_relationships_lists)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->createTagRelationshipsLists($id, $body);
```




#### [Create Tag Relationships Segments](https://developers.klaviyo.com/en/v2024-07-15/reference/create_tag_relationships_segments)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->createTagRelationshipsSegments($id, $body);
```




#### [Delete Tag](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_tag)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->deleteTag($id);
```




#### [Delete Tag Group](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_tag_group)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->deleteTagGroup($id);
```




#### [Delete Tag Relationships Campaigns](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_tag_relationships_campaigns)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->deleteTagRelationshipsCampaigns($id, $body);
```




#### [Delete Tag Relationships Flows](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_tag_relationships_flows)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->deleteTagRelationshipsFlows($id, $body);
```




#### [Delete Tag Relationships Lists](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_tag_relationships_lists)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->deleteTagRelationshipsLists($id, $body);
```




#### [Delete Tag Relationships Segments](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_tag_relationships_segments)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->deleteTagRelationshipsSegments($id, $body);
```




#### [Get Tag](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag_group | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Tags->getTag($id, $fields_tag_group=$fields_tag_group, $fields_tag=$fields_tag, $include=$include);
```




#### [Get Tag Group](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_group)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag_group | string[]

$klaviyo->Tags->getTagGroup($id, $fields_tag_group=$fields_tag_group);
```




#### [Get Tag Group Relationships Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_group_relationships_tags)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagGroupRelationshipsTags($id);
```




#### [Get Tag Group Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_group_tags)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Tags->getTagGroupTags($id, $fields_tag=$fields_tag);
```




#### [Get Tag Groups](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_groups)

```php

## Keyword Arguments

# $fields_tag_group | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Tags->getTagGroups($fields_tag_group=$fields_tag_group, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Tag Relationships Campaigns](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_relationships_campaigns)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsCampaigns($id);
```




#### [Get Tag Relationships Flows](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_relationships_flows)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsFlows($id);
```




#### [Get Tag Relationships Lists](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_relationships_lists)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsLists($id);
```




#### [Get Tag Relationships Segments](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_relationships_segments)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsSegments($id);
```




#### [Get Tag Relationships Tag Group](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_relationships_tag_group)

```php
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsTagGroup($id);
```




#### [Get Tag Tag Group](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tag_tag_group)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag_group | string[]

$klaviyo->Tags->getTagTagGroup($id, $fields_tag_group=$fields_tag_group);
```




#### [Get Tags](https://developers.klaviyo.com/en/v2024-07-15/reference/get_tags)

```php

## Keyword Arguments

# $fields_tag_group | string[]
# $fields_tag | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Tags->getTags($fields_tag_group=$fields_tag_group, $fields_tag=$fields_tag, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Update Tag](https://developers.klaviyo.com/en/v2024-07-15/reference/update_tag)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->updateTag($id, $body);
```




#### [Update Tag Group](https://developers.klaviyo.com/en/v2024-07-15/reference/update_tag_group)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->updateTagGroup($id, $body);
```






## Templates

#### [Create Template](https://developers.klaviyo.com/en/v2024-07-15/reference/create_template)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Templates->createTemplate($body);
```




#### [Create Template Clone](https://developers.klaviyo.com/en/v2024-07-15/reference/create_template_clone)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Templates->createTemplateClone($body);
```




#### [Create Template Render](https://developers.klaviyo.com/en/v2024-07-15/reference/create_template_render)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Templates->createTemplateRender($body);
```




#### [Delete Template](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_template)

```php
## Positional Arguments

# $id | string

$klaviyo->Templates->deleteTemplate($id);
```




#### [Get Template](https://developers.klaviyo.com/en/v2024-07-15/reference/get_template)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_template | string[]

$klaviyo->Templates->getTemplate($id, $fields_template=$fields_template);
```




#### [Get Templates](https://developers.klaviyo.com/en/v2024-07-15/reference/get_templates)

```php

## Keyword Arguments

# $fields_template | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Templates->getTemplates($fields_template=$fields_template, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Update Template](https://developers.klaviyo.com/en/v2024-07-15/reference/update_template)

```php
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Templates->updateTemplate($id, $body);
```






## Webhooks

#### [Create Webhook](https://developers.klaviyo.com/en/v2024-07-15/reference/create_webhook)

```php
## Positional Arguments

# $body | associative array

$klaviyo->Webhooks->createWebhook($body);
```




#### [Delete Webhook](https://developers.klaviyo.com/en/v2024-07-15/reference/delete_webhook)

```php
## Positional Arguments

# $id | string

$klaviyo->Webhooks->deleteWebhook($id);
```




#### [Get Webhook](https://developers.klaviyo.com/en/v2024-07-15/reference/get_webhook)

```php
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_webhook | string[]
# $include | string[]

$klaviyo->Webhooks->getWebhook($id, $fields_webhook=$fields_webhook, $include=$include);
```




#### [Get Webhook Topic](https://developers.klaviyo.com/en/v2024-07-15/reference/get_webhook_topic)

```php
## Positional Arguments

# $id | string

$klaviyo->Webhooks->getWebhookTopic($id);
```




#### [Get Webhook Topics](https://developers.klaviyo.com/en/v2024-07-15/reference/get_webhook_topics)

```php

$klaviyo->Webhooks->getWebhookTopics();
```




#### [Get Webhooks](https://developers.klaviyo.com/en/v2024-07-15/reference/get_webhooks)

```php

## Keyword Arguments

# $fields_webhook | string[]
# $include | string[]

$klaviyo->Webhooks->getWebhooks($fields_webhook=$fields_webhook, $include=$include);
```




#### [Update Webhook](https://developers.klaviyo.com/en/v2024-07-15/reference/update_webhook)

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
