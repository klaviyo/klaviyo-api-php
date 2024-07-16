# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

NOTE: For more granular API-specific changes, please see our [API Changelog](https://developers.klaviyo.com/en/docs/changelog_)

## [9.0.1] - revision 2024-07-15

### Added

 - Forms API
  - New `klaviyo->Forms` object with methods to get forms, form versions and relationships
 - Webhooks API
  - new `klaviyo->Webooks` class containing CRUD operations for webhooks

### Changed
 - `Profiles->subscribe()`
  - added `historical_import` flag for importing historically consented profiles can now be optionally supplied in the payload for the Subscribe Profiles endpoint.
  - When using this flag, a consented_at date must be provided and must be in the past.

## [8.1.0] - revision 2024-06-15

### Added
  - Segments Api
    - New create segment endpoint `$klaviyo->Segments->createSegment()`.
    - New delete segment endpoint `$klaviyo->Segments->deleteSegment()`.
    - Updated exisiting segments endpoints to include the segment definition
    - For more information, see our [Segments API overview](https://developers.klaviyo.com/en/reference/segments_api_overview).

  - Flows Api
    - New delete flows endpoint `$klaviyo->Flows->deleteFlow()`
   
## [8.0.0] - revision 2024-05-15

### Added

  - Bulk Create Events API with 
	- We have added support for creating events in bulk via the `$klaviyo->Events->bulkCreateEvents` method
- Create multiple events for new and existing profiles and/or update profile properties in a single API call. For more information, see our [Events API overview](https://developers.klaviyo.com/en/reference/events_api_overview).

### Changed

  - Accounts Api
	- `$klaviyo->Accounts->getAccounts` and `$klaviyo->Accounts->getAccount` have been updated to return the account's locale, e.g. `en-US`.

  - **Breaking** Subscribe API Synchronous Validation Improved
    - To provide better feedback for handling SMS subscriptions, we’ve added improved validation behavior to `$klaviyo->Profiles->subscribeProfiles` method. In prior revisions, such requests may appear as 202s but will fail to update SMS consent. To handle this issue, 400 validation errors are returned for the following cases
      1. If a profile is subscribed to SMS marketing and [age-gating is enabled](https://help.klaviyo.com/hc/en-us/articles/4408311712667) but age_gated_date_of_birth is not provided, or the DOB does not meet the region's requirements.
      2. If the account does not have a sending number in the phone number’s region.
      3. If the phone number is in a region not supported by Klaviyo.
      4. If consented_at is set and the list or global setting is double opt-in.


## [7.1.2] - revision 2024-02-15

### Fixed: 

- Patched a bug due to incorrect handling of page_cursor

## [7.1.1] - revision 2024-02-15

### Fixed: 

- Patched a bug due to colliding enum variable names

## [7.1.0] - revision 2024-02-15

### Added: 

- Optional `$user_agent_suffix` param to client instantiation
  - example usage: 
  ```
    $klaviyo = new KlaviyoAPI(
        'YOUR_API_KEY', 
        $num_retries = 3, 
        $wait_seconds = 3,
        $guzzle_options = [],
        $user_agent_suffix = "/YOUR_APP_NAME");
  ```

## [7.0.0] - revision 2024-02-15

### Added: 

- New `Reporting` allows you to request campaign and flow performance data that you can view in the Klaviyo UI.

- `campaignValuesQuery`
  - Request campaign analytics data, for example, a campaign performance report on the open rate over the past 30 days.

- `flowValuesQuery`
  - Request flow analytics data, for example, a flow performance report on the revenue per recipient value over the past 3 months.

- `flowSeriesQuery`
  - Fetch flow series data for a specific interval and timeframe, for example, a flow performance report on weekly click rates  over the past 12 months.


- New `Profiles` endpoint allows you to create or update a profile with a set of profile attributes.

  - `createOrUpdateProfile`
    - This endpoint operates synchronously and offers an upsert pattern similar to the [v1/v2 Identify API](https://developers.klaviyo.com/en/docs/apis_comparison_chart).

### Changed:
	
- Removed the $attribution field from event_properties in getEvent and  getEvents (breaking change).
	
  - To include this data in your request, add include=attributions to your request.

## [6.1.0] - revision 2023-12-15

### Added

#### New Endpoints: Bulk Profile Imports

We have added the following endpoints to enable bulk profile imports:
- `Profiles->spawnBulkProfileImportJob`
- `Profiles->getBulkProfileImportJob`
- `Profiles->getBulkProfileImportJobs`
- `Profiles->getBulkProfileImportJobLists`
- `Profiles->getBulkProfileImportJobProfiles`
- `Profiles->getBulkProfileImportJobImportErrors`
- `Profiles->getBulkProfileImportJobRelationshipsProfiles`
- `Profiles->getBulkProfileImportJobRelationshipsLists`

### Changed

#### Relationships field of `Profiles->subscribeProfiles` payload is now optional

When using `Profiles->subscribeProfiles`, the `relationships` field of the payload is now optional (see [Profiles->subscribeProfiles reference](https://developers.klaviyo.com/en/reference/subscribe_profiles) for details).

## [6.0.0] - revision 2023-10-15

### Added

#### Support for returning list suppressions via the [/profiles endpoint](https://developers.klaviyo.com/en/reference/get_profiles)

We now support filtering on list suppression with the get profiles endpoint, which brings us to parity with v2 list suppression endpoint that was the previously recommended solution.

Rules for suppression [filtering](https://developers.klaviyo.com/en/docs/filtering_):  

- You may not mix-and-match list and global filters  
- You may only specify a single date filter  
- You may or may not specify a reason  
- You must specify a list_id to filter on any list suppression properties

Examples:

- To return profiles who were suppressed after a certain date:  
  `$filter="greater-than(subscriptions.email.marketing.suppression.timestamp,2023-03-01T01:00:00Z)"`
- To return profiles who were suppressed from a specific list after a certain date:  
  `$filter="greater-than(subscriptions.email.marketing.list_suppressions.timestamp,2023-03-01T01:00:00Z),equals(subscriptions.email.marketing.list_suppressions.list_id,\"LIST_ID\")"`
- To return all profiles who were suppressed for a specific reason after a certain date:  
  `$filter="greater-than(subscriptions.email.marketing.suppression.timestamp,2023-03-01T01:00:00Z),equals(subscriptions.email.marketing.suppression.reason,\"user_suppressed\")"`

#### Optionally retrieve subscription status on Get List Profiles, Get Segment Profiles, Get Event Profile

Now you can retrieve subscription status on any endpoint that returns profiles, including Get List Profiles, Get Segment Profiles and Get Event Profile.  Use `$additional_fields_profile="subscriptions"` on these endpoints to include subscription information.

### Changed

#### Subscription object not returned by default on Get Profile / Get Profiles

The subscription object is no longer returned by default with get profile(s) requests. However, it can be included by adding the  `$additional_fields_profile="subscriptions"` to the request. This change will allow us to provide a more performant experience when making requests to Get Profiles without including the subscriptions object.

#### Profile Subscription Fields Renamed

In the interest of providing more clarity and information on the subscription object, we have renamed several fields, and added several as well. This will provide more context on a contact's subscriptions and consent, as well as boolean fields to see who you can or cannot message.

For SMSMarketing:

- `timestamp` is now `consent_timestamp`
- `last_updated` is a new field that mirrors `consent_timestamp`
- `can_receive_sms_marketing` is a new field which is `True` if the profile is consented for SMS 

For EmailMarketing:

- `timestamp` is now `consent_timestamp`
- `can_receive_email_marketing` is True if the profile does not have a global suppression
- `suppressions` is now `suppression`
- `last_updated` is a new field that is the most recent of all the dates on the object

## [5.2.0] - revision 2023-09-15

### Added

- `Images` API
  - We now support the following operations to work with images:
    - `getImage`
    - `getImages`
    - `updateImage`
    - `uploadImageFromFile`
    - `uploadImageFromUrl`
- `Coupons` API
  - We now support CRUD operations for both Coupons and Coupon Codes
  - Check out [Coupons API guide](https://developers.klaviyo.com/en/docs/use_klaviyos_coupons_api) for more information.
- New profile merge endpoint: `Profiles->mergeProfiles`
- Additional filtering/sorting option for getting profiles from `Lists` and `Segments`: `joined_group_at`
- Increased the maximum page size limit for `Lists->getListRelationshipsProfiles` and `Segments->getSegmentRelationshipsProfiles` to 1000

## [5.1.0] - revision 2023-08-15
### Added
- Flow Message Templates
- You can now retrieve the templates associated with flow messages using `Flows->getFlowMessageTemplate()` or `Flows->getFlowMessageRelationshipsTemplate()` . You’re also able to include the template HTML for a flow message using `Flows->getFlowMessage($id, $include=['template'])`.
- Create or Update Push Tokens
- We have added an endpoint to create or update push tokens, `Profiles->createPushToken()`. This endpoint can be used to migrate profiles and their push tokens from another platform to Klaviyo. If you’re looking to register push tokens from users’ devices, please use our mobile SDKs.

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
