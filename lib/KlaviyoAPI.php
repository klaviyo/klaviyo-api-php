<?php
namespace KlaviyoAPI;

use GuzzleHttp\Client as GuzzleClient;
use KlaviyoAPI\ApiException;
use KlaviyoAPI\Configuration;

use KlaviyoAPI\API\AccountsApi;
use KlaviyoAPI\API\CampaignsApi;
use KlaviyoAPI\API\CatalogsApi;
use KlaviyoAPI\API\CouponsApi;
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
use KlaviyoAPI\API\WebhooksApi;




class KlaviyoAPI {
    public $api_key = "API_KEY";
    public $wait_seconds;
    public $num_retries;
    public $config;
    public $guzzle_options;
    public $Accounts;
    public $Campaigns;
    public $Catalogs;
    public $Coupons;
    public $DataPrivacy;
    public $Events;
    public $Flows;
    public $Forms;
    public $Images;
    public $Lists;
    public $Metrics;
    public $Profiles;
    public $Reporting;
    public $Reviews;
    public $Segments;
    public $Tags;
    public $Templates;
    public $TrackingSettings;
    public $Webhooks;
    


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
        
        $this->Webhooks = new Subclient(
                new WebhooksApi(new GuzzleClient($this->guzzle_options),$this->config),
                $wait_seconds = $this->wait_seconds,
                $num_retries = $this->num_retries,
            );
        

    }
}
