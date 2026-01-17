<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
$this->setFrameMode(true);
?>
<div class="smart-filter">
	<div class="smart-filter__title"><?= GetMessage("CT_BCSF_FILTER_TITLE") ?></div>

	<form name="<?= $arResult["FILTER_NAME"] . "_form" ?>" action="<?= $arResult["FORM_ACTION"] ?>" method="get" class="smart-filter__form">
		<? foreach ($arResult["HIDDEN"] as $arItem): ?>
				<input type="hidden" name="<?= $arItem["CONTROL_NAME"] ?>" id="<?= $arItem["CONTROL_ID"] ?>" value="<?= $arItem["HTML_VALUE"] ?>"/>
		<? endforeach; ?>

		<div class="smart-filter__properties">
			<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
					<? // Пропускаем пустые свойства
						if (empty($arItem["VALUES"]) || (isset($arItem["PRICE"]) && $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)) {
							continue;
						}

						$isPrice = isset($arItem["PRICE"]);
						$isOpen = $arItem["DISPLAY_EXPANDED"] === "Y" || $isPrice;
						?>

					<div class="smart-filter__property <?= $isOpen ? 'bx-active' : '' ?>">
						<div class="smart-filter__property-name" onclick="smartFilter.hideFilterProps(this)">
							<span><?= $arItem["NAME"] ?></span>
							<button type="button" class="smart-filter__toggle" aria-label="Свернуть/Развернуть"></button>
						</div>

						<div class="smart-filter__property-values" data-role="bx_filter_block">
							<? // --- СЛАЙДЕР ЦЕН И ЧИСЕЛ ---
								if ($arItem["DISPLAY_TYPE"] === "A" || $arItem["DISPLAY_TYPE"] === "B" || $isPrice):
									$isPrice ? $key = $arItem["ENCODED_ID"] : '';
									?>
									<div class="smart-filter__slider-inputs">
										<input
											class="smart-filter__slider-input"
											type="number"
											name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
											id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
											value="<?= $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
											placeholder="<?= GetMessage("CT_BCSF_FILTER_FROM") ?>"
											onkeyup="smartFilter.keyup(this)"
										/>
										<span class="smart-filter__slider-defis">&mdash;</span>
										<input
											class="smart-filter__slider-input"
											type="number"
											name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
											id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
											value="<?= $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
											placeholder="<?= GetMessage("CT_BCSF_FILTER_TO") ?>"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>

									<div class="smart-filter-slider-track-container">
										<div class="smart-filter-slider-track" id="drag_track_<?= $key ?>">
											<div class="smart-filter-slider-price-bar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?= $key ?>"></div>
											<div class="smart-filter-slider-price-bar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?= $key ?>"></div>
											<div class="smart-filter-slider-price-bar-v" style="left: 0;right: 0;" id="colorAvailableActive_<?= $key ?>"></div>
											<div class="smart-filter-slider-range" id="drag_tracker_<?= $key ?>" style="left: 0; right: 0;">
												<a class="smart-filter-slider-handle left" href="javascript:void(0)" id="left_slider_<?= $key ?>"></a>
												<a class="smart-filter-slider-handle right" href="javascript:void(0)" id="right_slider_<?= $key ?>"></a>
											</div>
										</div>
									</div>
									<?
									$arJsParams = array(
										"leftSlider" => 'left_slider_' . $key,
										"rightSlider" => 'right_slider_' . $key,
										"tracker" => "drag_tracker_" . $key,
										"trackerWrap" => "drag_track_" . $key,
										"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
										"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
										"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
										"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
										"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
										"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
										"fltMinPrice" => $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] ?: $arItem["VALUES"]["MIN"]["VALUE"],
										"fltMaxPrice" => $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] ?: $arItem["VALUES"]["MAX"]["VALUE"],
										"precision" => $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0,
										"colorUnavailableActive" => 'colorUnavailableActive_' . $key,
										"colorAvailableActive" => 'colorAvailableActive_' . $key,
										"colorAvailableInactive" => 'colorAvailableInactive_' . $key,
									);
									?>
									<script>
										BX.ready(function () {
											window['trackBar<?= $key ?>'] = new BX.Iblock.SmartFilter(<?= CUtil::PhpToJSObject($arJsParams) ?>);
										});
									</script>

							<? // --- ЧЕКБОКСЫ И РАДИОКНОПКИ ---
								else: ?>
									<div class="smart-filter__value-list">
										<? foreach ($arItem["VALUES"] as $val => $ar): ?>
												<div class="smart-filter__value">
													<input
														type="<?= ($arItem["DISPLAY_TYPE"] === "R") ? 'radio' : 'checkbox' ?>"
														class="smart-filter__input"
														value="<?= $ar["HTML_VALUE"] ?>"
														name="<?= $ar["CONTROL_NAME"] ?>"
														id="<?= $ar["CONTROL_ID"] ?>"
														<?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
														<?= $ar["DISABLED"] ? 'disabled' : '' ?>
														onclick="smartFilter.click(this)"
													/>
													<label for="<?= $ar["CONTROL_ID"] ?>" class="smart-filter__label" data-role="label_<?= $ar["CONTROL_ID"] ?>">
														<?= $ar["VALUE"] ?>
														<? if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])): ?>
																<span class="smart-filter__count" data-role="count_<?= $ar["CONTROL_ID"] ?>">(<?= $ar["ELEMENT_COUNT"] ?>)</span>
														<? endif; ?>
													</label>
												</div>
										<? endforeach; ?>
									</div>
							<? endif; ?>
						</div>
					</div>
			<? endforeach; ?>
		</div>

		<div class="smart-filter__buttons">
			<input class="btn btn-primary" type="submit" id="set_filter" name="set_filter" value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"/>
			<input class="btn btn-link" type="submit" id="del_filter" name="del_filter" value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>"/>
			
			<div class="smart-filter__result" id="modef" style="display: none;">
				<?= GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
				<a class="smart-filter__result-link" href="<?= $arResult["FILTER_URL"] ?>"><?= GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
			</div>
		</div>

	</form>
</div>

<script>
	var smartFilter = new JCSmartFilter('<?= CUtil::JSEscape($arResult["FORM_ACTION"]) ?>', '<?= CUtil::JSEscape($arParams["FILTER_VIEW_MODE"]) ?>', <?= CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"]) ?>);
</script>