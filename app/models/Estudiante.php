<?php
namespace app\models;

use PDO;

class Estudiante {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function crearEstudiante($matricula, $cedula, $nombre, $apellido, $email, $telefono) {
        $sql = "INSERT INTO estudiantes (matricula, cedula, nombre, apellido, email, telefono, fecha_registro)
                VALUES (:matricula, :cedula, :nombre, :apellido, :email, :telefono, NOW())";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);
            return $stmt->execute();
        } catch (\PDOException $e) {
            // Lanzar la excepción para que el controlador la pueda capturar y manejar (errores de unicidad, etc.)
            throw $e;
        }
    }

    // Aquí puedes agregar otros métodos para interactuar con la tabla de estudiantes
    // como obtener estudiantes, actualizar información, etc.
}
    