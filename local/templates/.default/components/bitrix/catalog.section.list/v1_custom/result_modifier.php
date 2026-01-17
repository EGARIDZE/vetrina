<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

if (empty($arResult['SECTIONS'])) {
	return;
}

CModule::IncludeModule('iblock');
$arStructuredSections = [];

foreach ($arResult['SECTIONS'] as $arParentSection) {
	$dbChildren = CIBlockSection::GetList(
		['SORT' => 'ASC', 'NAME' => 'ASC'],
		[
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'SECTION_ID' => $arParentSection['ID'],
			'ACTIVE' => 'Y',
			'GLOBAL_ACTIVE' => 'Y',
		],
		false,
		['ID', 'NAME', 'SECTION_PAGE_URL', 'PICTURE']
	);

	$arChildrenList = [];
	while ($arChild = $dbChildren->GetNext()) {
		$arChild['ELEMENT_CNT'] = CIBlockSection::GetSectionElementsCount($arChild['ID'], ['CNT_ACTIVE' => 'Y']);

		if (!empty($arChild['PICTURE'])) {
			$resizedPicture = CFile::ResizeImageGet($arChild['PICTURE'], ['width' => 121, 'height' => 121], BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$arChild['PREPARED_PICTURE'] = ['SRC' => $resizedPicture['src'], 'ALT' => $arChild['NAME']];
		} else {
			$arChild['PREPARED_PICTURE'] = null;
		}
		$arChildrenList[] = $arChild;
	}

	if (!empty($arChildrenList)) {
		$arStructuredSections[] = ['PARENT' => $arParentSection, 'CHILDREN' => $arChildrenList];
	}
}

$arResult['STRUCTURED_SECTIONS'] = $arStructuredSections;

// echo "<pre>";
// print_r($arResult);
// echo "</pre>";