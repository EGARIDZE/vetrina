<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
IncludeTemplateLangFile(__FILE__);
CJSCore::Init(["fx"]);
\Bitrix\Main\UI\Extension::load(["ui.bootstrap4", "ui.fonts.opensans"]);
$curPage = $APPLICATION->GetCurPage(true); ?>
<?php $APPLICATION->ShowHead(); ?>
<div id="panel">
	<?php $APPLICATION->ShowPanel(); ?>
</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:eshop.banner",
	"",
	array()
); ?>



<div class="bx-wrapper " id="bx_eshop_wrap">



	<div class="bx-header">
		<div class="workarea">
			<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/header_custom.php", [], ["MODE" => "html"]); ?>



		</div>
	</div>


	<?php
	// В файле header.php, перед выводом блоков:
	$curPage = $APPLICATION->GetCurPage(false);

	// Если мы на корне сайта ("/" или "/index.php"), то выводим блоки  
	if ($curPage === '/' || $curPage === SITE_DIR || $curPage === '/about/delivery/' . 'index.php'):
		?>
		<div class="bx-header">
			<div class="workarea">
				</div></div><?php endif; ?>