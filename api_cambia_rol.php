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

    $id_usuario = sanitario($_POST['id'] ?? '');
    $is_admin = sanitario($_POST['is_admin'] ?? '');
    $rol = ($is_admin === "true") ? "admin" : "user";

    try {
        $conn = conectarDB();
        $stmt = $conn->prepare("UPDATE usuarios SET rol = ? WHERE id = ?");
        $stmt->bind_param('ss', $rol, $id_usuario);
        $stmt->execute();

        // Verificar si alguna fila fue afectada
        if ($stmt->affected_rows > 0) {
            echo "Actualizado el usuario con éxito.";
        } elseif ($stmt->affected_rows == 0) {
            echo "No existe el usuario.";
        } else {
            echo "Error: No se pudo actualizar el usuario.";
        }
    } catch (mysqli_sql_exception $e) {
        manejarError($e, "Error en la base de datos o tabla usuario", false);
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
