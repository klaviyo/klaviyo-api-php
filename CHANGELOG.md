# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

NOTE: For more granular API-specific changes, please see our [API Changelog](https://developers.klaviyo.com/en/docs/changelog_)



## [5.0.0] - revision 2023-07-15
### Added
- Back-In-stock APIs
  - We have added support for subscribing profiles to back-in-stock notifications, for both email and SMS, using the new [createBackInStockSubscription](./README.md#create-back-in-stock-subscription) endpoint.  
- New functionality to Campaigns API
  - CRUD support for SMS campaigns is now available
  - You can now also retrieve all messages for a campaign to determine performance data on campaigns where you're running A/B tests
    - To support this functionality, we introduced a relationship between [campaigns and campaign messages](./README.md#get-campaign-relationships-campaign-messages), and between [campaign messages and templates](./README.md#get-campaign-message-relationships-template)


### Changed
- Relationship Standardization
  - We are making a number of changes across endpoints to standardize how we handle [relationships](https://developers.klaviyo.com/en/docs/relationships_) in our APIs and leverage consistently typed objects across endpoints. For example, you can create a profile in our APIs in the same shape, regardless of whether you're calling the profiles endpoint or the events endpoint.
  - The changes include:
    - Updating 1:1 relationships to use singular tense and return an object (instead of plural and return an array) 
      - example: for [getFlowAction](./README.md#get-flow-action), if you want to use the `include` param, you would set `include=` to `"flow"` (instead of `"flows"`); the response will be an object (previously an array)
    - Moving related object IDs from the attributes payload to relationships
      - example: The format for the [body](https://developers.klaviyo.com/en/reference/create_tag) of [create_tag](./README.md#create-tag) has changed, with `tag_group_id` previously at `data.attributes.tag_group_id` being removed and replaced by a `data` object containing `type`+`id` and located at `data.relationships.tag-group.data`.
    - Specifying a relationship between two Klaviyo objects to allow for improved consistency and greater interoperability across endpoints 
      - example: for [createEvent](./README.md#create-event), you can now create/update a profile for an event in the same way you would when using the profiles API directly
  - NOTE: The examples for the above relationship changes are illustrative, not comprehensive. For a complete list of ALL the endpoints that have changed and exactly how, please refer to our latest [API Changelog](https://developers.klaviyo.com/en/docs/changelog_#revision-2023-07-15)
- For [getCampaigns](./README.md#get-campaigns) endpoint, `filter` param is now required, to, at minimum, filter on `messages.channel`

### Removed
- We removed the `company_id` from the response for [getTemplate](./README.md#get-template) and [getTemplates](./README.md#get-templates). If you need to obtain the company ID / public API key for an account, please use the [Accounts API](./README.md#accounts).

## [4.0.0] - revision 2023-06-15
### Added
- Accounts API is now available, this will allow you to access information about the Klaviyo account associated with your API key.
  - `getAccounts`
  - `getAccount`
  
**Note:** You will need to generate a new API key with either the `Accounts` scope enabled or `Full Access` to use these endpoints.

### Removed
- All `client` endpoints
  - `createClientEvent`
  - `createClientProfile`
  - `createClientSubscription`
## [2.0.0] - 2023-04-19

### Changed
- Fixed order of params, and added `page_size`, so some calls may need to be updated.

## [2.0.0] - 2023-04-06
### Changed
- Relationship endpoints that were previously grouped together are now split into related-resource-specific endpoints. This means that all relationship endpoints have new function names.
- Profiles API can now return predictive analytics when calling `getProfile` and `getProfiles`, by passing in `$additional_fields_profile=["predictive_analytics"]`.

### Migration Guide
- To migrate to this latest version, all calls to relationship endpoints need to be updated, as in the following example:
  - `getCampaignRelationships($id, "tags")` will become `getCampaignRelationshipsTags($id)`.
- Because PHP is sensitive to the ordering of optional args, this is a breaking change to all `getProfile` and `getProfiles` calls that use optional args. Please refer to `getProfile` and `getProfiles` in the README for more details on ordering.
  - Specifically, because params are passed in alphabetical order, even if you do not intend to use this new param, you will need to shift over the params by one by passing in `$additional_fields_profile=NULL`.

## [1.3.0] - 2023-03-01
### Added
- Added `page_size` support for paging through endpoints that return profiles.

## [1.2.1] - 2023-02-23
### Fixed
- Fixed a bug that caused paging through events to periodically fail.

## [1.2.0] - 2023-02-23
### Added
- Added support for Campaigns (which were previously in our Beta API/SDKs).

### Changed
- Pagination for Flows changed from page offset to cursor.

## [1.1.0] - 2023-01-25
### Added
- Added the following endpoints (which were previously in our Beta API/SDKs):
  - Data Privacy
  - All Tags endpoints, as well as the following related resource-specific endpoints:
    - Get Flow Tags
    - Get List Tags
    - Get Segment Tags

## [1.0.0] - 2023-10-19
### Added
- Initial release

### Changed
- Naming changes:
  - Packagist package name: `klaviyo/sdk-beta` → `klaviyo/api`
  - Namespace: `KlaviyoBeta` → `KlaviyoAPI`
  - client name: `Client` → `KlaviyoAPI`
  - Client variable name in readme examples: `$client` → `$klaviyo`
  - Some functions have changed name
- Parameter ordering: The order of params has changed; you will need to update these for your existing implementation to work