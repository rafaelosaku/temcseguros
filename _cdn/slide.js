//Efeito de slide na página inicial
$(function () {

    var slideAuto = setInterval(slideGo, 4000);

    $('.slide_nav_item.g').click(function () {
        clearInterval(slideAuto);
        slideGo();
        slideAuto = setInterval(slideGo, 4000);
    });

    $('.slide_nav_item.b').click(function () {
        clearInterval(slideAuto);
        slideBack();
        slideAuto = setInterval(slideGo, 4000);
    });

    function slideGo() {
        if ($('.slide_item.first').next().size()) {
            $('.slide_item.first').fadeOut(400, function () {
                $(this).removeClass('first').next().fadeIn().addClass('first');
            });
        } else {
            $('.slide_item.first').fadeOut(400, function () {
                $('.slide_item').removeClass('first');
                $('.slide_item:eq(0)').fadeIn().addClass('first');
            });
        }
    }

    function slideBack() {
        if ($('.slide_item.first').index() > 1) {
            $('.slide_item.first').fadeOut(400, function () {
                $(this).removeClass('first').prev().fadeIn().addClass('first');
            });
        } else {
            $('.slide_item.first').fadeOut(400, function () {
                $('.slide_item').removeClass('first');
                $('.slide_item:last-of-type').fadeIn().addClass('first');
            });
        }
    }

});