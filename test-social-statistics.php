<?php
/* 
 * Social statistics.
 */

//Debug
function vardump($str) {
    var_dump('<pre>');
    var_dump($str);
    var_dump('</pre>');
}

require_once 'class-custom-social-statistics.php';
$def_text = 'Not found';

$shares_counter_custom = new CustomSocialStatistics();

echo '<h1>For example</h1>';

echo '<b>Facebook</b> version #1 (https://www.facebook.com/WordPresscom/) - ';
$fb_page = 'https://www.facebook.com/WordPresscom/';
$fb_app_id = 'YOUR-APP-ID';
$fb_app_secret = 'YOUR-APP-SECRET';
$res = $shares_counter_custom->get_facebook( $fb_page, $fb_app_id, $fb_app_secret );
echo ($res != false) ? number_format($res, 0, ',', ' ').' likes' : $def_text;
echo '<br/>';

echo '<b>Facebook</b> version #2 (https://wordpress.com) - ';
$fb_page = 'https://wordpress.com';
$res = $shares_counter_custom->get_facebook2( $fb_page, $fb_app_id, $fb_app_secret );
echo ($res != false) ? number_format($res, 0, ',', ' ').' likes' : $def_text;
echo '<br/><br/>';
