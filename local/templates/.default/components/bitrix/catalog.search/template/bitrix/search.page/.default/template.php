<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @global CMain $APPLICATION */
/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponent $component */
?>

<div class="search-page">
	<form action="" method="get">
		<div class="search-form-container">
			<? if ($arParams["USE_SUGGEST"] === "Y"):
				if (mb_strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"])) {
					$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
					$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
					$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
				}
				?>
				<? $APPLICATION->IncludeComponent(
					"bitrix:search.suggest.input",
					"", // Здесь можно указать ваш кастомный шаблон, если он есть
					array(
						"NAME" => "q",
						"VALUE" => $arResult["REQUEST"]["~QUERY"],
						"INPUT_SIZE" => 40,
						"DROPDOWN_SIZE" => 10,
						"FILTER_MD5" => $arResult["FILTER_MD5"],
						"INPUT_CLASS" => "search-input", // Добавляем класс для стилизации
					),
					$component,
					array("HIDE_ICONS" => "Y")
				); ?>
			<? else: ?>
				<input class="search-input" type="text" name="q" value="<?= $arResult["REQUEST"]["QUERY"] ?>" size="40"
					placeholder="Поиск..." />
			<? endif; ?>

			<button type="submit" class="search-button" aria-label="<?= GetMessage("SEARCH_GO") ?>">
				<svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M16.9498 16.9498C18.666 15.2335 19.5834 12.9335 19.5834 10.5834C19.5834 8.23321 18.666 5.93321 16.9498 4.21695C15.2335 2.5007 12.9335 1.58337 10.5834 1.58337C8.23321 1.58337 5.93321 2.5007 4.21695 4.21695C2.5007 5.93321 1.58337 8.23321 1.58337 10.5834C1.58337 12.9335 2.5007 15.2335 4.21695 16.9498C5.93321 18.666 8.23321 19.5834 10.5834 19.5834C12.9335 19.5834 15.2335 18.666 16.9498 16.9498Z"
						stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					<path d="M18.4166 18.4166L22.4166 22.4166" stroke="currentColor" stroke-width="1.5"
						stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
			</button>
		</div>

		<input type="hidden" name="how" value="<? echo $arResult["REQUEST"]["HOW"] == "d" ? "d" : "r" ?>" />
		<? if ($arParams["SHOW_WHEN"]): ?>
			<script>
				var switch_search_params = function () {
					var sp = document.getElementById('search_params');
					var flag;

					if (sp.style.display == 'none') {
						flag = false;
						sp.style.display = 'block'
					}
					else {
						flag = true;
						sp.style.display = 'none';
					}

					var from = document.getElementsByName('from');
					for (var i = 0; i < from.length; i++)
						if (from[i].type.toLowerCase() == 'text')
							from[i].disabled = flag

					var to = document.getElementsByName('to');
					for (var i = 0; i < to.length; i++)
						if (to[i].type.toLowerCase() == 'text')
							to[i].disabled = flag

					return false;
				}
			</script>
			<br /><a class="search-page-params" href="#"
				onclick="return switch_search_params()"><? echo GetMessage('CT_BSP_ADDITIONAL_PARAMS') ?></a>
			<div id="search_params" class="search-page-params"
				style="display:<? echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"] ? 'block' : 'none' ?>">
				<? $APPLICATION->IncludeComponent(
					'bitrix:main.calendar',
					'',
					array(
						'SHOW_INPUT' => 'Y',
						'INPUT_NAME' => 'from',
						'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
						'INPUT_NAME_FINISH' => 'to',
						'INPUT_VALUE_FINISH' => $arResult["REQUEST"]["~TO"],
						'INPUT_ADDITIONAL_ATTR' => 'size="10"',
					),
					null,
					array('HIDE_ICONS' => 'Y')
				); ?>
			</div>
		<? endif ?>
	</form><br />

	<? if (isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
		?>
		<div class="search-language-guess">
			<? echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#" => '<a href="' . $arResult["ORIGINAL_QUERY_URL"] . '">' . $arResult["REQUEST"]["ORIGINAL_QUERY"] . '</a>')) ?>
		</div><br />
		<?
	endif; ?>
</div>