<?php 
session_start();
require_once __DIR__ . "/../../requires.php";

// dd($_POST);

$email = $_POST["email"];
$name = $_POST["name"];
$dob = $_POST["dob"];
$password = $_POST["password"];
$passwordConfirm = $_POST["password-confirm"];

$fields = [
    "email" => [
        "value" => $email,
        "error" => false,
    ],
    "name" => [
        "value" => $name,
        "error" => false,
    ],
    "dob" => [
        "value" => $dob,
        "error" => false,
    ],
];

$error = false;

function validateEmail($email) 
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $GLOBALS["fields"]["email"]["error"] = true;
        $GLOBALS['error'] = true;
    }
}

function validateName($name) 
{
    if (empty($name))
    {
        $GLOBALS["fields"]["name"]["error"] = true;
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

// function validatePassword($password)
// {
//     if (empty($password) || strlen($password) < 5)
//     {
//         $_SESSION["password-error"] = true;
//         header("Location: /../../register.php");
//     }
// }

// function validatePasswordConfirm($password, $passwordConfirm)
// {
//     if ($password !== $passwordConfirm)
//     {
//         $_SESSION["passwordConfitm-error"] = true;
//         header("Location: /../../register.php");
//     }
// }

validateEmail($email);
validateName($name);
validateDob($dob);
// validatePassword($password);
// validatePasswordConfirm($password, $passwordConfirm);

if ($error === true)
{   
    $_SESSION["fields"] = $fields;
    header("Location: /../../register.php");
} else {
    header("Location: /../../register.php");
}




