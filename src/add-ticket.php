<? session_start()?>
<!doctype html>
<html lang="ru">
<head>
    <?php require_once __DIR__ ."/components/head.php" ?>
    <title>Document</title>
</head>
<body>
<?php 
require_once __DIR__ . "/components/header.php";
require_once __DIR__ . "/requires.php";
?>


<section class="main">
    <div class="container">
        <div class="row">
            <h2 class="display-6 mb-3">Добавить заявку</h2>
        </div>

        <?
            if (isset($_SESSION["fieldsTickets"]))
            {
                $fieldsTickets = $_SESSION["fieldsTickets"];
                unset($_SESSION["fieldsTickets"]);
            }
            ?>

            <div class="">
                <? if(isset($fieldsTickets["totalError"])) {
                    if ($fieldsTickets["totalError"]["error"]) {
                    ?>

                    <div class="alert alert-danger mt-1" role="alert">
                        <?= $fieldsTickets["totalError"]["message"]?>
                    </div>
                <?}
                } 
                ?>
            </div>
        <div class="row">
            <form action="./actions/tickets/add-tickets.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fullNameField" class="form-label">Тема заявки</label>
                    <input 
                        type="text"
                        value="<?= $fieldsTickets['title']['value'] ?? ''?>"
                        class="form-control <?= $fieldsTickets['title']['error'] ? 'is-invalid' : '' ?>" 
                        id="fullNameField" 
                        aria-describedby="emailHelp" 
                        name="title">
                </div>
                <div class="mb-3">
                    <label for="fullNameField" class="form-label">Изображение</label>
                    <input type="file" class="form-control" id="fullNameField" aria-describedby="emailHelp" name="image">
                </div>
                <div class="mb-3">
                    <label for="dobField" class="form-label">Описание</label>
                    <textarea 
                        value="<?= $fieldsTickets['desc']['value'] ?? ' ' ?>"
                        class="form-control <?= $fieldsTickets['desc']['error'] ? 'is-invalid' : '' ?>" 
                        id="dobField" 
                        name="desc">
                    </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Добавить заявку</button>
            </form>
        </div>
    </div>
</section>
<?php require_once "./components/scripts.php" ?>
</body>
</html>