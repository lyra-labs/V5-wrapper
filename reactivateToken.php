<?php
/**
 * reactivateToken example
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

spip_log("start<br>  reactivateToken $token",$mode."_LOG");

$vads = new PayzenWSv5($config);

$response = new reactivateTokenResponse();
    try {
        $response = $vads->reactivateToken($token);
    }
    catch (Exception $e) {
        spip_log("reactivateToken : erreur ".$e->getMessage(),$mode."_LOG");
        return false;
    }

    if ($e = $response->reactivateTokenResult->commonResponse->responseCode){
        spip_log($s="reactivateToken $token : erreur $e : ".$response->reactivateTokenResult->commonResponse->responseCodeDetail,$mode._LOG_RESP);
        // 31 : Invalid reactivateToken => Token bien désactivé 
        if ($e==31) {
            return true;
        }
        else {
            return false;
        }
    }

    else {
        echo "<br>reactivateToken $token : OK<br>response code "
         .$response->reactivateTokenResult->commonResponse->responseCode
         ." : ".$response->reactivateTokenResult->commonResponse->responseCodeDetail;
    }

