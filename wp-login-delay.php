<?php
/*
Plugin Name: Wordpress Login Delay
Plugin URI: http://damoiseau.me
Description: Adds a one second delay to the login to avoid brute-force attack
Version: 1.4
Author: Mike
Author URI: http://damoiseau.me
License: GPL2
*/

/**
 * Settings
 * @see http://codex.wordpress.org/Settings_API
 */
include( dirname( __FILE__ ) . '/wldelay-settings.php' );
if( is_admin() ) {
    $wldelay_settings_page = new WPDelay_Settings();
}

// @see http://codex.wordpress.org/Function_Reference/add_filter
// @see https://codex.wordpress.org/Plugin_API/Filter_Reference/wp_authenticate_user

if( !function_exists( 'wldelay_get_options' ) ) {
	function wldelay_get_options() {
		static $options = null;

		if( empty( $options ) ) {
			$options = get_option( 'wldelay_options' );
		}

		return $options;
	}
}

if( !function_exists( 'wldelay_get_delay_value' ) ) {
	function wldelay_get_delay_value() {

		$options = wldelay_get_options();

		$useRandomDelay = $options['wldelay_delay_random'];
		if( $useRandomDelay ) {
			$delay = rand( 1, 5 ); // @todo add a setting
		} else {
			$delay = $options['wldelay_delay'];
		}

		return $delay;
	}
}

if( !function_exists( 'wldelay_auth_login' ) ) {
    function wldelay_auth_login ($user, $password) {
		$delay = wldelay_get_delay_value();


        // get_option returns FALSE if the option is not set in the database
        // then we should use the default delay value set in WPDelay_Settings
        if( ( FALSE !== $delay['wldelay_delay'] ) && isset( $delay['wldelay_delay'] ) ){
            $delay = $delay['wldelay_delay'];
        } else {
            $delay = WPDelay_Settings::_DEFAULT_DELAY_IN_SECONDS;
        }

        sleep( $delay );

        return $user;
    }
    add_filter('wp_authenticate_user', 'wldelay_auth_login',1, 2);
}

