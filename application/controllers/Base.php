<?php defined('BASEPATH') or exit('No direct script access allowed');
class Base extends CI_Controller {
	
    public $arrQueries = array();
    public $arrHttp = array();
    public $arrKeys = array();
    public $arrLinks = array();

    function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");

        $this->arrQueries = array(
            'users' => "'WebTransaction/Action/Resources_V1_Users/post','WebTransaction/Action/Resources_V1_Users/get','WebTransaction/Action/Resources_V1_Users/put'",
            'wallets' => "'WebTransaction/Action/Resources_V1_Users_Wallets/get','WebTransaction/Action/Resources_V1_Users_Wallets/post','WebTransaction/Action/Resources_V1_Users_Wallets/put'",
            'cards' => "'WebTransaction/Action/Resources_V1_Users_Wallets_Cards/post','WebTransaction/Action/Resources_V1_Users_Wallets_Cards/get','WebTransaction/Action/Resources_V1_Users_Wallets_Cards/delete','WebTransaction/Action/Resources_V1_Users_Wallets_Cards/put'",
            'funds' => "'WebTransaction/Action/Resources_V1_Users_Wallets_Funds/get','WebTransaction/Action/Resources_V1_Users_Wallets_Funds/post','WebTransaction/Action/Resources_V1_Users_Wallets_Funds/put','WebTransaction/Action/Resources_V1_Users_Wallets_Funds/delete','WebTransaction/Action/Resources_V1_Users_Wallets_Cards_Funds/post','WebTransaction/Action/Resources_V1_Users_Wallets_Cards_Funds/delete'"
        );

        $this->arrHttp = array(
            '2xx' => "'200'",
            '4xx' => "'400','401','402','403','404'",
            '5xx' => "'500','501','502','503'"
        );

        $this->arrKeys = array(
            "intrains" => array(
                "key" => "S1DvFP1v7HeNMZRYP90zOPKmXPj4SdOq",
                "secret" => "ruqYq4X3KEGpGDluBMmjlpPQNQ2jcKiwPIPieBoDq5zPzXjLliKjI2Dy7qLuuCWe"
            ),
            "sgmmdlyt" => array(
                "key" => "Uo30l7pBuR21fPzqg914CsiDPHxBoDf7",
                "secret" => "0U1bWdcjwWP8xZy2kld2mWvjXZ0vSDFvrScjf7Sk3h55yvNgpYZYi4mUgxoWQn0m"
            )
        );

        $this->arrLinks = array(
            "intrains" => array(
                "users" => "https://chart-embed.service.newrelic.com/herald/8afda474-fb75-442b-a0f7-c3fdf860c348?height=400px&timepicker=true",
                "wallets" => "https://chart-embed.service.newrelic.com/herald/a302cc63-2f46-40c3-83e5-05b3df39d4c5?height=400px&timepicker=true",
                "cards" => "https://chart-embed.service.newrelic.com/herald/ca12516d-4321-4119-b62a-09cbd230f67d?height=400px&timepicker=true",
                "funds" => "https://chart-embed.service.newrelic.com/herald/d1014180-60e7-4361-ad92-3b2784285a82?height=400px&timepicker=true"
            ),
            "sgmmdlyt" => array(
                "users" => "https://chart-embed.service.newrelic.com/herald/3e416aa5-dfc0-4f40-8e8c-2c79682d1cb5?height=400px&timepicker=true",
                "wallets" => "https://chart-embed.service.newrelic.com/herald/c5f0b5e6-c8cf-4218-b891-3ac2b0a0cb64?height=400px&timepicker=true",
                "cards" => "https://chart-embed.service.newrelic.com/herald/a57a1592-34a6-41e0-b20a-43c04d517aa1?height=400px&timepicker=true",
                "funds" => "https://chart-embed.service.newrelic.com/herald/e510a250-1520-40aa-9022-9e0d843034a7?height=400px&timepicker=true"
            )
        );
    }
		   
    function index(){
        $response = array("status" => true, "data" => array("Health"=>"OK"));
        $this->output->set_output(json_encode($response));
    }

    function counts($entity, $httpStatus, $programCode, $timestamp = "1"){
        $accountId = NEWRELIC_ACCOUNT_ID;
        $entityGuid = NEWRELIC_ENTITY_GUID;
        $endpointNames = $this->arrQueries[$entity];
        $httpCode = $this->arrHttp[$httpStatus];
        $programCode = isNull($programCode) ? EMPTY_STRING : " AND program_code IN ('" . $programCode . "') ";
        $headers = array('Content-Type:application/json','API-Key:' . NEWRELIC_API_KEY); 
        $arrData = array("query" => "{actor{account(id: " . $accountId . ") {nrql(query: \"SELECT count(*) FROM Transaction WHERE (entityGuid = '" . $entityGuid . "') AND ((transactionType = 'Web' AND name IN (" . $endpointNames . "))) AND httpResponseCode IN (" . $httpCode . ") " . $programCode . " SINCE " . $timestamp . " day ago\") {results}}}}");
        $curlResp = fireCurl($headers, $arrData);
        if ($curlResp['status'] == true){
            $data = json_decode($curlResp['data'],TRUE);
            $count = $data['data']['actor']['account']['nrql']['results']['0']['count'];
        } else {
            $count = 0;
        }        
        return $count;
    }  

    function latency($entity, $programCode, $timestamp = "1"){
        $accountId = NEWRELIC_ACCOUNT_ID;
        $entityGuid = NEWRELIC_ENTITY_GUID;
        $endpointNames = $this->arrQueries[$entity];
        $programCode = isNull($programCode) ? EMPTY_STRING : " AND program_code IN ('" . $programCode . "') ";
        $headers = array('Content-Type:application/json','API-Key:' . NEWRELIC_API_KEY); 
        $arrData = array("query" => "{actor{account(id: " . $accountId . ") {nrql(query: \"SELECT average(duration) as avrg FROM Transaction WHERE (entityGuid = '" . $entityGuid . "') AND ((transactionType = 'Web' AND name IN (" . $endpointNames . "))) " . $programCode . " SINCE " . $timestamp . " day ago LIMIT max\") {results}}}}");
        $curlResp = fireCurl($headers, $arrData);
        if ($curlResp['status'] == true){
            $data = json_decode($curlResp['data'],TRUE);
            $count = $data['data']['actor']['account']['nrql']['results']['0']['avrg'];
        } else {
            $count = 0;
        }        
        return $count;
    }
}