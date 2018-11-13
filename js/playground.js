/**
 * @file
 * Javascript for adding the jsPDF playground editor to the
 * add/edit entity form.
 */

(function ($) {

  'use strict';

  function injectPlayground() {
    var editor = '<div class="container"> <div class="masthead"> <h1 class="muted">jsPDF</h1> <h4>HTML5 JavaScript PDF generation library playground.</h4> </div><div class="row-fluid"> <div class="span6" style="float: right"> <iframe class="preview-pane" type="application/pdf" width="100%" height="650" frameborder="0" style="position:relative;z-index:999"></iframe> </div><div class="span5 no-gutter"> <p>A HTML5 client-side solution for generating PDFs. Perfect for event tickets, reports, certificates, you name it! </p><p><b>No servers were used in the making of this demo.</b></p></div><div id="editor" class="bypass"></div><div class="controls"> <label class="checkbox"> <input type="checkbox" id="auto-refresh" checked="checked"> Auto refresh on changes? </label> <a href="#" class="run-code hide btn btn-success">Run Code</a> <div class="alert hide"> Auto refresh disabled for this </div></div></div><div class="clearfix"></div></div><script src="https://use.edgefonts.net/source-code-pro.js"></script>';
    $('.certificate-form').prepend(editor);
  }

  // On initial load.
  injectPlayground();

})(jQuery);
