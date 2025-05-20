<?php 
require_once 'Usuario.php';
session_start();


/* $host = 'localhost';
$user = 'c1402791_ddd';
$password_sql = 'faKIlabu60';
$passwordBd = 'faKIlabu60';
$dbname = 'c1402791_ddd'; */


$host = 'localhost';
$user = 'root';
$password_sql = '';
$passwordBd = '';
$dbname = 'c1402791_ddd'; 


$duracionSession = 1111;

function iniciarSession()
{
    
    global $duracionSession;
    sessionLimit($duracionSession);
}

function conectar_DB_usuarios($redirectSiError = true)
{

    // Conexión a la base de datos
    global $host, $user, $passwordBd, $dbname;
    try {

        $conn = new PDO("mysql:host=$host;charset=utf8mb4", $user, $passwordBd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Crear la base de datos si no existe
        $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

        // Seleccionar la base de datos
        $conn->exec("USE $dbname");

        // Crear la tabla si no existe  
        $tabla = "CREATE TABLE IF NOT EXISTS usuarios (  
        id INT AUTO_INCREMENT PRIMARY KEY,  
        nombre VARCHAR(255) NOT NULL,  
        email VARCHAR(255) NOT NULL UNIQUE,  
        password VARCHAR(255),
        rol VARCHAR(255)
        ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        $conn->exec($tabla);


        return $conn;
    } catch (PDOException $e) {
        manejarError($e, "Error PDO en la connexion de base de datos", $redirectSiError);
    }
}

function conectarDB($redirectSiError = true)
{
    global $host, $user, $password_sql, $dbname;
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $conn = new mysqli($host, $user, $password_sql);
        $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
        $conn->select_db($dbname);
        // Crear la tabla si no existe  
        $tabla = "CREATE TABLE IF NOT EXISTS productos (  
            id INT AUTO_INCREMENT PRIMARY KEY,  
            nombre VARCHAR(255) NOT NULL,  
            img VARCHAR(255) NOT NULL,  
            caracteristicas TEXT NOT NULL  
        )";
        $conn->query($tabla);
        return $conn;
    } catch (mysqli_sql_exception $e) {
        manejarError($e, "Error msql en la connexion de base de datos", $redirectSiError);
    }
}

function manejarError($e, $msg, $redirectSiError)
{
    error_log(date('Y-m-d H:i:s') . " - " . $e->getMessage() . "\n", 3, "error_log.txt");
    if ($redirectSiError) {
        if (!headers_sent()) {
            header("Location: error.php?error=" . urlencode($e));
            die();
        } else {
            echo "<script>window.location.href='error.php?error=" . $e . "';</script>";
            die();
        }
    }
    die();
}



