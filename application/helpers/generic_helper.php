<?php
/*
 * @Author : Kishan Ravindra
 */
function isNull($dataVar) {
	$isNull = FALSE;
	if (isset ( $dataVar ) && ! empty ( $dataVar ) && ! is_null ( $dataVar )) {
		$isNull = ($dataVar == 'null' || $dataVar == 'undefined') ? TRUE : $isNull;
	} else {
		$isNull = TRUE;
	}
	return $isNull;
}

function Request() {
    return json_decode(file_get_contents("php://input"), TRUE);
}

function Response() {
    $response = array(
        'STATUS' => false,
        'STATUS_MSG' => STATUS_F,
        'DATA' => (object) array()
    );
    return $response;
}

function getStatus($status) {
    $status = isset($status) ? strtoupper($status) : $status;
    switch ($status) {
        case "TRUE":
            $status = "1";
            break;
        case "FALSE":
            $status = "0";
            break;
        default:
            break;
    }
    return $status;
}

function getMillis($dateString = EMPTY_STRING) {
    $dateInMillis = EMPTY_STRING;
    if (! empty($dateString) || $dateString != EMPTY_STRING) {
        $dateInMillis = strtotime($dateString) * 1000;
    }
    return $dateInMillis;
}

function fireCurl($headers = array(), $arrData = array()) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, NEWRELIC_API_URL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = array();
    $response['status'] = TRUE;
    $response['data'] = curl_exec($ch);
    if (curl_error($ch)) {
        $response['status'] = FALSE;
        $response['data'] = curl_error($ch);
    }
    curl_close($ch);
    return $response;
}