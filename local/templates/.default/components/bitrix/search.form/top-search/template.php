<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>



<div class="search-overlay" id="search-overlay" style="display: none;" aria-hidden="true">
	<div class="search-overlay__container">
		<button class="search-overlay__close-btn" id="search-close-btn" type="button" aria-label="Закрыть поиск">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M19 5L5 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
					stroke-linejoin="round" />
				<path d="M5 5L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
					stroke-linejoin="round" />
			</svg>
		</button>
		<?
		// echo "<pre>";
		// print_r($component);
		// echo "</pre>";
		?>
		<form action="<?= $arResult["FORM_ACTION"] ?>" method="get" class="search-overlay__form">
			<?php if ($arParams['USE_SUGGEST'] === 'Y'): ?>
				<?php $APPLICATION->IncludeComponent(
					'bitrix:search.suggest.input',
					'',
					['NAME' => 'q', 'VALUE' => '', 'INPUT_SIZE' => 40, 'DROPDOWN_SIZE' => 10,],
					$component,
					['HIDE_ICONS' => 'Y']
				); ?>
			<?php else: ?>
				<input class="search-overlay__input" type="text" name="q" value="" size="40" maxlength="50"
					autocomplete="off" placeholder="Поиск по сайту..." />
			<?php endif; ?>

			<button class="search-overlay__submit-btn" type="submit" name="s" title="<?= GetMessage("SEARCH_GO") ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M16.9498 16.9498C18.666 15.2335 19.5834 12.9335 19.5834 10.5834C19.5834 8.23321 18.666 5.93321 16.9498 4.21695C15.2335 2.5007 12.9335 1.58337 10.5834 1.58337C8.23321 1.58337 5.93321 2.5007 4.21695 4.21695C2.5007 5.93321 1.58337 8.23321 1.58337 10.5834C1.58337 12.9335 2.5007 15.2335 4.21695 16.9498C5.93321 18.666 8.23321 19.5834 10.5834 19.5834C12.9335 19.5834 15.2335 18.666 16.9498 16.9498Z"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M18.4166 18.4166L22.4166 22.4166" stroke="currentColor" stroke-width="2"
						stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</button>
			<input type="hidden" name="how" value="<?php echo $arResult['REQUEST']['HOW'] == 'd' ? 'd' : 'r' ?>" />
		</form>
	</div>
</div>

<button type="button" class="search-open-btn" id="search-open-btn" aria-label="Открыть поиск">
	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path
			d="M16.9498 16.9498C18.666 15.2335 19.5834 12.9335 19.5834 10.5834C19.5834 8.23321 18.666 5.93321 16.9498 4.21695C15.2335 2.5007 12.9335 1.58337 10.5834 1.58337C8.23321 1.58337 5.93321 2.5007 4.21695 4.21695C2.5007 5.93321 1.58337 8.23321 1.58337 10.5834C1.58337 12.9335 2.5007 15.2335 4.21695 16.9498C5.93321 18.666 8.23321 19.5834 10.5834 19.5834C12.9335 19.5834 15.2335 18.666 16.9498 16.9498Z"
			stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
		<path d="M18.4166 18.4166L22.4166 22.4166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
			stroke-linejoin="round" />
	</svg>
</button>