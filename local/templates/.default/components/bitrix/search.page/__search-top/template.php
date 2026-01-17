<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
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

// Главное условие, которое определяет режим работы шаблона.
// Если в $arResult есть поисковый запрос, значит, это страница результатов.
$isResultPage = (isset($arResult['REQUEST']['QUERY']) && !empty($arResult['REQUEST']['QUERY']));
?>

<div class="search-overlay" id="search-overlay" style="display: none;" aria-hidden="true">
	<div class="search-overlay__container">
		<button class="search-overlay__close-btn" id="search-close-btn" type="button" aria-label="Закрыть поиск">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M18 6L6 18" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6 6L18 18" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</button>
		
		<form action="<?= $arResult["FORM_ACTION"] ?>" method="get" class="search-overlay__form">
			<?php if ($arParams['USE_SUGGEST'] === 'Y'): ?>
				<?php $APPLICATION->IncludeComponent(
					'bitrix:search.suggest.input', '',
					['NAME' => 'q', 'VALUE' => '', 'INPUT_SIZE' => 40, 'DROPDOWN_SIZE' => 10,],
					$component, ['HIDE_ICONS' => 'Y']
				);?>
			<?php else: ?>
				<input class="search-overlay__input" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" placeholder="Поиск по сайту..." />
			<?php endif; ?>

			<button class="search-overlay__submit-btn" type="submit" name="s" title="<?= GetMessage("SEARCH_GO") ?>">
				<svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.9498 16.9498C18.666 15.2335 19.5834 12.9335 19.5834 10.5834C19.5834 8.23321 18.666 5.93321 16.9498 4.21695C15.2335 2.5007 12.9335 1.58337 10.5834 1.58337C8.23321 1.58337 5.93321 2.5007 4.21695 4.21695C2.5007 5.93321 1.58337 8.23321 1.58337 10.5834C1.58337 12.9335 2.5007 15.2335 4.21695 16.9498C5.93321 18.666 8.23321 19.5834 10.5834 19.5834C12.9335 19.5834 15.2335 18.666 16.9498 16.9498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.4166 18.4166L22.4166 22.4166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
			</button>
			<input type="hidden" name="how" value="<?php echo $arResult['REQUEST']['HOW'] == 'd' ? 'd' : 'r' ?>" />
		</form>
	</div>
</div>


<?php if (!$isResultPage): ?>
	<button type="button" class="search-open-btn" id="search-open-btn" aria-label="Открыть поиск">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.9498 16.9498C18.666 15.2335 19.5834 12.9335 19.5834 10.5834C19.5834 8.23321 18.666 5.93321 16.9498 4.21695C15.2335 2.5007 12.9335 1.58337 10.5834 1.58337C8.23321 1.58337 5.93321 2.5007 4.21695 4.21695C2.5007 5.93321 1.58337 8.23321 1.58337 10.5834C1.58337 12.9335 2.5007 15.2335 4.21695 16.9498C5.93321 18.666 8.23321 19.5834 10.5834 19.5834C12.9335 19.5834 15.2335 18.666 16.9498 16.9498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.4166 18.4166L22.4166 22.4166" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
<?php endif; ?>


