<?php
include_once __DIR__ . "/funciones.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['imagen']) && isset($_POST['img'])) {

        $imgId = sanitario($_POST['img'] ?? ""); // Obtener el nombre del archivo de producto que vamos a actualizar

        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $imgSinExt = time() . '_' . bin2hex(random_bytes(8));
            $nombreImagen = $imgSinExt . '.' . $extension;
            $rutaImagen = 'img/' . $nombreImagen;

            // Mover la imagen a 'img/'
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {

                //actualizamos valor de columna img en BD(nombre de imagen)
                try {
                    $conn = conectarDB();
                    $stmt = $conn->prepare("UPDATE productos SET img = ? WHERE img = ?");
                    $stmt->bind_param('ss', $nombreImagen, $imgId);
                    $stmt->execute();

                    // Verificar si alguna fila fue afectada
                    if ($stmt->affected_rows > 0) {

                        $producto = obtenerUnProd($nombreImagen);
                        if ($producto) {
                            $newImgSinExt = obtenerNombreDeArchivoSinExt($producto['img']);
                            $newExtension = obtenerExtDeArchivo($producto['img']);
                            $newNombreImagen = $newImgSinExt . '.' . $newExtension;
                            $newRutaImagen = 'img/' . $newNombreImagen;
?>

                            <!--enviamos respuesta del servidor ----
                            [<?php echo $newImgSinExt; ?>] estos corchetes para encontrar el ID de conteinedor que vamos a Actualizar com javaScript despues de renovar imagen-->
                            <div class="caja_producto">
                                <div class="caja_prod_baton">

                                    <!-- Contenedor para el spinner, inicialmente oculto -->
                                    <div id="spinner_<?php echo $newImgSinExt; ?>" class="d-none text-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Cargando...</span>
                                        </div>
                                    </div>

                                    <figure id="fig_<?php echo $newImgSinExt; ?>">
                                        <img class="imagen_prod hover"
                                            id="img_<?php echo $newImgSinExt; ?>"
                                            src="<?php echo $newRutaImagen; ?>"
                                            alt="<?php echo $newNombreImagen; ?>"
                                            onclick="seleccionarImagen('<?php echo $newImgSinExt; ?>')"
                                            data-bs-toggle="popover"
                                            data-bs-trigger="hover"
                                            data-bs-content="Click para cambiarlo"
                                            data-bs-placement="top">
                                    </figure>
                                    <input class="oculto" type="file" id="input_<?php echo $newImgSinExt; ?>" onchange="subirImagen('<?php echo $newImgSinExt; ?>','<?php echo $newExtension; ?>')">
                                </div>

                                <div class="text_prod_cont">

                                    <!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->

                                    <div class=" p-2 text-end">
                                        <batton id="elim_<?php echo $newImgSinExt;?>"
                                            onclick="eliminarProducto('<?php echo $newImgSinExt; ?>','<?php echo $newExtension; ?>')"
                                            href=""
                                            class="btn btn-danger text-dark baton"

                                            data-bs-toggle="popover"
                                            data-bs-trigger="hover"
                                            data-bs-content="Esto eliminará el producto"
                                            data-bs-placement="top">X
                                        </batton>
                                    </div>

                                    <!--XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->

                                    <label for="nombre_<?php echo $newImgSinExt; ?>" class="form-label">Nombre del Producto</label>
                                    <textarea
                                        onchange="subirText('<?php echo $newImgSinExt; ?>','<?php echo $newExtension; ?>','nombre')"
                                        class="form-control"
                                        id="nombre_<?php echo $newImgSinExt; ?>"
                                        name="nombre_<?php echo $newImgSinExt; ?>"
                                        rows="2"><?php echo $producto['nombre']; ?></textarea>

                                    <label for="caracteristicas_<?php echo $newImgSinExt; ?>" class="form-label">Características del Producto</label>
                                    <textarea
                                        onchange="subirText('<?php echo $newImgSinExt; ?>','<?php echo $newExtension; ?>','caracteristicas')"
                                        class="form-control"
                                        id="caracteristicas_<?php echo $newImgSinExt; ?>"
                                        name="caracteristicas_<?php echo $newImgSinExt; ?>"
                                        rows="4"><?php echo $producto['caracteristicas']; ?></textarea>

                                </div>

                            </div>
                            <!-- respuesta de servidor ---- END-->

<?php
                        } else {
                            echo "No se encontró ningún producto con ese ID.";
                        }
                    } else {
                        echo "<h2>Error: No se pudo actualizar el producto.</h2>";
                    }
                } catch (mysqli_sql_exception $e) {
                    manejarError($e, "Error en la base de datos", false);
                    echo "Error en la base de datos";
                } finally {
                    if (isset($stmt)) {
                        $stmt->close();
                    }
                    if (isset($conn)) {
                        $conn->close();
                    }
                }
            } else {
                echo "Error al mover la imagen.";
            }
        } else {
            echo "Error al subir imagen.";
        }
    }
}
?>