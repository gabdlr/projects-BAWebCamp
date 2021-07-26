$(document).ready(function() {
    $('#login-admin').on('submit', function(e) {
    e.preventDefault();
    
    // El this en este caso se refiere al formulario #crear-admin(id)
    // serializeArray es una funcion de jQuery 
    // que devuelve los datos que enviamos con el post en un arreglo
    var datos = $(this).serializeArray(); 
    
    //Llamado a xhr (ajax) en jQuery
        $.ajax({
            // Se especifica el tipo de request
            // tomandolo desde el formulario #crear-admin
            type: $(this).attr('method'),
            data: datos,
            // Especifica a donde se enviara los datos (el action del form)
            url: $(this).attr('action'),
            // El tipo de dato, lo enviamos como un json
            dataType: 'json',
            success: function(data) {
                var resultado = data;
                if (resultado.respuesta == 'exito') {
                    Swal({
                        title: 'Login correcto',
                        text: 'Bienvenid@, ' + resultado.usuario + '!!',
                        type: 'success'
                    })
                    setTimeout(function(){
                        window.location.href = 'index.php'
                    }, 1000);
                } else {
                        // hubo un error
                        swal({
                        type: 'error',
                        title: 'Error!',
                        text: 'Usuario o password incorrectos!'
                        })
                }
            }
        })
       
    });

})