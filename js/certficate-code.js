/**
 * @file
 * Javascript for moving the code cleanly from the playground to to the creation form.
 */

(function ($) {

	'use strict';

  function moveCode() {
    var editorCode = $('#editor .ace_text-layer .ace_line');
    var editorCodeLength = editorCode.length;
    var code = '';
    var pretty = '';

    editorCode.each(function(index) {
      // If the line is a comment, don't include it.
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

    // Place code form the editor into the creation form.
    var formCode = $('.creation-code');
    var formPretty = $('.pretty-code');
    formCode.text(code);
    formPretty.text(pretty);
  }

  // On editor change.
  var editor = ace.edit("editor");
  editor.getSession().on('change', moveCode);

  // On initial load.
  moveCode();

})(jQuery);
