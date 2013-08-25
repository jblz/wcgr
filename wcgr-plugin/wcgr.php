<?php

/*
 * Plugin Name: WCGR demo plugin by jblz
 * Plugin URI: http://github.com/jblz/wcgr
 * Description: Plugin that demonstrates concepts discussed at WCGR
 * Author: jblz
 * Version: 0.3
 * Author URI: http://get2see.me
 * License: GPL2+
 */

class WCGR_Demo {
	const VERSION = '0.3';

	static function init() {
		add_action( 'wp_ajax_wcgr_get_data', array( 'WCGR_Demo', 'logged_in_ajax_handler' ) );
		add_action( 'wp_ajax_nopriv_wcgr_get_data', array( 'WCGR_Demo', 'ajax_handler' ) );
		self::enqueue_css_and_js();
	}

	static function enqueue_css_and_js() {
		wp_enqueue_style( 'wcgr-style', plugins_url() . '/wcgr/css/wcgr.css', array(), self::VERSION );
		wp_register_script( 'wcgr-app', plugins_url() . '/wcgr/js/app.js', array( 'jquery', 'underscore' ), self::VERSION, true );
		wp_enqueue_script( 'wcgr-app' );
	}

	static function get_header() {
		$headers = array(
			"That's no moon...",
			"If there's a bright center to the universe, you're on the planet that it's farthest from.",
			"The ability to destroy a planet is insignificant next to the power of the Force.",
			"Where is the rebel base?"
		);

		return $headers[ array_rand( $headers ) ];
	}

	static function get_colors() {
		return array(
			'amethyst' => '#9966CC',
			'blue' => null,
			'cyan' => null,
			'gold' => null,
			'green' => null,
			'orange' => null,
			'red' => null,
			'silver' => null,
			'viridian' => '#40826D',
			'yellow' => null,
		);
	}

	static function get_planets() {
		return array(
			'Alderaan',
			'Bespin',
			'Corellia',
			'Coruscant',
			'Dac',
			'Dantooine',
			'Felucia',
			'Geonosis',
			'Hoth',
			'Kamino',
			'Kashyyyk',
			'Korriban',
			'Manaan',
			'Naboo',
			'Nelvaan',
			'Tatooine',
			'Taris',
		);
	}

	static function logged_in_ajax_handler() {
		self::ajax_handler( array(
			'display_name' => wp_get_current_user()->display_name,
		) );
	}

	static function ajax_handler( $args = array() ) {
		switch( $_GET['key'] ) {
			case 'lightsaber_colors':
				$to_return = self::get_colors();
				break;

			case 'planets':
			default:
				$planets = self::get_planets();
				shuffle( $planets );

				$to_return = array(
					'header'  => self::get_header(),
					'planets' => $planets,
				);

				if ( $args['display_name'] ) {
					$to_return['display_name'] = $args['display_name'];
				}
				break;
		}

		sleep( mt_rand( 1, 4 ) );
		echo json_encode( $to_return );
		die();
	}
}
add_action( 'init', array( 'WCGR_Demo', 'init' ) );
