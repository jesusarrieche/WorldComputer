$(document).ready(function () {
    const actualizarUsuario = (datos) => {
        $.ajax({
            type: "POST",
            url: "Usuario/actualizar",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log("R:" + response);
                let json = JSON.parse(response);
                if (json.tipo == 'success') {

                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
                    // setTimeout(function () {
                    //     window.location.reload();
                    // }, 1000);
                } else {
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
                }
            },
            error(response) {
                console.log(response);
            }
        });
    }
    /**
    * VARIABLES
    */
    var seguridadImgActu = "", seguridadPreguntaActu = seguridadPregunta;
    //Selección de imagen de seguridad
    $('.card-seguridad-img').on('click', function(e){
        seguridadImgActu = $(this).attr('data-img');
        $('.card-seguridad-img').removeClass('bg-primary');
        $(this).addClass('bg-primary');
        console.log(seguridadImgActu)
    })

    $('#formularioActualizarUsuario').submit(async function (e) {
        e.preventDefault();
        var requerirAutenticacion = false;
        let datos = new FormData(document.querySelector('#formularioActualizarUsuario'));
        if (datos.get('contrasena') != datos.get('confirmarContrasena')) {
            Swal.fire(
                "Error",
                "Las Contraseñas no coinciden",
                "warning"
            );
            return 0;
        }
        if (datos.get('seguridad_respuesta') != "" &&
            (datos.get('seguridad_respuesta').length < 3 || datos.get('seguridad_respuesta').length > 20)) {
            Swal.fire(
                "Error",
                `Escoja una pregunta de seguridad e indique la respuesta.\n
                    Debe contener entre 3 y 20 caracteres`,
                "warning"
            );
            return 0;
        }
        if (seguridadImgActu != "" || datos.get('seguridad_pregunta') != seguridadPreguntaActu || datos.get('seguridad_respuesta') != "") {
            requerirAutenticacion = true;
        }
        if (requerirAutenticacion) {
            let sesionAutenticada = await getSesionAutenticada();
            if (!sesionAutenticada) {
                iniciarAutenticacion();
                return 0;
            }
        }
        datos.append('seguridad_img', seguridadImgActu);
        actualizarUsuario(datos);
    });
});