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
        
        if (response) {
          window.location = "/";
          window.location.reload();
        }
        else{
          console.log(response);
          Swal.fire("Error", "Ocurrió un problema al iniciar sesión", "error");
        }

        
      },
      error: (response) => {
        console.log(response);
        Swal.fire("¡Usuario o contraseña incorrecta!", "Por favor verifique el usuario y la contraseña", "error");
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
});
