<?php
//  ----------------------------------------
//  Requirements
//  ----------------------------------------

use dualjack\simple_app\src\App;

require dirname( __FILE__ ) . '/lib/ShellPress/src/Shared/Utility/RequirementChecker.php';

$requirementChecker = new ShellPress_RequirementChecker();

$checkPHP   = $requirementChecker->checkPHPVersion( '5.3' );
$checkWP    = $requirementChecker->checkWPVersion( '4.7' );

if( ! $checkPHP || ! $checkWP ){

	if( ! is_admin() ) wp_die( 'Requirements for theme are not fed!' );

	return;

}

//  ----------------------------------------
//  ShellPress
//  ----------------------------------------

require_once( __DIR__ . '/lib/ShellPress/ShellPress.php' );
require_once( __DIR__ . '/src/App.php' );

App::initShellPress( __FILE__, 'simple_app', '1.0.0' );   //  <--- Remember to always change version here