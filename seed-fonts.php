<?php
/*
Plugin Name: Seed Fonts
Plugin URI: https://www.seedthemes.com/plugin/seed-fonts
Description: Enable web fonts on Appearance -> Fonts. You can add more by <a href="https://www.seedthemes.com/plugin/seed-fonts/" target="_blank">uploading your web fonts to the theme folder</a>.
Version: 1.1.0
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

add_action( 'wp_enqueue_scripts', 'seed_fonts_scripts', 30 );

function seed_fonts_scripts() {
	if( ! is_admin() ) {
		$is_enabled = ( get_option( 'seed_fonts_is_enabled' ) );
		$font = get_option( 'seed_fonts_font' );
		$weight = get_option( 'seed_fonts_weight' );
		$selectors = get_option( 'seed_fonts_selectors' );
		$is_important = ( get_option( 'seed_fonts_is_important' ) );
		$font_styles = '';

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

		$body_is_enabled = ( get_option( 'seed_fonts_body_is_enabled' ) );
		$body_font = get_option( 'seed_fonts_body_font' );
		$body_selectors = get_option( 'seed_fonts_body_selectors' );
		$body_is_important = ( get_option( 'seed_fonts_body_is_important' ) );
		$body_font_styles = '';

		if( $body_is_enabled && ( $body_font !== FALSE ) && ( $body_font != '' ) ) {
			if( $body_selectors != '' )
				$body_font_styles = $body_selectors.' ';

			$body_font_styles .= '{font-family: "'.$body_font.'",  sans-serif'.( $body_is_important ? ' !important' : '' ).';';
			$body_font_styles .= ' }';

			if( file_exists( get_stylesheet_directory() . '/vendor/fonts' ) && is_dir( get_stylesheet_directory() . '/vendor/fonts' ) ) {
				wp_enqueue_style( 'seed-fonts-body-all', get_stylesheet_directory_uri() . '/vendor/fonts/' . $body_font . '/font.css' , array(  ) );
			} else {
				wp_enqueue_style( 'seed-fonts-body-all', plugin_dir_url( __FILE__ ) . 'fonts/' . $body_font . '/font.css' , array(  ) );
			}

			wp_add_inline_style( 'seed-fonts-all', $body_font_styles );
		}
	}
}

add_filter( 'body_class', 'seed_fonts_body_class' );

function seed_fonts_body_class( $classes ) {
	$is_enabled = get_option( 'seed_fonts_is_enabled' );
	$font = get_option( 'seed_fonts_font' );
	$weight = get_option( 'seed_fonts_weight' );

	if( $font === FALSE )
		$font = key ( seed_fonts_get_fonts() );

	if( $weight === FALSE )
		$weight = '';

	if( $is_enabled ) {
		$classes[] = 'seed-fonts-'.$font;

		if( $weight != '' )
			$classes[] = 'seed-fonts-weight-'.$weight;
	}

	$is_body_enabled = get_option( 'seed_fonts_body_is_enabled' );
	$body_font = get_option( 'seed_fonts_body_font' );

	if( $body_font === FALSE )
		$body_font = key ( seed_fonts_get_fonts() );

	if( $is_body_enabled ) {
		$classes[] = 'seed-fonts-body-'.$body_font;
	}

	return $classes;
}

add_action( 'admin_menu', 'seed_fonts_setup_menu' );

function seed_fonts_setup_menu() {
	$seed_font_page = add_submenu_page ( 'themes.php', __( 'Seed Fonts', 'seed-fonts' ), __( 'Fonts', 'seed-fonts' ), 'manage_options', 'seed-fonts', 'seed_fonts_init' );

	add_action( 'load-' . $seed_font_page, 'seed_fonts_admin_styles' );
}

function seed_fonts_admin_styles() {
	wp_enqueue_style( 'seed-fonts', plugin_dir_url( __FILE__ ) . 'seed-fonts-admin.css' , array(), '2016-1' );
	wp_enqueue_script( 'seed-fonts', plugin_dir_url( __FILE__ ) . 'seed-fonts-admin.js' , array( 'jquery', 'jquery-ui-tabs' ), '2016-1', true );
}

function seed_fonts_init() { ?>

	<div class="wrap">
		<div class="icon32" id="icon-options-general"></div>
		<h2><?php esc_html_e( 'Seed Fonts', 'seed-fonts' ); ?></h2>

		<?php
		if( isset( $_GET['settings-updated'] ) ) {
			?><div class="updated"><p><strong><?php esc_html_e( 'Settings updated successfully.', 'seed-fonts' ); ?></strong></div><?php
		}
		?>
		<p>
			<?php printf( wp_kses( __( 'This plugin comes with 5 Thai web fonts. You can add your own collection by <a href="%1$s" target="_blank">uploading your web fonts to the theme folder</a>', 'seed-fonts' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'https://www.seedthemes.com/plugin/seed-fonts/#upload-your-fonts' ) ); ?>
		</p>
		<form action="<?php echo admin_url( 'options.php' ); ?>" method="post" id="seed-fonts-form">
			<div id="seed-fonts-tabs">
			<ul class="wp-clearfix">
			<li><a href="#seed-fonts-header">Header</a></li>
			<li><a href="#seed-fonts-body">Body</a></li>
			</ul>

			<div class="dummy">
			<?php
				settings_fields( 'seed-fonts' );
				do_settings_sections( 'seed-fonts' );
			?>
			</div>

			<?php submit_button(); ?>

			</div>

			<?php seed_fonts_hidden_weight_options(); ?>
		</form>
	</div>

<?php }

/**
seed_fonts_get_fonts
 * Put font weight options
 *
 * @since 0.10.0
 */
