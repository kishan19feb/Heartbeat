<?php defined('BASEPATH') or exit('No direct script access allowed');
require BASE;
class Maintenance extends Base {
   
    function downtime(){
        $response = file_get_contents("./configs/downtime.json");
        $response = json_decode($response,TRUE);
        $current = getMillis(date('Y-m-d H:i'));
        $expiry = getMillis($response['day'] . " " . $response['to']);
        $response['status'] = $current < $expiry ? true : false;
        $this->output->set_output(json_encode($response));
    }

    function publish(){
        $request = Request();
        $reason = $request['reason'];
        $day = $request['day'];
        $from = $request['from'];
        $to = $request['to'];
        $configs = array(
            'reason' => $reason,
            'day' => $day,
            'from' => $from,
            'to' => $to
        );
        $status = file_put_contents("./configs/downtime.json", json_encode($configs));
        if ($status > 0){
            $url = "https://eoz0oxfucmqftm1.m.pipedream.net";
            $headers = array('Content-Type:application/json'); 
            $curlResp = fireCurl($headers, $configs, $url);
        }
        $response = array(
            'status' => ($status > 0) ? true : false,
            'data' => array(
                'bytes' => ($status > 0) ? $status : 0,
                'cURL' => $curlResp
            )
        );
        $this->output->set_output(json_encode($response));
    }

}