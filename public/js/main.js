(function ($) {
  'use strict';

  var fullHeight = function () {
    $('.js-fullheight').css('height', $(window).height());
    $(window).resize(function () {
      $('.js-fullheight').css('height', $(window).height());
    });
  };
  fullHeight();

  $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
  });
})(jQuery);

$(document).ready(function () {
  $('.dropify').dropify({
    messages: {
      default: 'Drag atau drop untuk memilih gambar',
      replace: 'Ganti',
      remove: 'Hapus',
      error: 'error',
    },
  });
  // $('.dropify').change((e) => console.log(e))
});

// $('#bank').change((e) => {
//   console.log(e.target.value)
//   $('#bank-detail').text(e.target.value);
// });
