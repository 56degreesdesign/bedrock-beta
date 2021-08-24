<?php

use FsDegreesTheme\AssetResolver;

add_action( 'wp_enqueue_scripts', function () {
	// CSS and JS Auto Versions
	$ctime = filemtime(get_template_directory() . '/build/css/app.css' );
	$jtime = filemtime(get_template_directory() . '/build/js/app.js' );
	// registers scripts and stylesheets
	wp_register_style( 'app', AssetResolver::resolve( 'css/app.css' ), [], $ctime );
	wp_register_script( 'app', AssetResolver::resolve( 'js/app.js' ), [], $jtime, true );

	// enqueue global assets
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'app' );
	wp_enqueue_script( 'app' );

} );