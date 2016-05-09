jQuery(document).ready(function ($) {

	/**
	 * Cache selectors
	 */
	var inputEnable = $('#seed-fonts-is-enabled'),
		inputCSS = $('#seed-fonts-css-generated'),
		inputSelectors = $('#seed-fonts-selectors'),
		inputFonts = $('#seed-fonts-font'),
		inputImportant = $('#seed-fonts-is-important'),
		inputFontWeight = $('#seed-fonts-weight');

	/**
	 * Function to ouput CSS
	 */
	function seed_fonts_generate_css() {
		var css = '';

		if (inputSelectors.val() != '')
			css += inputSelectors.val() + ' ';

		css += '{\r\n';
		css += '  font-family: "' + inputFonts.val() + '", san-serif' + ((inputImportant.prop('checked')) ? ' !important' : '') + ';\n';
		if (inputFontWeight.val() != '')
			css += '  font-weight: ' + inputFontWeight.val() + ((inputImportant.prop('checked')) ? ' !important' : '') + ';\n';
		css += '}';

		inputCSS.val(css);
	}

	/**
	 * Conditional Logic
	 */
	function seed_fonts_is_enabled() {
		var is_enabled = inputEnable.prop('checked');

		inputFonts.prop('disabled', !is_enabled);
		inputFontWeight.prop('disabled', !is_enabled);
		inputSelectors.prop('disabled', !is_enabled);
		inputImportant.prop('disabled', !is_enabled);
		inputCSS.toggle(is_enabled);
	}

	/**
	 * Trigger functions when DOM is ready
	 */
	seed_fonts_generate_css();
	seed_fonts_is_enabled();

	/**
	 * Output CSS live
	 */
	inputEnable.on('change', function () {
		seed_fonts_is_enabled();
	});

	inputFonts.on('change', function () {
		var font = inputFonts.val();
		var weight = inputFontWeight.val();

		inputFontWeight.empty().append($('#seed-fonts-' + font + '-weights').children().clone()).val(weight);

		if (inputFontWeight.val() == null)
			$("#seed-fonts-weight option:first").attr('selected', 'selected');

		seed_fonts_generate_css();
	});

	$('#seed-fonts-weight, #seed-fonts-is-important').on('change', function () {
		seed_fonts_generate_css();
	});

	inputSelectors.on('keyup focusout', function () {
		seed_fonts_generate_css();
	});

});