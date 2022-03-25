<?php defined('BASEPATH') or exit('No direct script access allowed');
require BASE;
class Heartbeat extends Base {
   
    function getCounts($entity, $programCode, $timestamp){
        $count_2xx = $this->getCount($entity, '2xx', $programCode, $timestamp);
        $count_4xx = $this->getCount($entity, '4xx', $programCode, $timestamp);
        $count_5xx = $this->getCount($entity, '5xx', $programCode, $timestamp);
        $response = array(
          'status' => true,
          'data' => array(
              "entity" => $entity,
              "count" => array(
                  "2xx" => $count_2xx,
                  "4xx" => $count_4xx,
                  "5xx" => $count_5xx
              )
          )
        );
        return $response;
    }
  
    function users($programCode = EMPTY_STRING, $timestamp = "1 day"){
        $resp = $this->getCounts(__FUNCTION__, $programCode, $timestamp);
        $this->output->set_output(json_encode($resp));
    }
  
    function wallets($programCode = EMPTY_STRING, $timestamp = "1 day"){
        $resp = $this->getCounts(__FUNCTION__, $programCode, $timestamp);
        $this->output->set_output(json_encode($resp));
    }
  
    function cards($programCode = EMPTY_STRING, $timestamp = "1 day"){
        $resp = $this->getCounts(__FUNCTION__, $programCode, $timestamp);
        $this->output->set_output(json_encode($resp));
    }
  
    function funds($programCode = EMPTY_STRING, $timestamp = "1 day"){
        $resp = $this->getCounts(__FUNCTION__, $programCode, $timestamp);
        $this->output->set_output(json_encode($resp));
    }
}