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
use KlaviyoAPI\API\ImagesApi;
use KlaviyoAPI\API\ListsApi;
use KlaviyoAPI\API\MetricsApi;
use KlaviyoAPI\API\ProfilesApi;
use KlaviyoAPI\API\SegmentsApi;
use KlaviyoAPI\API\TagsApi;
use KlaviyoAPI\API\TemplatesApi;




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
    /** @var Subclient */
    public $Accounts;
    /** @var Subclient */
    public $Campaigns;
    /** @var Subclient */
    public $Catalogs;
    /** @var Subclient */
    public $Coupons;
    /** @var Subclient */
    public $DataPrivacy;
    /** @var Subclient */
    public $Events;
    /** @var Subclient */
    public $Flows;
    /** @var Subclient */
    public $Images;
    /** @var Subclient */
    public $Lists;
    /** @var Subclient */
    public $Metrics;
    /** @var Subclient */
    public $Profiles;
    /** @var Subclient */
    public $Segments;
    /** @var Subclient */
    public $Tags;
    /** @var Subclient */
    public $Templates;


    /**
     * @param string $api_key
     * @param int $num_retries
     * @param int $wait_seconds
     * @param array $guzzle_options
     */
    public function __construct($api_key, $num_retries = 3, $wait_seconds = 3, $guzzle_options = []) {

        if (gettype($num_retries) == 'NULL'){
            $num_retries = 3;
        } 

        if (gettype($wait_seconds) == 'NULL'){
            $wait_seconds = 3;
        } 

        $this->api_key = $api_key;
        $this->num_retries = $num_retries;
        $this->wait_seconds = $wait_seconds;
        $this->guzzle_options = $guzzle_options;

        $this->config = clone Configuration::getDefaultConfiguration();
        $this->config->setApiKey('Authorization',"Klaviyo-API-Key $this->api_key");

        
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
        

    }
}
