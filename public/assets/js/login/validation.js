$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
      type: "POST",
      url: "/WorldComputer/login/login",
      cache: false,
      data: data,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);

        window.location = "/";
        window.location.reload();

        // if( json.tipo == 'success'){

        // }else{
        //     Swal.fire(
        //         json.titulo,
        //         json.mensaje,
        //         json.tipo
        //     );
        // }
      },
      error: (response) => {
        console.log(response);
        Swal.fire("¡Usuario o contraseña incorrecta!", "Por favor verifique el usuario y la contraseña", "error");
      },
    });
  });
});
