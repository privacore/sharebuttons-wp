<?php
/**
 * Created by PhpStorm.
 * User: Miroslav Marinov
 * Date: 2.3.2016
 * Time: 10:02
 */

//IMPORTANT!!!! Do not change code of this file if you change it will break plugin

//Defining constants.
define('PSSB_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PSSB_PLUGIN_URL', plugin_dir_url(__FILE__));

//Include plugin required classes
require_once(PSSB_PLUGIN_PATH . 'classes/PrivacoreSSBSetup.php');
require_once(PSSB_PLUGIN_PATH . 'classes/PrivacoreSSBBase.php');
require_once(PSSB_PLUGIN_PATH . 'classes/PrivacoreSSBAdmin.php');
require_once(PSSB_PLUGIN_PATH . 'classes/PrivacoreSSBFrontend.php');