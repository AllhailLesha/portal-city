<?php
require_once __DIR__ . "/../../requires.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ticketId = $_POST["id"];
    $sql = "DELETE FROM tickets WHERE `tickets`.`id` = :id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            "id" => $ticketId,
        ]);
    header("Location: /../../my-tickets.php");
    $_SESSION["ticketsCount"] = $_SESSION["ticketsCount"] - 1;
    } catch (\PDOException $exception) {
        echo $exception->getMessage();
    }
}