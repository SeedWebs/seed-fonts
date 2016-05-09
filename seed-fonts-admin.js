function seed_fonts_generate_css() {
	var css = '';

	if (jQuery('#seed-fonts-selectors').val() != '')
		css += jQuery('#seed-fonts-selectors').val() + ' ';

	css += '{\r\n';
	css += '  font-family: "' + jQuery('#seed-fonts-font').val() + '", san-serif' + ((jQuery('#seed-fonts-is-important').prop('checked')) ? ' !important' : '') + ';\n';
	if (jQuery('#seed-fonts-weight').val() != '')
		css += '  font-weight: ' + jQuery('#seed-fonts-weight').val() + ((jQuery('#seed-fonts-is-important').prop('checked')) ? ' !important' : '') + ';\n';
	css += '}';

	return css;
}

function seed_fonts_is_enabled() {
	var is_enabled = jQuery('#seed-fonts-is-enabled').prop('checked');

	jQuery('#seed-fonts-font').prop('disabled', !is_enabled);
	jQuery('#seed-fonts-weight').prop('disabled', !is_enabled);
	jQuery('#seed-fonts-selectors').prop('disabled', !is_enabled);
	jQuery('#seed-fonts-is-important').prop('disabled', !is_enabled);
	jQuery('#seed-fonts-css-generated').toggle(is_enabled);
}

jQuery(document).ready(function () {
	jQuery('#seed-fonts-css-generated').val(seed_fonts_generate_css());

	seed_fonts_is_enabled();

	jQuery('#seed-fonts-is-enabled').change(function () {
		seed_fonts_is_enabled();
	});

	jQuery('#seed-fonts-font').change(function () {
		var font = jQuery('#seed-fonts-font').val();
		var weight = jQuery('#seed-fonts-weight').val();

		jQuery('#seed-fonts-weight').empty().append(jQuery('#seed-fonts-' + font + '-weights').children().clone()).val(weight);

		if (jQuery('#seed-fonts-weight').val() == null)
			jQuery("#seed-fonts-weight option:first").attr('selected', 'selected');

		jQuery('#seed-fonts-css-generated').val(seed_fonts_generate_css());
	});

	jQuery('#seed-fonts-weight').change(function () {
		jQuery('#seed-fonts-css-generated').val(seed_fonts_generate_css());
	});

	jQuery('#seed-fonts-selectors').keyup(function () {
		jQuery('#seed-fonts-css-generated').val(seed_fonts_generate_css());
	});

	jQuery('#seed-fonts-selectors').focusout(function () {
		jQuery('#seed-fonts-css-generated').val(seed_fonts_generate_css());
	});

	jQuery('#seed-fonts-is-important').change(function () {
		jQuery('#seed-fonts-css-generated').val(seed_fonts_generate_css());
	});

	jQuery('#seed-fonts-submit').click(function () {
		jQuery('#seed-fonts-font').prop('disabled', false);
		jQuery('#seed-fonts-weight').prop('disabled', false);
		jQuery('#seed-fonts-selectors').prop('disabled', false);
		jQuery('#seed-fonts-is-important').prop('disabled', false);
		jQuery('#seed-fonts-form').submit();
	});
});