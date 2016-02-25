<?php
/**
 * cancelToken example
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
 *
 *  $token is the payment card alias/token
 * 
*/

$token    =  'c53360e0d89246a183278956c83e962b';

/** execute **/

spip_log("start<br>  cancelToken $token",$mode."_LOG");

$vads = new PayzenWSv5($config);

$response = new cancelTokenResponse();
    try {
        $response = $vads->cancelToken($token);
    }
    catch (Exception $e) {
        spip_log("call_resilier_token : erreur ".$e->getMessage(),$mode."_LOG");
        return false;
    }

    if ($e = $response->cancelTokenResult->commonResponse->responseCode){
        spip_log($s="call_resilier_token $token : erreur $e : ".$response->cancelTokenResult->commonResponse->responseCodeDetail,$mode._LOG_RESP);
        // 31 : Invalid paymentToken => Token bien désactivé 
        if ($e==31) {
            spip_log($s="call_resilier_token $token : erreur $e : ".$response->cancelTokenResult->commonResponse->responseCodeDetail,$mode."_E31");
            return true;
        }
        else {
        spip_log($s="call_resilier_token $token : erreur $e : ".$response->cancelTokenResult->commonResponse->responseCodeDetail,$mode."_NOT31");
            return false;
        }
    }

    else {
        echo "<br>call_resilier_token $token : OK<br>response code "
         .$response->cancelTokenResult->commonResponse->responseCode
         ." : ".$response->cancelTokenResult->commonResponse->responseCodeDetail;
    }

