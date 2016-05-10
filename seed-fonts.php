<?php
/*
Plugin Name: Seed Fonts
Plugin URI: https://www.seedthemes.com/plugin/seed-fonts
Description: Enable web fonts on Appearance -> Fonts. You can add more by <a href="https://github.com/SeedThemes/seed-fonts" target="_blank">uploading your web fonts to the theme folder</a>.
Version: 0.9.6
Author: SeedThemes
Author URI: https://www.seedthemes.com
License: GPL2
Text Domain: seed-fonts
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

        public static $fonts = array (
        	"athiti" => array(
        		"font" => "Athiti",
        		"weights" => array( 500, 600)
        		),
        	"Kanit" => array(
        		"font" => "Kanit",
        		"weights" => array( 300, 400, 500 )
        		),
        	"mitr" => array(
        		"font" => "Mitr",
        		"weights" => array( 300, 400, 500 )
        		),
        	"prompt" => array(
        		"font" => "Prompt",
        		"weights" => array( 400, 500, 600 )
        		),
        	"TH-Sarabun-New" => array(
				"font" => "TH Sarabun New",
        		"weights" => array( 400, 700 )
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

add_action( 'wp_enqueue_scripts', 'seed_fonts_scripts', 30 );

function seed_fonts_scripts() {
	if( ! is_admin() ) {
		$is_enabled = ( get_option( 'seed_fonts_is_enabled' ) );
		$font = get_option( 'seed_fonts_font' );
		$weight = get_option( 'seed_fonts_weight' );
		$selectors = get_option( 'seed_fonts_selectors' );
		$is_important = ( get_option( 'seed_fonts_is_important' ) );


		if( $is_enabled && ( $font !== FALSE ) && ( $font != '' ) ) {
			if( $selectors != '' )
				$font_styles = $selectors.' ';

			$font_styles .= '{font-family: "'.$font.'",  sans-serif'.( $is_important ? ' !important' : '' ).';';
			if( $weight != '' )
				$font_styles .= ' font-weight: '.$weight.( $is_important ? ' !important' : '' ).';';
			$font_styles .= ' }';

			if( file_exists( get_stylesheet_directory() . '/vendor/fonts' ) && is_dir( get_stylesheet_directory() . '/vendor/fonts' ) ) {
				wp_enqueue_style( 'seed-fonts-all', get_stylesheet_directory_uri() . '/vendor/fonts/' . $font . '/font.css' , array(  ) );
			} else {
				wp_enqueue_style( 'seed-fonts-all', plugin_dir_url( __FILE__ ) . 'fonts/' . $font . '/font.css' , array(  ) );
			}

			wp_add_inline_style( 'seed-fonts-all', $font_styles );
		}
	}
}

add_filter( 'body_class', 'seed_fonts_body_class' );

function seed_fonts_body_class( $classes ) {
	$is_enabled = get_option( 'seed_fonts_is_enabled' );
	$font = get_option( 'seed_fonts_font' );
	$weight = get_option( 'seed_fonts_weight' );

	if( $font === FALSE )
		$font = key ( Seed_fonts::$fonts );

	if( $weight === FALSE )
		$weight = '';

	if( $is_enabled ) {
		$classes[] = 'seed-fonts-'.$font;

		if( $weight != '' )
			$classes[] = 'seed-fonts-weight-'.$weight;
	}

	return $classes;
}

add_action( 'admin_menu', 'seed_fonts_setup_menu' );

function seed_fonts_setup_menu() {
	$seed_font_page = add_submenu_page ( 'themes.php', __( 'Seed Fonts', 'seed-fonts' ), __( 'Fonts', 'seed-fonts' ), 'manage_options', 'seed-fonts', 'seed_fonts_init' );

	add_action( 'load-' . $seed_font_page, 'seed_fonts_admin_styles' );
}

function seed_fonts_admin_styles() {
//		foreach( Seed_fonts::$fonts as $_font ):
//			wp_enqueue_style( 'seed-fonts-'.$_font["font-family"], $_font["css"] , array() );
//		endforeach;

//		wp_enqueue_style( 'seed-fonts-admin', plugin_dir_url( __FILE__ ) . 'seed-fonts-admin.css' , array() );

	wp_enqueue_script( 'seed-fonts', plugin_dir_url( __FILE__ ) . 'seed-fonts-admin.js' , array( 'jquery' ), '2016-1', true );
	wp_enqueue_style( 'seed-fonts', plugin_dir_url( __FILE__ ) . 'seed-fonts-admin.css' , array(  ) );
}

function seed_fonts_init() {

	if( file_exists( get_stylesheet_directory() . '/vendor/fonts' ) && is_dir( get_stylesheet_directory() . '/vendor/fonts' ) ) {
		$d_handle = opendir( get_stylesheet_directory() . '/vendor/fonts' );

		$fonts = array();

		while( FALSE !== ( $entry = readdir( $d_handle ) ) ) {
			if ( is_dir( get_stylesheet_directory() . '/vendor/fonts/' . $entry ) && ( file_exists ( get_stylesheet_directory() . '/vendor/fonts/' . $entry . '/font.css' ) ) ) {
				$headers = get_file_data ( get_stylesheet_directory() . '/vendor/fonts/' . $entry . '/font.css' , array( 'font' => 'Font Name', 'weights' => 'Weights' ) );

				$_font = array();

				if( $headers['font'] == '' )
					$_font['font'] = $entry;
				else
					$_font['font'] = $headers['font'];

				if( $headers['weights'] != '' )
					$_font['weights'] = array_map( 'trim', explode( ',', $headers['weights'] ) );

				$fonts[$entry] = $_font;
			}
		}

		Seed_fonts::$fonts = $fonts;
	}

	$is_enabled = get_option( 'seed_fonts_is_enabled' );
	$font = get_option( 'seed_fonts_font' );
	$weight = get_option( 'seed_fonts_weight' );
	$selectors = get_option( 'seed_fonts_selectors' );
	$is_important = get_option( 'seed_fonts_is_important' );

	if( $font === FALSE )
		$font = key ( Seed_fonts::$fonts );

	if( $weight === FALSE )
		$weight = '';

	if( $selectors === FALSE )
		$selectors = 'h1, h2, h3, h4, h5, h6, ._heading';

	echo '<div class="wrap">';
	echo '<h1>'. __( 'Seed Fonts', 'seed-fonts' ) . '</h1>';
	echo '<p>'. __( 'This plugin comes with 5 Thai web fonts. You can add your own collection by <a href="https://www.seedthemes.com/plugin/seed-fonts/#upload-your-fonts" target="_blank">uploading your web fonts to the theme folder</a>.', 'seed-fonts' ) . '</p>';

	echo '<form id="seed-fonts-form" method="post" name="seed_fonts_form" action="'.get_bloginfo( 'url' ).'/wp-admin/admin-post.php" >';
	echo '<table class="form-table"><tbody>';
	echo '<tr><th scope="row">'. __( 'Enable?', 'seed-fonts' ) .'</th><td><label for="seed-fonts-is-enabled"><input id="seed-fonts-is-enabled" type="checkbox" name="seed_fonts_is_enabled" value="on"'.( $is_enabled ? ' checked="checked"' : '').' /></label></td></tr>';
	echo '<tr><th scope="row">'. __( 'Font', 'seed-fonts' ) .'</th><td><select id="seed-fonts-font" name="seed_fonts_font"'.( $is_enabled ? '' : ' disabled' ).'>';
	foreach( Seed_fonts::$fonts as $_font_family => $_font ):
		echo '<option value="'.$_font_family.'" '.(($font == $_font_family) ? ' selected="selected"' : '').'>'.( array_key_exists( 'font', $_font ) ? $_font['font'] : $_font_family ).'</option>';
	endforeach;
	echo '</select></td></tr>';

	echo '<tr><th scope="row">'. __( 'Weight', 'seed-fonts' ) .'</th><td><select id="seed-fonts-weight" name="seed_fonts_weight"'.( $is_enabled ? '' : ' disabled' ).'>';
	echo '<option value=""></option>';

	if( array_key_exists( 'weights', Seed_fonts::$fonts[$font] ) ) {
		foreach( Seed_fonts::$fonts[$font]['weights'] as $_weight ):
			echo '<option value="'.$_weight.'" '.(($weight == $_weight) ? ' selected="selected"' : '').'>'.$_weight.'</option>';
		endforeach;
	}
	echo '</select><p class="description">'. __( '400 = Normal, 700 = Bold. For more detail, please see <a href="https://www.w3.org/TR/css-fonts-3/#font-weight-prop" target="_blank">W3.org</a>', 'seed-fonts' ) .'</p></td></tr>';

	echo '<tr><th scope="row">'. __( 'Selectors', 'seed-fonts' ) .'</th><td><input id="seed-fonts-selectors" class="regular-text" type="text" name="seed_fonts_selectors" value="'.htmlspecialchars( $selectors ).'"'.( $is_enabled ? '' : ' disabled' ).' /></td></tr>';
	echo '<tr><th scope="row">'. __( 'Force using this font?', 'seed-fonts' ) .'</th><td><label for="seed-fonts-is-important"><input id="seed-fonts-is-important" type="checkbox" name="seed_fonts_is_important" value="on"'.( $is_important ? ' checked="checked"' : '').( $is_enabled ? '' : ' disabled' ).' /> '. __( 'Yes (!important added).', 'seed-fonts' ) .'</label></td></tr>';
	echo '<tr><th scope="row">'. __( 'Generated CSS', 'seed-fonts' ) .'</th><td><textarea id="seed-fonts-css-generated" rows="4" cols="60" class="code" readonly'.( $is_enabled ? '' : ' style="display:none"' ).'></textarea>';
	echo '<input type="hidden" name="action" value="seed_fonts_save_options" /></td></tr></tbody></table>';
	echo '<p class="submit"><button type="button" id="seed-fonts-submit" class="button button-primary">'. __( 'Save Changes', 'seed-fonts' ) .'</button></p>';

	foreach( Seed_fonts::$fonts as $_font_family => $_font ):
		echo '<select id="seed-fonts-'.$_font_family.'-weights" style="display:none">';
		echo '<option value=""></option>';
		foreach( $_font['weights'] as $_weight ):
			echo '<option value="'.$_weight.'">'.$_weight.'</option>';
		endforeach;
		echo '</select>';
	endforeach;

	echo '</form>';
	
	echo '</div>';
}

add_action( 'admin_post_seed_fonts_save_options', 'seed_fonts_save' );

function seed_fonts_save() {
	if( array_key_exists( 'seed_fonts_is_enabled', $_POST ) && ( $_POST['seed_fonts_is_enabled'] == 'on' ) )
		update_option( 'seed_fonts_is_enabled' , true );
	else
		update_option( 'seed_fonts_is_enabled' , false );

	update_option( 'seed_fonts_font' , $_POST['seed_fonts_font'] );
	update_option( 'seed_fonts_weight' , $_POST['seed_fonts_weight'] );
	update_option( 'seed_fonts_selectors' , $_POST['seed_fonts_selectors'] );

	if( array_key_exists( 'seed_fonts_is_important', $_POST ) && ( $_POST['seed_fonts_is_important'] == 'on' ) )
		update_option( 'seed_fonts_is_important' , true );
	else
		update_option( 'seed_fonts_is_important' , false );

//		print_r($_POST);

	header("Location: admin.php?page=seed-fonts&saved=true");
}

function seed_fonts( ) {
}

load_plugin_textdomain('seed-fonts', false, basename( dirname( __FILE__ ) ) . '/languages' );

?>