<?php

/**
 * Created by PhpStorm.
 * User: Miroslav Marinov
 * Date: 2.3.2016
 * Time: 10:04
 */

if (!class_exists('PrivacoreSSBBase')) {
    class PrivacoreSSBBase
    {

        public function __construct()
        {
            //Admin Hooks
            if (is_admin()) {
                //set admin notices
                add_action('admin_notices', array($this, 'errorMessage'));
            }

        }

        /**
         * Create loading view functionality
         *
         * @param $viewName
         * @param array $data
         * @return string
         */
        protected function _loadView($viewName, $data = array())
        {
            //extract data
            extract($data);

            //Extract error messages if exists
            if (isset($_SESSION['pssb_errors'])) {
               extract($_SESSION['pssb_errors']);
            }
            ob_start( );
            include_once(PSSB_PLUGIN_PATH . 'views/' . $viewName . '.php');
            $buffer = ob_get_contents();
            ob_end_clean();
            return $buffer;
        }

        /**
         * Display error message
         */
        public function errorMessage()
        {
            if (!(isset($_SESSION['pssb_errors']) && count($_SESSION['pssb_errors']) > 0)) {
                return;
            }

            $data['notice_class'] = 'notice notice-error is-dismissible pssb-error-notice';
            $data['notice_message'] = __('Privacore SSB validation errors appeared!', 'privacore-ssb');
           echo  $this->_loadView('partials/notice', $data);
        }

        /**
         *
         * Get post excerpt by post ID.
         *
         * @param $post_id
         * @return mixed|string
         */
        public function getPostExcerptById($post_id)
        {
            global $post;

            $old_post = $post;
            if ($post_id != $post->ID) {
                $post = get_page($post_id);
            }

            if (!$excerpt = trim($post->post_excerpt)) {
                $excerpt = $post->post_content;
                $excerpt = strip_shortcodes($excerpt);

                $excerpt = str_replace(']]>', ']]&gt;', $excerpt);
                $excerpt = strip_tags($excerpt);
                $excerpt_length = apply_filters('excerpt_length', 55);

                $words = preg_split("/[\n\r\t ]+/", $excerpt, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);

                if (count($words) > $excerpt_length) {
                    array_pop($words);
                    $excerpt = implode(' ', $words);
                    $excerpt = $excerpt;
                } else {
                    $excerpt = implode(' ', $words);
                }
            }

            $post = $old_post;

            return $excerpt;
        }
    }

}

