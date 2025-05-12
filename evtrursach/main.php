<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Dream</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="main.css">
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

    <div class="content">
        <div class="intro-section">
            <h1>Добро пожаловать на Sweet Dream!</h1>
            <p>Мы рады приветствовать вас на нашем уютном сайте, где каждая страница пропитана ароматом свежих тортов и сладких вдохновений. Здесь вы найдете рецепты самых вкусных и изысканных десертов, которые принесут радость вам и вашим близким.</p>
        </div>

        <div class="split-section">
            <div class="text-container">
                <h2>Хотите поделиться своим шедевром?</h2>
                <p>Если у вас есть потрясающий рецепт, которым вы хотите поделиться с другими любителями выпечки, мы будем счастливы увидеть ваш вклад! Чтобы добавить рецепт, просто нажмите на "Добавить рецепт" и заполните форму.</p>
            </div>
            <div class="carousel">
    <img src="/images/cake1.jpg" class="carousel-image" alt="Торт 1">
    <img src="/images/cake2.jpg" class="carousel-image" alt="Торт 2">
    <img src="/images/cake3.jpg" class="carousel-image" alt="Торт 3">
</div>

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