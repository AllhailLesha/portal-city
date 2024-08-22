<?php
require_once __DIR__ . "/../../requires.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: /../../index.php");        
} else {
    echo "Пошел с этой страницы!";
}
