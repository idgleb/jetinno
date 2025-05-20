<?php
include_once __DIR__ . "/funciones.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $text = sanitario($_POST['text'] ?? '');
    $columna = sanitario($_POST['columna'] ?? '');
    $id_usuario = sanitario($_POST['id'] ?? '');

    try {
        $conn = conectarDB();
        $stmt = $conn->prepare("UPDATE usuarios SET $columna = ? WHERE id = ?");
        $stmt->bind_param('ss', $text, $id_usuario);
        $stmt->execute();

        // Verificar si alguna fila fue afectada
        if ($stmt->affected_rows > 0) {
            echo "Actualizado el usuario con éxito.";
        } elseif ($stmt->affected_rows == 0) {
            echo "No se realizaron cambios.";
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
