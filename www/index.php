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
<div class="container">
<?php if(isset($_SESSION['errors'])): ?>
        <div class="error-list">
        <?php foreach($_SESSION['errors'] as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
        </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['name'])): ?>
    <h3>Данные из сессии:</h3>
    <div class="card">
    <ul>
        <li>Имя: <?= $_SESSION['name'] ?></li>
        <li>Email: <?= $_SESSION['email'] ?></li>
    </ul>
</div>
<?php else: ?>
    <p>Данных пока нет.</p>
<?php endif; ?>


<?php require_once 'UserInfo.php';
$info = UserInfo::getInfo(); 


echo "<h3>Информация о пользователе:</h3>"; ?>

<div class="card">
    <?php foreach ($info as $key => $val) {
        echo htmlspecialchars($key) . ': ' . htmlspecialchars($val) . '<br>';
    } ?>
</div>

<div class="nav">
    <a href="form.html">Заполнить форму</a> |
    <a href="view.php">Посмотреть все данные</a> |
    <a href="cookies.php">Куки</a>
</div>  

</div>
</body> 
</html>

