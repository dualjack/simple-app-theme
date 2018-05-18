<?php

new SimpleAppTheme();

class SimpleAppTheme {

	const NAME = 'simple-app-theme';

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
		add_filter( 'upgrader_source_selection',                array( $this, '_f_renameGitHubZipFile' ) );

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
	 * Adds custom theme update info data from github repository.
	 *
	 * @param object $transient
	 *
	 * @internal
	 *
	 * @return object
	 */
	public function _f_addUpdateInfoToThemeTransient( $transient ) {

		if( ! isset( $transient->response ) ) return $transient;                        //  Check, if we have an array set. Sometimes there are errors.
		if( isset( $transient->response[ $this::NAME ] ) ) return $transient;           //  Do not fire remote check version twice.

		//  ----------------------------------------
		//  Prepare data for request
		//  ----------------------------------------

		if( ! function_exists( 'wp_get_theme' ) ){  //  Sometimes this function is called in wrong places.
			return $transient;
		}

		$theme = wp_get_theme();    /** @var WP_Theme $theme */

		//  ----------------------------------------
		//  Make request
		//  ----------------------------------------

		$response       = wp_remote_get( 'https://raw.githubusercontent.com/dualjack/simple-app-theme/master/updates.json' );
		$responseBody   = wp_remote_retrieve_body( $response );
		$responseCode   = wp_remote_retrieve_response_code( $response );

		if( ! is_wp_error( $response ) && $responseCode === 200 ){

			$encoded = (array) json_decode( $responseBody, true );

			if( $encoded && isset( $encoded['new_version'] ) && version_compare( $encoded['new_version'], $theme->get( 'Version' ), '>' ) ){

				$transient->response[ $this::NAME ] = $encoded;

			} else {

				unset( $transient->response[ $this::NAME ]);

			}

		}

		return $transient;

	}

	/**
	 * GitHub provides releases as zipped directory with tag version suffix.
	 * This method removes it.
	 *
	 * @param $source
	 *
	 * @return string
	 */
	public function _f_renameGitHubZipFile( $source ) {

		if( strpos( $source, $this::NAME ) === false ) return $source;  //  Are we talking about this theme?

		$newSource  = trailingslashit( dirname( $source ) ) . trailingslashit( $this::NAME );
		$result     = rename( $source, $newSource );

		return $result ? $newSource : $source;

	}

}