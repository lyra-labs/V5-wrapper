<?php
/*
 * Payzen parameters
 * and General Purpose functions 
 *
 * Authors :
 *
 */


// LOG prefix - keep spip_log compatibility
$mode   =  'inter';

// Payzen parameters
$config['SITE_ID']   =  '99'; // Payzen ShopID
$config['mode_test'] =  '1';  // define if payzen will be called in TEST mode
$config['CLE_test']  =  '99'; // Payzen TEST key
$config['CLE']       =  '';   // Payzen PRODUCTION key


// Functions 

// Allows to keep the spip log function  
function spip_log($txt, $mode) {
    echo "</br>[$mode]</br>$txt</br>";

}

// get the TEST or PRODUCTION key when needed   
function systempay_key($config){
    if ($config['mode_test']) {
        return $config['CLE_test'];
    }
    return $config['CLE'];
}

