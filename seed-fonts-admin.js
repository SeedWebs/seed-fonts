jQuery(document).ready(function ($) {

	function seed_fonts_generate_css() {
		var css = '';

		if ($('#seed-fonts-selectors').val() != '')
			css += $('#seed-fonts-selectors').val() + ' ';

		css += '{\r\n';
		css += '  font-family: "' + $('#seed-fonts-font').val() + '", san-serif' + (($('#seed-fonts-is-important').prop('checked')) ? ' !important' : '') + ';\n';
		if ($('#seed-fonts-weight').val() != '')
			css += '  font-weight: ' + $('#seed-fonts-weight').val() + (($('#seed-fonts-is-important').prop('checked')) ? ' !important' : '') + ';\n';
		css += '}';

		return css;
	}

	function seed_fonts_is_enabled() {
		var is_enabled = $('#seed-fonts-is-enabled').prop('checked');

		$('#seed-fonts-font').prop('disabled', !is_enabled);
		$('#seed-fonts-weight').prop('disabled', !is_enabled);
		$('#seed-fonts-selectors').prop('disabled', !is_enabled);
		$('#seed-fonts-is-important').prop('disabled', !is_enabled);
		$('#seed-fonts-css-generated').toggle(is_enabled);
	}

	$('#seed-fonts-css-generated').val(seed_fonts_generate_css());

	seed_fonts_is_enabled();

	$('#seed-fonts-is-enabled').change(function () {
		seed_fonts_is_enabled();
	});

	$('#seed-fonts-font').change(function () {
		var font = $('#seed-fonts-font').val();
		var weight = $('#seed-fonts-weight').val();

		$('#seed-fonts-weight').empty().append($('#seed-fonts-' + font + '-weights').children().clone()).val(weight);

		if ($('#seed-fonts-weight').val() == null)
			$("#seed-fonts-weight option:first").attr('selected', 'selected');

		$('#seed-fonts-css-generated').val(seed_fonts_generate_css());
	});

	$('#seed-fonts-weight, #seed-fonts-is-important').change(function () {
		$('#seed-fonts-css-generated').val(seed_fonts_generate_css());
	});

	$('#seed-fonts-selectors').on('keyup focusout', function() {
		$('#seed-fonts-css-generated').val(seed_fonts_generate_css());
	});

	$('#seed-fonts-submit').click(function () {
		$('#seed-fonts-font').prop('disabled', false);
		$('#seed-fonts-weight').prop('disabled', false);
		$('#seed-fonts-selectors').prop('disabled', false);
		$('#seed-fonts-is-important').prop('disabled', false);
		$('#seed-fonts-form').submit();
	});

});