# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

NOTE: For more granular API-specific changes, please see our [API Changelog](https://developers.klaviyo.com/en/docs/changelog_)

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
