<?php
// $hero = get_field('hero')['hero'];
$hero = 'Heading';

get_header();

get_template_part( 'templates/sections/home/intro', null, ['data' => $hero] );
get_template_part( 'templates/sections/home/vue', 'component' );
//get_auto_sections('sections', '/templates/sections');

get_footer();