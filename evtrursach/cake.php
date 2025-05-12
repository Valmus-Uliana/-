<?php
include('connect.php'); // Подключаем файл с соединением к базе данных

// Проверяем, передан ли параметр id
if (isset($_GET['id'])) {
    // Приводим id к целому числу для безопасности
    $id = intval($_GET['id']);
    
    // Подготавливаем запрос к таблице cake для получения рецепта с нужным id
    $sql = "SELECT * FROM cake WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $recipe = $result->fetch_assoc();
    } else {
        echo "Рецепт не найден.";
        exit();
    }
    $stmt->close();
    $mysqli->close();
} else {
    echo "ID рецепта не передан.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Dream</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cake.css">
    <script src="script.js"></script>
</head>
<body>

<header>
    <a href="main.php" class="logo">
        <img src="/images/красивый тортик.png" alt="Sweet Dream Logo">
        <span>Sweet Dream</span>
    </a>

    <!-- Обычное меню -->
    <nav id="main-nav">
        <a href="list-recepies.php">Рецепты</a>
        <a href="add-recepie.php">Добавить рецепт</a>
    </nav>

    <!-- Кнопка бургер-меню -->
    <button class="burger-menu" onclick="toggleMenu()">☰</button>

    <!-- Выпадающее меню -->
    <div class="menu-dropdown" id="dropdown">
        <a href="list-recepies.php">Рецепты</a>
        <a href="add-recepie.php">Добавить рецепт</a>
    </div>

    <div class="theme-buttons">
        <button onclick="setTheme('light-theme')">Светлая</button>
        <button onclick="setTheme('dark-theme')">Темная</button>
    </div>
</header>
    
    <div class="recipe-container">
    <!-- Название рецепта -->
    <h1><?php echo htmlspecialchars($recipe['name']); ?></h1>
    
    <!-- Ингредиенты -->
    <div class="recipe-section">
      <h2>Ингредиенты</h2>
      <p><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
    </div>
    
    <!-- Описание готовки -->
    <div class="recipe-section">
      <h2>Описание готовки</h2>
      <p><?php echo nl2br(htmlspecialchars($recipe['cook'])); ?></p>
    </div>
    
    <!-- Фото торта -->
    <div class="recipe-image">
      <img src="/images/<?php echo htmlspecialchars($recipe['foto']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>">
    </div>
  </div>

  <footer>
        <div class="footer-container">
            <div class="footer-item">
                <p>Наша почта:</p>
                <a href="https://e.mail.ru/compose/?to=ulash_gulash@mail.ru" target="_blank"><p>sweetdream@mail.ru</p></a>
            </div>
            <div class="footer-item">
                <p>Телефон:</p>
                <a href=""><p>+375 29 21-43-653</p></a>
            </div>
            <div class="footer-item">
                <p>Адрес:</p>
                <a href="https://yandex.ru/maps/?text=Минск, Сурганова 50" target="_blank"><p>Минск, Сурганова 50</p></a>
            </div>
        </div>
    </footer>
    
</body>
</html>