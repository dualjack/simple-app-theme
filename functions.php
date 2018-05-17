<?php

new SimpleAppTheme();

class SimpleAppTheme {

	/**
	 * SimpleAppTheme constructor.
	 */
	public function __construct() {

		//  ----------------------------------------
		//  Actions
		//  ----------------------------------------

		add_action( 'after_setup_theme',                        array( $this, '_a_initThemeSupport' ) );

		//  ----------------------------------------
		//  Filters
		//  ----------------------------------------

		add_filter( 'pre_set_site_transient_update_themes',     array( $this, '_f_addUpdateInfoToThemeTransient' ) );

	}

	//  ================================================================================
	//  ACTIONS
	//  ================================================================================

	/**
	 * Called on after_setup_theme.
	 */
	public function _a_initThemeSupport() {

		add_theme_support( 'title-tag' );

	}

	//  ================================================================================
	//  FILTERS
	//  ================================================================================

	/**
	 * @param object $transient
	 *
	 * @internal
	 *
	 * @return object
	 */
	public function _f_addUpdateInfoToThemeTransient( $transient ) {

		if( ! isset( $transient->response ) ) return $transient;    //  Check, if we have an array set. Sometimes there are errors.

		//  ----------------------------------------
		//  Prepare data for request
		//  ----------------------------------------

		if( ! function_exists( 'wp_get_theme' ) ){  //  Sometimes this function is called in wrong places.
			return $transient;
		}

		$theme = wp_get_theme();    /** @var WP_Theme $theme */

		$basename = 'simple-app-theme';
		$version = $theme->get( 'Version' );

		//  ----------------------------------------
		//  Make request
		//  ----------------------------------------

		$response       = wp_remote_get( 'https://raw.githubusercontent.com/dualjack/simple-app-theme/master/updates.json' );
		$responseBody   = wp_remote_retrieve_body( $response );
		$responseCode   = wp_remote_retrieve_response_code( $response );

		if( ! is_wp_error( $response ) && $responseCode === 200 ){

			$encoded = (array) json_decode( $responseBody, true );

			if( $encoded && isset( $encoded['new_version'] ) && version_compare( $encoded['new_version'], $version, '>' ) ){

				$transient->response[ $basename ] = $encoded;

			} else {

				unset( $transient->response[ $basename ]);

			}

		}

		return $transient;

	}

}