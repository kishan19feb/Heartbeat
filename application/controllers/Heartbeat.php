<?php defined('BASEPATH') or exit('No direct script access allowed');
require BASE;
class Heartbeat extends Base {
    function index(){
        $request = Request();
        $programCode = $request['programCode'];
        $entity = $request['category'];
        $key = $request['clientKey'];
        $dbKey = $this->arrKeys[$programCode]['key'];
        $dbSecret = $this->arrKeys[$programCode]['secret'];
        $authKey = base64_encode($dbKey.":".$dbSecret);
        $link = $this->arrLinks[$programCode][$entity];
        $response = array();
        if($key == $authKey){
            $count_2xx = $this->counts($entity, '2xx', $programCode);
            $count_4xx = $this->counts($entity, '4xx', $programCode);
            $count_5xx = $this->counts($entity, '5xx', $programCode);
            $denom = ($count_2xx + $count_4xx + $count_5xx);
            if ($denom == 0){
                $availablity = 0;
            } else {
                $availablity = (($count_2xx + $count_4xx) / $denom) / 100;
            }
            $response['status'] = ($availablity > 0) ? true : false;
            $response['data'] = array(
                "reason" => "API Unavailable !",
                "link" => $link
            );
        } else {
            $response['status'] = ($availablity > 0) ? true : false;
            $response['data'] = array(
                "reason" => "Authentication Error !",
                "link" => $link
            );
        }
        $this->output->set_output(json_encode($response));
    }
    
    function getCounts($entity, $programCode, $timestamp){
        $count_2xx = $this->counts($entity, '2xx', $programCode, $timestamp);
        $count_4xx = $this->counts($entity, '4xx', $programCode, $timestamp);
        $count_5xx = $this->counts($entity, '5xx', $programCode, $timestamp);
        $latency = $this->latency($entity, $programCode, $timestamp);
        $latency = number_format((float)$latency  * 1000, 2, '.', '');
        $response = array(
          'status' => true,
          'data' => array(
              "since" => $timestamp . " day(s)",
              "entity" => $entity,
              "latency" => $latency . " ms",
              "count" => array(
                  "2xx" => $count_2xx,
                  "4xx" => $count_4xx,
                  "5xx" => $count_5xx
              )
            )
        );
        if(!isNull($programCode)){
            $response['data']['program'] = $programCode;
        };
        return $response;
    }
  
    function users($programCode = EMPTY_STRING, $timestamp = "1"){
        $resp = $this->getCounts(__FUNCTION__, $programCode, $timestamp);
        $this->output->set_output(json_encode($resp));
    }
  
    function wallets($programCode = EMPTY_STRING, $timestamp = "1"){
        $resp = $this->getCounts(__FUNCTION__, $programCode, $timestamp);
        $this->output->set_output(json_encode($resp));
    }
  
    function cards($programCode = EMPTY_STRING, $timestamp = "1"){
        $resp = $this->getCounts(__FUNCTION__, $programCode, $timestamp);
        $this->output->set_output(json_encode($resp));
    }
  
    function funds($programCode = EMPTY_STRING, $timestamp = "1"){
        $resp = $this->getCounts(__FUNCTION__, $programCode, $timestamp);
        $this->output->set_output(json_encode($resp));
    }
}