<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div class="basket-checkout-container" data-entity="basket-checkout-aligner">
		<div class="cart-order__wrap">
			<div class="cart-order js-accordion-wrap active">
				<p class="h2 cart-order__accordion-button js-accordion-button">
					<span><?= Loc::getMessage('SBB_YOUR_ORDER') ?></span>
				</p>
				<div class="cart-order__accordion js-accordion-content" style="max-height: none">
					<div class="cart-order__list p2">
						<p class="cart-order__item">
							<span>{{BASKET_ITEMS_COUNT}} {{GOODS_MESSAGE}} {{#WEIGHT_FORMATED}}| {{{WEIGHT_FORMATED}}}{{/WEIGHT_FORMATED}}</span>
							<span>{{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}</span>
						</p>
						{{#DISCOUNT_PRICE_FORMATED}}
							<p class="cart-order__item orange">
								<span><?= Loc::getMessage('SBB_SALE_ACTIONS') ?></span>
								<span>-{{{DISCOUNT_PRICE_FORMATED}}}</span>
							</p>
						{{/DISCOUNT_PRICE_FORMATED}}
					</div>
					<? if ($arParams['HIDE_COUPON'] !== 'Y') { ?>
								<div class="cart-order-promo">
								<label class="field cart-order-promo__label promo-input-with-button">
									<input class="field-input" type="text" placeholder="<?= Loc::getMessage('SBB_PROMOCODE') ?>" data-entity="basket-coupon-input">
									<button class="promo-input-button" data-entity="basket-coupon-button" aria-label="<?= Loc::getMessage('SBB_APPLY') ?>">
										<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
											<path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</button>
								</label>
							</div>
						
								<!-- Сюда будут выводиться примененные купоны -->
								{{#COUPON_LIST}}
								<div class="basket-coupon-alert text-{{CLASS}}">
									<span class="basket-coupon-text">
										<strong>{{COUPON}}</strong> - {{JS_CHECK_CODE}}
										{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
									</span>
									<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
										<?= Loc::getMessage('SBB_DELETE') ?>
									</span>
								</div>
								{{/COUPON_LIST}}
					<? } ?>
				</div>
				
				<div class="cart-order__sum">
					<span class="p2"><?= Loc::getMessage('SBB_TO_PAY') ?></span>
					{{#DISCOUNT_PRICE_FORMATED}}
						<span class="p2 gray crossed">{{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}</span>
					{{/DISCOUNT_PRICE_FORMATED}}
					<span class="h2" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</span>
				</div>

				<a class="cart-order__continue{{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}" href="javascript:void(0);" data-entity="basket-checkout-button">
					<?= Loc::getMessage('SBB_ORDER') ?>
					<svg class="icon" width="15" height="14" viewBox="0 0 15 14" fill="#3D9CEA" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M3.47668 12.5672C3.16426 12.8796 3.16426 13.3861 3.47668 13.6985C3.7891 14.011 4.29563 14.011 4.60805 13.6985L10.754 7.55263C10.9096 7.39696 10.9877 7.1931 10.9883 6.98907C10.989 6.78345 10.9109 6.57761 10.754 6.42072L4.60805 0.274802C4.29563 -0.0376171 3.7891 -0.0376171 3.47668 0.274802C3.16426 0.587222 3.16426 1.09375 3.47668 1.40617L9.05718 6.98667L3.47668 12.5672Z"></path>
					</svg>
				</a>
			</div>
		</div>
	</div>
</script>