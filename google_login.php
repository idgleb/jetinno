<?php
include_once __DIR__ . "/funciones.php";
iniciarSession();

header('Content-Type: application/json');

// Incluir la biblioteca de cliente de Google
require_once 'google-api-php-client/vendor/autoload.php';

// Configuración de credenciales de Google
// https://console.cloud.google.com/apis/credentials  //
/////////////////////////////////////////////////////////
$clientID = '429531318854-h800utrp4glp7pgl7jfrdqm7tb0uc7l4.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/projectos/jetinno/google_login.php';
//$redirectUri = 'https://jetinno.store/google_login.php';

// Inicializar cliente de Google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Manejo de OAuth2
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Obtener información del perfil
    $google_service = new Google_Service_Oauth2($client);
    $data = $google_service->userinfo->get();

    // Datos del usuario
    $nombre = $data['name'];
    $email = $data['email'];

    // Validar si el email ya existe en BD
    $usuarioBD = Usuario::getUsuarioPorEmail($email);
    if ($usuarioBD) {
        $_SESSION["usuario"] = $usuarioBD;
        header("Location: index.php?avisar=" . urlencode("Te conozco. Sesión iniciada")."#ventajamodal");
        exit;
    }

    // Guardar en la base de datos o iniciar sesión
    try {
        $conn = conectar_DB_usuarios();

        // Insertar nuevo usuario
        $consulta = $conn->prepare("INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)");
        $consulta->execute([':nombre' => $nombre, ':email' => $email]);

        // Redirigir al usuario a su perfil o página de bienvenida
        ///////////////////////////////////////////////////////////////////////////////
        $usuarioBD = Usuario::getUsuarioPorEmail($email);
        if (!$usuarioBD) {
            echo json_encode(["status" => "error", "msg" => "Error al insertar usuario"]);
            exit;
        }
        $_SESSION["usuario"] = $usuarioBD;
        header("Location: index.php?avisar=" . urlencode("Hola, registraste exitoso. Sesión iniciada")."#ventajamodal");
        exit;
        //////////////////////////////////////////////////////////////////////////////
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "msg" => "Error al registrar usuario: " . $e->getMessage()]);
        exit;
    }
} else {
    // Generar URL de autenticación
    $login_url = $client->createAuthUrl();
    header("Location: " . $login_url);
    exit();
}
