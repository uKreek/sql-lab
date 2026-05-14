<?php

session_start(); 

require 'db.php';
require 'Guest.php';

$guests = new Guest($pdo);


$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email'] ?? '');
$age = intval($_POST['age']);
$tariff = htmlspecialchars($_POST['tariff'] ?? '');
$personal_trainer = isset($_POST['agree']) ? 1 : 0;
$time_of_visits = $_POST['time_of_visits'] ?? '';

$errors = [];
if(empty($name)) $errors[] = "Имя не может быть пустым";
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Некорректный email";

if(!empty($errors)){
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit();
}

setcookie("name", $name);
setcookie("email", $email);

$_SESSION['name'] = $name;
$_SESSION['email'] = $email;

$line = $name . ";" . $email . "\n";
file_put_contents("data.txt", $line, FILE_APPEND);


header("Location: index.php");
    exit();