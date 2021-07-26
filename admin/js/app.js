$(document).ready(function () {
    $('.sidebar-menu').tree()
    $('#registros').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'language' : {
          paginate: {
              next: 'Siguiente',
              previous : 'Anterior',
              last: 'Ultimo',
              first: 'Primero'
          },
          info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 registros',
          search: ' Buscar'
      }
    });
  })

  $('#crear-admin').attr('disabled', true);
  //Tiene sus bugs 
  $('#repetir_password').on('blur', function() {
    var password_nuevo = $('#password').val();
    var password_nuevo_repeticion = $('#repetir_password').val();
    if (password_nuevo == password_nuevo_repeticion) {
      $('#resultado_password').text('Correcto');
      $('#resultado_password').parents('.form-group').addClass('has-success').removeClass('has-error');
      $('input#password').parents('.form-group').addClass('has-sucxcess').removeClass('has-error');
      $('#crear_registro').attr('disabled', false);
    } 
    else {
      $('#resultado_password').text('Los passwords no coinciden!');
      $('#resultado_password').parents('.form-group').addClass('has-error').removeClass('has-success');
      $('input#password').parents('.form-group').addClass('has-error').removeClass('has-success');
      $('#crear_registro').attr('disabled', true);
    }

    
  })

  //Date picker
  $('#fecha').datepicker({
    autoclose: true
  });

  //Select2
  $('.seleccionar').select2();

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  });

  //Icon picker

  $('#icono').iconpicker();

  //iCheck
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass   : 'iradio_flat-blue'
  })
 
// LINE CHART
$.getJSON('servicio-registrados.php', function(data){
  var line = new Morris.Line({
    element: 'grafica-registros',
    resize: true,
    data: data,
    xkey: 'fecha',
    ykeys: ['cantidad'],
    labels: ['Item 1'],
    lineColors: ['#3c8dbc'],
    hideHover: 'auto'
  });
});


