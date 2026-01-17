<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

// Подключаем CSS
$this->addExternalCss($this->GetFolder() . '/style.css');

// 1) Получаем разделы
$arSections = [];
$rsSections = CIBlockSection::GetList(
	['SORT' => 'ASC'],
	[
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'SECTION_ID' => 0,
		'GLOBAL_ACTIVE' => 'Y'
	],
	false,
	['ID', 'NAME', 'CODE', 'PICTURE', 'DESCRIPTION']
);

while ($sec = $rsSections->GetNext()) {
	// присваиваем корневому разделу свойство для SEF-пути
	$sec['SECTION_CODE_PATH'] = $sec['CODE'];

	// 2) Выбираем подразделы, теперь с полем PICTURE
	$sec['SUBSECTIONS'] = [];
	$rsSub = CIBlockSection::GetList(
		['SORT' => 'ASC'],
		[
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'SECTION_ID' => $sec['ID'],
			'GLOBAL_ACTIVE' => 'Y'
		],
		false,
		['ID', 'NAME', 'CODE', 'PICTURE']
	);

	while ($sub = $rsSub->GetNext()) {
		// строим полный SECTION_CODE_PATH
		$sub['SECTION_CODE_PATH'] = $sec['SECTION_CODE_PATH'] . '/' . $sub['CODE'];

		// сразу получаем URL картинки
		$sub['PICTURE_URL'] = $sub['PICTURE']
			? CFile::GetPath($sub['PICTURE'])
			: '';

		$sec['SUBSECTIONS'][] = $sub;
	}

	$arSections[] = $sec;
}

// 3) Генерируем SEF-ссылки через шаблон из index.php
$tpl = $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'];

foreach ($arSections as &$s) {
	$s['SECTION_PAGE_URL'] = CComponentEngine::MakePathFromTemplate(
		$tpl,
		[
			'SECTION_ID' => $s['ID'],
			'SECTION_CODE_PATH' => $s['SECTION_CODE_PATH'],
		]
	);

	foreach ($s['SUBSECTIONS'] as &$sub) {
		$sub['SECTION_PAGE_URL'] = CComponentEngine::MakePathFromTemplate(
			$tpl,
			[
				'SECTION_ID' => $sub['ID'],
				'SECTION_CODE_PATH' => $sub['SECTION_CODE_PATH'],
			]
		);
	}
	unset($sub);
}
unset($s);
?>



<div class="  row mb-4 catalog_section_dep1 container m-auto py-5">

		<div class='col-md-3 col-sm-4 w-100'>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:main.include',
				'',
				array(
					'AREA_FILE_SHOW' => 'file',
					'PATH' => $arParams['SIDEBAR_PATH'],
					'AREA_FILE_RECURSIVE' => 'N',
					'EDIT_MODE' => 'html',
				),
				false,
				array('HIDE_ICONS' => 'Y')
			);
			?>
		</div>
<div class=" catalog_main ">




	<?php foreach ($arSections as $arSection): ?>
		<div class="catalog-section">

			<div class="catalog_heading">
				<h2 class="catalog_title"><?= htmlspecialcharsbx($arSection['NAME']) ?></h2>

				<a href="<?= htmlspecialcharsbx($arSection['SECTION_PAGE_URL']) ?>" class="catalog_all_link">
					Все категории
					<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
						width="15" height="15" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
						xml:space="preserve" class="">
						<g>
							<path
								d="M388.418 240.915 153.752 6.248c-8.331-8.331-21.839-8.331-30.17 0-8.331 8.331-8.331 21.839 0 30.17L343.163 256 123.582 475.582c-8.331 8.331-8.331 21.839 0 30.17 8.331 8.331 21.839 8.331 30.17 0l234.667-234.667c8.33-8.331 8.33-21.839-.001-30.17z"
								fill="#00ab9a" opacity="1" data-original="#000000" class=""></path>
						</g>
					</svg>
				</a>

			</div>
			<?php if ($arSection['PICTURE']): ?>
				<img src="<?= CFile::GetPath($arSection['PICTURE']) ?>" alt="<?= htmlspecialcharsbx($arSection['NAME']) ?>">
			<?php endif; ?>

			<div class="subsections">
				<?php foreach ($arSection['SUBSECTIONS'] as $subSection): ?>
					<div class="subsection-item">
						<a href="<?= htmlspecialcharsbx($subSection['SECTION_PAGE_URL']) ?>" class="subsection-link_outer">
							<?php if ($subSection['PICTURE_URL']): ?>
								<img src="<?= htmlspecialcharsbx($subSection['PICTURE_URL']) ?>"
									alt="<?= htmlspecialcharsbx($subSection['NAME']) ?>">
							<?php endif; ?>

							<span class="subsection-link_custom">
								<?= htmlspecialcharsbx($subSection['NAME']) ?>
							</span>

						</a>
					</div>
				<?php endforeach; ?>

			</div>
		</div>
	<?php endforeach; ?>
</div>
</div>

<style>
	.catalog_all_link {
		display: flex;
		gap: 5px;
		align-items: center;
	}

	.catalog_all_link:hover {
		gap: 15px;
	}

	.catalog_heading {
		display: flex;
		align-items: center;
		gap: 20px;
		margin: 0 0 20px 0;

	}

	.subsection-item .subsection-link_outer {
		display: flex;
		height: 100%;
		justify-content: space-between;
		flex-direction: column;
				padding: 20px;

	}


	.subsections {
		flex-wrap: nowrap;
		align-items: normal;
	}

	.all-categories-btn {
		height: fit-content;
		margin: auto 0;
	}

	.catalog_title {
		font-weight: 700;
	}

	.subsection-item {
		border-radius: 10px;
		border: .8px solid #e7e9ec;
	}

	.subsection-link_custom {
		padding: 0;
		background: transparent;
		text-align: center;
		color: black;
	}

	.catalog_main {
	
		display: flex;
		flex-direction: column;
		gap: 20px;

	}
		.subsection-item .subsection-link_outer:hover .subsection-link_custom{
color: #00AB9A;
	}
</style><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>