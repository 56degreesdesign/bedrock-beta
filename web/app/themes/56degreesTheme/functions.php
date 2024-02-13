<?php

use FsDegreesTheme\AutoLoader;
use FsDegreesTheme\View;

/*
 * Set up our auto loading class and mapping our namespace to the app directory.
 *
 * The autoloader follows PSR4 autoloading standards so, provided StudlyCaps are used for class, file, and directory
 * names, any class placed within the app directory will be autoloaded.
 *
 * i.e; If a class named SomeClass is stored in app/SomeDir/SomeClass.php, there is no need to include/require that file
 * as the autoloader will handle that for you.
 */
require get_stylesheet_directory() . '/app/AutoLoader.php';
$loader = new AutoLoader();
$loader->register();
$loader->addNamespace( 'FsDegreesTheme', get_stylesheet_directory() . '/app' );

View::$view_dir = get_stylesheet_directory() . '/templates/views';

// require get_stylesheet_directory() . '/includes/utils/post-types/post-name.php';
// require get_stylesheet_directory() . '/includes/utils/taxonomies/taxonomy-name.php';

require get_stylesheet_directory() . '/includes/utils/cf7-button.php';
require get_stylesheet_directory() . '/includes/utils/acf-options.php';
require get_stylesheet_directory() . '/includes/utils/google-maps-api.php';
require get_stylesheet_directory() . '/includes/utils/shortcodes.php';
require get_stylesheet_directory() . '/includes/utils/svg.php';

require get_stylesheet_directory() . '/includes/scripts-and-styles.php';
require get_stylesheet_directory() . '/includes/wp-theme-support.php';
require get_stylesheet_directory() . '/includes/api.php';