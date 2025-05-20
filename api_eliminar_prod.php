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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $imgSinExt = sanitario($_POST['imgSinExt'] ?? '');
    $extension = sanitario($_POST['extension'] ?? '');
    $nombreImagen = $imgSinExt . '.' . $extension;

    try {
        $conn = conectarDB();

        $stmt = $conn->prepare("DELETE FROM productos WHERE img = ?");

        $stmt->bind_param('s', $nombreImagen);
        $stmt->execute();

        // Verificar si alguna fila fue afectada
        if ($stmt->affected_rows > 0) {
            echo "Eliminado";
        } elseif ($stmt->affected_rows == 0) {
            echo "No se realizaron eliminacion.";
        } else {
            echo "Error: No se pudo eliminar el producto.";
        }
    } catch (mysqli_sql_exception $e) {
        manejarError($e, "Error en la base de datos", false);
        echo "Error en la base de datos.";
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
}
