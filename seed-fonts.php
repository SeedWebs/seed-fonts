<?php
/*
Plugin Name: Seed Fonts
Plugin URI: https://github.com/SeedThemes/seed-fonts
Description: Custom font-face fonts with generated free Thai fonts on fonts.SeedThemes.com.
Version: 0.5.0
Author: Seed Themes
Author URI: http://www.seedthemes.com
License: GPL2
*/

/*
Copyright 2016 SeedThemes  (email : info@seedthemes.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!class_exists('Seed_Fonts'))
{
    class Seed_Fonts
    {
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
        } // END public function __construct
    
        /**
         * Activate the plugin
         */
        public static function activate()
        {
            // Do nothing
        } // END public static function activate

		public static $fonts = array	(
							"boon" => array (
										"font-family" => "boon",
										"css" => "https://fonts.seedthemes.com/boon/fonts.css"
									),
							"cs_prajad" => array (
										"font-family" => "cs_prajad",
										"css" => "https://fonts.seedthemes.com/cs_prajad/fonts.css"
									),
							"supermarket" => array (
										"font-family" => "supermarket",
										"css" => "https://fonts.seedthemes.com/supermarket/fonts.css"
									),
							"thaisans_neue" => array (
										"font-family" => "thaisans_neue",
										"css" => "https://fonts.seedthemes.com/thaisans_neue/fonts.css"
									)							
						);


        /**
         * Deactivate the plugin
         */     
        public static function deactivate()
        {
            // Do nothing
        } // END public static function deactivate
    } // END class Seed_Fonts
} // END if(!class_exists('Seed_Fonts'))

if(class_exists('Seed_Fonts'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Seed_Fonts', 'activate'));
    register_deactivation_hook(__FILE__, array('Seed_Fonts', 'deactivate'));

    // instantiate the plugin class
    $seed_fonts = new Seed_Fonts();
}

	add_action( 'wp_enqueue_scripts', 'seed_fonts_scripts' );

	function seed_fonts_scripts() {
		if( ! is_admin() ) {
			wp_enqueue_script( 'seed-fonts', plugin_dir_url( __FILE__ ) . '/seed-fonts.js' , array('jquery'), '2016-1', true );
			wp_enqueue_style( 'seed-fonts', plugin_dir_url( __FILE__ ) . '/seed-fonts.css' , array() );

			$font_selected = get_option( 'seed_fonts_font_selected' );
	
			if( $font_selected != '') {
					$font_styles = 'h1,h2,h3,h4,h5,h6,._heading {
					font-family: "'.$font_selected.'",  sans-serif;
					font-weight: 300;
				}';

				wp_enqueue_style( 'seed-fonts-selected', Seed_fonts::$fonts[$font_selected]['css'] , array() );
				wp_add_inline_style( 'seed-fonts-selected', $font_styles );
			}
		}
	}

	add_action( 'admin_menu', 'seed_fonts_setup_menu' );

	function seed_fonts_setup_menu() {
		$seed_font_page = add_menu_page ( 'Seed Themes', 'Seed Fonts', 'manage_options', 'seed-fonts', 'seed_fonts_init' );

		add_action( 'load-' . $seed_font_page, 'seed_fonts_admin_styles' );
	}

	function seed_fonts_admin_styles() {
		foreach( Seed_fonts::$fonts as $_font ):
			wp_enqueue_style( 'seed-fonts-'.$_font["font-family"], $_font["css"] , array() );
		endforeach;

		wp_enqueue_style( 'seed-fonts-admin', plugin_dir_url( __FILE__ ) . '/seed-fonts-admin.css' , array() );
	}

	function seed_fonts_init() {
		$font_selected = get_option( 'seed_fonts_font_selected' );

		echo '<h1>Seed Fonts</h1>';

		echo '<form id="seed-fonts-selector" method="post" name="seed_fonts_selector_form" action="'.get_bloginfo( 'url' ).'/wp-admin/admin-post.php" >';

		foreach( Seed_fonts::$fonts as $_font ):
			echo '<input type="radio" name="seed_fonts_selector" id="font_'.$_font['font-family'].'" value="'.$_font['font-family'].'" '.(($font_selected == $_font['font-family']) ? ' checked="checked"' : '').' />';
			echo '<h2 class="'.$_font["font-family"].'">'.$_font["font-family"].' AaBbCcDd 1 2 3 4 5 6 7 8 9 0</h2>';
		endforeach;

		echo '<input type="hidden" name="action" value="seed_fonts_save_options" />';
		echo '<input type="submit" />';

		echo '</form>';
	}

	add_action( 'admin_post_seed_fonts_save_options', 'seed_fonts_save' );

	function seed_fonts_save() {
		update_option( 'seed_fonts_font_selected' , $_POST['seed_fonts_selector'] );

		header("Location: admin.php?page=seed-fonts&saved=true");
	}

	function seed_fonts( ) {
	}