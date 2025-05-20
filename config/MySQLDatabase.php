<?php

namespace Config;

use PDO;
use PDOException;

class MySQLDatabase extends BaseDatos {

    protected function connect(): ?PDO {
        try {
            $dsn = "mysql:host={$this->config['host']};dbname={$this->config['dbname']};charset={$this->config['charset']}";
            $pdo = new PDO($dsn, $this->config['username'], $this->config['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            error_log("❌ Error de conexión: " . $e->getMessage());
            return null;
        }
    }
}