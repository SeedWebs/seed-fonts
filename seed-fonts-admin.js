jQuery(document).ready(function ($) {
  $("#seed-fonts-tabs").tabs();

  /* Cache selectors */
  var inputEnable = $("#seed-fonts-is-enabled"),
    inputCSS = $("#seed-fonts-css-generated"),
    inputSelectors = $("#seed-fonts-selectors"),
    inputGoogleFonts = $("#seed-fonts-is-google-fonts"),
    inputGoogleFontName = $("#seed-fonts-google-font-name"),
    inputFonts = $("#seed-fonts-font"),
    inputImportant = $("#seed-fonts-is-important"),
    inputFontWeight = $("#seed-fonts-weight"),
    inputBodyEnable = $("#seed-fonts-body-is-enabled"),
    inputBodyCSS = $("#seed-fonts-body-css-generated"),
    inputBodySelectors = $("#seed-fonts-body-selectors"),
    inputBodyGoogleFonts = $("#seed-fonts-body-is-google-fonts"),
    inputBodyGoogleFontName = $("#seed-fonts-body-google-font-name"),
    inputBodyFonts = $("#seed-fonts-body-font"),
    inputBodyWeight = $("#seed-fonts-body-weight"),
    inputBodySize = $("#seed-fonts-body-size"),
    inputBodySizeUnit = $("#seed-fonts-body-size-unit"),
    inputBodyLineheight = $("#seed-fonts-body-lineheight"),
    inputBodyImportant = $("#seed-fonts-body-is-important"),
    formSeedFonts = $("#seed-fonts-form");

  /* Function to ouput CSS */
  function seed_fonts_generate_css() {
    var css = "";
    var ggfont = inputGoogleFontName.val();
    ggfont = ggfont.replace(/ +(?= )/g, "");

    if (inputSelectors.val() != null && inputSelectors.val() != "")
      css += inputSelectors.val() + " ";

    css += "{\r\n";
    css +=
      '  font-family: "' +
      (inputGoogleFonts.prop("checked") ? ggfont : inputFonts.val()) +
      '", san-serif' +
      (inputImportant.prop("checked") ? " !important" : "") +
      ";\n";
    if (inputFontWeight.val() != null && inputFontWeight.val() != "")
      css +=
        "  font-weight: " +
        inputFontWeight.val() +
        (inputImportant.prop("checked") ? " !important" : "") +
        ";\n";
    css += "}";

    inputCSS.val(css);
  }

  function seed_fonts_body_generate_css() {
    css = "";
    var ggfont = inputBodyGoogleFontName.val();
    ggfont = ggfont.replace(/ +(?= )/g, "");

    if (inputBodySelectors.val() != null && inputBodySelectors.val() != "")
      css += inputBodySelectors.val() + " ";

    css += "{\r\n";
    css +=
      '  font-family: "' +
      (inputBodyGoogleFonts.prop("checked") ? ggfont : inputBodyFonts.val()) +
      '", san-serif' +
      (inputBodyImportant.prop("checked") ? " !important" : "") +
      ";\n";
    if (inputBodySize.val() != null && inputBodySize.val() != "")
      css +=
        "  font-size: " +
        inputBodySize.val() +
        inputBodySizeUnit.val() +
        (inputBodyImportant.prop("checked") ? " !important" : "") +
        ";\n";
    if (inputBodyWeight.val() != null && inputBodyWeight.val() != "")
      css +=
        "  font-weight: " +
        inputBodyWeight.val() +
        (inputBodyImportant.prop("checked") ? " !important" : "") +
        ";\n";
    if (inputBodyLineheight.val() != null && inputBodyLineheight.val() != "")
      css +=
        "  line-height: " +
        inputBodyLineheight.val() +
        (inputBodyImportant.prop("checked") ? " !important" : "") +
        ";\n";
    css += "}";

    inputBodyCSS.val(css);
  }

  /* Conditional Logic */
  function seed_fonts_is_enabled() {
    var is_enabled = inputEnable.prop("checked");

    inputFonts.prop("disabled", !is_enabled);
    inputGoogleFonts.prop("disabled", !is_enabled);
    inputGoogleFontName.prop("disabled", !is_enabled);
    inputFontWeight.prop("disabled", !is_enabled);
    inputSelectors.prop("disabled", !is_enabled);
    inputImportant.prop("disabled", !is_enabled);
    inputCSS.toggle(is_enabled);
  }

  function seed_fonts_is_google_fonts() {
    var is_googlefonts = inputGoogleFonts.prop("checked");
    var weight = $("#seed-fonts-weight").val();
    var font = inputFonts.val();
    if (is_googlefonts) {
      $("#seed-fonts-google-font-name").closest("tr").show();
      $("#seed-fonts-font").closest("tr").hide();
      inputFontWeight
        .empty()
        .append($("#seed-fonts-all-weights").children().clone())
        .val(weight);
    } else {
      $("#seed-fonts-google-font-name").closest("tr").hide();
      $("#seed-fonts-font").closest("tr").show();
      inputFontWeight
        .empty()
        .append(
          $("#seed-fonts-" + font + "-weights")
            .children()
            .clone()
        )
        .val(weight);
    }
    if (inputFontWeight.val() == null)
      $("#seed-fonts-weight option:first").attr("selected", "selected");
  }

  function seed_fonts_body_is_enabled() {
    var body_is_enabled = inputBodyEnable.prop("checked");

    inputBodyGoogleFonts.prop("disabled", !body_is_enabled);
    inputBodyGoogleFontName.prop("disabled", !body_is_enabled);
    inputBodyFonts.prop("disabled", !body_is_enabled);
    inputBodyWeight.prop("disabled", !body_is_enabled);
    inputBodySize.prop("disabled", !body_is_enabled);
    inputBodySizeUnit.prop("disabled", !body_is_enabled);
    inputBodyLineheight.prop("disabled", !body_is_enabled);
    inputBodySelectors.prop("disabled", !body_is_enabled);
    inputBodyImportant.prop("disabled", !body_is_enabled);
    inputBodyCSS.toggle(body_is_enabled);
  }

  function seed_fonts_body_is_google_fonts() {
    var body_is_googlefonts = inputBodyGoogleFonts.prop("checked");
    if (body_is_googlefonts) {
      $("#seed-fonts-body-google-font-name").closest("tr").show();
      $("#seed-fonts-body-font").closest("tr").hide();
    } else {
      $("#seed-fonts-body-google-font-name").closest("tr").hide();
      $("#seed-fonts-body-font").closest("tr").show();
    }
  }

  /* Trigger functions when DOM is ready */
  seed_fonts_generate_css();
  seed_fonts_body_generate_css();
  seed_fonts_is_enabled();
  seed_fonts_is_google_fonts();
  seed_fonts_body_is_enabled();
  seed_fonts_body_is_google_fonts();

  /* If using Google Fonts */
  inputGoogleFonts.on("change", function () {
    seed_fonts_is_google_fonts();
    seed_fonts_generate_css();
  });
  inputBodyGoogleFonts.on("change", function () {
    seed_fonts_body_is_google_fonts();
    seed_fonts_body_generate_css();
  });

  /* Output CSS live */
  inputEnable.on("change", function () {
    seed_fonts_is_enabled();
  });
  inputFonts.on("change", function () {
    var font = inputFonts.val();
    var weight = inputFontWeight.val();

    inputFontWeight
      .empty()
      .append(
        $("#seed-fonts-" + font + "-weights")
          .children()
          .clone()
      )
      .val(weight);

    if (inputFontWeight.val() == null)
      $("#seed-fonts-weight option:first").attr("selected", "selected");

    seed_fonts_generate_css();
  });

  $("#seed-fonts-weight, #seed-fonts-is-important").on("change", function () {
    seed_fonts_generate_css();
  });

  inputSelectors.on("keyup focusout", function () {
    seed_fonts_generate_css();
  });
  inputGoogleFontName.on("keyup focusout", function () {
    seed_fonts_generate_css();
  });

  inputBodyGoogleFontName.on("keyup focusout", function () {
    seed_fonts_body_generate_css();
  });

  inputBodyEnable.on("change", function () {
    seed_fonts_body_is_enabled();
  });

  inputBodyFonts.on("change", function () {
    seed_fonts_body_generate_css();
  });

  inputBodySize.on("keyup focusout", function () {
    seed_fonts_body_generate_css();
  });

  inputBodySizeUnit.on("change", function () {
    seed_fonts_body_generate_css();
  });

  inputBodyLineheight.on("keyup focusout", function () {
    seed_fonts_body_generate_css();
  });

  $("#seed-fonts-body-weight, #seed-fonts-body-is-important").on(
    "change",
    function () {
      seed_fonts_body_generate_css();
    }
  );

  inputBodySelectors.on("keyup focusout", function () {
    seed_fonts_body_generate_css();
  });

  formSeedFonts.on("submit", function (event) {
    formSeedFonts.css("opacity", "0.5");
  });
});