function seed_fonts_hidden_weight_options() {
	$fonts = seed_fonts_get_fonts();

	foreach( $fonts as $_font => $_font_desc ) { ?>

	<select id="seed-fonts-<?php esc_html_e( $_font, 'seed-fonts' ); ?>-weights" style="display:none">
		<option value=""></option><?php
		foreach( $_font_desc["weights"] as $_weight ) { ?>		
		<option value="<?php esc_html_e( $_weight, 'seed-fonts' ); ?>"><?php esc_html_e( $_weight, 'seed-fonts' ); ?></option><?php		
		} ?>
	</select> <?php
	}
}

/**
 * Get the list of available fonts
 *
 * @since 0.10.0
 * @return array
 */
function seed_fonts_get_fonts() {

	$fonts = array(
		"athiti"         => array(
			"font"    => "Athiti",
			"weights" => array( 500, 600 )
		),
		"kanit"          => array(
			"font"    => "Kanit",
			"weights" => array( 300, 400, 500 )
		),
		"mitr"           => array(
			"font"    => "Mitr",
			"weights" => array( 300, 400, 500 )
		),
		"prompt"         => array(
			"font"    => "Prompt",
			"weights" => array( 400, 500, 600 )
		),
		"cloud" => array(
			"font"    => "Cloud",
			"weights" => array( 300, 700 )
		),
		"th-sarabun-new" => array(
			"font"    => "TH Sarabun New (Loop: มีหัว)",
			"weights" => array( 400, 700 )
		),
		"boon" => array(
			"font"    => "Boon (Loop: มีหัว)",
			"weights" => array( 400, 500, 600 )
		),
		"cs-prajad" => array(
			"font"    => "CS Prajad (Loop: มีหัว)",
			"weights" => array( 400, 700 )
		)
	);

	// This is where we add custom fonts
	if ( file_exists( get_stylesheet_directory() . '/vendor/fonts' ) && is_dir( get_stylesheet_directory() . '/vendor/fonts' ) ) {

		$custom_fonts = array();

		$d_handle = opendir( get_stylesheet_directory() . '/vendor/fonts' );

		while ( false !== ( $entry = readdir( $d_handle ) ) ) {

			if ( is_dir( get_stylesheet_directory() . '/vendor/fonts/' . $entry ) && ( file_exists( get_stylesheet_directory() . '/vendor/fonts/' . $entry . '/font.css' ) ) ) {

				$headers = get_file_data( get_stylesheet_directory() . '/vendor/fonts/' . $entry . '/font.css', array(
					'font'    => 'Font Name',
					'weights' => 'Weights'
				) );

				$_font = array(
					'font'    => empty( $headers['font'] ) ? $entry : $headers['font'],
					'weights' => empty( $headers['weights'] ) ? array() : array_map( 'trim', explode( ',', $headers['weights'] ) ),
				);

				$custom_fonts[ $entry ] = $_font;
			}
		}

		if( count( $custom_fonts ) > 0 )
			$fonts = $custom_fonts;

	}

	return apply_filters( 'seed_fonts_fonts', $fonts );

}

