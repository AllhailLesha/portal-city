<?php
session_start();
require_once __DIR__ . "/../../requires.php";

$email = $_POST["email"];
$password = $_POST["password"];

$fields = [
    "email" => [
        "value" => $email,
        "message" => "",
        "error" => false,
    ],
    "password" => [
        "message" => "",
        "error" => false,
    ],

];

$error = false;

function checkEmail($email, $pdo) 
{
    $sql = "SELECT `id`, `email`, `name`, `dob`, `password`, `user_group_id` FROM `users` WHERE email = :email";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "email" => $email,
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        validateEmail($GLOBALS['email'], $user['email'] ?? null);
        validatePassword($GLOBALS['password'], $user["password"] ?? null);
        $_SESSION["user"] = $user;
        header("Location: /../../index.php");        
    } catch (\PDOException $exception) {
        echo $exception->getMessage();
    }

}

function validatePassword($password, $passwordFromBd)
{
    if (!password_verify($password, $passwordFromBd))
    {
        $GLOBALS['fields']['password']['error'] = true;
        $GLOBALS['fields']['password']['message'] = "Неправильный пароль";
        $GLOBALS['error'] = true;
        $_SESSION["fields"] = $GLOBALS['fields'];
        header("Location: /../../login.php");        
    }
}

function validateEmail($email, $emailFromBd)
{
    if ($email !== $emailFromBd)
    {
        $GLOBALS['fields']['email']['error'] = true;
        $GLOBALS['fields']['email']['message'] = "Пользователя с такой почтой не существует";
        $_SESSION["fields"] = $GLOBALS['fields'];
        $GLOBALS['error'] = true;
        header("Location: /../../login.php");  
    }
}

checkEmail($email, $pdo);