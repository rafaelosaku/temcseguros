$(document).ready(function (e) {
    $('.sub-menu').hide();
    $('.show-sub-menu').hover(function () {
        $(this).find('.sub-menu').slideDown('slow');
    }, function () {
        $(this).find('.sub-menu').slideUp('fast');
    });
});


