<?php

use FsDegreesTheme\AssetResolver;

add_action( 'wp_enqueue_scripts', function () {
	// CSS and JS Auto Versions
	$ctime = filemtime(get_template_directory() . '/build/css/app.css' );
	$jtime = filemtime(get_template_directory() . '/build/js/app.js' );
	// registers scripts and stylesheets
	wp_register_style( 'app', AssetResolver::resolve( 'css/app.css' ), [], $ctime );
	wp_register_script( 'app', AssetResolver::resolve( 'js/app.js' ), [], $jtime, true );

    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'global-styles' );

	// enqueue global assets
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'app' );
	wp_enqueue_script( 'app' );

} );

function defer_parsing_of_js( $tag, $handle, $src ) {
    $excluded_urls = [
        'wp-includes/js/dist/hooks.min.js',
        'contact-form-7/includes/js/index.js',
        'recaptcha',
    ];

    if (is_admin()) {
        return $tag;
    }

    foreach ($excluded_urls as $url) {
        if (strpos($src, $url) !== false) {
            return $tag;
        }
    }

    return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
}

add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10, 3 );
