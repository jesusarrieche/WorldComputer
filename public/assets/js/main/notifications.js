$(document).ready(function() {


    // INTERACCION
    var down = false;

    $('#bell').click(function(e) {

        var color = $(this).text();
        if (down) {

            $('#box').css('height', '0px');
            $('#box').css('opacity', '0');
            down = false;
        } else {

            $('#box').css('height', 'auto');
            $('#box').css('opacity', '1');
            down = true;

        }

    });

    $('#getout').click(function(e) {
        $('#box').css('height', '0px');
        $('#box').css('opacity', '0');
        down = false;
    });


    // PETICIONES
    const getNotifications = () => {
        console.log("GetNotifications");
        $.ajax({
            type: "POST",
            url: "/WorldComputer/notificacion/listar",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);

                console.log(response.data.length);

                if (response.data.length !== 0) {

                    $('.notifications-item').remove();

                    response.data.forEach((e) => {
                        $('#box').append(`<div class="notifications-item"> <img src="https://freeiconshop.com/wp-content/uploads/edd/notification-flat.png" alt="img">
                            <div class="text">
                                <h4>${e.titulo.toUpperCase()}</h4>
                                <p>${e.mensaje}</p>
                            </div>
                        </div>`);
                    })




                } else {

                }

                // if( json.tipo == 'success'){

                //     Swal.fire(
                //         json.titulo,
                //         json.mensaje,
                //         json.tipo
                //     );


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

            }
        });
    }


    getNotifications();

    setInterval(getNotifications, 15000);




});