	function seed_fonts_generate_css() {
		var css = '';

		css = jQuery('#seed-fonts-selectors').val() + ' {\r\n';
		css += '	font-family: "' + jQuery('#seed-fonts-font').val() + '", san-serif' + ((jQuery('#seed-fonts-is-important').prop('checked'))  ? ' !important' : '') + '\n';
		css += '	font-weight: ' + jQuery('#seed-fonts-weight').val()  + ((jQuery('#seed-fonts-is-important').prop('checked'))  ? ' !important' : '') + '\n';
		css += '}';

		return css;
	}

	jQuery(document).ready(function () {
		jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );

		jQuery('#seed-fonts-selectors').keyup( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});

		jQuery('#seed-fonts-selectors').change( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});

		jQuery('#seed-fonts-font').change( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});

		jQuery('#seed-fonts-weight').change( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});

		jQuery('#seed-fonts-is-important').change( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});
	});