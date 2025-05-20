<?php
include_once __DIR__ . "/funciones.php";
iniciarSession();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores enviados desde el formulario
    $email = isset($_POST['email']) ? sanitario($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitario($_POST['password']) : '';

    // Validar formato de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = "";
    }

    // Validar formato de contraseña (mínimo 8 caracteres)
    if (strlen($password) < 1) {
        $password = "";  // Si la contraseña es menor a 8 caracteres, la vacía
    }

    // Validar que los campos requeridos no estén vacíos
    if ($email == "" || $password == "") {
        $response = [
            "email" => $email,
            "password" => $password,
        ];
        echo json_encode($response);
        exit;
    }


    verificarUsuario($email, $password);

} else {
    echo json_encode(["status" => "error", "msg" => "Método de solicitud no soportado."]);
    exit;
}
