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

		add_action( 'after_setup_theme',    array( $this, '_a_initThemeSupport' ) );

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

}