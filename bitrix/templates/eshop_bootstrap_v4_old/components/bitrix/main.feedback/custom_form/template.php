<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["MESSAGE"] <> ''):?>
    <div class="alert alert-success"><?=$arResult["MESSAGE"]?></div>
<?endif;

if($arResult["ERROR_MESSAGE"] <> ''):?>
    <div class="alert alert-danger"><?=$arResult["ERROR_MESSAGE"]?></div>
<?endif;

if($arResult["OK_MESSAGE"] <> ''):?>
    <div class="alert alert-success"><?=$arResult["OK_MESSAGE"]?></div>
<?endif;

if($arResult["SHOW_FORM"]):?>
<div class="feedback-form">
    <form action="<?=POST_FORM_ACTION_URI?>" method="POST">
        <?=bitrix_sessid_post()?>
        
        <div class="form-group">
            <label for="feedback-name">Имя *</label>
            <input type="text" id="feedback-name" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>" required>
        </div>
        
        <div class="form-group">
            <label for="feedback-phone">Телефон *</label>
            <input type="tel" id="feedback-phone" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>" required>
        </div>
        
        <div class="form-group">
            <label for="feedback-email">Email</label>
            <input type="email" id="feedback-email" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
        </div>
        
        <div class="form-group">
            <label for="feedback-message">Сообщение</label>
            <textarea id="feedback-message" name="MESSAGE" rows="4"><?=$arResult["MESSAGE_TEXT"]?></textarea>
        </div>
        
        <?if($arParams["USE_CAPTCHA"] == "Y"):?>
        <div class="form-group">
            <label for="feedback-captcha">Введите код с картинки *</label>
            <input type="text" name="captcha_word" size="30" maxlength="50" value="" required>
            <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
        </div>
        <?endif;?>
        
        <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
        <button type="submit" name="submit" value="Y">Отправить</button>
    </form>
</div>
<?endif;?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>