/**
 * Get the list of fonts formatted for use in a dropdown
 *
 * @since 0.10.0
 * @return array
 */
function seed_fonts_get_fonts_option_list() {

	$list = array();

	foreach ( seed_fonts_get_fonts() as $id => $data ) {
		$list[ $id ] = $data['font'];
	}

	return $list;

}

/**
 * Get the list of font weights formatted for use in a dropdown
 *
 * @since 0.10.0
 *
 * @param string $font Name of the font
 *
 * @return array
 */
function seed_fonts_get_fonts_weights_option_list( $font ) {

	$font = seed_fonts_get_font( $font );

	if ( ! isset( $font['weights'] ) || empty( $font['weights'] ) ) {
		return array();
	}

	$list = array( "" => "" );

	foreach ( $font['weights'] as $weight ) {
		$list[ $weight ] = $weight;
	}

	return $list;

}

/**
 * Get font data
 *
 * @since 0.10.0
 *
 * @param string $font Name of the font to retrieve
 *
 * @return bool|array
 */
function seed_fonts_get_font( $font ) {

	if ( empty( $font ) ) {
		return false;
	}

	$fonts = seed_fonts_get_fonts();

	if ( array_key_exists( $font, $fonts ) ) {
		return $fonts[ $font ];
	}

	return false;

}

/**
 * Quick helper function that prefixes an option ID
 *
 * This makes it easier to maintain and makes it super easy to change the options prefix without breaking the options
 * registered with the Settings API.
 *
 * @since 0.10.0
 *
 * @param string $name Unprefixed name of the option
 *
 * @return string
 */
function seed_fonts_get_option_id( $name ) {
	return 'seed_fonts_' . $name;
}

/**
 * Get the plugin settings in header tab
 *
 * @since 0.10.0
 * @return array
 */
function seed_fonts_get_header_settings() {

	$settings = array(
		array(
			'id'      => 'seed-fonts-header',
			'title'   => __( 'Fonts Settings - Header', 'seed-fonts' ),
			'options' => array(
				array(
					'id'      => seed_fonts_get_option_id( 'is_enabled' ),
					'title'   => esc_html__( 'Enable?', 'seed-fonts' ),
					'type'    => 'checkbox',
					'options' => array( 'on' => esc_html__( 'Yes', 'seed-fonts' ) )
				),
				array(
					'id'      => seed_fonts_get_option_id( 'font' ),
					'title'   => esc_html__( 'Font', 'seed-fonts' ),
					'type'    => 'dropdown',
					'options' => seed_fonts_get_fonts_option_list()
				),
				array(
					'id'      => seed_fonts_get_option_id( 'weight' ),
					'title'   => esc_html__( 'Weight', 'seed-fonts' ),
					'desc'    => wp_kses( sprintf( __( '400 = Normal, 700 = Bold. For more detail, please see <a href="%1$s" target="_blank">W3.org</a>', 'seed-fonts' ), esc_url( 'https://www.w3.org/TR/css-fonts-3/#font-weight-prop' ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array()
						)
					) ),
					'type'    => 'dropdown',
					'options' => seed_fonts_get_fonts_weights_option_list( get_option( 'seed_fonts_font' ) )
				),
				array(
					'id'      => seed_fonts_get_option_id( 'selectors' ),
					'title'   => esc_html__( 'Selectors', 'seed-fonts' ),
					'type'    => 'text',
					'desc'    => esc_html__( 'Separate selectors with commas', 'seed-fonts' ),
					'default' => 'h1, h2, h3, h4, h5, h6, nav, .menu, .button, .price, ._heading'
				),
				array(
					'id'      => seed_fonts_get_option_id( 'is_important' ),
					'title'   => esc_html__( 'Force Using This Font?', 'seed-fonts' ),
					'type'    => 'checkbox',
					'options' => array( 'on' => esc_html__( 'Yes (!important added)', 'seed-fonts' ) )
				),
				array(
					'id'       => seed_fonts_get_option_id( 'css-generated' ),
					'title'    => esc_html__( 'Generated CSS', 'seed-fonts' ),
					'type'     => 'textarea_code'
				),
			),
		),
	);

	return $settings;

}

