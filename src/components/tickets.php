<?php

require_once __DIR__ . '/../requires.php';

if (isset($_GET["q"])) {
    $sql = "SELECT * FROM `tickets` WHERE title like :q ORDER BY `id` DESC";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            "q" => "%{$_GET['q']}%",
        ]);
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $exception) {
        echo $exception->getMessage();
    }
} else {
    $sql = "SELECT `id`, `title`, `description`, `image`, `tickets_tag_id`, `created_at` FROM `tickets` ORDER BY `id` DESC";
    try {
        $stmt = $pdo->query($sql);
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $exception) {
        echo $exception->getMessage();
    }
}

$ticketTagSql = "SELECT `id`, `name`, `background`, `color`, `created_at` FROM `tickets_tags`";

try {
    $ticketTagStmt = $pdo->query($ticketTagSql);
    $ticketTags = $ticketTagStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\PDOException $tagsException) {
    echo $tagsException->getMessage();
}