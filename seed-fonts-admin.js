jQuery(document).ready(function ($) {

    $( "#seed-fonts-tabs" ).tabs();

	/**
	 * Cache selectors
	 */
	var inputEnable = $('#seed-fonts-is-enabled'),
		inputCSS = $('#seed-fonts-css-generated'),
		inputSelectors = $('#seed-fonts-selectors'),
		inputFonts = $('#seed-fonts-font'),
		inputImportant = $('#seed-fonts-is-important'),
		inputFontWeight = $('#seed-fonts-weight'),

		inputBodyEnable = $('#seed-fonts-body-is-enabled'),
		inputBodyCSS = $('#seed-fonts-body-css-generated'),
		inputBodySelectors = $('#seed-fonts-body-selectors'),
		inputBodyFonts = $('#seed-fonts-body-font'),
		inputBodySize = $('#seed-fonts-body-size'),
		inputBodySizeUnit = $('#seed-fonts-body-size-unit'),
		inputBodyImportant = $('#seed-fonts-body-is-important'),

		formSeedFonts = $('#seed-fonts-form');

	/**
	 * Function to ouput CSS
	 */
	function seed_fonts_generate_css() {
		var css = '';

		if ( (inputSelectors.val() != null) && (inputSelectors.val() != '') )
			css += inputSelectors.val() + ' ';

		css += '{\r\n';
		css += '  font-family: "' + inputFonts.val() + '", san-serif' + ((inputImportant.prop('checked')) ? ' !important' : '') + ';\n';
		if ( (inputFontWeight.val() != null) && (inputFontWeight.val() != '') )
			css += '  font-weight: ' + inputFontWeight.val() + ((inputImportant.prop('checked')) ? ' !important' : '') + ';\n';
		css += '}';

		inputCSS.val(css);
	}

	function seed_fonts_body_generate_css() {
		css = '';

		if ( (inputBodySelectors.val() != null) && (inputBodySelectors.val() != '') )
			css += inputBodySelectors.val() + ' ';

		css += '{\r\n';
		css += '  font-family: "' + inputBodyFonts.val() + '", san-serif' + ((inputBodyImportant.prop('checked')) ? ' !important' : '') + ';\n';
		if ( (inputBodySize.val() != null) && (inputBodySize.val() != '') )
			css += '  font-size: ' + inputBodySize.val() + inputBodySizeUnit.val() + ((inputBodyImportant.prop('checked')) ? ' !important' : '') + ';\n';
		css += '}';

		inputBodyCSS.val(css);
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

	function seed_fonts_body_is_enabled() {
		var body_is_enabled = inputBodyEnable.prop('checked');

		inputBodyFonts.prop('disabled', !body_is_enabled);
		inputBodySize.prop('disabled', !body_is_enabled);
		inputBodySizeUnit.prop('disabled', !body_is_enabled);
		inputBodySelectors.prop('disabled', !body_is_enabled);
		inputBodyImportant.prop('disabled', !body_is_enabled);
		inputBodyCSS.toggle(body_is_enabled);
	}

	/**
	 * Trigger functions when DOM is ready
	 */
	seed_fonts_generate_css();
	seed_fonts_body_generate_css();
	seed_fonts_is_enabled();
	seed_fonts_body_is_enabled();

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

	inputBodyEnable.on('change', function () {
		seed_fonts_body_is_enabled();
	});

	inputBodyFonts.on('change', function () {
		seed_fonts_body_generate_css();
	});

	inputBodySize.on('keyup focusout', function () {
		seed_fonts_body_generate_css();
	});

	inputBodySizeUnit.on('change', function () {
		seed_fonts_body_generate_css();
	});

	$('#seed-fonts-body-is-important').on('change', function () {
		seed_fonts_body_generate_css();
	});

	inputBodySelectors.on('keyup focusout', function () {
		seed_fonts_body_generate_css();
	});

	formSeedFonts.on( 'submit', function ( event ) {
		inputFonts.prop( 'disabled', false );
		inputFontWeight.prop( 'disabled', false );
		inputSelectors.prop( 'disabled', false );
		inputImportant.prop( 'disabled', false );

		inputBodyFonts.prop( 'disabled', false );
		inputBodySize.prop( 'disabled', false );
		inputBodySizeUnit.prop( 'disabled', false );
		inputBodySelectors.prop( 'disabled', false );
		inputBodyImportant.prop( 'disabled', false );
	});

});