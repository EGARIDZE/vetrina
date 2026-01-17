(function () {
    'use strict';

    function initializeSearch() {
        const openBtn = document.getElementById('search-open-btn');
        const closeBtn = document.getElementById('search-close-btn');
        const searchOverlay = document.getElementById('search-overlay');


        if (!openBtn || !closeBtn || !searchOverlay) {
            return;
        }

        const searchInput = searchOverlay.querySelector('input[name="q"]');
        const body = document.body;

        const openSearch = function () {
            searchOverlay.style.display = 'flex';
            setTimeout(function () {
                searchOverlay.classList.add('is-active');
                body.classList.add('search-is-active');
            }, 10);

            setTimeout(function () {
                if (searchInput) {
                    searchInput.focus();
                }
            }, 300);
        };

        const closeSearch = function () {
            searchOverlay.classList.remove('is-active');
            body.classList.remove('search-is-active');

            setTimeout(function () {
                searchOverlay.style.display = 'none';
            }, 300);
        };

        openBtn.addEventListener('click', openSearch);
        closeBtn.addEventListener('click', closeSearch);

        // Закрытие по клику на фон оверлея
        searchOverlay.addEventListener('click', function (event) {
            if (event.target === searchOverlay) {
                closeSearch();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && searchOverlay.classList.contains('is-active')) {
                closeSearch();
            }
        });

        // console.log('Search component successfully initialized.');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeSearch);
    } else {
        initializeSearch();
    }

})();