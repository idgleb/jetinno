<?php
include_once __DIR__ . "/funciones.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los valores enviados desde el formulario
    $nombre = isset($_POST['nombre']) ? sanitario($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? sanitario($_POST['email']) : '';
    $ciudad = isset($_POST['ciudad']) ? sanitario($_POST['ciudad']) : '';
    $mensaje = isset($_POST['mensaje']) ? sanitario($_POST['mensaje']) : '';

    // Validar formato de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = "";
    }

    $response = [
        "nombre" => $nombre,
        "email" => $email,
        "ciudad" => $ciudad,
        "message" => $mensaje,
    ];

    // Validar que los campos requeridos no estén vacíos
    if ($response['nombre'] == "" || $response['email'] == "" || $response['ciudad'] == "" || $response['message'] == "") {
        echo json_encode($response);
        exit;
    }

    //guardamos datos de formulzrio a BD
    try {
        $conn = conectarDB();

        $tabla = "CREATE TABLE IF NOT EXISTS email (  
                id INT AUTO_INCREMENT PRIMARY KEY,  
                nombre VARCHAR(255) NOT NULL,  
                email VARCHAR(255) NOT NULL,  
                ciudad VARCHAR(255) NOT NULL,
                mensaje TEXT NOT NULL  
            )";

        $conn->query($tabla);

        $stmt = $conn->prepare("INSERT INTO email (nombre, email, ciudad, mensaje) VALUES (?, ?, ?, ?)"); 
        $stmt->bind_param("ssss", $nombre, $email, $ciudad, $mensaje);  
        $stmt->execute();

        echo json_encode(["msg" => "A la brevedad nos pondremos en contacto con usted."]);
        exit;

    } catch (mysqli_sql_exception $e) {
        echo json_encode(["msg" => "Paso algo malo..."]);
        exit;
    }finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
} else {
    echo json_encode(["msg" => "Método de solicitud no soportado."]);
    exit;
}
