<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
$this->setFrameMode(true);
if (empty($arResult['STRUCTURED_SECTIONS']))
	return;

// Задаем количество видимых элементов по умолчанию (если параметр не передан)
$itemsVisible = min($arParams["ITEMS_VISIBLE_BY_DEFAULT"], 6);

if (!function_exists('plural_form_final_v5')) {
	function plural_form_final_v5($n, $f)
	{
		return $n % 10 == 1 && $n % 100 != 11 ? $f[0] : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? $f[1] : $f[2]);
	}
}
$product_word_forms = ['товар', 'товара', 'товаров'];
$placeholder_path = $this->GetFolder() . '/images/tile-empty.png';
?>

<?php foreach ($arResult['STRUCTURED_SECTIONS'] as $sectionBlock):
	$parentSection = $sectionBlock['PARENT'];
	$childrenSections = $sectionBlock['CHILDREN'];
	$totalChildren = count($childrenSections);
	?>
	<div class="catalog-categories__wrap">
		<p class="catalog-categories__title">
			<span class="h2"><?= $parentSection['NAME'] ?></span>
			<a href="<?= $parentSection['SECTION_PAGE_URL'] ?>" class="p2 link gray">Все категории<svg width="12"
					class="icon" height="12" viewBox="0 0 12 12" fill="#99A4AE" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0)">
						<path fill-rule="evenodd" clip-rule="evenodd"
							d="M2.64616 11.0596C2.43137 11.2744 2.43137 11.6227 2.64616 11.8374C2.86094 12.0522 3.20919 12.0522 3.42397 11.8374L8.88383 6.37759C8.99128 6.27013 9.04498 6.12928 9.04492 5.98844C9.04498 5.84761 8.99128 5.70676 8.88383 5.5993L3.42397 0.139445C3.20918 -0.0753436 2.86094 -0.0753435 2.64616 0.139445C2.43137 0.354233 2.43137 0.702474 2.64616 0.917263L7.71734 5.98844L2.64616 11.0596Z">
						</path>
					</g>
					<defs>
						<clipPath id="clip0">
							<rect width="12" height="12" fill="white" transform="translate(0 12) rotate(-90)"></rect>
						</clipPath>
					</defs>
				</svg></a>
		</p>
        
        <!-- Изменение: Добавляем CSS-переменную для управления количеством колонок из PHP -->
		<div class="catalog-categories" style="--items-per-row: <?= $itemsVisible ?>;">
			<?php foreach ($childrenSections as $index => $arSection):
				$itemClasses = 'catalog-categories_col';
				if ($index >= $itemsVisible) // Логика скрытия остается прежней
					$itemClasses .= ' hidden-category';
				$pictureSrc = $arSection['PREPARED_PICTURE']['SRC'] ?? $placeholder_path;
				$pictureAlt = $arSection['PREPARED_PICTURE']['ALT'] ?? $arSection['NAME'];
				?>
                <!-- Изменение: Убран inline-стиль 'width'. Теперь ширина контролируется в style.css -->
				<div class="<?= $itemClasses; ?>">
					<a class="catalog-categories-item" href="<?= $parentSection['SECTION_PAGE_URL'].$arSection['CODE']."/"; ?>">
						<span class="catalog-categories-item_img"><img src="<?= $pictureSrc; ?>"
								alt="<?= $pictureAlt; ?>"></span>
						<span class="catalog-categories-item_info">
							<p class="link"><?= $arSection['NAME']; ?></p>
							<?php if (isset($arSection['ELEMENT_CNT'])): ?>
								<p class="p3 gray"><?= $arSection['ELEMENT_CNT']; ?>
									<?= plural_form_final_v5($arSection['ELEMENT_CNT'], $product_word_forms); ?></p>
							<?php endif; ?>
						</span>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if ($totalChildren > $itemsVisible): ?>
			<div class="toggle-more-wrapper"><span class="toggle-more-btn" data-alt-text="Свернуть">Еще</span></div>
		<?php endif; ?>
	</div>
<?php endforeach; ?>
<script>
	document.addEventListener('click', function (event) {
		if (event.target.matches('.toggle-more-btn')) {
			const button = event.target;
			const container = button.closest('.catalog-categories__wrap').querySelector('.catalog-categories');
			if (container) {
				container.classList.toggle('is-expanded');
				button.classList.toggle('is-active');
				const altText = button.dataset.altText;
				button.dataset.altText = button.textContent;
				button.textContent = altText;
			}
		}
	});
</script>