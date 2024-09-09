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
                        <input 
                            type="email" 
                            value="<?= $fields['email']['value'] ?? '' ?>" 
                            class="form-control <?= $fields['email']['error'] ? 'is-invalid' : '' ?>" 
                            id="emailRegisterField" 
                            aria-describedby="emailHelp" 
                            name="email">
                        <div id="emailRegisterHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
                        <div 
                            class="alert alert-danger d-flex align-items-center <?= $fields['email']['error'] ? '' : 'visually-hidden' ?>" 
                            role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>
                                <symbol id="info-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </symbol>
                                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                            </svg>
                            <div>
                               <?= $fields["email"]["error"] ? $fields["email"]["message"] : ""?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fullNameField" class="form-label">ФИО</label>
                        <input 
                            type="text" 
                            value="<?= $fields['name']['value'] ?? ''?>" 
                            class="form-control <?= $fields['name']['error'] ? 'is-invalid' : ''?>" 
                            id="fullNameField" 
                            aria-describedby="emailHelp" 
                            name="name">
                        <div 
                            class="alert alert-danger d-flex align-items-center <?= $fields['name']['error'] ? '' : 'visually-hidden' ?>" 
                            role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>
                                <symbol id="info-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </symbol>
                                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                            </svg>
                            <div>
                               <?= $fields["name"]["error"] ? $fields["name"]["message"] : ""?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dobField" class="form-label">Дата рождения</label>
                        <input 
                            type="date" 
                            value="<?= $fields['dob']['value'] ?? ''?>" 
                            class="form-control <?= $fields['dob']['error'] ? 'is-invalid' : ''?>" 
                            id="dobField" 
                            aria-describedby="emailHelp" 
                            name="dob">
                    </div>
                    <div class="mb-3">
                        <label for="passwordRegisterField" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="passwordRegisterField" name="password">
                        <div 
                            class="alert alert-danger d-flex align-items-center <?= $fields['password']['error'] ? '' : 'visually-hidden' ?>" 
                            role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>
                                <symbol id="info-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </symbol>
                                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                            </svg>
                            <div>
                               <?= $fields["password"]["error"] ? $fields["password"]["message"] : ""?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirmField" class="form-label">Подтверждение пароля</label>
                        <input type="password" class="form-control" id="passwordConfirmField" name="password-confirm">
                        <div 
                            class="alert alert-danger d-flex align-items-center <?= $fields['passwordConfirm']['error'] ? '' : 'visually-hidden' ?>" 
                            role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                                <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </symbol>
                                <symbol id="info-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                </symbol>
                                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                            </svg>
                            <div>
                               <?= $fields["passwordConfirm"]["error"] ? $fields["passwordConfirm"]["message"] : ""?>
                            </div>
                        </div>
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