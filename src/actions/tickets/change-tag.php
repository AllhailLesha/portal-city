<?php
session_start();
require_once __DIR__ . "/../../requires.php";

$changeMethod = $_POST["changeMethod"];
$ticketId = $_POST["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($changeMethod == 5 ) {
        $sql = "DELETE FROM tickets WHERE `tickets`.`id` = :ticketId";
        $stmt = $pdo->prepare($sql);
    
        try {
            checkSession();
            $stmt->execute([
                "ticketId" => $ticketId,
            ]);
            header("Location: /../../tickets-control.php");
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
    } else {
        $sql = "UPDATE `tickets` SET `tickets_tag_id` = :changeMethod WHERE id = :ticketId";    
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute([    
                "changeMethod" => $changeMethod,
                "ticketId" => $ticketId,    
            ]);
            header("Location: /../../tickets-control.php");
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}


function checkSession() {
    $sql = "SELECT `user_id` FROM `tickets` WHERE id = :ticketId";
    $stmt = $GLOBALS["pdo"]->prepare($sql);
    try {
        $stmt->execute([
            "ticketId" => $GLOBALS['ticketId'],
        ]);
        $ticket = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\PDOException $exception) {
        echo $exception->getMessage();
    }

    if (isset($_SESSION["user"])) {
        if ($_SESSION["user"]["id"] === $ticket["user_id"]) {
            $_SESSION["ticketsCount"] = $_SESSION["ticketsCount"] - 1;
        }
    }
}
