<?php
include_once __DIR__ . "/funciones.php";
iniciarSession();

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nombreUsuario = $usuario->getNombre();
    $rolUsuario = $usuario->getRol();
}

if (!isset($rolUsuario)) {
    header("Location: index.php?avisar=" . urlencode("No tenes derecho") . "#ventajamodal");
    exit;
}
if ($rolUsuario != "admin") {
    header("Location: index.php?avisar=" . urlencode("No tenes derecho") . "#ventajamodal");
    exit;
}

$avisar = sanitario($_REQUEST["avisar"] ?? "");

?>


<!DOCTYPE html>
<?php $title = "USUARIOS"; ?>
<?php include 'layout/metedatos_css.php'; ?>

<body>

    <!--#ventajamodal -->
    <div id="ventajamodal">
        <div class="modal_cont ">
            <batton
                onclick="cerrarModal()"
                href=""
                class="btn btn-danger text-dark baton"
                data-bs-toggle="popover"
                data-bs-trigger="hover"
                data-bs-content="cerrar"
                data-bs-placement="top">X
            </batton>

            <h2 class="no-bootstrap" id="msg_avizar1">
                <?php echo (isset($nombreUsuario) ? $nombreUsuario . ", " : '') . $avisar; ?>
                <span id="msg_avizar"></span>
            </h2>

        </div>
    </div>


    <?php include 'layout/admin_header.php'; ?>

    <main>

        <div class="width90centr">
            <h2 class="mb-1">Corregir Usuarios</h2>

            <?php

            $elementosPorPagina = 5;

            $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $paginaActual = sanitario($paginaActual);

        
            $totalPaginas = calcularTotalPaginasUsuarios($elementosPorPagina);

            mostrarBotonesNav($paginaActual, $totalPaginas, true);

            $offset = ($paginaActual - 1) * $elementosPorPagina;

            $redirectSiError = true;

            $result = obtenerUsuariosDeBase($redirectSiError, $elementosPorPagina, $offset);

            // Verificar si hay usuarios
            if ($result->num_rows > 0) :
                $iter = 0;
                while ($usuario = $result->fetch_assoc()):

                    $id_usuario = $usuario['id'];

                    /////// lista de productos para coregir /////////
                    $iter++;
                    if ($iter % 2 != 0): ?>
                        <div class="col_row">
                        <?php endif; ?>

                        <div id="usuario_<?php echo $usuario['id']; ?>">

                            <div class="caja_producto">
                                <div class="caja_prod_baton">


                                </div>

                                <div class="text_prod_cont">

                                    <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

                                    <div class=" p-2 text-end">
                                        <batton id="elim_<?php echo $usuario['id']; ?>"
                                            onclick="eliminarUsuario('<?php echo $usuario['id']; ?>')"
                                            href=""
                                            class="btn btn-danger text-dark baton"

                                            data-bs-toggle="popover"
                                            data-bs-trigger="hover"
                                            data-bs-content="Esto eliminará el usuario"
                                            data-bs-placement="top">X
                                        </batton>
                                    </div>

                                    <!--XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->


                                    <label for="nombre_<?php echo $usuario['id']; ?>" class="form-label">Nombre del Usuario</label>

                                    <textarea
                                        onchange="subirText('<?php echo $usuario['id']; ?>','nombre')"
                                        class="form-control"
                                        id="nombre_<?php echo $usuario['id']; ?>"
                                        name="nombre_<?php echo $usuario['id']; ?>"
                                        rows="2"><?php echo $usuario['nombre']; ?>
                                    </textarea>

                                    <label for="email_<?php echo $usuario['id']; ?>" class="form-label">Email de Usuario</label>
                                    <textarea
                                        onchange="subirText('<?php echo $usuario['id']; ?>','email')"
                                        class="form-control"
                                        id="email_<?php echo $usuario['id']; ?>"
                                        name="email_<?php echo $usuario['id']; ?>"
                                        rows="4"><?php echo $usuario['email']; ?>
                                    </textarea>

                                    <div class="form-check form-switch">
                                        <input
                                            onchange="cambiaAdmin(this, '<?php echo $usuario['id']; ?>');"
                                            id="chbox_admin_<?php echo $usuario['id'] ?>"
                                            name="chbox_admin_<?php echo $usuario['id'] ?>"
                                            class="form-check-input"
                                            type="checkbox"
                                            <?php echo ($usuario['rol'] === 'admin' ? 'checked' : '') ?>
                                            >
                                        <label class="form-check-label" for="chbox_admin_<?php echo $usuario['id']; ?>">ADMIN</label>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <?php if ($iter % 2 == 0 || $iter == $result->num_rows): ?>
                        </div>
                    <?php endif; ?>
                    <!--///////////////////////////////-->

                <?php
                endwhile;
                mostrarBotonesNav($paginaActual, $totalPaginas);
            else : ?>
                <h2>No se encontraron usuarios</h2>
            <?php

            endif;

            ?>

        </div>

    </main>

    <?php include 'layout/admin_footer.php'; ?>


