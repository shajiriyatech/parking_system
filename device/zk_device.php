<?php

// TURN THIS TRUE ONLY WHEN YOU ARE AT SITE
define('DEVICE_ENABLED', false);

//require_once __DIR__ . '/../vendor/autoload.php';

//use ZKLib\ZKLib;

// 

class ZKDevice {

    public function addCard($uid, $flat, $name, $cardNo) {
        return true;
    }

    public function deleteCard($uid) {
        return true;
    }
}