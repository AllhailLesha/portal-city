<?session_start()?>
<!doctype html>
<html lang="ru">
<head>
    <?php require_once __DIR__ ."/components/head.php" ?>
    <title>Document</title>
</head>
<?php 
 require_once __DIR__ . "/database/db.php";
?>
<body>
<?php require_once __DIR__ . "/components/header.php" ?>

<section class="main">
    <div class="container">
        <div class="row">
            <h2 class="display-6 mb-3">Заявки</h2>
        </div>
        <? require_once __DIR__ . "/components/tickets.php"?>
        <div class="row">
            <? foreach ($tickets as $ticket) { 
                foreach ($ticketTags as $ticketTag) {
                    if ($ticket["tickets_tag_id"] === $ticketTag["id"]) {?>
                        <div class="card mb-3">
                            <img src="public/images/<?= $ticket['image']?>.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $ticket["title"]?> <span class="badge" style="background-color: <?= $ticketTag['background']?>; color: <?= $ticketTag['color']?>"><?= $ticketTag["name"]?></span> </h5>
                                <p class="card-text"><?= $ticket['description']?></p>
                                <p class="card-text"><small class="text-muted"><?= $ticket['created_at']?></small></p>   
                            </div>
                        </div>
                    <?}
                    }
                }?> 
        </div>
    </div>
</section>
<?php require_once "./components/scripts.php" ?>
</body>
</html>