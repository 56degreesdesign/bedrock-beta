<?php
function my_acf_init() {	
	acf_update_setting('google_api_key', 'AIzaSyB5jZgAZt-WJhWUPCpAc2WPt9AgGp6ffRU');
}
add_action('acf/init', 'my_acf_init');