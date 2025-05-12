<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Dream</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="add-recepie.css">
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

   <!-- Форма (пример) -->
<div class="container">
  <div class="form-container">
    <h2>Добавьте новый рецепт торта</h2>
    <!-- Добавлен enctype для загрузки файлов -->
    <form action="add-recepie.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="cake-name">Введите название торта:</label>
        <input type="text" name="cake_name" id="cake-name" placeholder="Клубничный торт" required>
      </div>

      <div class="form-group">
        <label for="ingredients">Введите ингредиенты:</label>
        <textarea name="ingredients" id="ingredients" rows="8" 
        placeholder="Ингредиент 1 - 100 гр
Ингредиент 2 - 100 гр
..." required></textarea>
      </div>

      <div class="form-group">
        <label for="cake-description">Введите описание торта:</label>
        <textarea name="description" id="cake-description" rows="5" placeholder="Этот торт создан для настоящих ценителей шоколадного наслаждения. Мягкие и влажные коржи, пропитанные нежной шоколадной глазурью, в сочетании с тонкими нотками какао создают идеальную гармонию вкуса. " required></textarea>
      </div>

      <div class="form-group">
        <label for="cooking-description">Введите описание приготовления:</label>
        <textarea name="cook" id="cooking-description" rows="8"
        placeholder="Смешать 1 и 2 
Добавить 3
..." required></textarea>
      </div>

      <div class="form-group">
        <label for="cake-photo">Загрузите фото торта:</label>
        <input type="file" name="cake_photo" id="cake-photo" accept="image/*" required>
      </div>

      <div class="form-group">
        <button type="submit">Добавить рецепт</button>
      </div>
    </form>

    <?php
    include('connect.php'); // Подключаем базу данных

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['cake_name']) || empty($_POST['ingredients']) || empty($_POST['description']) || empty($_POST['cook']) || empty($_FILES['cake_photo']['name'])) {
            echo "<b style='font-size:24px; color:red;'>❌ Ошибка: Все поля должны быть заполнены!</b>";
            exit();
        }

        // Получаем данные из формы
        $cake_name = htmlspecialchars($_POST['cake_name']);
        $ingredients = htmlspecialchars($_POST['ingredients']);
        $description = htmlspecialchars($_POST['description']);
        $cook = htmlspecialchars($_POST['cook']);
        $foto = htmlspecialchars(basename($_FILES['cake_photo']['name']));

        // Загружаем фото
        $target_dir = "images/";
        $target_file = $target_dir . $foto;

        if (!empty($_FILES['cake_photo']['name'])) {
            if (move_uploaded_file($_FILES["cake_photo"]["tmp_name"], $target_file)) {
                echo "✅ Фото успешно загружено!";
            } else {
                echo "❌ Ошибка при загрузке фото.";
                exit();
            }
        } else {
            echo "❌ Ошибка: Файл не загружен.";
            exit();
        }

        // Добавляем данные в таблицу `cake`
        $sql = "INSERT INTO cake (`name`, `ingredients`, `description`, `cook`, `foto`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssss", $cake_name, $ingredients, $description, $cook, $foto);

        if ($stmt->execute()) {
            echo "<p style='font-size:24px; color:green;'>✅ Рецепт успешно добавлен!</p>";
            echo "<meta http-equiv='refresh' content='0; URL=add-recepie.php'>";
            exit();
        } else {
            echo "❌ Ошибка при добавлении данных: " . $stmt->error;
        }

        // Закрываем соединение
        $stmt->close();
        $mysqli->close();
    }
    ?>
  </div>

  <div class="example-container">
    <h3>Пример заполнения</h3>
    <p><strong>Название торта:</strong> Вишневый торт</p>

    <p><strong>Ингредиенты:</strong></p>
    <p>Мука - 200 гр<br>Яйца - 4 шт<br>Вишня - 150 гр<br>...</p>

    <h3>Описание торта</h3>
    <p>Лёгкие, воздушные коржи, пропитанные ароматной клубничной пропиткой, гармонично сочетаются с насыщенным сливочным кремом.</p>

    <h3>Описание приготовления</h3>
    <p>1. Взбейте яйца с сахаром.<br>2. Добавьте муку, аккуратно перемешайте.<br>3. Выпекайте коржи и пропитайте их вишневым сиропом.<br>...</p>
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