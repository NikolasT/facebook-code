<?php

class CustomSocialStatistics {

	private $timeout;

	public function __construct( $timeout = 60 ) {
		$this->timeout = $timeout;
	}

	/**
	 * Returns the number of shares on Facebook
	 * @return string|boolean
	 */
        function get_facebook( $facebook_page_id, $fb_app_id, $fb_app_secret ){
            if( ! $facebook_page_id || ! $fb_app_id || ! $fb_app_secret ){
                return false;
            }
            $access_token = $this->get_fb_access_token( $fb_app_id, $fb_app_secret );

            $api_url = 'https://graph.facebook.com/v2.8/';
            $url = sprintf(
                    '%s%s?fields=fan_count&%s',
                    $api_url,
                    $facebook_page_id,
                    $access_token
            );

            $connection = file_get_contents($url);
            $response = json_decode($connection, true);

            return $response != false ? $response['fan_count'] : 0;
        }
        /* Version #2 */
        function get_facebook2( $facebook_page_id, $fb_app_id, $fb_app_secret ){
            if( ! $facebook_page_id || ! $fb_app_id || ! $fb_app_secret ){
                return false;
            }
            $access_token = $this->get_fb_access_token( $fb_app_id, $fb_app_secret );

            $api_url = 'https://graph.facebook.com/?ids=';
            $url = sprintf(
                    '%s%s&fields=id,share,og_object{engagement,comments.limit(0).summary(true),likes.limit(0).summary(true)}&%s',
                    $api_url,
                    $facebook_page_id,
                    $access_token
            );

            $connection = file_get_contents($url);
            $response = json_decode($connection, true);

            return $response != false ? $response[$facebook_page_id]['share']['share_count'] : 0;
        }
        
        /**
        * Get Facebook Access Token
        * */
        private function get_fb_access_token( $fb_app_id, $fb_app_secret ){
            $api_url = 'https://graph.facebook.com/';
            $url = sprintf(
                            '%soauth/access_token?client_id=%s&client_secret=%s&grant_type=client_credentials',
                            $api_url,
                            $fb_app_id,
                            $fb_app_secret
            );
            $json_string = file_get_contents($url);
            return $json_string != false ? $json_string : '';
        }
}