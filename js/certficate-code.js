/**
 * @file
 * Javascript for moving the code cleanly from the playground to to the creation form.
 */

(function ($) {

	'use strict';

  var dataUrl = '';

  function moveCode() {
    var editorCode = $('#editor .ace_text-layer .ace_line');
    var editorCodeLength = editorCode.length;
    var code = '';
    var pretty = '';
    var download = $('#edit-download').val();
    var certificateDataUrl = $('edit-field-certificate-data-url-0-value').val();

    editorCode.each(function(index) {
      // If a Data URL has been declared, add it into the editor.
      if ( $(this).text().startsWith('var imgData') &&
           dataUrl != '' ) {
        $(this).text("var newImgData = '" + dataUrl + ";");
      // $(this).text("var imgData = test;");
      // $(this).text(dataUrl);
      }

      if ( $(this).text().startsWith('doc.addImage') &&
           dataUrl != '' ) {
        $(this).text("doc.addImage(newImgData, 0, 0, 300, 200);");
      }

      // If this line is a comment, don't include it.
      if ( !$(this).text().startsWith('//') ) {
        code += $(this).text().trim();
      }

      if ( !$(this).text() ) {
        // Don't add an extra newline if we are on the last line
        // of the editor.
        if ( (index + 1) < editorCodeLength) {
          pretty += '\n';
        }
      }
      else {
        pretty += $(this).text() + '\n';
      }
    });

    if (download) {
      var filename = 'certificate.pdf';
      if ($('#edit-file-name').val().length) {
        filename = $('#edit-file-name').val() + '.pdf';
      }
      pretty += '\ndoc.save("' + filename + '");';
      code += 'doc.save("' + filename + '");';
    }

    // Place code form the editor into the creation form.
    var formCode = $('.creation-code');
    var formPretty = $('.pretty-code');
    formCode.text(code);
    formPretty.text(pretty);
  }

  function addCertificateDataUrl() {
    dataUrl = $(this).val();
    moveCode();
  }

  // On editor change.
  if ($('.certificate-form #editor').length){
    var editor = ace.edit('editor');
    editor.getSession().on('change', moveCode);
  }

  $('#edit-download').on('change', moveCode);
  $('#edit-file-name').on('change', moveCode);
  $('#edit-field-certificate-data-url-0-value').on('change', addCertificateDataUrl);

})(jQuery);