<?php if ($isResultPage): ?>
	<div class="search-page">
		<form action="" method="get">
		<?php if ($arParams['USE_SUGGEST'] === 'Y'):
			if (mb_strlen($arResult['REQUEST']['~QUERY']) && is_object($arResult['NAV_RESULT']))
			{
				$arResult['FILTER_MD5'] = $arResult['NAV_RESULT']->GetFilterMD5();
				$obSearchSuggest = new CSearchSuggest($arResult['FILTER_MD5'], $arResult['REQUEST']['~QUERY']);
				$obSearchSuggest->SetResultCount($arResult['NAV_RESULT']->NavRecordCount);
			}
			?>
			<?php $APPLICATION->IncludeComponent(
				'bitrix:search.suggest.input',
				'',
				[
					'NAME' => 'q',
					'VALUE' => $arResult['REQUEST']['~QUERY'],
					'INPUT_SIZE' => 40,
					'DROPDOWN_SIZE' => 10,
					'FILTER_MD5' => $arResult['FILTER_MD5'],
				],
				$component, ['HIDE_ICONS' => 'Y']
			);?>
		<?php else:?>
			<input type="text" name="q" value="<?=$arResult['REQUEST']['QUERY']?>" size="40" />
		<?php endif;?>
		<?php if ($arParams['SHOW_WHERE']):?>
			&nbsp;<select name="where">
			<option value=""><?=GetMessage('SEARCH_ALL')?></option>
			<?php foreach ($arResult['DROPDOWN'] as $key => $value):?>
			<option value="<?=$key?>"<?php echo ($arResult['REQUEST']['WHERE'] == $key) ? ' selected' : '';?>><?=$value?></option>
			<?php endforeach?>
			</select>
		<?php endif;?>
			&nbsp;<input type="submit" value="<?=GetMessage('SEARCH_GO')?>" />
			<input type="hidden" name="how" value="<?php echo $arResult['REQUEST']['HOW'] == 'd' ? 'd' : 'r'?>" />
		<?php if ($arParams['SHOW_WHEN']):?>
			<script>
			var switch_search_params = function()
			{
				var sp = document.getElementById('search_params');
				var flag;
				var i;

				if(sp.style.display == 'none')
				{
					flag = false;
					sp.style.display = 'block'
				}
				else
				{
					flag = true;
					sp.style.display = 'none';
				}

				var from = document.getElementsByName('from');
				for(i = 0; i < from.length; i++)
					if(from[i].type.toLowerCase() == 'text')
						from[i].disabled = flag;

				var to = document.getElementsByName('to');
				for(i = 0; i < to.length; i++)
					if(to[i].type.toLowerCase() == 'text')
						to[i].disabled = flag;

				return false;
			}
			</script>
			<br /><a class="search-page-params" href="#" onclick="return switch_search_params()"><?php echo GetMessage('CT_BSP_ADDITIONAL_PARAMS')?></a>
			<div id="search_params" class="search-page-params" style="display:<?php echo $arResult['REQUEST']['FROM'] || $arResult['REQUEST']['TO'] ? 'block' : 'none'?>">
				<?php $APPLICATION->IncludeComponent(
					'bitrix:main.calendar',
					'',
					[
						'SHOW_INPUT' => 'Y',
						'INPUT_NAME' => 'from',
						'INPUT_VALUE' => $arResult['REQUEST']['~FROM'],
						'INPUT_NAME_FINISH' => 'to',
						'INPUT_VALUE_FINISH' => $arResult['REQUEST']['~TO'],
						'INPUT_ADDITIONAL_ATTR' => 'size="10"',
					],
					null,
					['HIDE_ICONS' => 'Y']
				);?>
			</div>
		<?php endif?>
		</form><br />

		<?php if (isset($arResult['REQUEST']['ORIGINAL_QUERY'])):
			?>
			<div class="search-language-guess">
				<?php echo GetMessage('CT_BSP_KEYBOARD_WARNING', ['#query#' => '<a href="' . $arResult['ORIGINAL_QUERY_URL'] . '">' . $arResult['REQUEST']['ORIGINAL_QUERY'] . '</a>'])?>
			</div><br /><?php
		endif;?>

		<?php if ($arResult['REQUEST']['QUERY'] === false && $arResult['REQUEST']['TAGS'] === false):?>
		<?php elseif ($arResult['ERROR_CODE'] != 0):?>
			<p><?=GetMessage('SEARCH_ERROR')?></p>
			<?php ShowError($arResult['ERROR_TEXT']);?>
			<p><?=GetMessage('SEARCH_CORRECT_AND_CONTINUE')?></p>
			<br /><br />
			<p><?=GetMessage('SEARCH_SINTAX')?><br /><b><?=GetMessage('SEARCH_LOGIC')?></b></p>
			<table border="0" cellpadding="5">
				<tr>
					<td align="center" valign="top"><?=GetMessage('SEARCH_OPERATOR')?></td><td valign="top"><?=GetMessage('SEARCH_SYNONIM')?></td>
					<td><?=GetMessage('SEARCH_DESCRIPTION')?></td>
				</tr>
				<tr>
					<td align="center" valign="top"><?=GetMessage('SEARCH_AND')?></td><td valign="top">and, &amp;, +</td>
					<td><?=GetMessage('SEARCH_AND_ALT')?></td>
				</tr>
				<tr>
					<td align="center" valign="top"><?=GetMessage('SEARCH_OR')?></td><td valign="top">or, |</td>
					<td><?=GetMessage('SEARCH_OR_ALT')?></td>
				</tr>
				<tr>
					<td align="center" valign="top"><?=GetMessage('SEARCH_NOT')?></td><td valign="top">not, ~</td>
					<td><?=GetMessage('SEARCH_NOT_ALT')?></td>
				</tr>
				<tr>
					<td align="center" valign="top">( )</td>
					<td valign="top">&nbsp;</td>
					<td><?=GetMessage('SEARCH_BRACKETS_ALT')?></td>
				</tr>
			</table>
		<?php elseif (count($arResult['SEARCH']) > 0):?>
			<?php echo ($arParams['DISPLAY_TOP_PAGER'] != 'N') ? $arResult['NAV_STRING'] : '';?>
			<br /><hr />
			<?php foreach ($arResult['SEARCH'] as $arItem):?>
				<a href="<?php echo $arItem['URL']?>"><?php echo $arItem['TITLE_FORMATED']?></a>
				<p><?php echo $arItem['BODY_FORMATED']?></p>
				<?php if (
					$arParams['SHOW_RATING'] == 'Y'
					&& $arItem['RATING_TYPE_ID'] <> ''
					&& $arItem['RATING_ENTITY_ID'] > 0
				):?>
					<div class="search-item-rate"><?php
						$APPLICATION->IncludeComponent(
							'bitrix:rating.vote', $arParams['RATING_TYPE'],
							[
								'ENTITY_TYPE_ID' => $arItem['RATING_TYPE_ID'],
								'ENTITY_ID' => $arItem['RATING_ENTITY_ID'],
								'OWNER_ID' => $arItem['USER_ID'],
								'USER_VOTE' => $arItem['RATING_USER_VOTE_VALUE'],
								'USER_HAS_VOTED' => $arItem['RATING_USER_VOTE_VALUE'] == 0 ? 'N' : 'Y',
								'TOTAL_VOTES' => $arItem['RATING_TOTAL_VOTES'],
								'TOTAL_POSITIVE_VOTES' => $arItem['RATING_TOTAL_POSITIVE_VOTES'],
								'TOTAL_NEGATIVE_VOTES' => $arItem['RATING_TOTAL_NEGATIVE_VOTES'],
								'TOTAL_VALUE' => $arItem['RATING_TOTAL_VALUE'],
								'PATH_TO_USER_PROFILE' => $arParams['~PATH_TO_USER_PROFILE'],
							],
							$component,
							['HIDE_ICONS' => 'Y']
						);?>
					</div>
				<?php endif;?>
				<small><?=GetMessage('SEARCH_MODIFIED')?> <?=$arItem['DATE_CHANGE']?></small><br /><?php
				if ($arItem['CHAIN_PATH']):?>
					<small><?=GetMessage('SEARCH_PATH')?>&nbsp;<?=$arItem['CHAIN_PATH']?></small><?php
				endif;
				?><hr />
			<?php endforeach;?>
			<?php echo ($arParams['DISPLAY_BOTTOM_PAGER'] != 'N') ? $arResult['NAV_STRING'] : '';?>
			<br />
			<p>
			<?php if ($arResult['REQUEST']['HOW'] == 'd'):?>
				<a href="<?=$arResult['URL']?>&amp;how=r<?php echo $arResult['REQUEST']['FROM'] ? '&amp;from=' . $arResult['REQUEST']['FROM'] : ''?><?php echo $arResult['REQUEST']['TO'] ? '&amp;to=' . $arResult['REQUEST']['TO'] : ''?>"><?=GetMessage('SEARCH_SORT_BY_RANK')?></a>&nbsp;|&nbsp;<b><?=GetMessage('SEARCH_SORTED_BY_DATE')?></b>
			<?php else:?>
				<b><?=GetMessage('SEARCH_SORTED_BY_RANK')?></b>&nbsp;|&nbsp;<a href="<?=$arResult['URL']?>&amp;how=d<?php echo $arResult['REQUEST']['FROM'] ? '&amp;from=' . $arResult['REQUEST']['FROM'] : ''?><?php echo $arResult['REQUEST']['TO'] ? '&amp;to=' . $arResult['REQUEST']['TO'] : ''?>"><?=GetMessage('SEARCH_SORT_BY_DATE')?></a>
			<?php endif;?>
			</p>
		<?php else:?>
			<?php ShowNote(GetMessage('SEARCH_NOTHING_TO_FOUND'));?>
		<?php endif;?>
	</div>
<?php endif; ?>