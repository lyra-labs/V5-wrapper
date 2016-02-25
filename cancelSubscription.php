<?php
/**
 * cancelSubscription example
 *
 * @author
 *  Cedric Morin, Nursit.com
 *  Parslow, LyraNetwork
 * @copyright
 *
 */

include('lib-v5/config.php');
include('lib-v5/classes.php');
include('lib-v5/functions.php');

/*
 * Parameters 
 *
 *  $token is the payment card alias/token
 *  $subid is the subscription id
 * 
*/

$token    =  'c53360e0d89246a183278956c83e962b';
$subid    =  '20150723x5Wpys';

/** execute **/

spip_log("start<br>  cancelSubscription $subid for token $token",$mode."_LOG");

$vads = new PayzenWSv5($config);

$response = new cancelSubscriptionResponse();
    try {
        $response = $vads->cancelSubscription($token, $subid);
    }
    catch (Exception $e) {
        spip_log("call_resilier_abonnement : erreur ".$e->getMessage(),$mode."_LOG");
        return false;
    }

    if ($e = $response->cancelSubscriptionResult->commonResponse->responseCode){
        spip_log($s="call_resilier_abonnement $subid : erreur $e : ".$response->cancelSubscriptionResult->commonResponse->responseCodeDetail,$mode._LOG_RESP);
        // 33 : Invalid Subscription => on est donc bien desabonne
        if ($e==33) {
            spip_log($s="call_resilier_abonnement $subid : erreur $e : ".$response->cancelSubscriptionResult->commonResponse->responseCodeDetail,$mode."_E33");
            return true;
        }
        else {
        spip_log($s="call_resilier_abonnement $subid : erreur $e : ".$response->cancelSubscriptionResult->commonResponse->responseCodeDetail,$mode."_NOT33");
            return false;
        }
    }

    else {
        echo "<br>call_resilier_abonnement $subid : OK<br>response code "
         .$response->cancelSubscriptionResult->commonResponse->responseCode
         ." : ".$response->cancelSubscriptionResult->commonResponse->responseCodeDetail;
    }

