<?php
session_start();
$cacheFile = 'api_cache.json';
$cacheTtl = 300; 

// Проверяем кэш
if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTtl)) {
    $_SESSION['api_data'] = json_decode(file_get_contents($cacheFile), true);
} else {
    // Если кэша нет, выполняем запрос (как и раньше)
    require_once 'ApiClient.php';
    $api = new ApiClient();
    $apiData = $api->request('https://www.themealdb.com/api/json/v1/1/random.php');
    
    if (!isset($apiData['error'])) {
        file_put_contents($cacheFile, json_encode($apiData, JSON_UNESCAPED_UNICODE));
    }
    $_SESSION['api_data'] = $apiData;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_index.css">
    <title>Data</title>
</head>
<body>

<?php if(isset($_SESSION['username'])): ?>
    <h3>Данные из сессии:</h3>
    <div class="card">
    <ul>
        <li>Имя: <?= $_SESSION['username'] ?></li>
        <li>Email: <?= $_SESSION['email'] ?></li>
    </ul>
</div>
<?php else: ?>
    <p>Данных пока нет.</p>
<?php endif; ?>


<?php if(isset($_SESSION['errors'])): ?>
    <ul>
        <div class="error-list">
        <?php foreach($_SESSION['errors'] as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
        </div>
    </ul>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>



<?php require_once 'UserInfo.php';
$info = UserInfo::getInfo(); 

if (isset($_SESSION['api_data']['meals'][0]['strInstructions'])) {
    echo "<h3>Данные из API:</h3>";
    echo "<pre id='api-data'>" . print_r($_SESSION['api_data']['meals'][0]['strInstructions'], true) . "</pre>";
} ?>


<button id="refreshBtn">Обновить данные</button>
<div id="apiResult">
    </div>

<script>
document.getElementById('refreshBtn').addEventListener('click', function() {
    const output = document.getElementById('apiResult');
    output.innerHTML = "Загрузка...";

    fetch('refresh.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                output.innerHTML = `<p style="color:red;">Ошибка: ${data.error}</p>`;
            } else {
                output.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;
            }
        })
        .catch(err => {
            output.innerHTML = `<p style="color:red;">Сервер недоступен или произошла ошибка.</p>`;
        });
});
</script>

<?php echo "<h3>Информация о пользователе:</h3>"; ?>
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


</body> 
</html>