/**
 * Get the plugin settings in body tab
 *
 * @since 0.10.0
 * @return array
 */
function seed_fonts_get_body_settings() {

	$settings = array(
		array(
			'id'      => 'seed-fonts-body',
			'title'   => __( 'Fonts Settings - Body', 'seed-fonts' ),
			'options' => array(
				array(
					'id'      => seed_fonts_get_option_id( 'body_is_enabled' ),
					'title'   => esc_html__( 'Enable?', 'seed-fonts' ),
					'type'    => 'checkbox',
					'options' => array( 'on' => esc_html__( 'Yes', 'seed-fonts' ) )
				),
				array(
					'id'      => seed_fonts_get_option_id( 'body_font' ),
					'title'   => esc_html__( 'Font', 'seed-fonts' ),
					'type'    => 'dropdown',
					'options' => seed_fonts_get_fonts_option_list()
				),
				array(
					'id'      => seed_fonts_get_option_id( 'body_selectors' ),
					'title'   => esc_html__( 'Selectors', 'seed-fonts' ),
					'type'    => 'text',
					'desc'    => esc_html__( 'Separate selectors with commas', 'seed-fonts' ),
					'default' => 'body'
				),
				array(
					'id'      => seed_fonts_get_option_id( 'body_is_important' ),
					'title'   => esc_html__( 'Force Using This Font?', 'seed-fonts' ),
					'type'    => 'checkbox',
					'options' => array( 'on' => esc_html__( 'Yes (!important added)', 'seed-fonts' ) )
				),
				array(
					'id'       => seed_fonts_get_option_id( 'body-css-generated' ),
					'title'    => esc_html__( 'Generated CSS', 'seed-fonts' ),
					'type'     => 'textarea_code'
				),
			),
		),
	);

	return $settings;

}

add_action( 'admin_init', 'seed_fonts_register_plugin_settings' );

/**
 * Register plugin settings
 *
 * This function dynamically registers plugin settings.
 *
 * @since 0.10.0
 * @see   seed_fonts_get_settings
 * @return void
 */
function seed_fonts_register_plugin_settings() {

	$header_settings = seed_fonts_get_header_settings();

	foreach ( $header_settings as $key => $section ) {

		/* We add the sections and then loop through the corresponding options */
		add_settings_section( $section['id'], $section['title'], 'seed_fonts_section', 'seed-fonts' );

		/* Get the options now */
		foreach ( $section['options'] as $k => $option ) {

			$field_args = array(
				'name'    => $option['id'],
				'title'   => $option['title'],
				'type'    => $option['type'],
				'desc'    => isset( $option['desc'] ) ? $option['desc'] : '',
				'default' => isset( $option['default'] ) ? $option['default'] : '',
				'options' => isset( $option['options'] ) ? $option['options'] : array(),
				'group'   => 'seed-fonts'
			);

			register_setting( 'seed-fonts', $option['id'] );
			add_settings_field( $option['id'], $option['title'], 'seed_fonts_output_settings_field', 'seed-fonts', $section['id'], $field_args );

		}
	}

	$body_settings = seed_fonts_get_body_settings();

	foreach ( $body_settings as $key => $section ) {

		/* We add the sections and then loop through the corresponding options */
		add_settings_section( $section['id'], $section['title'], 'seed_fonts_section', 'seed-fonts' );

		/* Get the options now */
		foreach ( $section['options'] as $k => $option ) {

			$field_args = array(
				'name'    => $option['id'],
				'title'   => $option['title'],
				'type'    => $option['type'],
				'desc'    => isset( $option['desc'] ) ? $option['desc'] : '',
				'default' => isset( $option['default'] ) ? $option['default'] : '',
				'options' => isset( $option['options'] ) ? $option['options'] : array(),
				'group'   => 'seed-fonts'
			);

			register_setting( 'seed-fonts', $option['id'] );
			add_settings_field( $option['id'], $option['title'], 'seed_fonts_output_settings_field', 'seed-fonts', $section['id'], $field_args );

		}
	}

}

