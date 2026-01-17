<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Возврат товара");
?>

<div class="return-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center head_return">
        <h1 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-mb-10 g-font-nunito return_title">
          Возврат товара
        </h1>
        <p class="landing-block-node-card-text g-mb-20 g-font-size-18">
          Если купленный товар вам не подошёл, вы можете вернуть его в магазин
        </p>
      </div>
    </div>
  </div>
</div>

<div class="return_main">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">

        <div class="return-card card">
          <div class="card-header card-header-custom">В каком случае мы примем товар</div>
          <div class="card-body">
            <ul>
              <li> Вы не пользовались товаром и не вскрыли упаковку.</li>
              <li>Сохранили товарный чек на покупку.</li>
              <li>С момента покупки не прошло 14 дней.</li>
            </ul>
          </div>
        </div>

        <div class="return-card card">
          <div class="card-header card-header-custom">Что нельзя вернуть</div>
          <div class="card-body">
            <p>Рыбок, растения, корм в негерметичной упаковке, бытовую химию или ветпрепараты. Чтобы убедиться, что товар можно вернуть, позвоните в магазин.</p>
          </div>
        </div>

		<div class="return-card card">
          <div class="card-header card-header-custom">Куда обращаться</div>
          <div class="card-body">
            <p>Приезжайте в магазин, в котором покупали зоотовары. Перед поездкой позвоните в этот магазин и сообщите, что приедете. Менеджер подготовится к оформлению возврата, чтобы процедура не заняла у вас много времени. С собой возьмите товар, который хотите вернуть, и чек на его покупку.</p>
          </div>
        </div>

        <div class="return-card card">
          <div class="card-header card-header-custom">Как вернём деньги</div>
          <div class="card-body">
            <p>Если покупку оплачивали по карте, деньги вернутся на эту карту в течение нескольких дней. Срок возврата зависит от банка, который выпустил вашу карту. Если вы платили наличными, деньги за покупку вернут наличными из кассы после оформления возврата.</p>
			<p>Правила возврата товара регулируются законом Республики Беларусь от 9 января 2002 г. N 90-З <a href="/upload/sale/zakon_o_zashhite_prav_potrebitelja.docx">«О защите прав потребителей»</a>.</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>


/* Шапка и фон на всю ширину */
.return-header {
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

/* Основной фон */
.return_main {
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

/* Заголовок внутри шапки */
.head_return {
  background: #31353E;
  padding: 12px;
  border-radius: 15px;
  color: white !important;
}

.return_title {
  font-size: 36px;
  margin-bottom: 0.5rem;
}

/* Карточки */
.return-card {
  border-radius: 10px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
  margin-bottom: 1rem;
  border: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
}

.return-card:hover {
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

.return-card .card-body {
  padding: 1rem 1.2rem;
}

/* Списки и текст */
.return-card ul {
  padding-left: 1.2rem;
}

.return-card ul li {
  margin-bottom: 0.5rem;
  font-size: 1rem;
  color: #212529;
}

/* Оттенок для текста в карточках */
.return-card .card-body p {
  font-size: 1rem;
  color: #212529;
  margin: 0;
}

/* Адаптация под мобильные */
@media (max-width: 768px) {
  .head_return {
    padding: 15px;
  }
  .return_title {
    font-size: 28px;
  }
}
</style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>