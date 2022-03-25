<?php defined('BASEPATH') or exit('No direct script access allowed');
require BASE;
class Maintenance extends Base {
   
    function downtime(){
        $response = file_get_contents("./configs/downtime.json");
        $response = json_decode($response,TRUE);
        $current = getMillis(date('Y-m-d h:i'));
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
        $response = array(
            'status' => ($status > 0) ? true : false,
            'data' => array(
                'bytes' => ($status > 0) ? $status : 0
            )
        );
        $this->output->set_output(json_encode($response));
    }

}