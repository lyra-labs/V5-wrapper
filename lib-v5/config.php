<?php
/*
 * Payzen parameters
 * and General Purpose functions
 *
 * Authors :
 *  Parslow, LyraNetwork
 *
 */

// Define URL constant
//  use secure.payzen.eu for production instance
//      demo.payzen.eu for demo instance
define("NAMESPACE_URL","http://v5.ws.vads.lyra.com/Header/");
define("WSDL_URL","https://secure.payzen.eu/vads-ws/v5?wsdl");
#define("WSDL_URL","https://demo.payzen.eu/vads-ws/v5?wsdl");

// LOG prefix - keep spip_log compatibility
$mode   =  'inter';

// Payzen parameters
$config['SITE_ID']   =  '99'; // Payzen ShopID
$config['mode_test'] =  '1';  // define if payzen will be called in TEST mode
$config['CLE_test']  =  '99'; // Payzen TEST key
$config['CLE']       =  '';   // Payzen PRODUCTION key

