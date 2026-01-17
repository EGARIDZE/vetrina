BX.ready(function () {

    window.CatalogSectionSlider = function (params) {
        this.sliderNode = params.sliderNode || null;
        this.basketItems = []; // Хранилище ID товаров в корзине
        if (this.sliderNode) {
            this.init();
        }
    };

    window.CatalogSectionSlider.prototype = {

        init: function () {
            this.bindEvents();
            // Сразу при загрузке проверяем корзину
            this.refreshBasketState();
        },

        bindEvents: function () {
            // Клик по кнопке "В корзину"
            BX.bind(this.sliderNode, 'click', BX.delegate(this.onBuyClick, this));

            // Клик по SKU
            var skuElements = this.sliderNode.querySelectorAll('[data-entity="sku-block-element"]');
            for (var i = 0; i < skuElements.length; i++) {
                BX.bind(skuElements[i], 'click', BX.delegate(this.onSkuClick, this));
            }

            // Делегирование
            BX.bind(this.sliderNode, 'click', BX.delegate(function (e) {
                var target = e.target;
                if (!target.hasAttribute('data-entity') || target.getAttribute('data-entity') !== 'sku-block-element') {
                    target = BX.findParent(target, { 'attrs': { 'data-entity': 'sku-block-element' } });
                }
                if (target) {
                    this.onSkuClick({ target: target, preventDefault: function () { } });
                }
            }, this));

            // Слушаем глобальное событие изменения корзины (например, из шапки)
            BX.addCustomEvent('OnBasketChange', BX.delegate(this.refreshBasketState, this));
        },

        /**
         * Запрос к get_basket.php для получения текущего состояния корзины
         */
        refreshBasketState: function () {
            var self = this;
            BX.ajax({
                url: '/ajax/get_basket.php', // Ваш файл
                method: 'POST',
                dataType: 'json',
                data: {
                    sessid: BX.bitrix_sessid()
                },
                onsuccess: function (response) {
                    if (response.status === 'success') {
                        // Сохраняем массив ID товаров
                        self.basketItems = response.data.map(function (item) {
                            return parseInt(item.PRODUCT_ID);
                        });
                        // Обновляем все кнопки в слайдере
                        self.updateAllButtons();
                    }
                }
            });
        },

        /**
         * Обновляет внешний вид всех кнопок в слайдере
         */
        updateAllButtons: function () {
            var buttons = this.sliderNode.querySelectorAll('[data-entity="buy-button"]');
            for (var i = 0; i < buttons.length; i++) {
                var btn = buttons[i];
                var productId = parseInt(btn.getAttribute('data-product-id'));
                this.setButtonState(btn, productId);
            }
        },

        /**
         * Устанавливает вид конкретной кнопки (В корзине / Купить)
         */
        setButtonState: function (btn, productId) {
            if (!btn) return;

            // Проверяем, есть ли ID в массиве корзины
            if (this.basketItems.includes(productId)) {
                // --- ТОВАР УЖЕ В КОРЗИНЕ ---
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-in-basket');

                // Меняем текст, чтобы было понятно, что товар там
                // Можно использовать галочку для наглядности
                btn.innerHTML = '<span style="margin-right:5px;">✓</span> В корзине';

                // Добавляем атрибут для логики клика (чтобы сработал редирект)
                btn.setAttribute('data-in-basket', 'Y');
                btn.setAttribute('title', 'Нажмите, чтобы перейти в корзину');
            } else {
                // --- ТОВАР НЕ В КОРЗИНЕ ---
                btn.classList.remove('btn-in-basket');
                btn.classList.add('btn-primary');

                // Возвращаем исходный текст
                btn.innerText = 'В корзину';

                btn.removeAttribute('data-in-basket');
                btn.removeAttribute('title');
            }
        },

        onSkuClick: function (e) {
            var target = e.target;
            if (!target.hasAttribute('data-sku-prop')) {
                target = BX.findParent(target, { 'attrs': { 'data-entity': 'sku-block-element' } });
            }
            if (!target) return;

            var slide = BX.findParent(target, { 'attrs': { 'data-entity': 'item' } });
            if (!slide) return;

            var propId = target.getAttribute('data-sku-prop');
            var siblings = slide.querySelectorAll('[data-sku-prop="' + propId + '"]');
            siblings.forEach(function (el) {
                el.classList.remove('selected');
            });
            target.classList.add('selected');

            var selectedOffer = this.getSelectedOffer(slide);
            if (selectedOffer) {
                this.updateProductInfo(slide, selectedOffer);
            }
        },

        getSelectedOffer: function (slide) {
            var selectedProps = {};
            var activeSku = slide.querySelectorAll('[data-entity="sku-block-element"].selected');

            activeSku.forEach(function (el) {
                selectedProps[el.getAttribute('data-sku-prop')] = el.getAttribute('data-value-id');
            });

            var offersJson = slide.querySelector('[data-entity="offers"]');
            if (!offersJson) return null;

            var offers = JSON.parse(offersJson.textContent);

            for (var offerId in offers) {
                var offer = offers[offerId];
                var match = true;
                for (var propId in selectedProps) {
                    if (!offer.TREE || !offer.TREE['PROP_' + propId] ||
                        offer.TREE['PROP_' + propId] != selectedProps[propId]) {
                        match = false;
                        break;
                    }
                }
                if (match) return offer;
            }
            return null;
        },

        updateProductInfo: function (slide, offer) {
            var priceBlock = slide.querySelector('.product-price');
            if (priceBlock && offer.ITEM_PRICES && offer.ITEM_PRICES[0]) {
                var price = offer.ITEM_PRICES[0];
                var priceHtml = '';
                if (price.DISCOUNT > 0 && price.PRINT_RATIO_BASE_PRICE !== price.PRINT_RATIO_PRICE) {
                    priceHtml += '<span class="price-old">' + price.PRINT_RATIO_BASE_PRICE + '</span>';
                }
                priceHtml += '<span class="price-current">' + price.PRINT_RATIO_PRICE + '</span>';
                priceBlock.innerHTML = priceHtml;
            }

            var buyButton = slide.querySelector('[data-entity="buy-button"]');
            if (buyButton) {
                buyButton.setAttribute('data-product-id', offer.ID);

                if (offer.CAN_BUY) {
                    buyButton.disabled = false;
                    buyButton.classList.remove('btn-disabled');
                    // ВАЖНО: При смене SKU проверяем статус корзины для НОВОГО ID
                    this.setButtonState(buyButton, parseInt(offer.ID));
                } else {
                    buyButton.disabled = true;
                    buyButton.classList.remove('btn-primary');
                    buyButton.classList.remove('btn-in-basket');
                    buyButton.classList.add('btn-disabled');
                    buyButton.innerText = 'Нет в наличии';
                }
            }

            if (offer.PREVIEW_PICTURE || offer.DETAIL_PICTURE) {
                var img = slide.querySelector('.product-image img');
                var picture = offer.PREVIEW_PICTURE || offer.DETAIL_PICTURE;
                if (img && picture.SRC) img.src = picture.SRC;
            }
        },

        onBuyClick: function (e) {
            var target = e.target;
            if (!target.hasAttribute('data-entity') || target.getAttribute('data-entity') !== 'buy-button') {
                target = BX.findParent(target, { 'attrs': { 'data-entity': 'buy-button' } });
            }
            if (!target || target.disabled) return;
            e.preventDefault();

            // Если товар уже в корзине, перенаправляем в корзину
            if (target.getAttribute('data-in-basket') === 'Y') {
                window.location.href = '/personal/cart/';
                return;
            }

            var productId = parseInt(target.getAttribute('data-product-id'));
            var quantity = 1;

            this.addToBasket(productId, quantity);
        },

        addToBasket: function (productId, quantity) {
            var self = this;

            BX.ajax({
                method: 'POST',
                dataType: 'json',
                url: window.location.href,
                data: {
                    sessid: BX.bitrix_sessid(),
                    action: 'ADD2BASKET',
                    ajax_basket: 'Y',
                    id: productId,
                    quantity: quantity
                },
                onsuccess: function (response) {
                    if (response.STATUS === 'OK' || response.status === 'success') {
                        // Локально обновляем массив и кнопку, чтобы не ждать рефреша
                        if (!self.basketItems.includes(productId)) {
                            self.basketItems.push(productId);
                        }

                        // Обновляем кнопки (визуально меняем на "В корзине")
                        self.updateAllButtons();

                        BX.onCustomEvent('OnBasketChange');
                        self.showNotification('Товар добавлен в корзину', 'success');
                    } else {
                        var errorMsg = (response.MESSAGE) ? response.MESSAGE : 'Ошибка добавления';
                        self.showNotification(errorMsg, 'error');
                    }
                },
                onfailure: function (error) {
                    // Fallback
                    BX.onCustomEvent('OnBasketChange');
                    self.showNotification('Товар добавлен', 'success');
                    // Принудительно обновляем статус через сервер
                    self.refreshBasketState();
                }
            });
        },

        showNotification: function (message, type) {
            if (window.BX && BX.UI && BX.UI.Notification) {
                BX.UI.Notification.Center.notify({ content: message, position: 'top-right', autoHideDelay: 3000 });
            } else {
                console.log(message);
            }
        }
    };
});