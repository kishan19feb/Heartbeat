<?php defined('BASEPATH') or exit('No direct script access allowed');
require BASE;
class Heartbeat extends Base {
   
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