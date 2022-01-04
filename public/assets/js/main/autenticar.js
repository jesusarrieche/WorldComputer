//Variables
var seguridadImgAutenticar = "";
// Función para autenticar usuario
const autenticarUsuario = (datos) =>{
    $.ajax({
        type: "POST",
        url: "Usuario/autenticar",
        data: datos,
        contentType: false,
        processData: false,
        success: function (response) {
            let json = JSON.parse(response);
            console.log(json)
            if( json.tipo == 'success'){
                ToastAlert.fire({
                    title: json.titulo,
                    html: json.mensaje,
                    icon: json.tipo,
                })      
                $('.card-seguridad-img-autenticar').removeClass('bg-primary');
                seguridadImgAutenticar = "";
                $('#modalAutenticarUsuario').modal('hide');
                $('#formularioAutenticarUsuario').trigger('reset');
            }else{
                Swal.fire(
                    json.titulo,
                    json.mensaje,
                    json.tipo
                );
            }
        },
        error: (response) => {
            console.log(response);
            ToastAlert.fire({
                title: 'Error',
                html: 'Ocurrió un error. Por favor intente de nuevo',
                icon: 'error',
            })
        }
    });
}
// Obtener variable que indica si el usuario está autenticado en la sesión actual 
async function getSesionAutenticada(){
    let sesionAutenticada = await fetch("Usuario/getSesionAutenticada",{
        method: "POST"
    })
    .then(res=> res.json())
    .then(res => {
        if(res.tipo == 'success'){
            return res.mensaje;
        }
        else{
            return false;
        }
    })
    .catch(err => {
        console.log(err)
    });
    return sesionAutenticada;
}
// Iniciar el proceso de autenticación
function iniciarAutenticacion(){
    fetch("Usuario/getSeguridadPregunta",{
        method: "POST"
    })
    .then(res=> res.json())
    .then(res => {
        if(res.tipo == 'success'){
            let seguridadPregunta = res.mensaje;
            $('#formularioAutenticarUsuario').find('#seguridad_pregunta').val(seguridadPregunta);
        }
        else{
            ToastAlert.fire({
                title: 'Error',
                html: 'Ocurrió un error al cargar algunos datos. Por favor intente de nuevo',
                icon: 'error',
            })
        }
    })
    .catch(err => {
        console.log(err)
    });
    ToastAlert.fire({
        title: 'Alerta',
        html: 'Debe Autenticar su Usuario para poder continuar con el proceso',
        icon: 'info',
    })
    $('#modalAutenticarUsuario').modal('show');
}

//Selección de imagen de seguridad
$('.card-seguridad-img-autenticar').on('click', function(e){
        seguridadImgAutenticar = $(this).attr('data-img');
    $('.card-seguridad-img-autenticar').removeClass('bg-primary');
    $(this).addClass('bg-primary');
})

$('#formularioAutenticarUsuario').submit(async function (e) { 
    e.preventDefault();
    let datos = new FormData(document.querySelector('#formularioAutenticarUsuario'));
    if(seguridadImgAutenticar == ""){
        Swal.fire(
            "Error",
            "Debe escoger una imagen de seguridad",
            "warning"
        );
        return 0;
    }
    if(datos.get('seguridad_respuesta') == "" || datos.get('seguridad_respuesta').length < 3 || datos.get('seguridad_respuesta').length > 20){
        Swal.fire(
            "Error",
            `Indique la respuesta a la pregunta de seguridad.\n
                Debe contener entre 3 y 20 caracteres`,
            "warning"
        );
        return 0;
    }
    datos.append('seguridad_img', seguridadImgAutenticar);
    autenticarUsuario(datos);
});

//Alertas pequeñas
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-start',
    showConfirmButton: false,
});

const ToastAlert = Swal.mixin({
    toast: true,
    position: 'bottom-start',
    timer: 4000,
    showConfirmButton: false,
});
// Toast.fire({
//     title: 'Espere!',
//     icon: 'info',
//     html: 'Los datos están siendo procesados',// add html attribute if you want or remove
//     allowOutsideClick: false,
//     onBeforeOpen: () => {
//       Swal.showLoading()
//     },
// });