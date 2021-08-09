<?php
/* Disable the Gutenberg editor. */
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/* Theme Supports. */
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_filter( 'the_excerpt', 'wpautop' );

/* Theme Menus. */
register_nav_menu('fs_nav_menu', 'Navbar Main Menu');

/* Images Sizes. */
add_image_size( 'largeRetina', 2048, 0, true );
add_image_size( 'placeholder', 150, 0, true );

/* Hide ACF if it's not fsDegrees. */
function hide_acf_menu() {
	$current_user = wp_get_current_user();
	if($current_user->ID != '1') {
		remove_menu_page('edit.php?post_type=acf-field-group');
	}
}
add_action('admin_menu', 'hide_acf_menu', 100);

/* Add custom logo in wp-admin */
function fsdegrees_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'fsdegrees_login_logo_url' );

function fsdegrees_login_logo_url_title() {
    return the_title();
}
add_filter( 'login_headertitle', 'fsdegrees_login_logo_url_title' );

function fsdegrees_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-file.svg);
			-webkit-background-size: contain;
         	-moz-background-size: contain;
            -o-background-size: contain;
			background-size: contain;
			background-repeat: no-repeat;
			height: 80px;
			width: 320px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'fsdegrees_login_logo' );

/* Remove Admin Menu Link to Theme Customizer */
add_action( 'admin_menu', function () {
    global $submenu;

    if ( isset( $submenu[ 'themes.php' ] ) ) {
        foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
            if ( in_array( 'customize', $menu_item ) ) {
                unset( $submenu[ 'themes.php' ][ $index ] );
            }
        }
    }
});

function remove_menus(){
  	remove_menu_page( 'edit-comments.php' );  
}

add_action( 'admin_menu', 'remove_menus' );

/* Remove Unwanted WP Markup */
add_action('init', 'fsdegrees_init_actions');
function fsdegrees_init_actions() {
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_action( 'wp_head', 'feed_links_extra', 3);
	remove_action( 'wp_head', 'feed_links', 2);
	remove_action( 'wp_head', 'rsd_link');
	remove_action( 'wp_head', 'wlwmanifest_link');
	remove_action( 'wp_head', 'index_rel_link');
	remove_action( 'wp_head', 'parent_post_rel_link', 10 ,0);
	remove_action( 'wp_head', 'start_post_rel_link', 10 ,0);
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action( 'wp_head', 'wp_generator');
	remove_action( 'wp_head', 'rel_canonical');

	add_rewrite_rule(
		'^search\/([^\/]+)(\/in\/([^\/]+))?(\/page\/([^\/]+))?\/?$',
		'index.php?s=$matches[1]&sin=$matches[3]&paged=$matches[5]',
		'top' );		
}