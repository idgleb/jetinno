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

<?php $title = "AGREGAR PRODUCTOS"; ?>
<?php include 'layout/metedatos_css.php'; ?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreProducto = sanitario($_POST['nombreProducto'] ?? "");
    $caracteristicasProducto = sanitario($_POST['caracteristicasProducto'] ?? "");
    // Procesar la imagen
    if (isset($_FILES['imagenProducto']) && $_FILES['imagenProducto']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['imagenProducto']['name'], PATHINFO_EXTENSION);
        $nombreImagen = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
        $rutaImagen = 'img/' . $nombreImagen;
        // Mover la imagen subida al directorio 
        if (move_uploaded_file($_FILES['imagenProducto']['tmp_name'], $rutaImagen)) {
            //  insertar los datos en la base de datos
            try {
                $conn = conectarDB();
                $stmt = $conn->prepare("INSERT INTO productos (nombre, img, caracteristicas) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nombreProducto, $nombreImagen, $caracteristicasProducto);
                // Ejecutar la consulta 
                $stmt->execute();
                $avisar = "Producto agregado con exito";
            } catch (mysqli_sql_exception $e) {
                manejarError($e, "Paso algo malo", true);
            } finally {
                if (isset($stmt)) {
                    $stmt->close();
                }
                if (isset($conn)) {
                    $conn->close();
                }
            }
        } else {
            $avisar = "Error guardar la imagen";
        }
    } else {
        $avisar = "Error al procesar la imagen";
    }
}

?>

<body>

    <!--#ventajamodal -->
    <div id="ventajamodal">
        <div class="modal_cont">
            <a href="#">X</a>
            <h2 id="msg_avizar"><?php echo (isset($nombreUsuario) ? $nombreUsuario . ", " : '') . $avisar; ?>
            </h2>
        </div>
    </div>

    <?php include 'layout/admin_header.php'; ?>

    <main>

        <div class="width90centr">

            <div class="container mb-5">
                <h2 class="mb-1">Agregar Producto</h2>
                <form class="row" action="admin_agregar.php#ventajamodal" method="POST" enctype="multipart/form-data">
                    <div class="mb-0">
                        <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Ingrese el nombre del producto" required>
                        <label for="imagenProducto" class="form-label">Imagen del Producto</label>
                        <input type="file" class="form-control" id="imagenProducto" name="imagenProducto" accept="image/*" required>
                        <label for="caracteristicasProducto" class="form-label">Características del Producto</label>
                        <textarea class="form-control" id="caracteristicasProducto" name="caracteristicasProducto" rows="2" placeholder="Ingrese las características del producto" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Producto</button>
                </form>
            </div>

            <?php include 'layout/lista_poductos.php'; ?>


        </div>

    </main>

    <?php include 'layout/admin_footer.php'; ?>


</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>