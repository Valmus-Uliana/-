<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet Dream - Рецепты</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="list-recepies.css">
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
  
  <!-- Строка поиска -->
  <div class="search-container">
    <input type="text" id="searchInput" placeholder="Поиск..." onkeydown="handleSearch(event)">
  </div>
  
  <!-- Контейнер для карточек рецептов -->
  <div class="cake-container">
    <?php
      // Подключаем базу данных
      include('connect.php');

      // Если в URL передан параметр q, выполняем поиск
      if (isset($_GET['q']) && trim($_GET['q']) !== '') {
          $q = trim($_GET['q']);
          $like = "%" . $q . "%";
          // Выполняем подготовленный запрос, ищем в полях name, description и ingredients
          $sql = "SELECT * FROM cake WHERE name LIKE ? OR description LIKE ? OR ingredients LIKE ?";
          $stmt = $mysqli->prepare($sql);
          $stmt->bind_param("sss", $like, $like, $like);
          $stmt->execute();
          $result = $stmt->get_result();
          
          echo '<h2 style="text-align:center; color:#444;">Результаты поиска: "' . htmlspecialchars($q) . '"</h2>';
          
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  ?>
                  <a href="cake.php?id=<?php echo $row['id']; ?>" style="text-decoration: none;">
                    <div class="cake-item">
                      <img src="images/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                      <div class="cake-text">
                        <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                      </div>
                    </div>
                  </a>
                  <?php
              }
          } else {
              echo '<p style="color:#fff; font-size:24px; text-align:center;">Ничего не найдено по запросу "' . htmlspecialchars($q) . '".</p>';
          }
          $stmt->close();
      } else {
          // Если запрос пустой, выводим все рецепты
          $sql = "SELECT * FROM cake";
          $result = $mysqli->query($sql);

          if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  ?>
                  <a href="cake.php?id=<?php echo $row['id']; ?>" style="text-decoration: none;">
                    <div class="cake-item">
                      <img src="/images/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                      <div class="cake-text">
                        <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                      </div>
                    </div>
                  </a>
                  <?php
              }
          } else {
              echo '<p style="color:#fff; font-size:24px; text-align:center;">Нет доступных рецептов.</p>';
          }
      }
      
      // Закрываем соединение
      $mysqli->close();
    ?>
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