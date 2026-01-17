<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "ID" => $_REQUEST["ELEMENT_ID"], 
        "IBLOCK_TYPE" => "catalog_vetrina", 
        "IBLOCK_ID" => "4", 
		"DEPTH_LEVEL" => "3",
        "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/", 
        "CACHE_TIME" => "3600" 
    )
);

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>