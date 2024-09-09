<?session_start();
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
        <div class="row">
            <h2 class="display-6 mb-3">Управление заявками</h2>
        </div>
        <? 
            require_once __DIR__ . "/components/tickets.php"; 
            if (isset($_SESSION["user"]) && (int)$_SESSION["user"]["user_group_id"] === 1) {?>
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
                            foreach ($ticketTags as $ticketTag) {
                                if ($ticket["tickets_tag_id"] === $ticketTag["id"]) { ?>
                                    <tr>
                                        <td>
                                            <img src="public/images/<?= $ticket["image"]?>.jpg" width="200" height="100" alt="">
                                        </td>
                                        <td><?= $ticket["title"]?></td>
                                        <td><?= $ticket["description"]?></td>
                                        <td>
                                            <span class="badge" style="background-color: <?= $ticketTag['background']?>; color: <?= $ticketTag['color']?>"><?= $ticketTag["name"]?></span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Действия
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <form action="./actions/tickets/change-tag.php" method="post">
                                                            <input class="visually-hidden" value="<?= $ticket['id']?>" name="id">
                                                            <input class="visually-hidden" value="1" name="changeMethod">   
                                                            <button class="dropdown-item" type="submit">Выполнено</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="./actions/tickets/change-tag.php" method="post">
                                                            <input class="visually-hidden" value="<?= $ticket['id']?>" name="id">
                                                            <input class="visually-hidden" value="2" name="changeMethod">
                                                            <button class="dropdown-item" type="submit">В процессе</button>
                                                        </form>    
                                                    </li>
                                                    <li>
                                                        <form action="./actions/tickets/change-tag.php" method="post">
                                                            <input class="visually-hidden" value="<?= $ticket['id']?>" name="id">
                                                            <input class="visually-hidden" value="3" name="changeMethod">
                                                            <button class="dropdown-item" type="submit">Создано</button>
                                                        </form>    
                                                    </li>
                                                    <li>
                                                        <form action="./actions/tickets/change-tag.php" method="post">
                                                            <input class="visually-hidden" value="<?= $ticket['id']?>" name="id">
                                                            <input class="visually-hidden" value="4" name="changeMethod"> 
                                                            <button class="dropdown-item" type="submit">Отклонить</button>
                                                        </form>    
                                                    </li>
                                                    <li>
                                                        <form action="./actions/tickets/change-tag.php" method="post">
                                                            <input class="visually-hidden" value="<?= $ticket['id']?>" name="id">
                                                            <input class="visually-hidden" value="5" name="changeMethod"> 
                                                            <button class="dropdown-item" type="submit">Удалить</button>
                                                        </form>    
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?}
                            }
                        }?>
                        </tbody>
                    </table>
                </div>
            <?}
        ?>
    </div>
</section>
<?php require_once __DIR__ . "/components/scripts.php" ?>
</body>
</html>