/**
 * Generate new section
 *
 * This callback function set div for a new section
 *
 * @since 0.10.0
 * @see   seed_fonts_register_plugin_settings
 * @return void
 */
function seed_fonts_section( $section ) {
?>
</div><div id="<?php echo $section['id'] ?>">
<?php
}

/**
 * Generate the option field output
 *
 * @since 0.10.0
 *
 * @param array $option The current option array
 *
 * @return void
 */
function seed_fonts_output_settings_field( $option ) {

	$current    = get_option( $option['name'], $option['default'] );
	$field_type = $option['type'];
	$id         = str_replace( '_', '-', $option['name'] );

	// Because disabling the options when "Enable" is unchecked saved empty values we need to make sure the default is taken into account
	if ( empty( $current ) && ! empty( $option['default'] ) ) {
		$current = $option['default'];
	}

	switch( $field_type ):

		case 'text': ?>
			<input type="text" name="<?php echo $option['name']; ?>" id="<?php echo $id; ?>" value="<?php echo $current; ?>" class="regular-text" />
			<?php break;

		case 'checkbox': ?>
			<?php foreach( $option['options'] as $val => $choice ):

				if ( count( $option['options'] ) > 1 ) {
					$id = "{$id}_{$val}";
				}

				$selected = is_array( $current ) && in_array( $val, $current ) ? 'checked="checked"' : '';  ?>
				<label for="<?php echo $id; ?>">
					<input type="checkbox" name="<?php echo $option['name']; ?>[]" value="<?php echo $val; ?>" id="<?php echo $id; ?>" <?php echo $selected; ?> />
					<?php echo $choice; ?>
				</label>
			<?php endforeach;
			break;

		case 'dropdown': ?>
			<label for="<?php echo $option['name']; ?>">
				<select name="<?php echo $option['name']; ?>" id="<?php echo $id; ?>">

					<?php foreach( $option['options'] as $val => $choice ):
						if( $val == $current )
							$selected = 'selected="selected"';
						else
							$selected = ''; ?>
						<option value="<?php echo $val; ?>" <?php echo $selected; ?>><?php echo $choice; ?></option>

					<?php endforeach; ?>

				</select>
			</label>
			<?php break;

		case 'textarea':
			if( !$current && isset($option['std']) ) { $current = $option['std']; } ?>
			<textarea name="<?php echo $option['name']; ?>" id="<?php echo $id; ?>" rows="8" cols="70"><?php echo $current; ?></textarea>
			<?php break;

		case 'textarea_code':
			if( !$current && isset($option['std']) ) { $current = $option['std']; } ?>
			<textarea name="<?php echo $option['name']; ?>" id="<?php echo $id; ?>" rows="4" cols="60" class="code" readonly><?php echo $current; ?></textarea>
			<?php break;

	endswitch;

	// Add the field description
	if ( isset( $option['desc'] ) && $option['desc'] != '' ) {
		echo wp_kses_post( sprintf( '<p class="description">%1$s</p>', $option['desc'] ) );
	};

}

load_plugin_textdomain('seed-fonts', false, basename( dirname( __FILE__ ) ) . '/languages' );