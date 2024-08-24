<?php

session_start();

require_once __DIR__ . "/../../requires.php";

$title = $_POST["title"];
$image = $_FILES["image"];
$desc = $_POST["desc"];

$tickets_tags = [
    "complete" => 1,
    "inProgress" => 2,
    "created" => 3,
];

$fieldsTickets = [
    "title" => [
        "value" => $title,
        "error" => false,
        "message" => ""
    ], 
    "desc" => [
        "value" => $desc,
        "error" => false,
        "message" => ""
    ],
    "totalError" => [
        "error" => false,
        "message" => ''
    ]
];

$error = false;


function isAuth(): void
{
    if (!isset($_SESSION["user"])){
        $GLOBALS['fieldsTickets']["totalError"]["message"] = "Для создания заявки надо авторизироваться";
        $GLOBALS['fieldsTickets']["totalError"]["error"] = true;
        $GLOBALS['error'] = true;
    }
}

function validateTitle(string $title): void
{
    if (empty(trim($title)))
    {
        $GLOBALS['fieldsTickets']["title"]["error"] = true;
        $GLOBALS['fieldsTickets']["title"]["message"] = "У заявки должно быть название";
        $GLOBALS['error'] = true;
    }
}

function validateDesc(string $desc): void
{
    if (empty(trim($desc)))
    {
        $GLOBALS['fieldsTickets']["desc"]["error"] = true;
        $GLOBALS['fieldsTickets']["desc"]["message"] = "Оставьте описание для заявки";
        $GLOBALS['error'] = true;
    }
}

function validateError(bool $error, array $fieldsTickets): bool
{
    if ($error)
    {
        $_SESSION["fieldsTickets"] = $fieldsTickets;
        header("Location: /../../add-ticket.php");
        return false;
    } else {
        return true;
    }
}

isAuth();
validateTitle($title,);
validateDesc($desc);

if (validateError($error, $fieldsTickets))
{
    try {
        $sql = "INSERT INTO `tickets`(`title`, `description`, `image`, `tickets_tag_id`, `user_id`) VALUES (:title, :description, :image, :tickets_tag_id, :user_id)";
        $stmt = $pdo->prepare($sql);

        if ($image === "") {
            $fileName = null;
        } else {
            $fileName = uniqid();
        }

        $stmt->execute([
            "title" => $title,
            "description" => $desc,
            "image" => $fileName,
            "tickets_tag_id" => $tickets_tags["created"],
            "user_id" => $_SESSION["user"]["id"]
        ]);


        if (!(is_null($fileName))) {
            $dir = __DIR__ . "/../../public/images/";
            $fullPath = $dir . $fileName . ".jpg";

            move_uploaded_file($image["tmp_name"], $fullPath);
        }
        header("Location: /../../my-tickets.php");
    } catch (\PDOException $th) {
        echo $th->getMessage();
    }
}
