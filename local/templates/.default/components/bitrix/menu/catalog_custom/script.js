document.addEventListener('DOMContentLoaded', function() {
    const menu = document.querySelector('.catalog-menu');
    if (!menu) return;

    menu.addEventListener('click', function(e) {
        // Срабатываем только при клике на кнопку-переключатель
        if (e.target.classList.contains('catalog-menu__toggle')) {
            const parentItem = e.target.closest('.catalog-menu__item');
            if (parentItem) {
                // Вместо toggle используем if/else для управления анимацией
                if (parentItem.classList.contains('is-open')) {
                    parentItem.classList.remove('is-open');
                    const submenu = parentItem.querySelector('.catalog-menu__submenu');
                    if (submenu) {
                        submenu.style.maxHeight = null;
                    }
                } else {
                    parentItem.classList.add('is-open');
                    const submenu = parentItem.querySelector('.catalog-menu__submenu');
                    if (submenu) {
                        // Устанавливаем max-height равным реальной высоте контента
                        submenu.style.maxHeight = submenu.scrollHeight + "px";
                    }
                }
            }
        }
    });

    // Опционально: Устанавливаем max-height для уже открытых пунктов при загрузке страницы
    const openItems = menu.querySelectorAll('.catalog-menu__item.is-open');
    openItems.forEach(item => {
        const submenu = item.querySelector('.catalog-menu__submenu');
        if (submenu) {
            submenu.style.maxHeight = submenu.scrollHeight + "px";
        }
    });
});