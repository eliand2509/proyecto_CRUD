<?php

require_once __DIR__ . '/MySQLDatabase.php';

$config = require __DIR__ . '/conexion.php';

$db = new \Config\MySQLDatabase($config);
$pdo = $db->connect();

if ($pdo instanceof PDO) {
    echo "✅ Conexión exitosa a la base de datos.";
} else {
    echo "❌ Fallo en la conexión.";
}

