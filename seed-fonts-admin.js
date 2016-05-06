	function seed_fonts_generate_css() {
		var css = '';

		css = jQuery('#seed-fonts-selectors').val() + ' {\r\n';
		css += '	font-family: "' + jQuery('#seed-fonts-font').val() + '", san-serif;' + ((jQuery('#seed-fonts-is-important').prop('checked'))  ? ' !important;' : '') + '\n';
		if( jQuery('#seed-fonts-weight').val() != '' )
			css += '	font-weight: ' + jQuery('#seed-fonts-weight').val()  + ';' + ((jQuery('#seed-fonts-is-important').prop('checked'))  ? ' !important;' : '') + '\n';
		css += '}';

		return css;
	}

	jQuery(document).ready(function () {
		jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );

		jQuery('#seed-fonts-selectors').keyup( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});

		jQuery('#seed-fonts-selectors').focusout( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});

		jQuery('#seed-fonts-font').change( function() {
			var font = jQuery('#seed-fonts-font').val();
			var weight = jQuery('#seed-fonts-weight').val();

			jQuery('#seed-fonts-weight').empty().append(jQuery('#seed-fonts-' + font + '-weights').children().clone()).val(weight);

			if( jQuery('#seed-fonts-weight').val() == null )
				jQuery("#seed-fonts-weight option:first").attr('selected','selected');

			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});

		jQuery('#seed-fonts-weight').change( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});

		jQuery('#seed-fonts-is-important').change( function() {
			jQuery('#seed-fonts-css-generated').val( seed_fonts_generate_css() );
		});
	});