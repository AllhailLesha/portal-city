<?php 
session_start();
require_once __DIR__ . "/../../requires.php";

$email = $_POST["email"];
$name = $_POST["name"];
$dob = $_POST["dob"];
$password = $_POST["password"];
$passwordConfirm = $_POST["password-confirm"];

$fields = [
    "email" => [
        "value" => $email,
        "message" => "",
        "error" => false,
    ],
    "name" => [
        "value" => $name,
        "message" => "",
        "error" => false,
    ],
    "dob" => [
        "value" => $dob,
        "error" => false,
    ],
    "password" => [
        "message" => "",
        "error" => false,
    ],
    "passwordConfirm" => [
        "message" => "",
        "error" => false,
    ]
];

$error = false;

function validateEmail($email) 
{

    if (empty($email))
    {
        $GLOBALS["fields"]["email"]["error"] = true;
        $GLOBALS["fields"]["email"]["message"] = "Email является обязательным полем для заполнения!";
        $GLOBALS['error'] = true;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $GLOBALS["fields"]["email"]["error"] = true;
        $GLOBALS["fields"]["email"]["message"] = "Не валидный email!";
        $GLOBALS['error'] = true;
    } 
}

function validateName($name) 
{
    if (empty($name))
    {
        $GLOBALS["fields"]["name"]["error"] = true;
        $GLOBALS["fields"]["name"]["message"] = "Имя не может быть пустым";
        $GLOBALS['error'] = true;
    } else if (!preg_match("/^([А-ЯЁ][а-яё]+-?)+ ([А-ЯЁ][а-яё]+-?)+ ([А-ЯЁ][а-яё]+-?)+$/u", $name)) 
    {
        $GLOBALS["fields"]["name"]["error"] = true;
        $GLOBALS["fields"]["name"]["message"] = "Не валидное ФИО";
        $GLOBALS['error'] = true;
    }
}

function validateDob($dob) 
{
    if (empty($dob))
    {
        $GLOBALS["fields"]["dob"]["error"] = true;
        $GLOBALS['error'] = true;
    }
}

function validatePassword($password, $passwordConfirm)
{
    if (strlen($password) < 5)
    {
        $GLOBALS["fields"]["password"]["error"] = true;
        $GLOBALS["fields"]["password"]["message"] = "Пароль должен содержать минимум 5 символов";
        $GLOBALS['error'] = true;
        header("Location: /../../register.php");
    } else {
        validatePasswordConfirm($password, $passwordConfirm);
    }
}

function validatePasswordConfirm($password, $passwordConfirm)
{
    if ($password !== $passwordConfirm)
    {
        $GLOBALS["fields"]["password"]["error"] = true;
        $GLOBALS["fields"]["passwordConfirm"]["error"] = true;
        $GLOBALS["fields"]["password"]["message"] = "Пароли не совпадают";
        $GLOBALS["fields"]["passwordConfirm"]["message"] = "Пароли не совпадают";
        $GLOBALS['error'] = true;
        header("Location: /../../register.php");
    }
}

function addUser($email, $name, $dob, $password, $pdo) 
{
    $sql = "INSERT INTO `users`(`email`, `name`, `dob`, `password`, `user_group_id`) VALUES (:email, :name, :dob, :password, :userGroup)";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            "email" => $email,
            "name" => $name,
            "dob" => $dob,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "userGroup" => 2
        ]);
    } catch (\PDOException $exception) {
        echo $exception->getMessage();
    }
}

validateEmail($email);
validateName($name);
validateDob($dob);
validatePassword($password, $passwordConfirm);

if ($error === true)
{   
    $_SESSION["fields"] = $fields;
    header("Location: /../../register.php");
} else {
    addUser($email, $name, $dob, $password, $pdo);
    header("Location: /../../login.php");
}





