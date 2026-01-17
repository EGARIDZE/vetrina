<div class="d-flex gap-3 flex-wrap social-icons">
  <a href="https://www.instagram.com/vetrina_minsk/" class="social-btn instagram" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
  <a href="https://www.tiktok.com/@vetrina_minsk" class="social-btn tiktok" aria-label="TikTok" target="_blank"><i class="fab fa-tiktok"></i></a>
  <a href="https://t.me/vetrina_minsk" class="social-btn telegram" aria-label="Telegram" target="_blank"><i class="fab fa-telegram"></i></a>
</div>

<style>

.social-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  background: #fff;
  border: 1px solid #e0e0e0;
  border-radius: 12px;
  transition: border-color 0.15s, box-shadow 0.15s;
  box-shadow: 0 0 0 0 transparent;
  color: #222;
  font-size: 1.6rem;
  outline: none;
  cursor: pointer;
  position: relative;
}

.social-btn:focus {
  border-color: #bdbdbd;
  box-shadow: 0 0 0 2px rgba(0,123,255,.12);
}

/* Цветные иконки при наведении — оригинальные фирменные цвета */
.social-btn.instagram:hover i { color: #E4405F; }
.social-btn.tiktok:hover i { color: #69C9D0; } /* основной бирюзовый TikTok */
.social-btn.telegram:hover i { color: #229ED9; }

.social-btn:hover,
.social-btn:focus {
  border-color: #bbb;
}

.social-btn i {
  /* плавный переход для цвета и размера */
  transition: color 0.18s, transform 0.14s;
}

.social-btn:hover i {
  transform: scale(1.05);
}

.social-icons {
	gap: 5px;
}

.social-icons a {
	text-decoration: none;
}

/* Адаптация для разных экранов (иконки немного меньше на мобиле) */
@media (max-width: 576px) {
  .social-btn {
    width: 30px;
    height: 30px;
    font-size: 1.2rem;
    border-radius: 10px;
  }
}
</style>