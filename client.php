<?php
require_once(__DIR__ . '/vendor/autoload.php');

use KlaviyoAPI\KlaviyoAPI;

$klaviyo = new KlaviyoAPI(
    'pk_922f80a232659e3e8aae5aadb6519f148c', 
    $num_retries = 3, 
    $wait_seconds = 3,
    $guzzle_options = []);


$response = $klaviyo->Accounts->getAccounts($fields_account=NULL);
print_r($response);
