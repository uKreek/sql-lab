<?php
$host = 'db';
$db   = 'lab5_db';
$user = 'lab5_user';
$pass = 'lab5_pass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $sql = "CREATE TABLE IF NOT EXISTS guests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    age INT,
    tariff VARCHAR(100),
    personal_trainer TINYINT(1),
    time_of_visits VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
    ";

    $pdo->exec($sql);;

} catch (\PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit();
}

