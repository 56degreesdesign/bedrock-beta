<?php
// Create Shortcode button
// Shortcode: [button label="Learn More" url="https://google.com" new_tab="no"]

// function create_button_shortcode($atts) {

// 	$atts = shortcode_atts(
// 		array(
// 			'label' => 'Learn More',
// 			'url' => 'https://google.com',
// 			'new_tab' => 'no',
// 		),
// 		$atts,
// 		'button'
// 	);

// 	$label = $atts['label'];
// 	$url = $atts['url'];
// 	$new_tab = $atts['new_tab'];
//     $target = ($atts['new_tab'] != 'no') ? 'target="_blank" rel="noopener noreferrer"' : null; 
	
//     $html = '<a class="btn" href="'.$url.'" '.$target.'>';
//     $html .= '<span>'.$label.'</span>';
//     $html .=  '<svg xmlns="http://www.w3.org/2000/svg" width="34.4" height="13.322"><path data-name="Path 195" d="M27.546.354l6.148 6.148-6.467 6.467m6.467-6.467H0" fill="none" stroke="#fff" stroke-miterlimit="10"/></svg>';
//     $html .= '</a>';

//     return $html;
// }
// add_shortcode( 'button', 'create_button_shortcode' );

// Year Shortcode
function year_shortcode() {
	return date( "Y" );
}
add_shortcode( 'year', 'year_shortcode' );