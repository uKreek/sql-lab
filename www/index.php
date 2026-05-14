<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_index.css">
    <title>Data</title>
</head>
<body>

<?php
require 'db.php';
require 'Guest.php';

$guest = new Guest($pdo);
$all = $guest->getAll();
?>

<div class="container">

<?php $count_query = $pdo->query("SELECT COUNT(*) FROM guests");
$total_users = $count_query->fetchColumn(); 

$query = "SELECT * FROM users WHERE age >= 18 ORDER BY created_at DESC"; ?>

<h2>Данные о посетителях:</h2>
<p>Всего гостей: <strong><?= $total_users ?></strong></p>
<table class="table">
    <thead>
		<tr>
			<th>Имя</th>
			<th>Почта</th>
			<th>Возраст</th>
			<th>Тариф</th>
			<th>Тренер</th>
			<th>Время</th>
            <th>Дата заявки</th>
		</tr>
	</thead>
    <tbody>
    
        <?php foreach($all as $row): ?>
        <tr>
        <td><?= $row['email'] ?></td>
        <td><?= $row['username'] ?></td>
        <td><?= $row['age']?></td>
        <td><?= $row['tariff'] ?></td>
        <td><?= $row['personal_trainer'] ? 'Да' : 'Нет' ?></td>
        <td><?= $row['time_of_visits'] ?></td>
        <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
        
    </tbody>
</table>

<div class="nav">
<a href="form.html">Заполнить форму</a>
<div>
</body> 
</html>

