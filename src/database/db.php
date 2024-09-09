<?php

$database = require_once __DIR__ . "./../config/database.php";

try {
    $pdo = new PDO("{$database["driver"]}:host={$database["host"]};dbname={$database["database-name"]};port={$database["port"]}", $database["name"], $database["password"]);
} catch (\PDOException $th) {
    echo require_once __DIR__ . "./../components/db-connect-error.php";
    die();
}