//Info cursos

$(function() {
    $('.ocultar').hide();
    $('.programa-evento .info-curso:first').show()
    $('.menu-programa a:first').addClass('activo');
    $('.menu-programa a').on('click', function() {
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(500);
        return false;
    });

    //Menu fijo
    var barraAltura = $('.barra').innerHeight();
    var windowHeight = $(window).height();
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll > windowHeight) {
            $('.barra').addClass('fixed');
        } else {
            $('.barra').removeClass('fixed');
        }

    })

    //Menu responsive

    $('.menu-movil').on('click', function() {
        $('.navegacion-principal').slideToggle();

    })

    //Lettering

    $('.nombre-sitio').lettering();

});

//Agregar clase a menu

$('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
$('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
$('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');