<?php
namespace dualjack\simple_app\src;

/**
 * Date: 25.04.2018
 * Time: 20:42
 */

use shellpress\v1_2_0\ShellPress;

class App extends ShellPress {

	/**
	 * Called automatically after core is ready.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		//  ----------------------------------------
		//  Actions
		//  ----------------------------------------

		add_action( 'wp_enqueue_scripts',       array( $this, '_a_enqueueFrontScripts' ) );

	}

	//  ================================================================================
	//  ACTIONS
	//  ================================================================================

	/**
	 * Called on wp_enqueue_scripts.
	 */
	public function _a_enqueueFrontScripts() {

		//  Bootstrap

		wp_enqueue_style(
			'simple_app_bootstrap4',
			App::s()->getUrl( 'lib/ShellPress/assets/css/Bootstrap/bootstrap.css' ),
			array(),
			App::s()->getFullPluginVersion()
		);

	}

	//  ================================================================================
	//  FILTERS
	//  ================================================================================

}