<?php

/**
 * Created by PhpStorm.
 * User: Miroslav Marinov
 * Date: 2.3.2016
 * Time: 10:18
 */

if (!class_exists('PrivacoreSSBFrontend')) {

    class PrivacoreSSBFrontend extends PrivacoreSSBBase
    {
        public function __construct()
        {
            parent::__construct();

            if (!is_admin()) {
                add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
                add_shortcode('privacore-ssb-sc', array($this, 'pssbShortcode'));
            }

            if (esc_attr(get_option('pssb_display_auto')) == 1) {
                add_filter('the_content', array($this, 'showButtonsPublic'));
                add_action('wp_head', array($this, 'addMetaTwitterCards'));
            }
        }

        /**
         * Enqueue Scripts
         */
        public function enqueueScripts()
        {
            wp_enqueue_style('pssb-frontend-style', plugin_dir_url(dirname(__FILE__)) . 'assets/styles/front-pssb.css');
        }
        public function addMetaTwitterCards(){
            global $post;

            $description = get_post_meta($post->ID, 'pssb_twitter_text', true);
            $title = get_post_meta($post->ID, 'pssb_twitter_title', true) != '' ? get_post_meta($post->ID, 'pssb_twitter_title', true) : mb_substr(get_the_title($post->ID), 0, 70);
            $image = get_post_meta($post->ID, 'pssb_image', true);
            $typeOfTwitterCard = get_post_meta($post->ID, 'pssb_twitter_card', true);
            $twiterCard = 'summary';
            if ($typeOfTwitterCard == 2) {
                $twiterCard = 'summary_large_image';
            }
            if ($typeOfTwitterCard != 0) {
                echo "\t<meta name='twitter:card' content='$twiterCard' />\n";
                echo "\t<meta name='twitter:site' content='@privacore' />\n";
                echo "\t<meta name='twitter:title' content='$title' />\n";
                echo "\t<meta name='twitter:description' content='$description' />\n";
                echo "\t<meta name='twitter:image' content='$image' />\n";
            }

        }

        /**
         * Generate buttons data
         *
         * @param bool $isShortcode
         * @return array
         */
        private function _pssbButtonsData($isShortcode = false)
        {
            global $post;

            $data = array();

            //Make this check only if function is not called from shotcode function
            if ($isShortcode = true) {
                $displayOnPage = get_post_meta($post->ID, 'pssb_show_on_page', true);

                if ($displayOnPage == 0) {
                    $data['hide_on_page'] = true;

                    return $data;
                }
            }

            $excerpt = $this->getPostExcerptById($post->ID);

            $data['plugin_url'] = PSSB_PLUGIN_URL;
            $data['post_url'] = get_permalink($post->ID);

            //Fields
            $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            $data['social_image'] = get_post_meta($post->ID, 'pssb_image', true) != '' ? get_post_meta($post->ID, 'pssb_image', true) : $post_thumbnail[0];

            //Twitter field
            $data['twitter_text'] = get_post_meta($post->ID, 'pssb_twitter_text', true) != '' ? get_post_meta($post->ID, 'pssb_twitter_text', true) : mb_substr($excerpt, 0, 117);

            //LinkedIn fields
            $data['linkedin_title'] = get_post_meta($post->ID, 'pssb_linkedin_title', true) != '' ? get_post_meta($post->ID, 'pssb_linkedin_title', true) : mb_substr(get_the_title($post->ID), 0, 200);
            $data['linkedin_summary'] = get_post_meta($post->ID, 'pssb_linkedin_description', true) != '' ? get_post_meta($post->ID, 'pssb_linkedin_description', true) : mb_substr($excerpt, 0, 257);

            //Facebook fields
            $data['facebook_title'] = get_post_meta($post->ID, 'pssb_facebook_title', true) != '' ? get_post_meta($post->ID, 'pssb_facebook_title', true) : mb_substr(get_the_title($post->ID), 0, 100);
            $data['facebook_description'] = get_post_meta($post->ID, 'pssb_facebook_description', true) != '' ? get_post_meta($post->ID, 'pssb_facebook_description', true) : mb_substr($excerpt, 0, 301);



            return $data;
        }

        /**
         * Generate Social buttons view
         *
         * @return string
         */
        private function _getRenderedView()
        {
            $data = $this->_pssbButtonsData();
			if(!$data['hide_on_page']){
                return $this->_loadView('front-buttons', $data);
            }
        }

        /**
         * Display Social Media Share buttons after post/page content
         * @param $content
         * @return string
         */
        public function showButtonsPublic($content)
        {
            if (is_single() || is_page()) {
                $content .= $this->_getRenderedView();
            }
            return $content;
        }




        /**
         * Create Privacore SSB buttons shortcode
         * @return string
         */
        public function pssbShortcode()
        {
            $data = $this->_pssbButtonsData(true);
			if(!$data['hide_on_page']){
				//use different view file for shortcode
				return $this->_loadView('shortcodes/buttons-sc', $data);
			}
        }
    }

}