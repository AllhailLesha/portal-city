<?php 
session_start();
?>
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
        <div class="card">
            <div class="card-header">
                Регистрация
            </div>

            <?php if(isset($_SESSION["fields"])) {?>
                <div class="alert alert-danger mt-1" role="alert">
                    Проверьте правильность введенных полей!
                </div>
            <?
            $fields = $_SESSION["fields"];
            unset($_SESSION["fields"]);
            } 
            ?>
            <div class="card-body">
                <form action="./actions/user/register.php" method="post">
                    <div class="mb-3">
                        <label for="emailRegisterField" class="form-label">E-mail</label>
                        <input type="email" value="<?= $fields['email']['value'] ?? '' ?>" class="form-control <?= $fields['email']['error'] ? 'is-invalid' : '' ?>" id="emailRegisterField" aria-describedby="emailHelp" name="email">
                        <div id="emailRegisterHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
                    </div>
                    <div class="mb-3">
                        <label for="fullNameField" class="form-label">ФИО</label>
                        <input type="text" value="<?= $fields['name']['value'] ?? ''?>" class="form-control <?= $fields['name']['error'] ? 'is-invalid' : ''?>" id="fullNameField" aria-describedby="emailHelp" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="dobField" class="form-label">Дата рождения</label>
                        <input type="date" value="<?= $fields['dob']['value'] ?? ''?>" class="form-control <?= $fields['dob']['error'] ? 'is-invalid' : ''?>" id="dobField" aria-describedby="emailHelp" name="dob">
                    </div>
                    <div class="mb-3">
                        <label for="passwordRegisterField" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="passwordRegisterField" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirmField" class="form-label">Подтверждение пароля</label>
                        <input type="password" class="form-control" id="passwordConfirmField" name="password-confirm">
                    </div>
                    <button type="submit" class="btn btn-primary">Создать аккаунт</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once "./components/scripts.php" ?>
</body>
</html>