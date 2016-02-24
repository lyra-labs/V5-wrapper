<?php


include('config.php');
include('lib-v5/classes.php');
include('lib-v5/functions.php');

/** Parameters **/

$tok    =  '173a814c0dfc4665bb400e29d4b4f87f';
$uid    =  '20150828JMZGgS';

/** execute **/

spip_log("start<br>  cancelSubscription $uid for token $tok",$mode."_LOG");

$vads = new PayzenWSv5($config);

$response = new cancelSubscriptionResponse();
    try {
        $response = $vads->cancelSubscription($tok, $uid);
    }
    catch (Exception $e) {
        spip_log("call_resilier_abonnement : erreur ".$e->getMessage(),$mode."_LOG");
        return false;
    }

    if ($e = $response->cancelSubscriptionResult->commonResponse->responseCode){
        spip_log($s="call_resilier_abonnement $uid : erreur $e : ".$response->cancelSubscriptionResult->commonResponse->responseCodeDetail,$mode._LOG_RESP);
        // 33 : Invalid Subscription => on est donc bien desabonne
        if ($e==33) {
            spip_log($s="call_resilier_abonnement $uid : erreur $e : ".$response->cancelSubscriptionResult->commonResponse->responseCodeDetail,$mode."_E33");
            return true;
        }
        else {
        spip_log($s="call_resilier_abonnement $uid : erreur $e : ".$response->cancelSubscriptionResult->commonResponse->responseCodeDetail,$mode."_NOT33");
            return false;
        }
    }

    else {
        echo "<br>call_resilier_abonnement $uis : OK<br>response code "
         .$response->cancelSubscriptionResult->commonResponse->responseCode
         ." : ".$response->cancelSubscriptionResult->commonResponse->responseCodeDetail;
    }

