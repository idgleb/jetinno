<?php
include_once __DIR__ . "/funciones.php";

class Usuario
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->obtenerValorCampoBD("nombre");
    }

    public function getEmail()
    {
        return $this->obtenerValorCampoBD("email");
    }

    public function getRol()
    {
        return $this->obtenerValorCampoBD("rol");
    }

    public static function getUsuarioPorEmail($email)
    {
        $conn = conectar_DB_usuarios();
        try {
            // Comprobar si el usuario ya existe
            $consulta = $conn->prepare("SELECT id FROM usuarios WHERE email = :email LIMIT 1");
            $consulta->execute([':email' => $email]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return new Usuario($resultado['id']);
            } else {
                // Si no se encuentra el usuario
                return null;
            }
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode([
                "status" => "error BD",
                "msg" => "error en la base"
            ]);
            exit;
        }
    }

    public function setRol($rol)
    {
        return $this->cambiarValorCampoBD("rol", $rol);
    }

    private function cambiarValorCampoBD($campo, $nuevoValor)
    {
        $conn = conectar_DB_usuarios();
        try {
            // Verificar si el valor ya es el mismo en la base de datos
            $consultaVerificar = $conn->prepare("SELECT $campo FROM usuarios WHERE id = :id");
            $consultaVerificar->execute([':id' => $this->id]);
            $resultado = $consultaVerificar->fetch(PDO::FETCH_ASSOC);

            if ($resultado && $resultado[$campo] === $nuevoValor) {
                return "sin cambios"; // O cualquier indicador para este caso
            }

            // Consulta preparada para actualizar el valor del campo
            $consulta = $conn->prepare("UPDATE usuarios SET $campo = :valor WHERE id = :id LIMIT 1");
            $consulta->execute([
                ':valor' => $nuevoValor,
                ':id' => $this->id
            ]);

            // Verificar si la actualización fue exitosa
            if ($consulta->rowCount() > 0) {
                return "actualizado";
            } else {
                return "no actualizado"; // Ninguna fila fue afectada
            }
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode([
                "status" => "error",
                "msg" => "Error en la base de datos",
                "error" => $e->getMessage()
            ]);
            exit;
        }
    }


    private function obtenerValorCampoBD($campo)
    {
        $conn = conectar_DB_usuarios();
        try {
            // Consulta preparada para obtener el nombre
            $consulta = $conn->prepare("SELECT " . $campo . " FROM usuarios WHERE id = :id LIMIT 1");

            // Ejecutar la consulta
            $consulta->execute([':id' => $this->id]);

            // Obtener el resultado
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado && isset($resultado[$campo])) {
                return $resultado[$campo];
            } else {
                // Si no se encuentra el usuario
                return null;
            }
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode([
                "status" => "error",
                "msg" => "Error en la base de datos",
                "error" => $e->getMessage()
            ]);
            exit;
        }
    }
}
