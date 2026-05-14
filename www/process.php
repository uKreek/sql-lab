<?php
require 'db.php';
require 'Guest.php';

$guest = new Guest($pdo);

$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$age = intval($_POST['age']);
$tariff = htmlspecialchars($_POST['tariff'] ?? '');
$personal_trainer = isset($_POST['personal_trainer']) ? 1 : 0;
$time_of_visits = $_POST['time_of_visits'] ?? '';

$guest->add($username, $email, $age, $tariff, $personal_trainer, $time_of_visits);

header("Location: index.php");
exit();
