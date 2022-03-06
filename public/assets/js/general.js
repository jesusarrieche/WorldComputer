function desglosarMensajeError(mensaje){
    let mensajeNuevo = mensaje;
    if(mensaje.search('SQLSTATE') >= 0){
        console.log('error sql');
        if (mensaje.search('Duplicate entry') >= 0) {
            console.log('dato duplicado');
            let mensajeDesg = mensaje.split("'");
            let campo = mensajeDesg[3];
            campo = campo.charAt(0).toUpperCase() + campo.slice(1);
            if(campo == "Usuario"){
                campo = "Nombre de Usuario";
            }
            if(campo == "Email"){
                campo = "Correo Electrónico";
            }
            if(campo == "Documento"){
                campo = "Documento (Cédula/Rif)";
            }
            mensajeNuevo = `El "${campo}" que ingresó se encuentra registrado en el sistema`;
        }
        else{
            mensajeNuevo = "Ocurrió un error. Por favor, intente de nuevo";
        }
    }
    return mensajeNuevo
}

function round(num) {
    var m = Number((Math.abs(num) * 100).toPrecision(15));
    return Math.round(m) / 100 * Math.sign(num);
}
