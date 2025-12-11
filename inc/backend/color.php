<?php 


//Custom Style Frontend
if(!function_exists('xconnect_color_scheme')){
    function xconnect_color_scheme(){
	  	$color_scheme = '';

	  	// Get theme options with fallbacks
		$primary_color      = xconnect_get_option('primary_color', '#eb6c56');
		$secondary_color    = xconnect_get_option('secondary_color', '#f6f6f6');
		$text_color         = xconnect_get_option('text_color', '#000000BF');
		$accent_color       = xconnect_get_option('accent_color', '#3b3b5b');
		$heading_color      = xconnect_get_option('heading_color', '#3b3b5b');
		$white_color        = xconnect_get_option('white_color', '#FFFFFF');
		$divider_color      = xconnect_get_option('divider_color', '#FFFFFF14');
		$dark_divider_color = xconnect_get_option('dark_divider_color', '#3835373b'); // example fallback


		// Ensure variables have values (use fallbacks if empty)
        $primary_color      = !empty($primary_color) ? $primary_color : '#eb6c56';
        $secondary_color    = !empty($secondary_color) ? $secondary_color : '#f6f6f6';
        $text_color         = !empty($text_color) ? $text_color : '#000000BF';
        $accent_color       = !empty($accent_color) ? $accent_color : '#3b3b5b';
        $heading_color      = !empty($heading_color) ? $heading_color : '#3b3b5b';
        $white_color        = !empty($white_color) ? $white_color : '#FFFFFF';
        $divider_color      = !empty($divider_color) ? $divider_color : '#FFFFFF14';
        $dark_divider_color = !empty($dark_divider_color) ? $dark_divider_color : '#3835373b';

        // === Font Options ===
        $body_typo   = xconnect_get_option('body_typo', []);
        $second_font = xconnect_get_option('second_font', []);

        $body_font_family   = !empty($body_typo['font-family']) ? $body_typo['font-family'] : 'Inter';
        $second_font_family = !empty($second_font['font-family']) ? $second_font['font-family'] : 'Belleza';

		// Output variables inside :root
		$color_scheme .= "
		:root {
		    --primary-color: {$primary_color};
		    --secondary-color: {$secondary_color};
		    --text-color: {$text_color};
		    --accent-color: {$accent_color};
		    --heading-color: {$heading_color};
		    --white-color: {$white_color};
		    --divider-color: {$divider_color};
		    --dark-divider-color: {$dark_divider_color};
		    /* Typography Variables */
            --font-body: '{$body_font_family}';
            --font-second: '{$second_font_family}';
		}
		";

		// Print CSS
		if( !empty($color_scheme) ){
		    echo '<style type="text/css">'.$color_scheme.'</style>';
		}


    }
}
add_action('wp_head', 'xconnect_color_scheme');


// Custom Body Font Variable
if (!function_exists('xconnect_body_font')) {
    function xconnect_body_font() {

        $body_typo = xconnect_get_option('body_typo', []);
        $body_font_family = !empty($body_typo['font-family']) ? $body_typo['font-family'] : 'Open Sans';

        $css = "
        :root {
            --font-body: '{$body_font_family}';
        }
        ";

        echo '<style type="text/css">'.$css.'</style>';
    }
}
add_action('wp_head', 'xconnect_body_font');


// Custom Second Font Variable
if (!function_exists('xconnect_second_font')) {
    function xconnect_second_font() {

        $second_font = xconnect_get_option('second_font', []);
        $second_font_family = !empty($second_font['font-family']) ? $second_font['font-family'] : 'DM Sans';

        $css = "
        :root {
            --font-second: '{$second_font_family}';
        }
        ";

        echo '<style type="text/css">'.$css.'</style>';
    }
}
add_action('wp_head', 'xconnect_second_font');
