/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/xls.js ***!
  \*****************************/
$(document).ready(function () {
  $(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
      }
    });
  });
  $('#xls_search').keyup(delay(function (e) {
    $xlsSearch = $(this);
    $xlsSearch.attr('disabled', true);
    $('.file-selector').attr('disabled', true);
    $.ajax({
      type: 'POST',
      url: '/xls/search',
      data: {
        xls_files: $.map($('.file-selector:checked'), function (element) {
          return element.value;
        }),
        needle: $('#xls_search').val()
      },
      success: function success(data) {
        $('form:has(.file-selector)').removeClass('file-not-found file-found');
        $('form:has(.file-selector:checked)').addClass('file-not-found');
        $('#results').html(data.markup);
        data.xls_files_found.forEach(function (fileName) {
          $("form:has(input.file-selector[value=\"".concat(fileName, "\"]:checked)")).addClass('file-found').removeClass('file-not-found');
        });
      },
      complete: function complete(data) {
        $xlsSearch.attr('disabled', false);
        $('.file-selector').attr('disabled', false);
      }
    });
    $('.file-selector').on('change', function () {
      $('#xls_search').trigger('keyup');
    });
  }, 2000)); //@TODO delay

  function delay(callback, ms) {
    var timer = 0;
    return function () {
      var context = this,
          args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  }
});
/******/ })()
;