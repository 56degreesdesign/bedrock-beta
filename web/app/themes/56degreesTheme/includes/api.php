<?php
// Route for All posts
add_action( 'rest_api_init', 'all_posts_route' );

function all_posts_route() {
    register_rest_route( 'FsDegreesTheme', '/all_posts', array(
        'methods'  => 'GET',
        'callback' => 'posts_endpoint',
    ) );
}

function posts_endpoint($data) {
    $args_query = array(
        'post_type' => array('post'),
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'order' => 'DESC',
        'orderby' => 'menu_order'
    );

    $query = new WP_Query( $args_query );

    $posts = array();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $item = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'link' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(),
                'content' => get_the_excerpt(),
            );
            $posts[] = $item;
        }
    }

    $response = $posts;

    return rest_ensure_response( $response );
}
