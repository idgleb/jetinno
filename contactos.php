<?php
include_once __DIR__ . "/funciones.php";
iniciarSession();

if (sanitario($_REQUEST["cerrar"] ?? "")) cierreSession();

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nombreUsuario = $usuario->getNombre();
}

$avisar = sanitario($_REQUEST["avisar"] ?? "");

?>

<?php

include_once "funciones.php";

?>

<!DOCTYPE html>
<?php $title = "CONTÁCTENOS"; ?>
<?php include 'layout/metedatos_css.php'; ?>

<body>

    <!--#ventajamodal -->
    <div id="ventajamodal">
        <div class="modal_cont">
            <a href="#">X</a>
            <h2 id="msg_avizar"><?php echo (isset($nombreUsuario) ? $nombreUsuario . ", " : '') . $avisar; ?>
            </h2>
        </div>
    </div>

    <?php include 'layout/header.php'; ?>

    <main>
        <div class="width90centr">
            <h2>CONTÁCTENOS</h2>
        </div>


        <div class="caja_form_mapa">

            <div class="caja_formulario">

                <form id="contactForm" class="container mt-4">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control mb-0" id="nombre" name="nombre" value="">
                        <div id="errorNombre" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control mb-0" id="email" name="email" value="">
                        <div id="errorEmail" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Ciudad:</label>
                        <input type="text" class="form-control mb-0" id="ciudad" name="ciudad" value="">
                        <div id="errorCiudad" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje:</label>
                        <textarea class="form-control mb-0" id="mensaje" name="mensaje" rows="4"></textarea>
                        <div id="errorMensaje" class="text-danger"></div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar</button>
                </form>
                <!-- contenedor para mostrar mensajes -->
                <div id="formMessage"></div>

            </div>

            <iframe class="caja_formulario" id="mapa"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.016888186409!2d-58.38414532495866!3d-34.603734457497914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4aa9f0a6da5edb%3A0x11bead4e234e558b!2z0J7QsdC10LvQuNGB0Log0LIg0JHRg9GN0L3QvtGBLdCQ0LnRgNC10YHQtQ!5e0!3m2!1sru!2sar!4v1718325764845!5m2!1sru!2sar"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>

        </div>

    </main>

    <?php include 'layout/footer.php'; ?>

</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/validator@latest/validator.min.js"></script>

<script>
    const contactForm = document.getElementById('contactForm');
    const nombreCampo = document.getElementById('nombre');
    const emailCampo = document.getElementById('email');
    const ciudadCampo = document.getElementById('ciudad');
    const mensajeCampo = document.getElementById('mensaje');

    const msg_avizar = document.getElementById('msg_avizar');

    const errorNombre = document.getElementById('errorNombre');
    const errorEmail = document.getElementById('errorEmail');
    const errorCiudad = document.getElementById('errorCiudad');
    const errorMensaje = document.getElementById('errorMensaje');


    nombreCampo.addEventListener('input', function() {
        if (!nombreCampo.value.trim()) {
            errorNombre.innerText = "El nombre es requerido.";
        } else {
            errorNombre.innerText = "";
        }
    });

    // Validación del campo 'email' con validator.js  
    emailCampo.addEventListener('input', function() {
        if (!emailCampo.value.trim()) {
            errorEmail.innerText = 'El email es requerido.';
        } else if (!validator.isEmail(emailCampo.value.trim())) {
            errorEmail.innerText = 'Por favor, introduce un email válido.';
        } else {
            errorEmail.innerText = '';
        }
    });

    ciudadCampo.addEventListener('input', function() {
        if (!ciudadCampo.value.trim()) {
            errorCiudad.innerText = "El ciudad es requerido.";
        } else {
            errorCiudad.innerText = "";
        }
    });

    mensajeCampo.addEventListener('input', function() {
        if (!mensajeCampo.value.trim()) {
            errorMensaje.innerText = "El mensaje es requerido.";
        } else {
            errorMensaje.innerText = "";
        }
    });


    document.addEventListener('DOMContentLoaded', function() {

        contactForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el comportamiento predeterminado del formulario

            const formData = new FormData(contactForm);

            fetch('subir_formulario.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta de la red');
                    }
                    return response.json();
                })
                .then(data => {
                    manejarRespuesta(data);
                })
                .catch(error => {
                    console.error('Error:', error); // Mostrar cualquier error en la consola
                    formMessage.style.color = 'red';
                    formMessage.textContent = 'Ocurrió un error al enviar el formulario.';
                });
        });
    });


    function manejarRespuesta(data) {

        console.log(data); // Mostrar la respuesta completa en la consola para depurar

        if (data.msg == "A la brevedad nos pondremos en contacto con usted.") {
            nombreCampo.value = '';
            emailCampo.value = '';
            ciudadCampo.value = '';
            mensajeCampo.value = '';

            formMessage.textContent = "Tu mensaje enviado con exito";
            msg_avizar.innerText = data.msg;
            window.location.href = "#ventajamodal";

        } else if (data.msg) {
            formMessage.textContent = data.msg;
            msg_avizar.innerText = data.msg;
            window.location.href = "#ventajamodal";
        } else formMessage.textContent = '';

        //validacion atraves de respuesta de servidor
        if (data.nombre === "") {
            errorNombre.textContent = "Nombre no puede ser vacio";
        } else errorNombre.textContent = "";

        if (data.email === "") {
            errorEmail.textContent = "Email no correcto";
        } else errorEmail.textContent = "";

        if (data.ciudad === "") {
            errorCiudad.textContent = "Ciudad no puede ser vacio";
        } else errorCiudad.textContent = "";

        if (data.message === "") {
            errorMensaje.textContent = "Mensaje no puede ser vacio";
        } else errorMensaje.textContent = "";

    }
</script>