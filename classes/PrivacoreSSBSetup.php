<?php

/**
 * Created by PhpStorm.
 * User: Miroslav Marinov
 * Date: 2.3.2016
 * Time: 10:31
 */

if (!class_exists('PrivacoreSSBSetup')) {
    class PrivacoreSSBSetup
    {
        /**
         * Setup Privacore SSB plugin on plugin activation
         */
        public function pssbActivate()
        {
            //Check if plugin is not cativated previously
            if (!get_option('pssb_display_auto')) {

                //Set auto display share buttons after post/page content
                update_option('pssb_display_auto', true);
            }
        }

    }

}