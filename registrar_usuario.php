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


<!DOCTYPE html>
<html lang="es">

<?php $title = "Registro de Usuario"; ?>
<?php include 'layout/metedatos_css.php'; ?>

<body class="d-flex flex-column min-vh-100">

    <?php include __DIR__ . '/layout/header.php'; ?>

    <main class="flex-fill min-h-100 d-flex flex-column justify-content-center align-items-center">

        <!--#ventajamodal -->
        <div id="ventajamodal">
            <div class="modal_cont">
                <a href="#">X</a>
                <h2 id="msg_avizar"><?php echo (isset($nombreUsuario) ? $nombreUsuario . ", " : '') . $avisar; ?>
                </h2>
            </div>
        </div>

        <div class="container-fluid d-flex flex-column justify-content-center align-items-center m-3">
            <div class="card shadow col-xl-5 col-lg-7 col-md-8">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Registro de Usuario</h1>
                    <form class="container-fluid wh-100" id="registroForm" novalidate>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <div id="errorNombre" class="text-danger"></div>
                            <div class="invalid-feedback">
                                Por favor, ingresa tu nombre.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div id="errorEmail" class="text-danger"></div>
                            <div class="invalid-feedback">
                                Por favor, ingresa un email válido.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>

                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required minlength="8">
                                <button type="button" class="btn btn-outline-secondary" id="btnToggleView">
                                    <i id="toggleIcon" class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnGenerar">Generar</button>
                                <button type="button" class="btn btn-outline-primary" id="btnCopiar">Copiar</button>
                                <div id="errorPassword" class="text-danger"></div>
                                <div id="invalid-pass" class="invalid-feedback">
                                    La contraseña debe tener al menos 8 caracteres.
                                </div>
                            </div>

                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>

                    </form>

                    <!-- contenedor para mostrar mensajes -->
                    <div id="formMessage"></div>

                    <div class="text-center my-3 ">

                        <p>Mas facil <i class="fa-regular fa-hand-point-down"></i></p>
                        <form class="container-fluid wh-100" action="google_login.php" method="POST">
                            <button type="submit" class="btn btn-outline-danger w-100 mb-2 m-1">
                                <i class="bi bi-google"></i> Registrar o Iniciar sesión con Google
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/validator@latest/validator.min.js"></script>

        <script>
            function generarContrasenaSegura(longitud = 12) {
                const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()";
                let contrasena = "";
                for (let i = 0; i < longitud; i++) {
                    const indiceAleatorio = Math.floor(Math.random() * caracteres.length);
                    contrasena += caracteres[indiceAleatorio];
                }
                return contrasena;
            }

            // Generar la contraseña al hacer clic en el botón "Generar"
            document.getElementById("btnGenerar").addEventListener("click", () => {
                const passwordField = document.getElementById("password");
                passwordField.value = generarContrasenaSegura(12); // Longitud de 12 caracteres
            });

            // Copiar la contraseña al portapapeles
            document.getElementById("btnCopiar").addEventListener("click", () => {
                const passwordField = document.getElementById("password");
                if (passwordField.value) {
                    navigator.clipboard.writeText(passwordField.value)
                        .then(() => {
                            alert("¡Contraseña copiada al portapapeles!");
                        })
                        .catch(err => {
                            alert("Hubo un error al copiar la contraseña: " + err);
                        });
                } else {
                    alert("No hay contraseña para copiar. Por favor, genera una primero.");
                }
            });

            // Alternar visibilidad de la contraseña
            document.getElementById("btnToggleView").addEventListener("click", () => {
                const passwordField = document.getElementById("password");
                const toggleIcon = document.getElementById("toggleIcon");

                if (passwordField.type === "password") {
                    passwordField.type = "text"; // Cambia a texto visible
                    toggleIcon.classList.replace("bi-eye", "bi-eye-slash"); // Cambia el ícono a "ojo cerrado"
                } else {
                    passwordField.type = "password"; // Vuelve a enmascarar
                    toggleIcon.classList.replace("bi-eye-slash", "bi-eye"); // Cambia el ícono a "ojo abierto"
                }
            });
        </script>


        <script>
            const nombreCampo = document.getElementById('nombre');
            const emailCampo = document.getElementById('email');

            const errorNombre = document.getElementById('errorNombre');
            const errorEmail = document.getElementById('errorEmail');
            const errorPassword = document.getElementById('errorPassword');

            const msg_avizar = document.getElementById('msg_avizar');
            var passwordField = document.getElementById('password');
            var invalidPassMessage = document.getElementById('invalid-pass');

            // Validación del campo 'email' con validator.js  
            emailCampo.addEventListener('input', function() {
                if (!emailCampo.value.trim()) {
                    errorEmail.innerText = 'El email es requerido.';
                } else if (!validator.isEmail(emailCampo.value.trim())) {
                    errorEmail.innerText = 'Che, introduce un email válido.';
                } else {
                    errorEmail.innerText = '';
                }
            });

            // Validación del campo 'password'
            passwordField.addEventListener('input', function() {
                // Verificar si la contraseña cumple con la longitud mínima
                if (passwordField.value.length < 8) {
                    // Si no cumple con los requisitos, mostrar el mensaje de error
                    invalidPassMessage.style.display = 'block'; // Mostrar el mensaje de error
                } else {
                    invalidPassMessage.style.display = 'none'; // Ocultar el mensaje de error al inicio
                }
            });

            document.getElementById('registroForm').addEventListener('submit',
                function(event) {
                    event.preventDefault();

                    if (this.checkValidity()) {
                        // Aquí iría el código para enviar los datos al servidor

                        const formData = new FormData(event.target); // Obtiene los datos del formulario

                        fetch('api_post_reg.php', {
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
                    }

                    this.classList.add('was-validated');
                });

            function manejarRespuesta(data) {

                console.log(data); // Mostrar la respuesta completa en la consola

                if (!data) {
                    formMessage.textContent = "data nulo..";
                    return;
                }

                if (data.status == "exito") {
                    ////EXIT //////////////////////////////////////////////////////////////////////////////
                    const mensaje = encodeURIComponent("registraste con exito y iniciaste seccion...");
                    window.location.href = `index.php?avisar=${mensaje}#ventajamodal`;
                    return;
                }
                if (data.status) {
                    formMessage.innerHTML = data.msg;
                    msg_avizar.innerHTML = data.msg;
                    window.location.href = "#ventajamodal";
                    return;
                } else formMessage.textContent = '';

                // Validación a través de la respuesta del servidor
                errorNombre.textContent = data.nombre ? "" : "El nombre no puede estar vacío.";
                errorEmail.textContent = data.email ? "" : "El email no es correcto.";
                errorPassword.textContent = data.password ? "" : "La contraseña no puede estar vacía.";

            }
        </script>
    </main>

    <?php include 'layout/footer.php'; ?>


</body>

</html>