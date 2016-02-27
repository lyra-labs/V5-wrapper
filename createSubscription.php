<?php
/**
 * createSubscription example
 *
 * @author
 *  Parslow, LyraNetwork
 * @copyright
 *
 */

include('lib-v5/config.php');
include('lib-v5/classes.php');
include('lib-v5/functions.php');

/*
 * Parameters 
*/

$orderRequest = array (
    "orderId" => "ORDER".date("z-Bs"),
    "extInfo" => array("key" => "keyData", "value" => "valuedata")
);
$subscriptionRequest = array (
    "effectDate" => date('c'),
    "amount" => "1234",
    "currency" => "978",
    "initialAmount" => "0",
    "initialAmountNumber" => "0",
    "rrule" => "RRULE:FREQ=DAILY;COUNT=3",
    "subscriptionId" => "",            # 
    "description" => "subscription created ".date("r")
);
$cardRequest = array (
    "paymentToken" => "c53360e0d89246a183278956c83e962b",     # Card number
);

/*
 * Execute 
 */

spip_log("start<br>  createSubscription ",$mode."_LOG");

$vads = new PayzenWSv5($config);

$response = new createSubscriptionResponse();
    try {
        $response = $vads->createSubscription($orderRequest, $subscriptionRequest, $cardRequest);
    }
    catch (Exception $e) {
        spip_log("createSubscription : erreur ".$e->getMessage(),$mode."_LOG");
        return false;
    }

    if ($e = $response->createSubscriptionResult->commonResponse->responseCode){
        spip_log($s="createSubscription : erreur $e : ".$response->createSubscriptionResult->commonResponse->responseCodeDetail,$mode._LOG_RESP);
        // 31
        if ($e==31) {
            return true;
        }
        else {
            return false;
        }
    }

    else {
        echo "<br>createSubscription  : OK<br>response code "
         .$response->createSubscriptionResult->commonResponse->responseCode
         ." : ".$response->createSubscriptionResult->commonResponse->responseCodeDetail;
    }

