<?
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
        $_SESSION["ticketsCount"] = $_SESSION["ticketsCount"] - 1;
        header("Location: /../../my-tickets.php");
    } catch (\PDOException $exception) {
        echo $exception->getMessage();
    }
}
?>