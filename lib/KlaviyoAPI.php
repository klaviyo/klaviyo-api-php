<?php
namespace KlaviyoAPI;

use GuzzleHttp\Client as GuzzleClient;
use KlaviyoAPI\ApiException;
use KlaviyoAPI\Configuration;

use KlaviyoAPI\API\CampaignsApi;
use KlaviyoAPI\API\CatalogsApi;
use KlaviyoAPI\API\ClientApi;
use KlaviyoAPI\API\DataPrivacyApi;
use KlaviyoAPI\API\EventsApi;
use KlaviyoAPI\API\FlowsApi;
use KlaviyoAPI\API\ListsApi;
use KlaviyoAPI\API\MetricsApi;
use KlaviyoAPI\API\ProfilesApi;
use KlaviyoAPI\API\SegmentsApi;
use KlaviyoAPI\API\TagsApi;
use KlaviyoAPI\API\TemplatesApi;




class KlaviyoAPI {
    public $api_key = "API_KEY";
    public $wait_seconds;
    public $num_retries;
    public $config;
    public $Campaigns;
    public $Catalogs;
    public $Client;
    public $DataPrivacy;
    public $Events;
    public $Flows;
    public $Lists;
    public $Metrics;
    public $Profiles;
    public $Segments;
    public $Tags;
    public $Templates;
    


    public function __construct($api_key, $num_retries = 3, $wait_seconds = 3) {

        if (gettype($num_retries) == 'NULL'){
            $num_retries = 3;
        } 

        if (gettype($wait_seconds) == 'NULL'){
            $wait_seconds = 3;
        } 

        $this->api_key = $api_key;
        $this->num_retries = $num_retries;
        $this->wait_seconds = $wait_seconds;

        $this->config = clone Configuration::getDefaultConfiguration();
        $this->config->setApiKey('Authorization',"Klaviyo-API-Key $this->api_key");

        
        $this->Campaigns = new Subclient(
                new CampaignsApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Catalogs = new Subclient(
                new CatalogsApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Client = new Subclient(
                new ClientApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->DataPrivacy = new Subclient(
                new DataPrivacyApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Events = new Subclient(
                new EventsApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Flows = new Subclient(
                new FlowsApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Lists = new Subclient(
                new ListsApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Metrics = new Subclient(
                new MetricsApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Profiles = new Subclient(
                new ProfilesApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Segments = new Subclient(
                new SegmentsApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Tags = new Subclient(
                new TagsApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        
        $this->Templates = new Subclient(
                new TemplatesApi(new GuzzleClient(),$this->config),
                $wait_seconds = 3,
                $num_retries = 3,
            );
        

    }
}
