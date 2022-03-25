<?php defined('BASEPATH') or exit('No direct script access allowed');
class Base extends CI_Controller {
	
    public $arrQueries = array();
    public $arrHttp = array();

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
        $httpCode = $this->arrHttp[$httpStatus];
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