</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var popoverTriggerList;
    var popoverList;
    document.addEventListener('DOMContentLoaded', function() {
        obtenerPopers();
    });

    function obtenerPopers() {
        popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    }

    function cerrarTodosPopers() {
        popoverTriggerList.map(function(popoverTriggerEl) {
            var popover = bootstrap.Popover.getInstance(popoverTriggerEl); // Obtener instancia del popover
            popover?.dispose(); // Cierra el popover si existe
        });
    }


    // Función para ELIMINAR producto mediante AJAX XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    // ///////////////////////////////////////////////////////////////////////////////////////////////////////
    function eliminarUsuario(idUsuario) {

        // Crear el cuerpo de la solicitud concatenando los valores
        let body =
            'id=' + encodeURIComponent(idUsuario);

        fetch('api_eliminar_usuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: body
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud: ' + response.statusText);
                }
                return response.text();
            })
            .then(data => {
                console.log('Respuesta del servidor:', data);
                let conteiner = document.getElementById('usuario_' + idUsuario);
                // Obtener la URL base sin parámetros ni fragmentos
                let baseUrl = window.location.href.split('?')[0].split('#')[0];
                if (data === "Eliminado") { // Comparación estricta
                    conteiner.innerHTML = "";
                    document.getElementById('msg_avizar').innerHTML = data;
                    mostrarModal();
                    //window.location.href = `${baseUrl}?avisar=${data}#ventajamodal`;
                } else {
                    // msg_avizar
                    document.getElementById('msg_avizar').innerHTML = data;
                    mostrarModal();
                    //window.location.href = `${baseUrl}?avisar=${data}#ventajamodal`;
                }
                cerrarTodosPopers();
                obtenerPopers();

            })
            .catch(error => {
                console.error('Hubo un problema con la solicitud:', error);
            });
    }

    // Función para cambiar rol  mediante AJAX
    function cambiaAdmin(checkbox, idUsuario) {

        const isAdmin = checkbox.checked;
        console.log(`Usuario ${idUsuario} es ${isAdmin ? 'ahora administrador' : 'ya no es administrador'}`);
        // Aquí podrías hacer una petición AJAX al servidor para actualizar el estado

        // Crear el cuerpo de la solicitud concatenando los valores
        let body = '&id=' + encodeURIComponent(idUsuario) +
            '&is_admin=' + encodeURIComponent(checkbox.checked);

        fetch('api_cambia_rol.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: body
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud: ' + response.statusText);
                }
                return response.text();
            })
            .then(data => {
                console.log('Respuesta del servidor:', data);

            })
            .catch(error => {
                console.error('Hubo un problema con la solicitud:', error);
            });

    }


    // Función para subir el texto corregido mediante AJAX
    function subirText(idUsuario, columna) {

        var textarea = document.getElementById(columna + '_' + idUsuario);

        if (textarea) {

            var text = textarea.value;

            // Crear el cuerpo de la solicitud concatenando los valores
            let body = 'text=' + encodeURIComponent(text) +
                '&id=' + encodeURIComponent(idUsuario) +
                '&columna=' + encodeURIComponent(columna);

            fetch('subir_text_usuario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: body
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud: ' + response.statusText);
                    }
                    return response.text();
                })
                .then(data => {
                    console.log('Respuesta del servidor:', data);

                })
                .catch(error => {
                    console.error('Hubo un problema con la solicitud:', error);
                });

        } else {
            alert("El elemento " + columna + "_" + idUsuario + " no existe");
        }
    }
</script>

<script>
    // Mostrar el modal
    function mostrarModal() {
        document.getElementById('ventajamodal').style.display = 'flex';
    }

    // Cerrar el modal
    function cerrarModal() {
        document.getElementById('ventajamodal').style.display = 'none';
    }
</script>