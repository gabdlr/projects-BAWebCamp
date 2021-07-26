$(document).ready(function() {

//Crear un registro
$('#guardar-registro').on('submit', function(e) {
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
                var resultado = (data);
                if (resultado.respuesta == 'exito') {
                    Swal({
                        title: 'Exito',
                        text: 'Los datos se han guardado correctamente!',
                        type: 'success'
                    });
                    console.log(resultado);
                    
                } else {
                    // hubo un error
                    swal({
                        type: 'error',
                        title: 'Error!',
                        text: 'Hubo un error!'
                    })
                    console.log(resultado);
                }
            }
        })       
});

//Con archivo
$('#guardar-registro-archivo').on('submit', function(e) {
    e.preventDefault();
    
    // El this en este caso se refiere al formulario #crear-admin(id)
    // serializeArray es una funcion de jQuery 
    // que devuelve los datos que enviamos con el post en un arreglo
    var datos = new FormData(this); 
    
    //Llamado a xhr (ajax) en jQuery
    $.ajax({
        
        type: $(this).attr('method'),
        data: datos,
        
        url: $(this).attr('action'),
        dataType: 'json',
        //Esto se agrega cuando estamos trabajando con archivos
        contentType: false,
        processData: false,
        async: true,
        cache: false,
        success: function(data) {
            var resultado = data;
            if (resultado.respuesta == 'exito') {
                Swal({
                    title: 'Exito',
                    text: 'Los datos se han guardado correctamente!',
                    type: 'success'
                });
                console.log(resultado);
                 
            } else {
                // hubo un error
                swal({
                    type: 'error',
                    title: 'Error!',
                    text: 'Hubo un error!'
                })
                console.log(resultado);
            }
        }
    })       
});

//Eliminar un registro
$('.borrar-registro').on('click', function(e) {
    e.preventDefault();

    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');

    swal({
        title: 'Estas seguro?',
        text: "Este cambio no se puede revertir!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
        }).then((result) =>   {                     
            if (result.value) {$.ajax({
                    type: 'post',
                    data: {
                        id : id,
                        registro : 'eliminar'
                    },
                    url: 'modelo-'+tipo+'.php',
                    success: function(data) {
                        var resultado = JSON.parse(data);
                        jQuery('[data-id="'+ resultado.id_eliminado +'"]').parents('tr').remove();
                        swal({
                            title: 'Eliminado!',
                            text:'El registro ha sido eliminado.',
                            type: 'success'
                        });
                    }
                
                })//Ajax 
            };
        });//Then sweet alert                       
    });//Borrar registro  
}) //Document Ready