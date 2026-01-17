<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 
//$APPLICATION->SetTitle("Доставка");
?>
<div class="delivery-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center head_delovery">
        <h1 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-mb-10  g-font-nunito delivery_title">
          Доставка
        </h1>
        <p class="landing-block-node-card-text g-mb-20 g-font-size-18 ">
          Быстрая и надежная доставка по Минску и всей Беларуси 
        </p>
      </div>
    </div>
  </div>
</div>

<div class="delivery_main">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="delivery-card card">
          <div class="card-header card-header-custom">Курьером по Минску</div>
          <div class="card-body">
            <p>Быстрая доставка в течение дня по Минску</p>

            <table class="price-table">
              <tr>
                <th>Сумма заказа</th>
                <th>Стоимость доставки</th>
              </tr>
              <tr>
                <td>до 50 BYN</td>
                <td>Только самовывоз</td>
              </tr>
              <tr>
                <td>от 50 BYN до 100 BYN</td>
                <td>10 BYN</td>
              </tr>
              <tr>
                <td>от 100 BYN до 160 BYN</td>
                <td>5 BYN</td>
              </tr>
              <tr>
                <td>от 160 BYN</td>
                <td class="free-delivery">Бесплатно</td>
              </tr>
            </table>
          </div>
        </div>

        <div class="delivery-card card">
          <div class="card-header card-header-custom">Яндекс доставка</div>
          <div class="card-body">
            <div class="delivery-method">
              <div class="delivery-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15 5H17C18.1046 5 19 5.89543 19 7V11H15V5Z" stroke="#004B65" stroke-width="2"/>
                  <path d="M5 7C5 5.89543 5.89543 5 7 5H9V11H5V7Z" stroke="#004B65" stroke-width="2"/>
                  <path d="M5 13H19V17C19 18.1046 18.1046 19 17 19H7C5.89543 19 5 18.1046 5 17V13Z" stroke="#004B65" stroke-width="2"/>
                </svg>
              </div>
              <div>
                <h5>Доставка службой Яндекс</h5>
                <p>Стоимость доставки рассчитывается индивидуально и оплачивается покупателем</p>
              </div>
            </div>
          </div>
        </div>

        <div class="delivery-card card">
          <div class="card-header card-header-custom">Самовывоз</div>
          <div class="card-body">
            <div class="delivery-method">
              <div class="delivery-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="#004B65" stroke-width="2"/>
                  <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#004B65" stroke-width="2"/>
                </svg>
              </div>
              <div>
                <h5>Заберите заказ самостоятельно</h5>
                <div class="pickup-address">
                  <strong>Адрес:</strong> Минск, ул. И. Лученка, 2
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
.delivery-header {
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

.delivery_title {
  font-size: 36px;
  margin-bottom: 0.5rem;
}

.head_delovery {
  background: #31353E;
  padding: 12px;
  border-radius: 15px;
  color: white !important;
}

.delivery_main {
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

.delivery-card {
  border-radius: 10px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
  margin-bottom: 1rem;
  border: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
}

.delivery-card:hover {
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

.delivery-card .card-body {
  padding: 1rem 1.2rem;
}

.price-table {
  width: 100%;
  border-collapse: collapse;
  margin: 1.2rem 0;
}

.price-table th {
  background-color: #f8f9fa;
  padding: 0.8rem;
  text-align: left;
  border-bottom: 2px solid #dee2e6;
}

.price-table td {
  padding: 0.8rem;
  border-bottom: 1px solid #dee2e6;
}

.price-table tr:last-child td {
  border-bottom: none;
}

.free-delivery {
  color: #28a745;
  font-weight: 600;
}

.pickup-address {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 1.2rem;
  margin-top: 1rem;
  border-left: 4px solid #004b65;
}

.delivery-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  background: rgba(0, 75, 101, 0.1);
  border-radius: 50%;
  margin-right: 15px;
}

.delivery-method {
  display: flex;
  align-items: center;
  margin-bottom: 1.5rem;
}

.delivery-method:last-child {
  margin-bottom: 0;
}

@media (max-width: 768px) {
  .delivery-method {
    flex-direction: column;
    text-align: center;
  }

  .delivery-icon {
    margin-right: 0;
    margin-bottom: 10px;
  }
}
</style>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>