function sanitario($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

function obtenerProdDeBase($redirectSiError, $limit = null, $offset = null)
{
    // Intentemos conectar
    try {
        // Conexión a la base de datos
        $conn = conectarDB($redirectSiError);
        // Consulta para obtener los productos, agregando paginación si es necesario
        $sql = "SELECT id, nombre, img, caracteristicas FROM productos";
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT ? OFFSET ?";
        }
        $stmt = $conn->prepare($sql);
        if ($limit !== null && $offset !== null) {
            $stmt->bind_param('ii', $limit, $offset);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    } catch (mysqli_sql_exception $e) {
        manejarError($e, "Paso algo malo", $redirectSiError);
        return null;
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
}

//////////////////////////////////////////////////////////////////////////////////////
////////////
//////                       USUARIOS //////////////////

function obtenerUsuariosDeBase($redirectSiError, $limit = null, $offset = null)
{
    // Intentemos conectar
    try {
        // Conexión a la base de datos
        $conn = conectarDB($redirectSiError);
        // Consulta para obtener los usuarios, agregando paginación si es necesario
        $sql = "SELECT id, nombre, email, rol FROM usuarios";
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT ? OFFSET ?";
        }
        $stmt = $conn->prepare($sql);
        if ($limit !== null && $offset !== null) {
            $stmt->bind_param('ii', $limit, $offset);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    } catch (mysqli_sql_exception $e) {
        manejarError($e, "Paso algo malo con base o tabla usuarios", $redirectSiError);
        return null;
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
}


//////////////////////////////////////////////////////////////////////////////////////
////////////


function obtenerUnProd($nombreImagen)
{
    try {
        $conn = conectarDB(true);
        $stmt = $conn->prepare("SELECT * FROM productos WHERE img = ?");
        $stmt->bind_param('s', $nombreImagen);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
        } else {
            $producto = null;
        }
        return $producto;
    } catch (mysqli_sql_exception $e) {
        manejarError($e, "Paso algo malo", true);
        return null;
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
}

function obtenerNombreDeArchivoSinExt($nombreArchivo)
{
    $posicionDePunto = strpos($nombreArchivo, '.');
    // Si el símbolo '.' se encuentra en la cadena
    if ($posicionDePunto !== false) {
        // Obtener la subcadena antes del '.'
        $imgSinExt = substr($nombreArchivo, 0, $posicionDePunto);
    } else {
        $imgSinExt = $nombreArchivo;
    }

    return $imgSinExt;
}
function obtenerExtDeArchivo($nombreArchivo)
{
    $posicionDePunto = strpos($nombreArchivo, '.');
    // Si el símbolo '.' se encuentra en la cadena
    if ($posicionDePunto !== false) {
        // Obtener la subcadena despues del '.'
        $imgExt = substr($nombreArchivo, $posicionDePunto + 1);
    } else {
        $imgExt = "";
    }
    return $imgExt;
}

function imprimirListaDeIdProdParaVentajasModalesCSS($beforStr, $afterStr)
{
    $redirect = false;
    $result = obtenerProdDeBase($redirect);

    if ($result != null) {
        if ($result->num_rows > 0) :
            $iter = 0;
            while ($row = $result->fetch_assoc()):
                $iter++;

                $imgSinExt = obtenerNombreDeArchivoSinExt($row['img']);

                echo $beforStr . $imgSinExt . $afterStr;

                if ($iter != $result->num_rows):
                    echo ",";
                endif;

            endwhile;
        endif;
    }
}

function listaModal()
{
    imprimirListaDeIdProdParaVentajasModalesCSS("#venta_", "");
}
function listaModalTarget()
{
    imprimirListaDeIdProdParaVentajasModalesCSS("#venta_", ":target");
}

function listaImgProdCaorregir()
{
    imprimirListaDeIdProdParaVentajasModalesCSS("#img_", ":hover");
}


function mostrarBotonesNav($paginaActual, $totalPaginas, $conID = null)
{
    // Mostrar los botones de paginacion con Bootstrap
    if ($conID !== null) {
        echo '<nav id="navv">';
    } else {
        echo '<nav>';
    }

    echo '<ul class="pagination justify-content-center">';
    // Enlace a la primera página
    if ($paginaActual > 1) {
        echo '<li class="page-item"><a class="page-link" href="?pagina=1#navv">&laquo;</a></li>';
    }
    // Enlace a la página anterior
    if ($paginaActual > 1) {
        echo '<li class="page-item"><a class="page-link" href="?pagina=' . ($paginaActual - 1) . '#navv">&lsaquo;</a></li>';
    }
    // Mostrar un rango de enlaces de páginas (por ejemplo, máximo 5)
    $rango = 5; // Rango de páginas antes y después de la página actual
    $inicio = max(1, $paginaActual - $rango);
    $fin = min($totalPaginas, $paginaActual + $rango);
    if ($inicio > 1) {
        echo '<li class="page-item disabled"><span class="page-link">..</span></li>';
    }
    for ($i = $inicio; $i <= $fin; $i++) {
        if ($i == $paginaActual) {
            echo '<li class="page-item"><span class="page-link bg-primary text-white" >' . $i . '</span></li>'; // Página actual
        } else {
            echo '<li class="page-item"><a class="page-link" href="?pagina=' . $i . '#navv">' . $i . '</a></li>';
        }
    }
    if ($fin < $totalPaginas) {
        echo '<li class="page-item disabled"><span class="page-link">..</span></li>';
    }
    // Enlace a la página siguiente
    if ($paginaActual < $totalPaginas) {
        echo '<li class="page-item"><a class="page-link" href="?pagina=' . ($paginaActual + 1) . '#navv">&rsaquo;</a></li>';
    }
    // Enlace a la última página
    if ($paginaActual < $totalPaginas) {
        echo '<li class="page-item"><a class="page-link" href="?pagina=' . $totalPaginas . '#navv">&raquo;</a></li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function calcularTotalPaginas($productosPorPagina)
{
    try {
        $conn = conectarDB(true);
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM productos");
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $totalProductos = $result->fetch_assoc()['total'];
        $totalPaginas = ceil($totalProductos / $productosPorPagina);
    } catch (mysqli_sql_exception $e) {
        manejarError($e, "Paso algo malo", true);
    } catch (Exception $e) {
        manejarError($e, "error inesperado", true);
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
    return $totalPaginas;
}


/////////////////////////////////////////////////////////////////////////
////////////////////////////
function calcularTotalPaginasUsuarios($elementosPorPagina)
{
    try {
        $conn = conectarDB(true);
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM usuarios");
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $totalProductos = $result->fetch_assoc()['total'];
        $totalPaginas = ceil($totalProductos / $elementosPorPagina);
    } catch (mysqli_sql_exception $e) {
        manejarError($e, "Paso algo malo", true);
    } catch (Exception $e) {
        manejarError($e, "error inesperado", true);
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
    return $totalPaginas;
}

////////////////////////////////////////////////

function verificarUsuario($email, $password)
{
    try {
        // Conexión a la base de datos
        $conn = conectar_DB_usuarios();

        // Consulta preparada para buscar el usuario
        $consulta = $conn->prepare("SELECT id, password FROM usuarios WHERE email = :email LIMIT 1");
        $consulta->execute([':email' => $email]);
        $user = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed_password = $user['password'];
            // Verificación de la contraseña
            if (password_verify($password, $hashed_password)) {
                ///////////////////////////////////////////////////////////////////////////////
                $usuarioBD = new Usuario($user['id']);
                $_SESSION["usuario"] = $usuarioBD;
                echo json_encode(["status" => "exito"]);
                exit;
                //////////////////////////////////////////////////////////////////////////////
            } else {
                echo json_encode(["status" => "error", "msg" => "Contraseña incorrecta."]);
                exit;
            }
        } else {
            echo json_encode(["status" => "error", "msg" => "Usuario no encontrado."]);
            exit;
        }
    } catch (PDOException $e) {
        // Manejo de errores de la base de datos
        echo json_encode(["status" => "error", "msg" => "Error en la base de datos: " . $e->getMessage()]);
        exit;
    }
}


function cierreSession()
{
    session_start();
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión

    // Eliminar la cookie de sesión
    setcookie(session_name(), '', time() - 3600, '/');

    header("Location: login.php#loginform"); // Redirige al usuario al formulario de inicio de sesión
    exit;
}


function sessionLimit($segundos)
{
    $usuario = $_SESSION["usuario"] ?? null;
    if ($usuario) {
        // Verificar si la sesión está configurada
        if (isset($_SESSION['LAST_ACTIVITY'])) {
            // Si ha pasado más tiempo que el permitido, destruye la sesión
            if (time() - $_SESSION['LAST_ACTIVITY'] > $segundos) {
                cierreSession();
                exit;
            }
        }
        // Actualizar el tiempo de actividad
        $_SESSION['LAST_ACTIVITY'] = time();
    }
}


