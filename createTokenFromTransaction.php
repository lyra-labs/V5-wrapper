<?php
/**
 * createTokenFromTransaction example
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

$uuid    =  '3bbb239bb95741c0abb85d2c29a35de8';

/** execute **/

spip_log("start<br> createTokenFromTransaction ",$mode."_LOG");

$vads = new PayzenWSv5($config);

$response = new createTokenFromTransactionResponse();
    try {
        $response = $vads->createTokenFromTransaction($uuid);
    }
    catch (Exception $e) {
        spip_log("createTokenFromTransaction : erreur ".$e->getMessage(),$mode."_LOG");
        return false;
    }

    if ($e = $response->createTokenFromTransactionResult->commonResponse->responseCode){
        spip_log($s="createTokenFromTransaction  : erreur $e : ".$response->createTokenFromTransactionTokenResult->commonResponse->responseCodeDetail,$mode._LOG_RESP);
        //  
        if ($e==31) {
        }
        else {
        spip_log($s="createTokenFromTransaction : erreur $e : ".$response->createTokenFromTransactionResult->commonResponse->responseCodeDetail,$mode."_NOT31");
            return false;
        }
    }

    else {
        echo "<br>createTokenFromTransaction : OK<br>response code "
         .$response->createTokenFromTransactionResult->commonResponse->responseCode
         ." : ".$response->createTokenFromTransactionResult->commonResponse->responseCodeDetail;
    }

