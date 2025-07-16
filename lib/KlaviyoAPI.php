<?php
namespace KlaviyoAPI;

use GuzzleHttp\Client as GuzzleClient;
use KlaviyoAPI\ApiException;
use KlaviyoAPI\Configuration;

use KlaviyoAPI\API\AccountsApi;
use KlaviyoAPI\API\CampaignsApi;
use KlaviyoAPI\API\CatalogsApi;
use KlaviyoAPI\API\CouponsApi;
use KlaviyoAPI\API\CustomObjectsApi;
use KlaviyoAPI\API\DataPrivacyApi;
use KlaviyoAPI\API\EventsApi;
use KlaviyoAPI\API\FlowsApi;
use KlaviyoAPI\API\FormsApi;
use KlaviyoAPI\API\ImagesApi;
use KlaviyoAPI\API\ListsApi;
use KlaviyoAPI\API\MetricsApi;
use KlaviyoAPI\API\ProfilesApi;
use KlaviyoAPI\API\ReportingApi;
use KlaviyoAPI\API\ReviewsApi;
use KlaviyoAPI\API\SegmentsApi;
use KlaviyoAPI\API\TagsApi;
use KlaviyoAPI\API\TemplatesApi;
use KlaviyoAPI\API\TrackingSettingsApi;
use KlaviyoAPI\API\WebFeedsApi;
use KlaviyoAPI\API\WebhooksApi;




class KlaviyoAPI {
    /** @var string */
    public $api_key = "API_KEY";
    /** @var int */
    public $wait_seconds;
    /** @var int */
    public $num_retries;
    /** @var string */
    public $config;
    /** @var array */
    public $guzzle_options;
    /** @var Subclient<AccountsApi> */
    public $Accounts;
    /** @var Subclient<CampaignsApi> */
    public $Campaigns;
    /** @var Subclient<CatalogsApi> */
    public $Catalogs;
    /** @var Subclient<CouponsApi> */
    public $Coupons;
    /** @var Subclient<CustomObjectsApi> */
    public $CustomObjects;
    /** @var Subclient<DataPrivacyApi> */
    public $DataPrivacy;
    /** @var Subclient<EventsApi> */
    public $Events;
    /** @var Subclient<FlowsApi> */
    public $Flows;
    /** @var Subclient<FormsApi> */
    public $Forms;
    /** @var Subclient<ImagesApi> */
    public $Images;
    /** @var Subclient<ListsApi> */
    public $Lists;
    /** @var Subclient<MetricsApi> */
    public $Metrics;
    /** @var Subclient<ProfilesApi> */
    public $Profiles;
    /** @var Subclient<ReportingApi> */
    public $Reporting;
    /** @var Subclient<ReviewsApi> */
    public $Reviews;
    /** @var Subclient<SegmentsApi> */
    public $Segments;
    /** @var Subclient<TagsApi> */
    public $Tags;
    /** @var Subclient<TemplatesApi> */
    public $Templates;
    /** @var Subclient<TrackingSettingsApi> */
    public $TrackingSettings;
    /** @var Subclient<WebFeedsApi> */
    public $WebFeeds;
    /** @var Subclient<WebhooksApi> */
    public $Webhooks;
    

    /**
     * @param string $api_key
     * @param int $num_retries
     * @param ?int $wait_seconds
     * @param array $guzzle_options
     * @param string $user_agent_suffix
     */
    public function __construct($api_key, $num_retries = 3, $wait_seconds = null, $guzzle_options = [], $user_agent_suffix = "") {

        if (gettype($num_retries) == 'NULL'){
            $num_retries = 3;
        } 

        if ($wait_seconds !== null){
            trigger_error("The 'wait_seconds' parameter is deprecated and will be removed in a future version. Please remove this to enable exponential backoff for retry intervals.", E_USER_WARNING);
        } 

        $this->api_key = $api_key;
        $this->num_retries = $num_retries;
        $this->wait_seconds = $wait_seconds;
        $this->guzzle_options = $guzzle_options;

        $this->config = clone Configuration::getDefaultConfiguration();
        $this->config->setApiKey('Authorization',"Klaviyo-API-Key $this->api_key");
        $user_agent = $this->config->getUserAgent();
        $user_agent = $user_agent . $user_agent_suffix;
        $this->config->setUserAgent($user_agent);

        
        $this->Accounts = new Subclient(
                new AccountsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Campaigns = new Subclient(
                new CampaignsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Catalogs = new Subclient(
                new CatalogsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Coupons = new Subclient(
                new CouponsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->CustomObjects = new Subclient(
                new CustomObjectsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->DataPrivacy = new Subclient(
                new DataPrivacyApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Events = new Subclient(
                new EventsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Flows = new Subclient(
                new FlowsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Forms = new Subclient(
                new FormsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Images = new Subclient(
                new ImagesApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Lists = new Subclient(
                new ListsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Metrics = new Subclient(
                new MetricsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Profiles = new Subclient(
                new ProfilesApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Reporting = new Subclient(
                new ReportingApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Reviews = new Subclient(
                new ReviewsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Segments = new Subclient(
                new SegmentsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Tags = new Subclient(
                new TagsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Templates = new Subclient(
                new TemplatesApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->TrackingSettings = new Subclient(
                new TrackingSettingsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->WebFeeds = new Subclient(
                new WebFeedsApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        
        $this->Webhooks = new Subclient(
                new WebhooksApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        

    }
}
