    //Animaciones para los numeros
    let intersection = 0;
    const observer = new IntersectionObserver( function(entries){
        console.log(entries[0]);
        if(entries[0].isIntersecting && intersection === 0) {
            $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6 }, 2000);
            $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15 }, 2000);
            $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 3 }, 2000);
            $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9 }, 2000);
            intersection++;
        }
    });
    observer.observe(document.querySelector('.resumen-evento'));
     
    //Cuenta regresiva

    $('.cuenta-regresiva').countdown('2021/12/17 09:00:00', function(event) {
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));
    });