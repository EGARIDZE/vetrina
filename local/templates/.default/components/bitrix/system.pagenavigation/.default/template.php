<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<div class="pagination-container">

	<nav class="modern-pagination" aria-label="Pagination">
		<ul class="pagination-list">

			<? if ($arResult["bDescPageNumbering"] === true):
				// --- Обратная навигация ---
				?>

				<? // Кнопка "Назад" ?>
				<li class="pagination-item pagination-item--arrow">
					<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
						<a class="pagination-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>" aria-label="Предыдущая страница">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</a>
					<? else: ?>
						<span class="pagination-link is-disabled">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</span>
					<? endif; ?>
				</li>

				<? // Номера страниц ?>
				<? while ($arResult["nStartPage"] >= $arResult["nEndPage"]): ?>
					<? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>
					<li class="pagination-item">
						<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
							<span class="pagination-link is-active"><?= $NavRecordGroupPrint ?></span>
						<? else: ?>
							<a class="pagination-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
						<? endif; ?>
					</li>
					<? $arResult["nStartPage"]--; ?>
				<? endwhile; ?>

				<? // Кнопка "Вперед" ?>
				<li class="pagination-item pagination-item--arrow">
					<? if ($arResult["NavPageNomer"] > 1): ?>
						<a class="pagination-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>" aria-label="Следующая страница">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</a>
					<? else: ?>
						<span class="pagination-link is-disabled">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</span>
					<? endif; ?>
				</li>

			<? else:
				// --- Прямая навигация ---
				?>

				<? // Кнопка "Назад" ?>
				<li class="pagination-item pagination-item--arrow">
					<? if ($arResult["NavPageNomer"] > 1): ?>
						<a class="pagination-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>" aria-label="Предыдущая страница">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</a>
					<? else: ?>
						<span class="pagination-link is-disabled">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</span>
					<? endif; ?>
				</li>

				<? // Первая страница и многоточие ?>
				<? if ($arResult["nStartPage"] > 1): ?>
					<li class="pagination-item">
						<a class="pagination-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1">1</a>
					</li>
					<? if ($arResult["nStartPage"] > 2): ?>
						<li class="pagination-item">
							<span class="pagination-link is-dots">...</span>
						</li>
					<? endif; ?>
				<? endif; ?>

				<? // Основной блок страниц ?>
				<? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>
					<li class="pagination-item">
						<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
							<span class="pagination-link is-active"><?= $arResult["nStartPage"] ?></span>
						<? else: ?>
							<a class="pagination-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
						<? endif; ?>
					</li>
					<? $arResult["nStartPage"]++; ?>
				<? endwhile; ?>
				
				<? // Последняя страница и многоточие ?>
				<? if ($arResult["nEndPage"] < $arResult["NavPageCount"]): ?>
					<? if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)): ?>
						<li class="pagination-item">
							<span class="pagination-link is-dots">...</span>
						</li>
					<? endif; ?>
					<li class="pagination-item">
						<a class="pagination-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><?= $arResult["NavPageCount"] ?></a>
					</li>
				<? endif; ?>


				<? // Кнопка "Вперед" ?>
				<li class="pagination-item pagination-item--arrow">
					<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
						<a class="pagination-link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>" aria-label="Следующая страница">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</a>
					<? else: ?>
						<span class="pagination-link is-disabled">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</span>
					<? endif; ?>
				</li>

			<? endif; ?>

		</ul>
	</nav>

</div>