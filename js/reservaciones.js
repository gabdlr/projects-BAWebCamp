/*Esta funcion inicial le indica al codigo JavaScript que espere a que todo el contenido html este cargado para comenza a ejecutarse,
el 'use strict' implica que esta accion solo se ejecutara una vez, esto prevee que todo el html este cargado para que el JavaScript
se ejecute con normalidad sobre los elementos html*/

(function() {
    'use strict';
    var regalo = document.getElementById('regalo');
    document.addEventListener('DOMContentLoaded', function() {

        //Campos datos usuarios
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');
        //Campos pases
        var pase_dia = document.getElementById('pase_dia');
        var pase_dos_dias = document.getElementById('pase_dos_dias');
        var pase_completo = document.getElementById('pase_completo');
        //Botones y divs
        var calcular = document.getElementById('calcular');
        var errorDiv = document.getElementById('error');
        var botonRegistro = document.getElementById('btnRegistro');
        var lista_productos = document.getElementById('lista-productos');
        var suma = document.getElementById('suma-total');
        //Extras
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');

        //Post formulario
        botonRegistro.disabled = true;

        calcular.addEventListener('click', calcularMontos);
        pase_dia.addEventListener('blur', mostrarDias);
        pase_dos_dias.addEventListener('blur', mostrarDias);
        pase_completo.addEventListener('blur', mostrarDias);

        nombre.addEventListener('blur', validarCampos);
        apellido.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarMail)

        //Esto se agrego posteriormente para el modulo de administracion
        if(pase_dia.value || pase_dos_dias.value || pase_completo.value) {
            mostrarDias();
        }

        function validarCampos() {
            if (this.value == '') {
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = 'Este campo es obligatorio';
                this.style.border = '1px solid red';
            } else {
                errorDiv.style.display = 'none';
                this.style.border = '1px solid';
            }
        }

        function validarMail() {
            if (this.value.indexOf('@') > -1) {
                errorDiv.style.display = 'none';
                this.style.border = '1px solid';
            } else {
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = 'Debe colocar una direccion de correo valida';
                this.style.border = '1px solid red';
            }
        }

        function calcularMontos(event) {
            event.preventDefault();
            if (regalo.value === '') {
                alert('Debes elegir un regalo');
                regalo.focus();
            } else {
                var boletosDia = pase_dia.value,
                    boletos2Dias = pase_dos_dias.value,
                    boletoCompleto = pase_completo.value,
                    cantCamisas = camisas.value,
                    cantEtiquetas = etiquetas.value;
                var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10) * 0.93) + (cantEtiquetas * 2);
                var listadoProductos = [];
                if (boletosDia >= 1) {
                    listadoProductos.push(boletosDia + ' Pases por dia');
                }
                if (boletos2Dias >= 1) {
                    listadoProductos.push(boletos2Dias + ' Pases por dos dias');
                }
                if (boletoCompleto >= 1) {
                    listadoProductos.push(boletoCompleto + ' Pases completo');
                }
                if (cantCamisas >= 1) {
                    listadoProductos.push(cantCamisas + ' Camisas');
                }
                if (cantEtiquetas >= 1) {
                    listadoProductos.push(cantEtiquetas + ' Etiquetas');
                }
                //se coloca lista_productos.innerHTML = '' para que no recargue toda la lista al cambiar un valor
                lista_productos.style.display = "block"; //Mostrara el borde solo cuando se alla ejecutado lista_productos
                lista_productos.innerHTML = '';
                for (var i = 0; i < listadoProductos.length; i++) {
                    lista_productos.innerHTML += listadoProductos[i] + '</br>';
                }
                suma.innerHTML = "$" + totalPagar.toFixed(2);

                botonRegistro.disabled = false;
                document.getElementById('total_pedido').value = totalPagar;

            }

        }

        function mostrarDias() {
            var boletosDia = pase_dia.value,
                boletos2Dias = pase_dos_dias.value,
                boletoCompleto = pase_completo.value;
            var diasElegidos = []

            if (boletosDia >= 1) {
                diasElegidos.push('viernes');
            }
            if (boletos2Dias >= 1) {
                diasElegidos.push('viernes', 'sabado');
            }
            if (boletoCompleto >= 1) {
                diasElegidos.push('viernes', 'sabado', 'domingo');
            }
            for (var i = 0; i < diasElegidos.length; i++) {
                document.getElementById(diasElegidos[i]).style.display = 'block';
            }
            if (boletosDia == 0 && boletos2Dias == 0 && boletoCompleto == 0) {
                document.getElementById('viernes').style.display = 'none',
                    document.getElementById('sabado').style.display = 'none',
                    document.getElementById('domingo').style.display = 'none';
            }
            if (boletoCompleto == 0) {
                document.getElementById('domingo').style.display = 'none';
            }
            if (boletosDia == 1 && boletos2Dias == 0 && boletoCompleto == 0) {
                document.getElementById('sabado').style.display = 'none',
                    document.getElementById('domingo').style.display = 'none';
            }

        }



    }); //DOM CONTENT LOADED
})();