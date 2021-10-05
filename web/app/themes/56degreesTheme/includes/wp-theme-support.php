<?php
/* Disable the Gutenberg editor. */
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/* Hide Front-end Admin Bar. */
add_filter('show_admin_bar', '__return_false');

/* Theme Supports. */
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_filter( 'xmlrpc_enabled', '__return_false' );
remove_filter( 'the_excerpt', 'wpautop' );

/* Theme Menus. */
function register_fs_menus() {
	register_nav_menus(
	  array(
		'fs_nav_menu' => __( 'Navbar Main Menu' ),
		'fs_footer_menu' => __( 'Footer Main Menu' )
	   )
	 );
   }
add_action( 'init', 'register_fs_menus' );

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

/* Remove WP Revisions */
function fsdegrees_disable_post_revisions() {
    foreach ( get_post_types() as $post_type ) {
        remove_post_type_support( $post_type, 'revisions' );
    }
}
add_action( 'init', 'fsdegrees_disable_post_revisions', 999 );

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
   }
   
   add_action( 'init', 'disable_emojis' );
   
   /**
    * Filter function used to remove the tinymce emoji plugin.
    * 
    * @param array $plugins 
    * @return array Difference betwen the two arrays
    */
   function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
   }
   
   /**
    * Remove emoji CDN hostname from DNS prefetching hints.
    *
    * @param array $urls URLs to print for resource hints.
    * @param string $relation_type The relation type the URLs are printed for.
    * @return array Difference betwen the two arrays.
    */
   function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
   
   $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
   
   return $urls;
   }

   // Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
  }
  add_action( 'admin_head', 'fix_svg' );