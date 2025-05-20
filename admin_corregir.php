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
<?php $title = "CAMBIAR"; ?>
<?php include 'layout/metedatos_css.php'; ?>

<body>

    <!--#ventajamodal -->
    <div id="ventajamodal">
        <div class="modal_cont">
            <batton
                onclick="cerrarModal()"
                href=""
                class="btn btn-danger text-dark baton"
                data-bs-toggle="popover"
                data-bs-trigger="hover"
                data-bs-content="cerrar"
                data-bs-placement="end">X
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
            
            <h2 class="mb-1">Corregir Productos</h2>

            <?php

            $productosPorPagina = 5;

            $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $paginaActual = sanitario($paginaActual);

            $totalPaginas = calcularTotalPaginas($productosPorPagina);

            mostrarBotonesNav($paginaActual, $totalPaginas, true);

            $offset = ($paginaActual - 1) * $productosPorPagina;

            $redirectSiError = true;
            $result = obtenerProdDeBase($redirectSiError, $productosPorPagina, $offset);

            // Verificar si hay prod
            if ($result->num_rows > 0) :
                $iter = 0;
                while ($producto = $result->fetch_assoc()):
                    $imgSinExt = obtenerNombreDeArchivoSinExt($producto['img']);
                    $extension = obtenerExtDeArchivo($producto['img']);
                    $nombreImagen = $imgSinExt . '.' . $extension;
                    $rutaImagen = 'img/' . $nombreImagen;

                    /////// lista de productos para coregir /////////
                    $iter++;
                    if ($iter % 2 != 0): ?>
                        <div class="col_row">
                        <?php endif; ?>

                        <div id="producto_<?php echo $imgSinExt; ?>">

                            <div class="caja_producto">
                                <div class="caja_prod_baton">

                                    <!-- Contenedor para el spinner, inicialmente oculto -->
                                    <div id="spinner_<?php echo $imgSinExt; ?>" class="d-none text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Cargando...</span>
                                        </div>
                                    </div>

                                    <figure id="fig_<?php echo $imgSinExt; ?>">
                                        <!-- Imagen del producto -->
                                        <img class="imagen_prod hover"
                                            id="img_<?php echo $imgSinExt; ?>"
                                            src="<?php echo $rutaImagen; ?>"
                                            alt="<?php echo $nombreImagen; ?>"
                                            onclick="seleccionarImagen('<?php echo $imgSinExt; ?>')"
                                            data-bs-toggle="popover"
                                            data-bs-trigger="hover"
                                            data-bs-content="Click para cambiarlo"
                                            data-bs-placement="top">
                                    </figure>
                                    <!-- Input oculto para seleccionar el archivo -->
                                    <input class="oculto" type="file" id="input_<?php echo $imgSinExt; ?>" onchange="subirImagen('<?php echo $imgSinExt; ?>','<?php echo $extension; ?>')" accept="image/*">

                                </div>

                                <div class="text_prod_cont">

                                    <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

                                    <div class=" p-2 text-end">
                                        <batton id="elim_<?php echo $imgSinExt; ?>"
                                            onclick="eliminarProducto('<?php echo $imgSinExt; ?>','<?php echo $extension; ?>')"
                                            href=""
                                            class="btn btn-danger text-dark baton"

                                            data-bs-toggle="popover"
                                            data-bs-trigger="hover"
                                            data-bs-content="Esto eliminará el producto"
                                            data-bs-placement="top">X
                                        </batton>
                                    </div>

                                    <!--XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->


                                    <label for="nombre_<?php echo $imgSinExt; ?>" class="form-label">Nombre del Producto</label>

                                    <textarea
                                        onchange="subirText('<?php echo $imgSinExt; ?>','<?php echo $extension; ?>','nombre')"
                                        class="form-control"
                                        id="nombre_<?php echo $imgSinExt; ?>"
                                        name="nombre_<?php echo $imgSinExt; ?>"
                                        rows="2"><?php echo $producto['nombre']; ?></textarea>

                                    <label for="caracteristicas_<?php echo $imgSinExt; ?>" class="form-label">Características del Producto</label>

                                    <textarea
                                        onchange="subirText('<?php echo $imgSinExt; ?>','<?php echo $extension; ?>','caracteristicas')"
                                        class="form-control" id="caracteristicas_<?php echo $imgSinExt; ?>"
                                        name="caracteristicas_<?php echo $imgSinExt; ?>"
                                        rows="4"><?php echo $producto['caracteristicas']; ?></textarea>

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
                <h2>No se encontraron productos</h2>
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

    // Función para abrir el explorador de archivos al hacer clic en la imagen
    function seleccionarImagen(imgId_SinExt) {
        document.getElementById('input_' + imgId_SinExt).click(); // Activa el input file oculto
    }

    // Función para ELIMINAR producto mediante AJAX XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    // ///////////////////////////////////////////////////////////////////////////////////////////////////////
    function eliminarProducto(imgSinExt, imgExt) {

        // Crear el cuerpo de la solicitud concatenando los valores
        let body =
            'imgSinExt=' + encodeURIComponent(imgSinExt) +
            '&extension=' + encodeURIComponent(imgExt);

        fetch('api_eliminar_prod.php', {
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
                let conteiner = document.getElementById('producto_' + imgSinExt);
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

    // Función para subir la imagen seleccionada mediante AJAX
    function subirImagen(imgSinExt, imgExt) {

        var input = document.getElementById('input_' + imgSinExt);
        var file = input.files[0];
        if (file) {

            var formData = new FormData();
            formData.append('imagen', file);
            let img = imgExt ? `${imgSinExt}.${imgExt}` : imgSinExt;
            formData.append('img', img);

            // Muestra el spinner  
            var spinner = document.getElementById('spinner_' + imgSinExt);
            spinner.classList.remove('d-none'); // Muestra el spinner 

            fetch('subir_imagen.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al subir la imagen.');
                    }
                    return response.text();
                })
                .then(respuesta => {
                    let conteiner = document.getElementById('producto_' + imgSinExt);
                    conteiner.innerHTML = respuesta;

                    // Extraer ID de la respuesta
                    let inicio = respuesta.indexOf('[') + 1;
                    let fin = respuesta.indexOf(']');
                    let id = respuesta.substring(inicio, fin);
                    conteiner.id = 'producto_' + id;

                    cerrarTodosPopers();

                    obtenerPopers();

                })
                .catch(error => {
                    alert(error.message);
                })
                .finally(() => {
                    // Ocultar el spinner al finalizar  
                    spinner = document.getElementById('spinner_' + imgSinExt);
                    spinner.classList.add('d-none'); // Oculta el spinner  

                });
        }
    }


    // Función para subir el texto corregido mediante AJAX
    function subirText(imgSinExt, imgExt, columna) {

        var textarea = document.getElementById(columna + '_' + imgSinExt);

        if (textarea) {

            var text = textarea.value;

            // Crear el cuerpo de la solicitud concatenando los valores
            let body = 'text=' + encodeURIComponent(text) +
                '&imgSinExt=' + encodeURIComponent(imgSinExt) +
                '&extension=' + encodeURIComponent(imgExt) +
                '&columna=' + encodeURIComponent(columna);

            fetch('subir_text.php', {
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
            alert("El elemento " + columna + "_" + imgSinExt + " no existe");
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