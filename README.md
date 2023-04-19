# Klaviyo PHP SDK

- SDK version: 3.0.0
- API Revision: 2023-02-22

## Helpful Resources

- [API Reference](https://developers.klaviyo.com/en/v2023-02-22/reference)
- [API Guides](https://developers.klaviyo.com/en/v2023-02-22/docs)
- [Postman Workspace](https://www.postman.com/klaviyo/workspace/klaviyo-developers)

## Design & Approach

This SDK is a thin wrapper around our API. See our API Reference for full documentation on behavior.

This SDK mirrors the organization and naming convention of the above language-agnostic resources, with a few namespace changes to conform to PHP idioms (details in Appendix).

## Organization

This SDK is organized into the following resources:



- Campaigns



- Catalogs



- Client



- DataPrivacy



- Events



- Flows



- Lists



- Metrics



- Profiles



- Segments



- Tags



- Templates



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
    $guzzle_options = []);

$response = $klaviyo->Metrics->getMetrics();
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
* `getReponseBody() : bytes`
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
- Organization: Resource groups and functions are listed in alphabetical order, first by Resource name, then by **OpenAPI Summary**. Operation summaries are those listed in the right side bar of the [API Reference](https://developers.klaviyo.com/en/v2023-02-22/reference/get_events). These summaries link directly to the corresponding section of the API reference.
- For example values / data types, as well as whether parameters are required/optional, please reference the corresponding API Reference link.
- Some keyword args are required for the API call to succeed, the API docs above are the source of truth regarding which keyword args are required.
- JSON payloads should be passed in as associative arrays
- A strange quirk of PHP is that default/optional arguments must be passed in in order, and MUST be included and set as `null`, at least up to the last default value you wish to use. 
  - For example, if a given function has the following optional parameters `someFunction($a=1, $b=2, $c=3)`, and you wish to only set `$b`, you MUST pass in `someFunction($a=null, $b=$YOUR_VALUE)`
  - Otherwise, if you pass in something such as `someFunction($b=$YOUR_VALUE)`, PHP will actually assign the `$YOUR_VALUE` to parameter `$a`, which is wrong.
- `$api_key` is optional, as it is set at client-level. However, you can override the client key wherever by passing in `$api_key` as the LAST optional param. Reminder: **DO NOT** use private API keys client-side / onsite.
- Paging: Where applicable, `$page_cursor` can be passed in either as a parsed string, or as the entire `self.link` response returned by paged API endpoints.

# Comprehensive list of Operations & Parameters





## Campaigns

#### [Create Campaign](https://developers.klaviyo.com/en/v2023-02-22/reference/create_campaign)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaign($body);
```




#### [Create Campaign Clone](https://developers.klaviyo.com/en/v2023-02-22/reference/create_campaign_clone)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignClone($body);
```




#### [Assign Campaign Message Template](https://developers.klaviyo.com/en/v2023-02-22/reference/create_campaign_message_assign_template)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignMessageAssignTemplate($body);
```




#### [Create Campaign Recipient Estimation Job](https://developers.klaviyo.com/en/v2023-02-22/reference/create_campaign_recipient_estimation_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignRecipientEstimationJob($body);
```




#### [Create Campaign Send Job](https://developers.klaviyo.com/en/v2023-02-22/reference/create_campaign_send_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Campaigns->createCampaignSendJob($body);
```




#### [Delete Campaign](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_campaign)

```python
## Positional Arguments

# $id | string

$klaviyo->Campaigns->deleteCampaign($id);
```




#### [Get Campaign](https://developers.klaviyo.com/en/v2023-02-22/reference/get_campaign)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign | string[]
# $fields_tag | string[]
# $include | string[]

$klaviyo->Campaigns->getCampaign($id, $fields_campaign=$fields_campaign, $fields_tag=$fields_tag, $include=$include);
```




#### [Get Campaign Message](https://developers.klaviyo.com/en/v2023-02-22/reference/get_campaign_message)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_message | string[]

$klaviyo->Campaigns->getCampaignMessage($id, $fields_campaign_message=$fields_campaign_message);
```




#### [Get Campaign Recipient Estimation](https://developers.klaviyo.com/en/v2023-02-22/reference/get_campaign_recipient_estimation)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_recipient_estimation | string[]

$klaviyo->Campaigns->getCampaignRecipientEstimation($id, $fields_campaign_recipient_estimation=$fields_campaign_recipient_estimation);
```




#### [Get Campaign Recipient Estimation Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_campaign_recipient_estimation_job)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_recipient_estimation_job | string[]

$klaviyo->Campaigns->getCampaignRecipientEstimationJob($id, $fields_campaign_recipient_estimation_job=$fields_campaign_recipient_estimation_job);
```




#### [Get Campaign Relationships Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_campaign_relationships_tags)

```python
## Positional Arguments

# $id | string

$klaviyo->Campaigns->getCampaignRelationshipsTags($id);
```




#### [Get Campaign Send Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_campaign_send_job)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_campaign_send_job | string[]

$klaviyo->Campaigns->getCampaignSendJob($id, $fields_campaign_send_job=$fields_campaign_send_job);
```




#### [Get Campaign Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_campaign_tags)

```python
## Positional Arguments

# $campaign_id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Campaigns->getCampaignTags($campaign_id, $fields_tag=$fields_tag);
```




#### [Get Campaigns](https://developers.klaviyo.com/en/v2023-02-22/reference/get_campaigns)

```python

## Keyword Arguments

# $fields_campaign | string[]
# $fields_tag | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Campaigns->getCampaigns($fields_campaign=$fields_campaign, $fields_tag=$fields_tag, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Update Campaign](https://developers.klaviyo.com/en/v2023-02-22/reference/update_campaign)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateCampaign($id, $body);
```




#### [Update Campaign Message](https://developers.klaviyo.com/en/v2023-02-22/reference/update_campaign_message)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateCampaignMessage($id, $body);
```




#### [Update Campaign Send Job](https://developers.klaviyo.com/en/v2023-02-22/reference/update_campaign_send_job)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Campaigns->updateCampaignSendJob($id, $body);
```






## Catalogs

#### [Create Catalog Category](https://developers.klaviyo.com/en/v2023-02-22/reference/create_catalog_category)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogCategory($body);
```




#### [Create Catalog Category Relationships Items](https://developers.klaviyo.com/en/v2023-02-22/reference/create_catalog_category_relationships_items)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->createCatalogCategoryRelationshipsItems($id, $body);
```




#### [Create Catalog Item](https://developers.klaviyo.com/en/v2023-02-22/reference/create_catalog_item)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogItem($body);
```




#### [Create Catalog Item Relationships Categories](https://developers.klaviyo.com/en/v2023-02-22/reference/create_catalog_item_relationships_categories)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->createCatalogItemRelationshipsCategories($id, $body);
```




#### [Create Catalog Variant](https://developers.klaviyo.com/en/v2023-02-22/reference/create_catalog_variant)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->createCatalogVariant($body);
```




#### [Delete Catalog Category](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_catalog_category)

```python
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogCategory($id);
```




#### [Delete Catalog Category Relationships Items](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_catalog_category_relationships_items)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->deleteCatalogCategoryRelationshipsItems($id, $body);
```




#### [Delete Catalog Item](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_catalog_item)

```python
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogItem($id);
```




#### [Delete Catalog Item Relationships Categories](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_catalog_item_relationships_categories)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->deleteCatalogItemRelationshipsCategories($id, $body);
```




#### [Delete Catalog Variant](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_catalog_variant)

```python
## Positional Arguments

# $id | string

$klaviyo->Catalogs->deleteCatalogVariant($id);
```




#### [Get Catalog Categories](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_categories)

```python

## Keyword Arguments

# $fields_catalog_category | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogCategories($fields_catalog_category=$fields_catalog_category, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Category](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_category)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_category | string[]

$klaviyo->Catalogs->getCatalogCategory($id, $fields_catalog_category=$fields_catalog_category);
```




#### [Get Catalog Category Items](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_category_items)

```python
## Positional Arguments

# $category_id | string

## Keyword Arguments

# $fields_catalog_item | string[]
# $fields_catalog_variant | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogCategoryItems($category_id, $fields_catalog_item=$fields_catalog_item, $fields_catalog_variant=$fields_catalog_variant, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Category Relationships Items](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_category_relationships_items)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string

$klaviyo->Catalogs->getCatalogCategoryRelationshipsItems($id, $page_cursor=$page_cursor);
```




#### [Get Catalog Item](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_item)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_item | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getCatalogItem($id, $fields_catalog_item=$fields_catalog_item, $fields_catalog_variant=$fields_catalog_variant, $include=$include);
```




#### [Get Catalog Item Categories](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_item_categories)

```python
## Positional Arguments

# $item_id | string

## Keyword Arguments

# $fields_catalog_category | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogItemCategories($item_id, $fields_catalog_category=$fields_catalog_category, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Item Relationships Categories](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_item_relationships_categories)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string

$klaviyo->Catalogs->getCatalogItemRelationshipsCategories($id, $page_cursor=$page_cursor);
```




#### [Get Catalog Item Variants](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_item_variants)

```python
## Positional Arguments

# $item_id | string

## Keyword Arguments

# $fields_catalog_variant | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogItemVariants($item_id, $fields_catalog_variant=$fields_catalog_variant, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Items](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_items)

```python

## Keyword Arguments

# $fields_catalog_item | string[]
# $fields_catalog_variant | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogItems($fields_catalog_item=$fields_catalog_item, $fields_catalog_variant=$fields_catalog_variant, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Catalog Variant](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_variant)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_catalog_variant | string[]

$klaviyo->Catalogs->getCatalogVariant($id, $fields_catalog_variant=$fields_catalog_variant);
```




#### [Get Catalog Variants](https://developers.klaviyo.com/en/v2023-02-22/reference/get_catalog_variants)

```python

## Keyword Arguments

# $fields_catalog_variant | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Catalogs->getCatalogVariants($fields_catalog_variant=$fields_catalog_variant, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Create Categories Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_create_categories_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_create_job | string[]
# $fields_catalog_category | string[]
# $include | string[]

$klaviyo->Catalogs->getCreateCategoriesJob($job_id, $fields_catalog_category_bulk_create_job=$fields_catalog_category_bulk_create_job, $fields_catalog_category=$fields_catalog_category, $include=$include);
```




#### [Get Create Categories Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_create_categories_jobs)

```python

## Keyword Arguments

# $fields_catalog_category_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getCreateCategoriesJobs($fields_catalog_category_bulk_create_job=$fields_catalog_category_bulk_create_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Create Items Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_create_items_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_create_job | string[]
# $fields_catalog_item | string[]
# $include | string[]

$klaviyo->Catalogs->getCreateItemsJob($job_id, $fields_catalog_item_bulk_create_job=$fields_catalog_item_bulk_create_job, $fields_catalog_item=$fields_catalog_item, $include=$include);
```




#### [Get Create Items Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_create_items_jobs)

```python

## Keyword Arguments

# $fields_catalog_item_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getCreateItemsJobs($fields_catalog_item_bulk_create_job=$fields_catalog_item_bulk_create_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Create Variants Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_create_variants_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_create_job | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getCreateVariantsJob($job_id, $fields_catalog_variant_bulk_create_job=$fields_catalog_variant_bulk_create_job, $fields_catalog_variant=$fields_catalog_variant, $include=$include);
```




#### [Get Create Variants Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_create_variants_jobs)

```python

## Keyword Arguments

# $fields_catalog_variant_bulk_create_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getCreateVariantsJobs($fields_catalog_variant_bulk_create_job=$fields_catalog_variant_bulk_create_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Delete Categories Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_delete_categories_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_delete_job | string[]

$klaviyo->Catalogs->getDeleteCategoriesJob($job_id, $fields_catalog_category_bulk_delete_job=$fields_catalog_category_bulk_delete_job);
```




#### [Get Delete Categories Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_delete_categories_jobs)

```python

## Keyword Arguments

# $fields_catalog_category_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getDeleteCategoriesJobs($fields_catalog_category_bulk_delete_job=$fields_catalog_category_bulk_delete_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Delete Items Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_delete_items_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_delete_job | string[]

$klaviyo->Catalogs->getDeleteItemsJob($job_id, $fields_catalog_item_bulk_delete_job=$fields_catalog_item_bulk_delete_job);
```




#### [Get Delete Items Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_delete_items_jobs)

```python

## Keyword Arguments

# $fields_catalog_item_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getDeleteItemsJobs($fields_catalog_item_bulk_delete_job=$fields_catalog_item_bulk_delete_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Delete Variants Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_delete_variants_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_delete_job | string[]

$klaviyo->Catalogs->getDeleteVariantsJob($job_id, $fields_catalog_variant_bulk_delete_job=$fields_catalog_variant_bulk_delete_job);
```




#### [Get Delete Variants Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_delete_variants_jobs)

```python

## Keyword Arguments

# $fields_catalog_variant_bulk_delete_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getDeleteVariantsJobs($fields_catalog_variant_bulk_delete_job=$fields_catalog_variant_bulk_delete_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Update Categories Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_update_categories_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_category_bulk_update_job | string[]
# $fields_catalog_category | string[]
# $include | string[]

$klaviyo->Catalogs->getUpdateCategoriesJob($job_id, $fields_catalog_category_bulk_update_job=$fields_catalog_category_bulk_update_job, $fields_catalog_category=$fields_catalog_category, $include=$include);
```




#### [Get Update Categories Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_update_categories_jobs)

```python

## Keyword Arguments

# $fields_catalog_category_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getUpdateCategoriesJobs($fields_catalog_category_bulk_update_job=$fields_catalog_category_bulk_update_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Update Items Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_update_items_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_item_bulk_update_job | string[]
# $fields_catalog_item | string[]
# $include | string[]

$klaviyo->Catalogs->getUpdateItemsJob($job_id, $fields_catalog_item_bulk_update_job=$fields_catalog_item_bulk_update_job, $fields_catalog_item=$fields_catalog_item, $include=$include);
```




#### [Get Update Items Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_update_items_jobs)

```python

## Keyword Arguments

# $fields_catalog_item_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getUpdateItemsJobs($fields_catalog_item_bulk_update_job=$fields_catalog_item_bulk_update_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Get Update Variants Job](https://developers.klaviyo.com/en/v2023-02-22/reference/get_update_variants_job)

```python
## Positional Arguments

# $job_id | string

## Keyword Arguments

# $fields_catalog_variant_bulk_update_job | string[]
# $fields_catalog_variant | string[]
# $include | string[]

$klaviyo->Catalogs->getUpdateVariantsJob($job_id, $fields_catalog_variant_bulk_update_job=$fields_catalog_variant_bulk_update_job, $fields_catalog_variant=$fields_catalog_variant, $include=$include);
```




#### [Get Update Variants Jobs](https://developers.klaviyo.com/en/v2023-02-22/reference/get_update_variants_jobs)

```python

## Keyword Arguments

# $fields_catalog_variant_bulk_update_job | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Catalogs->getUpdateVariantsJobs($fields_catalog_variant_bulk_update_job=$fields_catalog_variant_bulk_update_job, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Spawn Create Categories Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_create_categories_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnCreateCategoriesJob($body);
```




#### [Spawn Create Items Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_create_items_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnCreateItemsJob($body);
```




#### [Spawn Create Variants Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_create_variants_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnCreateVariantsJob($body);
```




#### [Spawn Delete Categories Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_delete_categories_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnDeleteCategoriesJob($body);
```




#### [Spawn Delete Items Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_delete_items_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnDeleteItemsJob($body);
```




#### [Spawn Delete Variants Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_delete_variants_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnDeleteVariantsJob($body);
```




#### [Spawn Update Categories Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_update_categories_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnUpdateCategoriesJob($body);
```




#### [Spawn Update Items Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_update_items_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnUpdateItemsJob($body);
```




#### [Spawn Update Variants Job](https://developers.klaviyo.com/en/v2023-02-22/reference/spawn_update_variants_job)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Catalogs->spawnUpdateVariantsJob($body);
```




#### [Update Catalog Category](https://developers.klaviyo.com/en/v2023-02-22/reference/update_catalog_category)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogCategory($id, $body);
```




#### [Update Catalog Category Relationships Items](https://developers.klaviyo.com/en/v2023-02-22/reference/update_catalog_category_relationships_items)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogCategoryRelationshipsItems($id, $body);
```




#### [Update Catalog Item](https://developers.klaviyo.com/en/v2023-02-22/reference/update_catalog_item)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogItem($id, $body);
```




#### [Update Catalog Item Relationships Categories](https://developers.klaviyo.com/en/v2023-02-22/reference/update_catalog_item_relationships_categories)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogItemRelationshipsCategories($id, $body);
```




#### [Update Catalog Variant](https://developers.klaviyo.com/en/v2023-02-22/reference/update_catalog_variant)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Catalogs->updateCatalogVariant($id, $body);
```






## Client

#### [Create Client Event](https://developers.klaviyo.com/en/v2023-02-22/reference/create_client_event)

```python
## Positional Arguments

# $company_id | string
# $body | associative array

$klaviyo->Client->createClientEvent($company_id, $body);
```




#### [Create or Update Client Profile](https://developers.klaviyo.com/en/v2023-02-22/reference/create_client_profile)

```python
## Positional Arguments

# $company_id | string
# $body | associative array

$klaviyo->Client->createClientProfile($company_id, $body);
```




#### [Create Client Subscription](https://developers.klaviyo.com/en/v2023-02-22/reference/create_client_subscription)

```python
## Positional Arguments

# $company_id | string
# $body | associative array

$klaviyo->Client->createClientSubscription($company_id, $body);
```






## DataPrivacy

#### [Request Profile Deletion](https://developers.klaviyo.com/en/v2023-02-22/reference/request_profile_deletion)

```python
## Positional Arguments

# $body | associative array

$klaviyo->DataPrivacy->requestProfileDeletion($body);
```






## Events

#### [Create Event](https://developers.klaviyo.com/en/v2023-02-22/reference/create_event)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Events->createEvent($body);
```




#### [Get Event](https://developers.klaviyo.com/en/v2023-02-22/reference/get_event)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_event | string[]
# $fields_metric | string[]
# $fields_profile | string[]
# $include | string[]

$klaviyo->Events->getEvent($id, $fields_event=$fields_event, $fields_metric=$fields_metric, $fields_profile=$fields_profile, $include=$include);
```




#### [Get Event Metrics](https://developers.klaviyo.com/en/v2023-02-22/reference/get_event_metrics)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_metric | string[]

$klaviyo->Events->getEventMetrics($id, $fields_metric=$fields_metric);
```




#### [Get Event Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/get_event_profiles)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]

$klaviyo->Events->getEventProfiles($id, $additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile);
```




#### [Get Event Relationships Metrics](https://developers.klaviyo.com/en/v2023-02-22/reference/get_event_relationships_metrics)

```python
## Positional Arguments

# $id | string

$klaviyo->Events->getEventRelationshipsMetrics($id);
```




#### [Get Event Relationships Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/get_event_relationships_profiles)

```python
## Positional Arguments

# $id | string

$klaviyo->Events->getEventRelationshipsProfiles($id);
```




#### [Get Events](https://developers.klaviyo.com/en/v2023-02-22/reference/get_events)

```python

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

#### [Get Flow](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow | string[]
# $include | string[]

$klaviyo->Flows->getFlow($id, $fields_flow_action=$fields_flow_action, $fields_flow=$fields_flow, $include=$include);
```




#### [Get Flow Action](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_action)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow_message | string[]
# $fields_flow | string[]
# $include | string[]

$klaviyo->Flows->getFlowAction($id, $fields_flow_action=$fields_flow_action, $fields_flow_message=$fields_flow_message, $fields_flow=$fields_flow, $include=$include);
```




#### [Get Flow For Flow Action](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_action_flow)

```python
## Positional Arguments

# $action_id | string

## Keyword Arguments

# $fields_flow | string[]

$klaviyo->Flows->getFlowActionFlow($action_id, $fields_flow=$fields_flow);
```




#### [Get Messages For Flow Action](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_action_messages)

```python
## Positional Arguments

# $action_id | string

## Keyword Arguments

# $fields_flow_message | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowActionMessages($action_id, $fields_flow_message=$fields_flow_message, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Flow Action Relationships Flow](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_action_relationships_flow)

```python
## Positional Arguments

# $id | string

$klaviyo->Flows->getFlowActionRelationshipsFlow($id);
```




#### [Get Flow Action Relationships Messages](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_action_relationships_messages)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowActionRelationshipsMessages($id, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Flow Actions For Flow](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_flow_actions)

```python
## Positional Arguments

# $flow_id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowFlowActions($flow_id, $fields_flow_action=$fields_flow_action, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Get Flow Message](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_message)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow_message | string[]
# $include | string[]

$klaviyo->Flows->getFlowMessage($id, $fields_flow_action=$fields_flow_action, $fields_flow_message=$fields_flow_message, $include=$include);
```




#### [Get Flow Action For Message](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_message_action)

```python
## Positional Arguments

# $message_id | string

## Keyword Arguments

# $fields_flow_action | string[]

$klaviyo->Flows->getFlowMessageAction($message_id, $fields_flow_action=$fields_flow_action);
```




#### [Get Flow Message Relationships Action](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_message_relationships_action)

```python
## Positional Arguments

# $id | string

$klaviyo->Flows->getFlowMessageRelationshipsAction($id);
```




#### [Get Flow Relationships Flow Actions](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_relationships_flow_actions)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $filter | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlowRelationshipsFlowActions($id, $filter=$filter, $page_size=$page_size, $sort=$sort);
```




#### [Get Flow Relationships Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_relationships_tags)

```python
## Positional Arguments

# $id | string

$klaviyo->Flows->getFlowRelationshipsTags($id);
```




#### [Get Flow Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flow_tags)

```python
## Positional Arguments

# $flow_id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Flows->getFlowTags($flow_id, $fields_tag=$fields_tag);
```




#### [Get Flows](https://developers.klaviyo.com/en/v2023-02-22/reference/get_flows)

```python

## Keyword Arguments

# $fields_flow_action | string[]
# $fields_flow | string[]
# $filter | string
# $include | string[]
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Flows->getFlows($fields_flow_action=$fields_flow_action, $fields_flow=$fields_flow, $filter=$filter, $include=$include, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Update Flow Status](https://developers.klaviyo.com/en/v2023-02-22/reference/update_flow)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Flows->updateFlow($id, $body);
```






## Lists

#### [Create List](https://developers.klaviyo.com/en/v2023-02-22/reference/create_list)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Lists->createList($body);
```




#### [Add Profile To List](https://developers.klaviyo.com/en/v2023-02-22/reference/create_list_relationships)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->createListRelationships($id, $body);
```




#### [Delete List](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_list)

```python
## Positional Arguments

# $id | string

$klaviyo->Lists->deleteList($id);
```




#### [Remove Profile From List](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_list_relationships)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->deleteListRelationships($id, $body);
```




#### [Get List](https://developers.klaviyo.com/en/v2023-02-22/reference/get_list)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_list | string[]

$klaviyo->Lists->getList($id, $fields_list=$fields_list);
```




#### [Get List Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/get_list_profiles)

```python
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $filter | string
# $page_cursor | string
# $page_size | int

$klaviyo->Lists->getListProfiles($list_id, $additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size);
```




#### [Get List Relationships Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/get_list_relationships_profiles)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string

$klaviyo->Lists->getListRelationshipsProfiles($id, $page_cursor=$page_cursor);
```




#### [Get List Relationships Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_list_relationships_tags)

```python
## Positional Arguments

# $id | string

$klaviyo->Lists->getListRelationshipsTags($id);
```




#### [Get List Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_list_tags)

```python
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Lists->getListTags($list_id, $fields_tag=$fields_tag);
```




#### [Get Lists](https://developers.klaviyo.com/en/v2023-02-22/reference/get_lists)

```python

## Keyword Arguments

# $fields_list | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Lists->getLists($fields_list=$fields_list, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Update List](https://developers.klaviyo.com/en/v2023-02-22/reference/update_list)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Lists->updateList($id, $body);
```






## Metrics

#### [Get Metric](https://developers.klaviyo.com/en/v2023-02-22/reference/get_metric)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_metric | string[]

$klaviyo->Metrics->getMetric($id, $fields_metric=$fields_metric);
```




#### [Get Metrics](https://developers.klaviyo.com/en/v2023-02-22/reference/get_metrics)

```python

## Keyword Arguments

# $fields_metric | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Metrics->getMetrics($fields_metric=$fields_metric, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Query Metric Aggregates](https://developers.klaviyo.com/en/v2023-02-22/reference/query_metric_aggregates)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Metrics->queryMetricAggregates($body);
```






## Profiles

#### [Create Profile](https://developers.klaviyo.com/en/v2023-02-22/reference/create_profile)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->createProfile($body);
```




#### [Get Profile](https://developers.klaviyo.com/en/v2023-02-22/reference/get_profile)

```python
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




#### [Get Profile Lists](https://developers.klaviyo.com/en/v2023-02-22/reference/get_profile_lists)

```python
## Positional Arguments

# $profile_id | string

## Keyword Arguments

# $fields_list | string[]

$klaviyo->Profiles->getProfileLists($profile_id, $fields_list=$fields_list);
```




#### [Get Profile Relationships Lists](https://developers.klaviyo.com/en/v2023-02-22/reference/get_profile_relationships_lists)

```python
## Positional Arguments

# $id | string

$klaviyo->Profiles->getProfileRelationshipsLists($id);
```




#### [Get Profile Relationships Segments](https://developers.klaviyo.com/en/v2023-02-22/reference/get_profile_relationships_segments)

```python
## Positional Arguments

# $id | string

$klaviyo->Profiles->getProfileRelationshipsSegments($id);
```




#### [Get Profile Segments](https://developers.klaviyo.com/en/v2023-02-22/reference/get_profile_segments)

```python
## Positional Arguments

# $profile_id | string

## Keyword Arguments

# $fields_segment | string[]

$klaviyo->Profiles->getProfileSegments($profile_id, $fields_segment=$fields_segment);
```




#### [Get Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/get_profiles)

```python

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $filter | string
# $page_cursor | string
# $page_size | int
# $sort | string

$klaviyo->Profiles->getProfiles($additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size, $sort=$sort);
```




#### [Subscribe Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/subscribe_profiles)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->subscribeProfiles($body);
```




#### [Suppress Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/suppress_profiles)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->suppressProfiles($body);
```




#### [Unsubscribe Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/unsubscribe_profiles)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->unsubscribeProfiles($body);
```




#### [Unsuppress Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/unsuppress_profiles)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Profiles->unsuppressProfiles($body);
```




#### [Update Profile](https://developers.klaviyo.com/en/v2023-02-22/reference/update_profile)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Profiles->updateProfile($id, $body);
```






## Segments

#### [Get Segment](https://developers.klaviyo.com/en/v2023-02-22/reference/get_segment)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_segment | string[]

$klaviyo->Segments->getSegment($id, $fields_segment=$fields_segment);
```




#### [Get Segment Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/get_segment_profiles)

```python
## Positional Arguments

# $segment_id | string

## Keyword Arguments

# $additional_fields_profile | string[]
# $fields_profile | string[]
# $filter | string
# $page_cursor | string
# $page_size | int

$klaviyo->Segments->getSegmentProfiles($segment_id, $additional_fields_profile=$additional_fields_profile, $fields_profile=$fields_profile, $filter=$filter, $page_cursor=$page_cursor, $page_size=$page_size);
```




#### [Get Segment Relationships Profiles](https://developers.klaviyo.com/en/v2023-02-22/reference/get_segment_relationships_profiles)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $page_cursor | string

$klaviyo->Segments->getSegmentRelationshipsProfiles($id, $page_cursor=$page_cursor);
```




#### [Get Segment Relationships Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_segment_relationships_tags)

```python
## Positional Arguments

# $id | string

$klaviyo->Segments->getSegmentRelationshipsTags($id);
```




#### [Get Segment Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_segment_tags)

```python
## Positional Arguments

# $segment_id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Segments->getSegmentTags($segment_id, $fields_tag=$fields_tag);
```




#### [Get Segments](https://developers.klaviyo.com/en/v2023-02-22/reference/get_segments)

```python

## Keyword Arguments

# $fields_segment | string[]
# $filter | string
# $page_cursor | string

$klaviyo->Segments->getSegments($fields_segment=$fields_segment, $filter=$filter, $page_cursor=$page_cursor);
```




#### [Update Segment](https://developers.klaviyo.com/en/v2023-02-22/reference/update_segment)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Segments->updateSegment($id, $body);
```






## Tags

#### [Create Tag](https://developers.klaviyo.com/en/v2023-02-22/reference/create_tag)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Tags->createTag($body);
```




#### [Create Tag Group](https://developers.klaviyo.com/en/v2023-02-22/reference/create_tag_group)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Tags->createTagGroup($body);
```




#### [Create Tag Relationships Campaigns](https://developers.klaviyo.com/en/v2023-02-22/reference/create_tag_relationships_campaigns)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->createTagRelationshipsCampaigns($id, $body);
```




#### [Create Tag Relationships Flows](https://developers.klaviyo.com/en/v2023-02-22/reference/create_tag_relationships_flows)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->createTagRelationshipsFlows($id, $body);
```




#### [Create Tag Relationships Lists](https://developers.klaviyo.com/en/v2023-02-22/reference/create_tag_relationships_lists)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->createTagRelationshipsLists($id, $body);
```




#### [Create Tag Relationships Segments](https://developers.klaviyo.com/en/v2023-02-22/reference/create_tag_relationships_segments)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->createTagRelationshipsSegments($id, $body);
```




#### [Delete Tag](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_tag)

```python
## Positional Arguments

# $id | string

$klaviyo->Tags->deleteTag($id);
```




#### [Delete Tag Group](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_tag_group)

```python
## Positional Arguments

# $id | string

$klaviyo->Tags->deleteTagGroup($id);
```




#### [Delete Tag Relationships Campaigns](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_tag_relationships_campaigns)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->deleteTagRelationshipsCampaigns($id, $body);
```




#### [Delete Tag Relationships Flows](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_tag_relationships_flows)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->deleteTagRelationshipsFlows($id, $body);
```




#### [Delete Tag Relationships Lists](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_tag_relationships_lists)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->deleteTagRelationshipsLists($id, $body);
```




#### [Delete Tag Relationships Segments](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_tag_relationships_segments)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->deleteTagRelationshipsSegments($id, $body);
```




#### [Get Tag](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Tags->getTag($id, $fields_tag=$fields_tag);
```




#### [Get Tag Group](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_group)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag_group | string[]

$klaviyo->Tags->getTagGroup($id, $fields_tag_group=$fields_tag_group);
```




#### [Get Tag Group Relationships Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_group_relationships_tags)

```python
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagGroupRelationshipsTags($id);
```




#### [Get Tag Group Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_group_tags)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag | string[]

$klaviyo->Tags->getTagGroupTags($id, $fields_tag=$fields_tag);
```




#### [Get Tag Groups](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_groups)

```python

## Keyword Arguments

# $fields_tag_group | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Tags->getTagGroups($fields_tag_group=$fields_tag_group, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Get Tag Relationships Campaigns](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_relationships_campaigns)

```python
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsCampaigns($id);
```




#### [Get Tag Relationships Flows](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_relationships_flows)

```python
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsFlows($id);
```




#### [Get Tag Relationships Lists](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_relationships_lists)

```python
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsLists($id);
```




#### [Get Tag Relationships Segments](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_relationships_segments)

```python
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsSegments($id);
```




#### [Get Tag Relationships Tag Group](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_relationships_tag_group)

```python
## Positional Arguments

# $id | string

$klaviyo->Tags->getTagRelationshipsTagGroup($id);
```




#### [Get Tag Tag Group](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tag_tag_group)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_tag_group | string[]

$klaviyo->Tags->getTagTagGroup($id, $fields_tag_group=$fields_tag_group);
```




#### [Get Tags](https://developers.klaviyo.com/en/v2023-02-22/reference/get_tags)

```python

## Keyword Arguments

# $fields_tag | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Tags->getTags($fields_tag=$fields_tag, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Update Tag](https://developers.klaviyo.com/en/v2023-02-22/reference/update_tag)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->updateTag($id, $body);
```




#### [Update Tag Group](https://developers.klaviyo.com/en/v2023-02-22/reference/update_tag_group)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Tags->updateTagGroup($id, $body);
```






## Templates

#### [Create Template](https://developers.klaviyo.com/en/v2023-02-22/reference/create_template)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Templates->createTemplate($body);
```




#### [Create Template Clone](https://developers.klaviyo.com/en/v2023-02-22/reference/create_template_clone)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Templates->createTemplateClone($body);
```




#### [Create Template Render](https://developers.klaviyo.com/en/v2023-02-22/reference/create_template_render)

```python
## Positional Arguments

# $body | associative array

$klaviyo->Templates->createTemplateRender($body);
```




#### [Delete Template](https://developers.klaviyo.com/en/v2023-02-22/reference/delete_template)

```python
## Positional Arguments

# $id | string

$klaviyo->Templates->deleteTemplate($id);
```




#### [Get Template](https://developers.klaviyo.com/en/v2023-02-22/reference/get_template)

```python
## Positional Arguments

# $id | string

## Keyword Arguments

# $fields_template | string[]

$klaviyo->Templates->getTemplate($id, $fields_template=$fields_template);
```




#### [Get Templates](https://developers.klaviyo.com/en/v2023-02-22/reference/get_templates)

```python

## Keyword Arguments

# $fields_template | string[]
# $filter | string
# $page_cursor | string
# $sort | string

$klaviyo->Templates->getTemplates($fields_template=$fields_template, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort);
```




#### [Update Template](https://developers.klaviyo.com/en/v2023-02-22/reference/update_template)

```python
## Positional Arguments

# $id | string
# $body | associative array

$klaviyo->Templates->updateTemplate($id, $body);
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
