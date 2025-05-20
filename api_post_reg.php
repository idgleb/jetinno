<?php
header('Content-Type: application/json');
include_once __DIR__ . "/funciones.php";
iniciarSession();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los valores enviados desde el formulario
    $nombre = isset($_POST['nombre']) ? sanitario($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? sanitario($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitario($_POST['password']) : '';


    // Validar formato de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = "";
    }

    // Validar formato de contraseña (mínimo 8 caracteres)
    if (strlen($password) < 8) {
        $password = "";  // Si la contraseña es menor a 8 caracteres, la vacía
    } else $password = password_hash($password, PASSWORD_DEFAULT); // Cifrar contraseña

    // Validar que los campos requeridos no estén vacíos
    if ($nombre == "" || $email == "" || $password == "") {
        $response = [
            "nombre" => $nombre,
            "email" => $email,
            "password" => $password,
        ];
        echo json_encode($response);
        exit;
    }

    // Validar si el email ya existe en BD
    if (Usuario::getUsuarioPorEmail($email)) {
        echo json_encode([
            "status" => "mail existe",
            "msg" => "este Email ya existe. Puedes entrar si es tuyo <a class='btn' href=login.php#loginform>Logear..</a> "
        ]);
        exit;
    }

    $rol = "";
    //guardamos datos a BD
    try {
        $conn = conectar_DB_usuarios();
        // Insertar nuevo usuario
        $consulta = $conn->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)");
        $consulta->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':password' => $password,
            ':rol' => $rol
        ]);
        ///////////////////////////////////////////////////////////////////////////////
        $usuarioBD = Usuario::getUsuarioPorEmail($email);
        if (!$usuarioBD) {
            echo json_encode(["status" => "error", "msg" => "Error al insertar usuario"]);
            exit;
        }
        $_SESSION["usuario"] = $usuarioBD;
        echo json_encode(["status" => "exito"]);
        exit;
        //////////////////////////////////////////////////////////////////////////////
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "msg" => "Error al registrar usuario: " . $e->getMessage()]);
        exit;
    } 
} else {
    echo json_encode(["status" => "error", "msg" => "Método de solicitud no soportado."]);
    exit;
}
