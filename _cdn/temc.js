$(document).ready(function () {
    //CONTROLE DO MENU MOBILE
    $('.mobile_action').removeClass('active');
    $('.mobile_action').click(function () {

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
            $('.main_header_nav').animate({'left': '0px'}, 300);

        } else {
            $(this).removeClass('active');
            $('.main_header_nav').animate({'left': '-100%'}, 300);
        }
    });

//    $('.j_nav_sub').addClass('close');
    $('.j_nav').click(function () {
        if (!$(this).hasClass('open')) {
            $(this).addClass('open');
            $(this).addClass('selected');
//            $('.j_nav_sub').removeClass('close');
            $('.j_nav_sub').slideDown('slow');
        } else {
            $(this).removeClass('open');
            $(this).removeClass('selected');
//            $('.j_nav_sub').addClass('close');
            $('.j_nav_sub').slideUp('slow');
        }
    });

    //Habilita campos para renovar seguro
    $(".renovar").attr(":disabled", true);
    $(".RenovarSeguroBloco").hide();
    $('.RenovarSeguro').click(function () {
        var renovar = "";
        $('input:radio[name=RenovarSeguro]').each(function () {
            if ($(this).is(':checked'))
                renovar = $(this).val();
        });
        if (renovar === "sim") {
            $(".renovar").attr("disabled", false);
            $(".RenovarSeguroBloco").slideDown('slow');
        } else {
            if (renovar === "nao") {
                $(".renovar").attr("disabled", true);
                $(".RenovarSeguroBloco").slideUp('slow');
            }
        }
    });

    //Habilita campos do formulário caso o assegurado 
    //não seja o condutor principal.
    $(".CondutorPrincipalNome").attr("disabled", true);
    $(".condutor1").hide();
    $('.CondutorPrincipal').click(function () {
        var condutor2 = "";
        $('input:radio[name=CondutorPrincipal]').each(function () {
            if ($(this).is(':checked'))
                condutor2 = $(this).val();
        });
        if (condutor2 === "sim" || condutor2 === "indeterminado") {
            $(".CondutorPrincipalNome").attr("disabled", true);
            $(".condutor1").slideUp('slow');
        } else {
            if (condutor2 === "nao") {
                $(".CondutorPrincipalNome").attr("disabled", false);
                $(".condutor1").slideDown('slow');
            }
        }
    });

    //Efeito de touch no slide
    $('.j_touch').on('swiperight', function () {
        clearInterval(slideAuto);
        slideBack();
        slideAuto = setInterval(slideGo, 4000);
    });

    $('.j_touch').on('swipeleft', function () {
        clearInterval(slideAuto);
        slideGo();
        slideAuto = setInterval(slideGo, 4000);
    });


    //Efeito de slide na página inicial
    var slideAuto = setInterval(slideGo, 4000);

    $('.slide_nav.go').click(function () {
        clearInterval(slideAuto);
        slideGo();
        slideAuto = setInterval(slideGo, 4000);
    });

    $('.slide_nav.back').click(function () {
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
//        if ($('.slide_item.first').index() >= $('.slide_item').length) {
        if ($('.slide_item.first').index() > 1){
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
