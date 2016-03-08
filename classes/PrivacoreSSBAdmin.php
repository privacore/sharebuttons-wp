<?php

/**
 * Created by PhpStorm.
 * User: Miroslav Marinov
 * Date: 2.3.2016
 * Time: 10:08
 */

if (!class_exists('PrivacoreSSBAdmin')) {

    class PrivacoreSSBAdmin extends PrivacoreSSBBase
    {
        //Set form fields list
        private $_formFields = array(
            'pssb_facebook_title',
            'pssb_facebook_description',
            'pssb_facebook_description',
            'pssb_twitter_text',
            'pssb_linkedin_title',
            'pssb_linkedin_description',
            'pssb_image'
        );

        public function __construct()
        {
            parent::__construct();

            //Call Plugin Initialization Method
            add_action('admin_init', array($this, 'init'));

            //Init Admin Menu
            add_action('admin_menu', array($this, 'adminMenu'));

            //save plugin fields on save post
            add_action('save_post', array($this, 'saveSSBFields'));

        }

        /**
         * Init Admin
         */
        public function init()
        {
            //Start Session if is not started
            if (!session_id()) {
                session_start();
            }

            //Enqueue Media scripts in admin
            add_action('admin_enqueue_scripts', array($this, 'enqueueAdminScripts'));

            //Add metaboxes to  admin
            add_action('add_meta_boxes', array($this, 'adminAddMetaBoxFields'), 10, 2);

            //Register Privacore SSB settings
            register_setting('privacore-ssb-settings-group', 'pssb_display_auto');

        }

        /**
         * Enqueue Admin Scripts
         */
        public function enqueueAdminScripts()
        {
            if (is_admin()) {
                wp_enqueue_media();

                wp_enqueue_style('pssb-admin-style', plugin_dir_url( dirname(__FILE__ )).'assets/styles/admin-pssb.css');

                wp_enqueue_script('pssb-admin-script', plugin_dir_url( dirname(__FILE__ )).'assets/js/admin-pssb.js', array('jquery','media-upload'),'1.0', true);
            }
        }

        /**
         * Add SSB Fields to WP Admin
         */
        public function adminAddMetaBoxFields()
        {   //Create Privacore SSB metabox section
            add_meta_box('privacore-ssb-meata-box', __('Privacore SSB', 'privacore-ssb'), array($this, 'renderSsbFields'), null, 'advanced', 'high');
        }


        /**
         * Render Metabox fields.
         *
         * @param $post
         * @param $args
         */
        public function renderSsbFields($post, $args)
        {
            $data['nonce'] = wp_create_nonce('pssb-nonce');

            //get all post meta fields
            $postMetaFields = get_post_meta($post->ID);

            //Add Privacore SSB fields data to form
            foreach ($postMetaFields as $pm_key => $pm_value) {
                if (in_array($pm_key, $this->_formFields)) {
                    $data[$pm_key] = $pm_value[0];
                }
            }

          echo $this->_loadView('ssb-meta-box-fields', $data);
        }

        /**
         * Save Privacore SBB fields
         *
         * @param $post_id
         * @return mixed
         */
        public function saveSSBFields($post_id)
        {
            $_SESSION['pssb_errors'] = array();
            //Verify if this is an auto save
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $post_id;
            //Verify nonce
            if (!wp_verify_nonce($_POST['pssb_nonce'], 'pssb-nonce'))
                return $post_id;


            // Check permissions
            if ('page' == $_POST['post_type']) {
                if (!current_user_can('edit_page', $post_id))
                    return $post_id;
            } else {
                if (!current_user_can('edit_post', $post_id))
                    return $post_id;
            }
            $_SESSION['pssb_errors'] = array();
            $postData = $_POST;

            //Image field
            if (isset($postData['pssb_image'])) {
                update_post_meta($post_id, 'pssb_image', sanitize_text_field($postData['pssb_image']));
            }

            //Facebook fields
            if (isset($postData['pssb_facebook_title'])) {

                if (mb_strlen(stripslashes($postData['pssb_facebook_title'])) <= 100) {
                    update_post_meta($post_id, 'pssb_facebook_title', sanitize_text_field($postData['pssb_facebook_title']));
                } else {
                    $_SESSION['pssb_errors']['pssb_facebook_title_error'] = __('Facebook title length must be 100 symbols maximum.', 'privacore-ssb');
                }
            }

            if (isset($postData['pssb_facebook_description'])) {

                if (mb_strlen(stripslashes($postData['pssb_facebook_description'])) <= 300) {
                    update_post_meta($post_id, 'pssb_facebook_description', sanitize_text_field($postData['pssb_facebook_description']));
                } else {
                    $_SESSION['pssb_errors']['pssb_facebook_description_error'] = __('Facebook description length must be 300 symbols maximum.', 'privacore-ssb');
                }
            }

            //Twitter field
            if (isset($postData['pssb_twitter_text'])) {
                if (mb_strlen(stripslashes($postData['pssb_twitter_text'])) <= 116) {
                    update_post_meta($post_id, 'pssb_twitter_text', sanitize_text_field($postData['pssb_twitter_text']));
                } else {
                    $_SESSION['pssb_errors']['pssb_twitter_text_error'] = __('Twitter text length must be 116 symbols maximum.', 'privacore-ssb');
                }
            }

            //Linkedin fields
            if (isset($postData['pssb_linkedin_title'])) {
                if (mb_strlen(stripslashes($postData['pssb_linkedin_title'])) <= 200) {
                    update_post_meta($post_id, 'pssb_linkedin_title', sanitize_text_field($postData['pssb_linkedin_title']));
                } else {
                    $_SESSION['pssb_errors']['pssb_linkedin_title_error'] = __('LinkedIn title length must be 200 symbols maximum.', 'privacore-ssb');
                }
            }

            if (isset($postData['pssb_linkedin_description'])) {
                if (mb_strlen(stripslashes($postData['pssb_linkedin_description'])) <= 256) {
                    update_post_meta($post_id, 'pssb_linkedin_description', sanitize_text_field($postData['pssb_linkedin_description']));
                } else {
                    $_SESSION['pssb_errors']['pssb_linkedin_description_error'] = __('LinkedIn summary length must be 256 symbols maximum.', 'privacore-ssb');
                }
            }

        }

        /**
         * Create Admin Menu
         */
        public function adminMenu()
        {
            //Create plugin options page
            add_options_page(
                __('Privacore SSB Settings', 'privacore-ssb'),
                __('PSSB Settings', 'privacore-ssb'),
                'manage_options',
                'privacore-ssb',
                array($this, 'adminPluginOptionsPage')
            );
        }

        /**
         * Load Privacore SSB settings page
         */
        public function adminPluginOptionsPage()
        {
           echo $this->_loadView('admin-settings-page');
        }
    }
}