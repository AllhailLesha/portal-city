<? session_start();?>
<!doctype html>
<html lang="ru">
<head>
    <?php require_once __DIR__ ."/components/head.php" ?>
    <title>Document</title>
</head>
<body>
<?php require_once __DIR__ . "/components/header.php" ?>

<section class="main">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Авторизация
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
                <form action="./actions//user//login.php" method="post">
                    <div class="mb-3">
                        <label for="emailField" class="form-label">E-mail</label> 
                        <input 
                            type="email" 
                            class="form-control <?= $fields['email']['error'] ? 'is-invalid' : ''?>" 
                            value="<?= $fields['email']['value'] ?? ''?>"
                            id="emailField" 
                            aria-describedby="emailHelp" 
                            name="email">
                        <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
                        <div 
                            class="alert alert-danger d-flex align-items-center <?= $fields['email']['error'] ? '' : 'visually-hidden' ?>" 
                            role="alert">
                            <div>
                               <?= $fields["email"]["error"] ? $fields["email"]["message"] : ""?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordField" class="form-label">Пароль</label> 
                        <input 
                            type="password" 
                            class="form-control <?= $fields['password']['error'] ? 'is-invalid' : ''?>" 
                            id="passwordField" 
                            name="password">
                        <div 
                            class="alert alert-danger d-flex align-items-center <?= $fields['password']['error'] ? '' : 'visually-hidden' ?>" 
                            role="alert">
                            <div>
                               <?= $fields["password"]["error"] ? $fields["password"]["message"] : ""?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once "./components/scripts.php" ?>
</body>
</html>