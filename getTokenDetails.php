<?php
/**
 * getTokenDetails example
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

spip_log("start<br>  getTokenDetails $token",$mode."_LOG");

$vads = new PayzenWSv5($config);

$response = new getTokenDetailsResponse();
    try {
        $response = $vads->getTokenDetails($token);
    }
    catch (Exception $e) {
        spip_log("getTokenDetails : erreur ".$e->getMessage(),$mode."_LOG");
        return false;
    }

    if ($e = $response->getTokenDetailsResult->commonResponse->responseCode){
        spip_log($s="getTokenDetails $token : erreur $e : ".$response->getTokenDetailsResult->commonResponse->responseCodeDetail,$mode._LOG_RESP);
    }

    else {
        echo "<br><br>getTokenDetails $token : OK<br>response code "
         .$response->getTokenDetailsResult->commonResponse->responseCode
         ." : ".$response->getTokenDetailsResult->commonResponse->responseCodeDetail;
 
        $cardResponse          = json_encode($response->getTokenDetailsResult->cardResponse);
        $customerResponse      = json_encode($response->getTokenDetailsResult->customerResponse);
        $authorizationResponse = json_encode($response->getTokenDetailsResult->authorizationResponse);
        $tokenResponse         = json_encode($response->getTokenDetailsResult->tokenResponse);
        echo "<br><br>cardResponse          : $cardResponse";
        echo "<br>authorizationResponse : $authorizationResponse";
        echo "<br>customerResponse : $customerResponse";
        echo "<br>tokenResponse : $tokenResponse";
    }



