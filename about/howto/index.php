<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Как купить");
?>
<div class="payment-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center head_payment">
        <h1 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-mb-10 g-font-nunito payment_title">
          Условия оплаты
        </h1>
        <p class="landing-block-node-card-text g-mb-20 g-font-size-18">
          Удобные и безопасные способы оплаты ваших заказов
        </p>
      </div>
    </div>
  </div>
</div>

<div class="payment_main">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="payment-card card">
          <div class="card-header card-header-custom">Наличными при получении</div>
          <div class="card-body">
            <div class="payment-method">
              <div class="payment-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2 8H22V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V8Z" stroke="#004B65" stroke-width="2"/>
                  <path d="M2 8V6C2 4.89543 2.89543 4 4 4H20C21.1046 4 22 4.89543 22 6V8" stroke="#004B65" stroke-width="2"/>
                  <path d="M12 14C13.1046 14 14 13.1046 14 12C14 10.8954 13.1046 10 12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14Z" stroke="#004B65" stroke-width="2"/>
                </svg>
              </div>
              <div>
                <h5>Оплата наличными, когда получаете заказ</h5>
                <p>Оплата курьеру, продавцу в зоомагазинах «Ветрина» или в пунктах самовывоза. Рассчитывайтесь, когда убедитесь в качестве товара и упаковки. Оплата в белорусских рублях. В корзине можете указать купюру, с которой вам нужна сдача.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="payment-card card">
          <div class="card-header card-header-custom">Картой при получении</div>
          <div class="card-body">
            <div class="payment-method">
              <div class="payment-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2 8H22V18C22 19.1046 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V8Z" stroke="#004B65" stroke-width="2"/>
                  <path d="M2 8V6C2 4.89543 2.89543 4 4 4H20C21.1046 4 22 4.89543 22 6V8" stroke="#004B65" stroke-width="2"/>
                  <path d="M6 12H10" stroke="#004B65" stroke-width="2"/>
                  <path d="M14 12H18" stroke="#004B65" stroke-width="2"/>
                </svg>
              </div>
              <div>
                <h5>Картой, когда получаете заказ</h5>
                <p>Visa, MasterCard и «Белкарт» при самовывозе, доставке или продавцу в магазине. Чтобы курьер приехал к вам с терминалом, заранее сообщите менеджеру, что оплачиваете картой.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Остальные блоки закомментированы, их можете вставить при необходимости -->

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>

/* Фоновые блоки и шапка — растяжение на всю ширину экрана */
.payment-header {
  color: white;
  padding: 2rem 0 2rem 0;
  border-radius: 0 0 15px 15px;
  background-image: url("/bitrix/templates/eshop_bootstrap_v4_original/images/bg2.png");
  background-repeat: no-repeat;
  background-position: center bottom;
  background-size: cover;
  margin-left: calc(-50vw + 50%);
  margin-right: calc(-50vw + 50%);
  width: 100vw;
  box-sizing: border-box;
}

.payment_main {
  padding: 0 0 2rem 0;
  border-radius: 0 0 15px 15px;
  background-image: url("/bitrix/templates/eshop_bootstrap_v4_original/images/bg3.png");
  background-repeat: no-repeat;
  background-position: center top;
  background-size: cover;
  margin-left: calc(-50vw + 50%);
  margin-right: calc(-50vw + 50%);
  width: 100vw;
  box-sizing: border-box;
}

/* Заголовки и блоки уменьшены по отступам и размерам */
.head_payment {
  background: #31353E;
  padding: 12px;
  border-radius: 15px;
  color: white !important;
}

.payment_title {
  font-size: 36px;
  margin-bottom: 0.5rem;
}

/* Карточки оплат */
.payment-card {
  border-radius: 10px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
  margin-bottom: 1rem;
  border: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
}

.payment-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.card-header-custom {
  background: #31353E;
  color: white;
  padding: 0.7rem 1rem;
  font-weight: 600;
  font-size: 1rem;
  border-bottom: none;
}

.payment-card .card-body {
  padding: 1rem 1.2rem;
}

/* Иконки и блоки */
.payment-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  background: rgba(0, 75, 101, 0.1);
  border-radius: 50%;
  margin-right: 15px;
}

.payment-method {
  display: flex;
  align-items: flex-start;
  margin-bottom: 1.5rem;
}

.payment-method:last-child {
  margin-bottom: 0;
}

/* Блок с заметками */
/* .payment-note {
  background-color: #e8f4fd;
  border-radius: 8px;
  padding: 1.2rem;
  margin: 1.5rem 0;
  border-left: 4px solid #004B65;
} */

/* Адаптация под мобильные устройства */
@media (max-width: 768px) {
  .payment-method {
    flex-direction: column;
    text-align: center;
  }
  .payment-icon {
    margin-right: 0;
    margin-bottom: 10px;
  }
}
</style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
