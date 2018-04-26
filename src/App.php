<?php
namespace dualjack\simple_app\src;

/**
 * Date: 25.04.2018
 * Time: 20:42
 */

use dualjack\simple_app\src\Components\Customizer;
use shellpress\v1_2_1\ShellPress;

class App extends ShellPress {

	/**
	 * Called automatically after core is ready.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		//  ----------------------------------------
		//  Autoloader
		//  ----------------------------------------

		App::s()->autoloading->addNamespace( 'dualjack\simple_app', dirname( App::s()->getMainPluginFile() ) );

		//  ----------------------------------------
		//  Actions
		//  ----------------------------------------

		add_action( 'wp_enqueue_scripts',       array( $this, '_a_enqueueFrontScripts' ) );

		//  ----------------------------------------
		//  Components
		//  ----------------------------------------

		new Customizer( self::s() );

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

}