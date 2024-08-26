<?
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <?php require_once __DIR__ ."/components/head.php" ?>
    <title>Document</title>
</head>
<body>
<?php require_once __DIR__ . "/components/header.php";
        require_once __DIR__ . "/requires.php";
?>

<section class="main">
    <div class="container">
        <? if(!isset($_SESSION["user"])) { ?>
            <p class="fs-2">Для просмотра "Моих заявок" надо авторизироваться</p>
            <a class="btn btn-success" href="./login.php">Авторизироваться</a>
        <?} else {
            $userId = $_SESSION["user"]["id"];
            $sql = "SELECT `id`, `title`, `description`, `image`, `tickets_tag_id` FROM `tickets` WHERE user_id = :userId";
            $stmt = $pdo->prepare($sql);

            try {
                $stmt->execute([
                    "userId" => $userId
                ]);
                $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (\PDOException $exception) {
                echo $exception->getMessage();
            }

            $ticketsTagSql = "SELECT `id`, `name`, `background`, `color`, `created_at`, `updated_at` FROM `tickets_tags`";
            try {
                $ticketsTagStmt = $pdo->query($ticketsTagSql);
                $ticketsTags = $ticketsTagStmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (\PDOException $exceptionTag) {
                echo $exceptionTag->getMessage();
            }
        ?>
        <div class="row">
            <h2 class="display-6 mb-3">Мои заявки</h2>
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Изображение</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($tickets as $ticket) { 
                    $tempTicketTag;

                    foreach ($ticketsTags as $ticketTag) {
                        if ($ticketTag["id"] === $ticket["tickets_tag_id"]) {
                            $tempTicketTag = $ticketTag;
                        }
                    }?>     
                    <tr>
                        <td>
                            <img src="public/images/<?=$ticket['image']?>.jpg" width="200" alt="<?= $ticket["title"]?>">
                        </td>
                        <td><?= $ticket["title"]?></td>
                        <td><?= $ticket["description"] ?></td>
                        <td>
                            <span class="badge rounded-pill" style="background-color: <?= $tempTicketTag['background']?>; color: <?= $tempTicketTag['color']?>"><?= $tempTicketTag["name"]?></span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Действия
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <form action="./actions/tickets/delete-ticket.php" method="post">
                                            <input class="visually-hidden" type="text" value="<?= $ticket["id"]?>" name="id">
                                            <button class="dropdown-item" type="submit">Удалить</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        </div>
        <?}?>
    </div>
</section>
<?php require_once "./components/scripts.php" ?>
</body>
</html>