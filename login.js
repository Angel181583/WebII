$(document).ready(function () {
    var working = false;
    $('.login').on('submit', function (e) {
        e.preventDefault();
        if (working) return;
        working = true;
        var $this = $(this),
            $state = $this.find('button > .state');

        $this.addClass('loading');
        $state.html('Verificando');

        // Obtener datos del formulario
        var formData = {
            usuario: $this.find('input[type="text"]').val(),
            contrasena: $this.find('input[type="password"]').val()
        };

        // Enviar datos usando AJAX
        $.ajax({
            type: 'POST',
            url: 'php/log.php', // Asegúrate de que la ruta es correcta
            data: formData,
            success: function (response) {

                // Manejar la respuesta del servidor
                var jsonResponse = JSON.parse(response); // Convertir la respuesta JSON en un objeto

                if (jsonResponse.status === 'success') {
                    $this.addClass('ok');
                    $state.html('¡Bienvenido!');
                    $this.find('input[type="text"]').val('');
                    $this.find('input[type="password"]').val('');


                    // Redireccionar después de mostrar el mensaje
                    setTimeout(function () {
                        window.location.href = jsonResponse.redirect; // Redirigir
                    }, 1000); // Esperar 1 segundo antes de redirigir
                } else {
                    
                    $state.html('Usuario o contraseña incorrectos.'); // Mensaje de error
                    
                }

                setTimeout(function () {
                    $state.html('Acceder');
                    $this.removeClass('ok loading');
                    working = false;
                }, 4000);
            },
            error: function () {
                // Manejar errores de conexión
                $state.html('Error de conexión. Inténtalo de nuevo.');
                setTimeout(function () {
                    $state.html('Acceder');
                    $this.removeClass('loading');
                    working = false;
                }, 4000);
            }
        });
    });
});
