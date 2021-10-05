<?php
/*
 * Template Name: Example Page Template
 * Template Post Type: post, page, whatever
 */

// ACF Fields
$hero = get_field('hero')['hero'];

get_header();

get_template_part( 'templates/sections/example-template/example-view', null, ['data' => $hero] );

// OR
// get_template_part( 'templates/sections/example-template/example', 'view', ['hero' => $hero] );

get_footer();