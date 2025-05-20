<?php
include_once __DIR__ . "/funciones.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $text = sanitario($_POST['text'] ?? '');
    $imgSinExt = sanitario($_POST['imgSinExt'] ?? '');
    $extension = sanitario($_POST['extension'] ?? '');
    $columna = sanitario($_POST['columna'] ?? '');
    $nombreImagen = $imgSinExt . '.' . $extension;

    try {
        $conn = conectarDB();
        $stmt = $conn->prepare("UPDATE productos SET $columna = ? WHERE img = ?");
        $stmt->bind_param('ss', $text, $nombreImagen);
        $stmt->execute();

        // Verificar si alguna fila fue afectada
        if ($stmt->affected_rows > 0) {
            echo "Actualizado el producto con éxito.";
        } elseif ($stmt->affected_rows == 0) {
            echo "No se realizaron cambios.";
        } else {
            echo "Error: No se pudo actualizar el producto.";
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
