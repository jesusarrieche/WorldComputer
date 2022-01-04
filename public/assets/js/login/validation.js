$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
      type: "POST",
      url: "login/login",
      cache: false,
      data: data,
      contentType: false,
      processData: false,
      success: function (response) {
        let res = JSON.parse(response);
        if (res.tipo == 'success') {
          window.location = "/";
          window.location.reload();
        }
        else {
          Swal.fire(
            res.titulo,
            res.mensaje,
            res.tipo
          );
        }
      },
      error: (response) => {
        console.log(response);
        Swal.fire("¡Error!", "Ocurrió un problema al iniciar sesión ", "error");
      },
    });
    Toast.fire({
      title: 'Espere!',
      html: 'Los datos están siendo procesados',// add html attribute if you want or remove
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading()
      },
    });
  });
  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-start',
    showConfirmButton: false,
  });

  const ToastAlert = Swal.mixin({
    toast: true,
    position: 'bottom-start',
    timer: 2500,
    showConfirmButton: false,
  });

  //---- JS funcionalidad recuperar contraseña

  $('#recuperarContrasena').on('click', function () {
    $('#modalRecuperarContrasena').modal('show');
  });


  const enviarCorreoRecuperacion = (datos) => {

    $.ajax({
      type: "POST",
      url: "Login/linkRecuperacion",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log("R: " + response);
        let json = JSON.parse(response);

        console.log(json);

        if (!json.error) {
          $('#modalRecuperarContrasena').modal('hide');

          ToastAlert.fire({
            title: '',
            icon: 'success',
            html: `${json.message}`,
            allowOutsideClick: false,
          });

          $('#linkRecuperacion').text(json.link);
          $('#simulacionCorreo').toast('show');
        } else {
          ToastAlert.fire("¡Error!", json.message, "error");
        }
      },
      error: (response) => {
        console.log(response);

      }
    });
  }


  $('#formularioRecuperarContrasena').on('submit', function (e) {
    e.preventDefault();

    let datos = new FormData(document.querySelector('#formularioRecuperarContrasena'));

    enviarCorreoRecuperacion(datos);

  })

});
