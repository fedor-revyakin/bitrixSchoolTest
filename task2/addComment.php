<?php

define("NAME_MAX_LENGTH", 20);
define("TEXT_MAX_LENGTH", 500);
define("MAX_RATING", 10);
define("FILE_NAME", "comments.txt");

$errorMessages = [];

if (! validate($errorMessages, $_POST)) {
    print(json_encode(["messages" => $errorMessages]));
    exit();
}

if (! save($_POST)) {
    print(json_encode(["success" => false]));
    exit();
}

print(json_encode(["success" => true]));

exit();


function validate(array &$errorMessages, array $formData): bool
{
    return email($errorMessages, trim($formData["email"]))
        & name($errorMessages, trim($formData["name"]))
        & rating($errorMessages, trim($formData["rating"]))
        & commentText($errorMessages, trim($formData["text"]));
}

function email(array &$errorMessages, string $email = null): bool
{
    if (! $email) {
        $errorMessages['email'] = "Укажите email";
        return false;
    }
    
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages['email'] = "Некорректный email";
        return false;
    }

    return true;
}

function name(array &$errorMessages, string $name = null): bool
{
    if (mb_strlen($name) > NAME_MAX_LENGTH) {
        $errorMessages['name'] = "Максимальная длина для имени: " . NAME_MAX_LENGTH . " символов";
        return false;
    }

    return true;
}

function rating(array &$errorMessages, string $rating = null): bool
{
    if (! strlen($rating)) {
        $errorMessages['rating'] = "Введите оценку страницы";
        return false;
    }

    if (preg_match("/[^0-9]/", $rating)) {
        $errorMessages['rating'] = "Используйте только цифры от 0 до 9";
        return false;
    }

    if (intval($rating) > MAX_RATING) {
        $errorMessages['rating'] = "Минимальная оценка 0, максимальная - " . MAX_RATING;
        return false;
    }

    return true;
}

function commentText(array &$errorMessages, string $text = null): bool
{
    if (mb_strlen($text) > TEXT_MAX_LENGTH) {
        $errorMessages['text'] = "Максимальная длина комментария " . TEXT_MAX_LENGTH . " символов";
        return false;
    }
    
    return true;
}

function save(array $formData): bool
{
    if (is_writable(FILE_NAME)) {
        if (! $fp = fopen(FILE_NAME, 'a')) {
            return false;
        }
    
        if (fputcsv($fp, $formData) === false) {
            return false;
        }
    
        fclose($fp);

        return true;
    
    } else {
        return false;
    }
}
