<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}
?>
<script id="basket-item-template" type="text/html">
	<div class="cart-goods-item{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}} {{#DELAYED}}delayed{{/DELAYED}}"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
		{{#SHOW_RESTORE}}
			<div class="basket-items-list-item-notification" style="width: 100%;">
				<div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed" id="basket-item-height-aligner-{{ID}}">
					{{#SHOW_LOADING}}
						<div class="basket-items-list-item-overlay"></div>
					{{/SHOW_LOADING}}
					<div class="basket-items-list-item-removed-container">
						<div>
							<?= Loc::getMessage('SBB_BASKET_ITEM_DELETED_MSGVER_1', ['#NAME#' => '<strong>{{NAME}}</strong>']) ?>
						</div>
						<div class="basket-items-list-item-removed-block">
							<a href="javascript:void(0)" data-entity="basket-item-restore-button">
								<?= Loc::getMessage('SBB_BASKET_ITEM_RESTORE') ?>
							</a>
							<span class="basket-items-list-item-clear-btn" data-entity="basket-item-close-restore-button"></span>
						</div>
					</div>
				</div>
			</div>
		{{/SHOW_RESTORE}}
		{{^SHOW_RESTORE}}
			{{#SHOW_LOADING}}
				<div class="basket-items-list-item-overlay"></div>
			{{/SHOW_LOADING}}

			<div class="cart-goods-item-checkbox">
				<label class="checkbox black">
				<input class="checkbox__input" type="checkbox" data-entity="basket-item-select" {{^DELAYED}}checked="checked"{{/DELAYED}}>
				<span class="checkbox__mock"></span>
				</label>
			</div>
			
			<div class="cart-goods-item-description">
				<div class="cart-goods-item-description__main" {{#DETAIL_PAGE_URL}}href="{{DETAIL_PAGE_URL}}"{{/DETAIL_PAGE_URL}}>
					<div class="cart-goods-item-description__img--wrap">
						<img class="cart-goods-item-description__img" alt="{{NAME}}" src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?= $templateFolder ?>/images/no_photo.png{{/IMAGE_URL}}">
						{{#SHOW_LABEL}}
							<div class="basket-item-label-text basket-item-label-big <?= $labelPositionClass ?>">
								{{#LABEL_VALUES}}
									<div{{#HIDE_MOBILE}} class="d-none d-sm-block"{{/HIDE_MOBILE}}>
										<span title="{{NAME}}">{{NAME}}</span>
									</div>
								{{/LABEL_VALUES}}
							</div>
						{{/SHOW_LABEL}}
						<? if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y') { ?>
												{{#DISCOUNT_PRICE_PERCENT}}
													<div class="basket-item-label-ring basket-item-label-small <?= $discountPositionClass ?>">
														-{{DISCOUNT_PRICE_PERCENT_FORMATED}}
													</div>
												{{/DISCOUNT_PRICE_PERCENT}}
						<? } ?>
					</div>
					<div class="cart-goods-item-description__text">
					     <a class="cart-goods-item-description__main" {{#DETAIL_PAGE_URL}}href="{{DETAIL_PAGE_URL}}"{{/DETAIL_PAGE_URL}}>
						<div style="display: flex; justify-content: space-between; align-items: flex-start;">
							<p class="h4 link" data-entity="basket-item-name">{{{NAME}}}</p>
							<? if (isset($mobileColumns['DELETE'])) { ?>
													<!-- ВОССТАНОВЛЕНА МОБИЛЬНАЯ КНОПКА УДАЛЕНИЯ -->
													<span class="basket-item-actions-remove d-block d-md-none" data-entity="basket-item-delete"></span>
							<? } ?>
						</div>
						</a>
						
						{{#NOT_AVAILABLE}}
							<div class="basket-items-list-item-warning-container">
								<div class="alert alert-warning text-center">
									<?= Loc::getMessage('SBB_BASKET_ITEM_NOT_AVAILABLE') ?>.
								</div>
							</div>
						{{/NOT_AVAILABLE}}
					
						{{#WARNINGS.length}}
							<div class="basket-items-list-item-warning-container">
								<div class="alert alert-warning alert-dismissable" data-entity="basket-item-warning-node">
									<span class="close" data-entity="basket-item-warning-close">&times;</span>
										{{#WARNINGS}}
											<div data-entity="basket-item-warning-text">{{{.}}}</div>
										{{/WARNINGS}}
								</div>
							</div>
						{{/WARNINGS.length}}

						<div class="basket-item-block-properties">
							<? if (!empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
								foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
									switch (trim((string) $blockName)) {
										case 'props':
											if (in_array('PROPS', $arParams['COLUMNS_LIST'])) { ?>
																																					{{#PROPS}}
																																						<p class="p3 gray" data-entity="basket-item-property-value" data-property-code="{{CODE}}">
																																							{{{VALUE}}}
																																						</p>
																																					{{/PROPS}}
																															<? }
											break;
										case 'sku': ?>
																															{{#SKU_BLOCK_LIST}}
																																<div class="basket-item-property {{#IS_IMAGE}}basket-item-property-scu-image{{/IS_IMAGE}}{{^IS_IMAGE}}basket-item-property-scu-text{{/IS_IMAGE}}"
																																	data-entity="basket-item-sku-block">
																																	<div class="basket-item-property-name">{{NAME}}</div>
																																	<div class="basket-item-property-value">
																																		<ul class="basket-item-scu-list">
																																			{{#SKU_VALUES_LIST}}
																																				<li class="basket-item-scu-item{{#SELECTED}} selected{{/SELECTED}}{{#NOT_AVAILABLE_OFFER}} not-available{{/NOT_AVAILABLE_OFFER}}"
																																					title="{{NAME}}" data-entity="basket-item-sku-field"
																																					data-initial="{{#SELECTED}}true{{/SELECTED}}{{^SELECTED}}false{{/SELECTED}}"
																																					data-value-id="{{VALUE_ID}}" data-sku-name="{{NAME}}" data-property="{{PROP_CODE}}">
																																					{{^IS_IMAGE}}<span class="basket-item-scu-item-inner">{{NAME}}</span>{{/IS_IMAGE}}
																																					{{#IS_IMAGE}}<span class="basket-item-scu-item-inner" style="background-image: url({{PICT}});"></span>{{/IS_IMAGE}}
																																				</li>
																																			{{/SKU_VALUES_LIST}}
																																		</ul>
																																	</div>
																																</div>
																															{{/SKU_BLOCK_LIST}}
																															<? break;
										case 'columns': ?>
																															<!-- ВОССТАНОВЛЕНА ЛОГИКА ВЫВОДА КАСТОМНЫХ КОЛОНОК -->
																															{{#COLUMN_LIST}}
																																<div class="p3 gray prop {{#HIDE_MOBILE}}d-none d-sm-block{{/HIDE_MOBILE}}" data-entity="basket-item-property">
																																	<div class="basket-item-property-custom-name">{{NAME}}:</div>
																																	<div class="basket-item-property-custom-value" data-column-property-code="{{CODE}}" data-entity="basket-item-property-column-value">
																																		{{#IS_TEXT}}
																																			{{VALUE}}
																																		{{/IS_TEXT}}
																																		{{#IS_LINK}}
																																			{{#VALUE}}
																																				{{{LINK}}}{{^IS_LAST}}, {{/IS_LAST}}
																																			{{/VALUE}}
																																		{{/IS_LINK}}
																																	</div>
																																</div>
																															{{/COLUMN_LIST}}
																															<? break;
									}
								}
							} ?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="cart-goods-item__price">
				<p class="p2 orange" id="basket-item-price-{{ID}}">{{{PRICE_FORMATED}}}</p>
				{{#SHOW_DISCOUNT_PRICE}}
					<p class="p3 gray crossed">{{{FULL_PRICE_FORMATED}}}</p>
				{{/SHOW_DISCOUNT_PRICE}}
			</div>
			
			<div class="cart-goods-item__quantity" data-entity="basket-item-quantity-block">
				<div class="basket-item-block-amount{{#NOT_AVAILABLE}} disabled{{/NOT_AVAILABLE}}">
					<p class="cart-goods-item-counter h3">
						<a class="cart-goods-item-counter__button remove gray" data-entity="basket-item-quantity-minus">-</a>
						<input type="text" class="basket-item-amount-filed" value="{{QUANTITY}}"
								{{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
								data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
								id="basket-item-quantity-{{ID}}">
						<a class="cart-goods-item-counter__button add" data-entity="basket-item-quantity-plus">+</a>
					</p>
				</div>
			</div>

			<p class="cart-goods-item__sum bold orange" id="basket-item-sum-price-{{ID}}">{{{SUM_PRICE_FORMATED}}}</p>

			<div class="cart-goods-item-buttons d-none d-md-block">
				<span class="h-border cart-goods-item-buttons__remove" data-entity="basket-item-delete">
					<svg class="icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="path-1-inside-1_5631:232333" fill="white"><path d="M3 5C3 4.72386 3.22386 4.5 3.5 4.5H10.5C10.7761 4.5 11 4.72386 11 5V11.5C11 12.6046 10.1046 13.5 9 13.5H5C3.89543 13.5 3 12.6046 3 11.5V5Z"></path></mask>
						<path d="M3 5C3 4.72386 3.22386 4.5 3.5 4.5H10.5C10.7761 4.5 11 4.72386 11 5V11.5C11 12.6046 10.1046 13.5 9 13.5H5C3.89543 13.5 3 12.6046 3 11.5V5Z" stroke="#99A4AE" stroke-width="2.2" mask="url(#path-1-inside-1_5631:232333)"></path>
						<rect x="2" y="2.5" width="10" height="1" rx="0.5" fill="#99A4AE"></rect>
						<path d="M6 1.05H8C8.80081 1.05 9.45 1.69919 9.45 2.5V2.95H4.55V2.5C4.55 1.69919 5.19919 1.05 6 1.05Z" stroke="#99A4AE" stroke-width="1.1"></path>
					</svg>
				</span>
			</div>
		{{/SHOW_RESTORE}}
	</div>
</script>