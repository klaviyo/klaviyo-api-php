# Changelog

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
  - New resources and endpoints: see [API Changelog](https://developers.klaviyo.com/en/docs/changelog_) for full details