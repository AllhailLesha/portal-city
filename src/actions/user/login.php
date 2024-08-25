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
        validateEmail($GLOBALS['email'], $user['email'] ?? "");
        validatePassword($GLOBALS['password'], $user["password"] ?? "");
        if ($user !== false ) {
            $_SESSION["user"] = $user;
            getTicketsCount();
            header("Location: /../../index.php");
        }        
    } catch (\PDOException $exception) {
        echo $exception->getMessage();
    }

}

function validatePassword($password, $passwordFromBd)
{

    if (empty($password)) {
        $GLOBALS['fields']['password']['error'] = true;
        $GLOBALS['fields']['password']['message'] = "Неправильный пароль";
        $GLOBALS['error'] = true;
        $_SESSION["fields"] = $GLOBALS['fields'];
        header("Location: /../../login.php");
    } else if (!password_verify($password, $passwordFromBd))
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
    if (empty($email)) {
        $GLOBALS['fields']['email']['error'] = true;
        $GLOBALS['fields']['email']['message'] = "Пользователя с такой почтой не существует";
        $_SESSION["fields"] = $GLOBALS['fields'];
        $GLOBALS['error'] = true;
        header("Location: /../../login.php");
    } else if ($email !== $emailFromBd)        
    {
        $GLOBALS['fields']['email']['error'] = true;
        $GLOBALS['fields']['email']['message'] = "Пользователя с такой почтой не существует";
        $_SESSION["fields"] = $GLOBALS['fields'];
        $GLOBALS['error'] = true;
        header("Location: /../../login.php");
    }
}

function getTicketsCount() {
    $ticketsSql = "SELECT `id`, `user_id` FROM `tickets` WHERE user_id = :sessionUserId";
    $ticketsStmt = $GLOBALS["pdo"]->prepare($ticketsSql);
    try {
        $ticketsStmt->execute([
            "sessionUserId" => $_SESSION["user"]["id"],
        ]);
        $ticketsCount = count($ticketsStmt->fetchAll(PDO::FETCH_ASSOC));
        $_SESSION["ticketsCount"] = $ticketsCount;
    } catch (\PDOException $exceptionTickets) {
        echo $exceptionTickets->getMessage();
    }
}
checkEmail($email, $pdo);