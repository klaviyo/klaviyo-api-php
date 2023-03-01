# Changelog

NOTE: For more granular API-specific changes, please see our [API Changelog](https://developers.klaviyo.com/en/docs/changelog_)

## 2.0.0

### Added
- `page_size`:  you can now set page_size when paging through endpoints that return profiles

## 1.2.1

### Bug Fixes
- Fixed bug that caused paging through events to periodically fail


## 1.2.0

### Added
- Campaigns (which were previously in our Beta API/SDKs)

### Changes
- Flows
    - Pagination changed from page offset to cursor

## 1.1.0

  - Added the following endpoints (which were previously in our Beta API/SDKs):
    - Data Privacy
    - All Tags endpoints, as well as the following related resource-specific endpoints:
      - Get Flow Tags
      - Get List Tags
      - Get Segment Tags

## 1.0.0

  * Initial release

  Differences between 1.0.0 and BETA:

  - Naming changes
    - Packagist package name: `klaviyo/sdk-beta` → `klaviyo/api`
    - Namespace: `KlaviyoBeta` → `KlaviyoAPI`
    - client name: `Client` → `KlaviyoAPI`
    - Client variable name in readme examples: `$client` → `$klaviyo`
    - Some functions have changed name
  - Parameter ordering: The order of params has changed; you will need to update these for your existing implementation to work
