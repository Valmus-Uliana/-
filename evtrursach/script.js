document.addEventListener("DOMContentLoaded", function () {
        let index = 0;
        const images = document.querySelectorAll('.carousel-image');

        function changeImage() {
            images.forEach((img, i) => {
                img.classList.remove("active");
                if (i === index) {
                    img.classList.add("active");
                }
            });

            index = (index + 1) % images.length;
        }

        setInterval(changeImage, 6000); // Меняет картинку каждые 6 секунд
    });


        function setTheme(theme) {
            document.body.classList.remove("light-theme", "dark-theme");
            document.body.classList.add(theme);
            localStorage.setItem("theme", theme); // Сохранение темы в localStorage
        }
    
        function loadTheme() {
            const savedTheme = localStorage.getItem("theme");
            if (savedTheme) {
                document.body.classList.add(savedTheme);
            } else {
                document.body.classList.add("light-theme"); // Тема по умолчанию
            }
        }
    
        // Загружаем сохраненную тему при загрузке страницы
        window.onload = loadTheme;

        function toggleMenu() {
    const menu = document.getElementById("dropdown");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
    }