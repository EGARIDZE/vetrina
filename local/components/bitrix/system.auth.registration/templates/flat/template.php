<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2024 Bitrix
 */

use Bitrix\Main\Web\Json;

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}

// ЛОГИКА ГЕНЕРАЦИИ УНИКАЛЬНОГО ЛОГИНА
// Если логин уже пришел (например, при ошибке валидации), используем его.
// Если нет - генерируем новый на основе времени и случайного числа.
// Префикс 'u_' + timestamp + random гарантирует уникальность.
$generatedLogin = $arResult["USER_LOGIN"];
if (empty($generatedLogin)) {
	$generatedLogin = 'user_' . time() . rand(100, 999);
}

?>
<style>
	:root {
		--color-primary: #00aea1;
		--color-primary-hover: #009790;
		--color-text: #1a1a1a;
		--color-text-light: #666;
		--color-border: #e0e0e0;
		--color-error: #dc3545;
		--color-success: #28a745;
	}

	.auth-form-wrapper {
		width: 100%;
		display: flex;
		justify-content: center;
	}

	.auth-form-card {
		background: white;
		border-radius: 8px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
		overflow: hidden;
		width: 100%;
		max-width: 700px;
	}

	.auth-form-header {
		background: var(--color-primary);
		color: white;
		padding: 30px;
		text-align: center;
	}

	.auth-form-header h1 {
		font-size: 24px;
		margin: 0;
		font-weight: 600;
	}

	.auth-form-body {
		padding: 40px 30px;
	}

	.form-group {
		margin-bottom: 20px;
	}

	.form-label {
		display: block;
		margin-bottom: 8px;
		font-weight: 500;
		color: var(--color-text);
		font-size: 14px;
	}

	.form-label .required {
		color: var(--color-error);
	}

	.form-input {
		width: 100%;
		padding: 12px 14px;
		border: 1px solid var(--color-border);
		border-radius: 6px;
		font-size: 14px;
		transition: border-color 0.3s, box-shadow 0.3s;
		font-family: inherit;
		box-sizing: border-box;
	}

	.form-input:focus {
		outline: none;
		border-color: var(--color-primary);
		box-shadow: 0 0 0 3px rgba(0, 174, 161, 0.1);
	}

	.error-box {
		background: rgba(220, 53, 69, 0.1);
		border-left: 4px solid var(--color-error);
		padding: 15px;
		border-radius: 6px;
		margin-bottom: 20px;
		color: var(--color-text);
		font-size: 13px;
	}
	
	.success-box {
		background: rgba(40, 167, 69, 0.1);
		border-left: 4px solid var(--color-success);
		padding: 15px;
		border-radius: 6px;
		margin-bottom: 20px;
		color: var(--color-text);
		font-size: 13px;
	}

	.btn-primary {
		background: var(--color-primary);
		color: white;
		padding: 12px 20px;
		border: none;
		border-radius: 6px;
		font-size: 16px;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.3s;
		width: 100%;
		display: block;
	}

	.btn-primary:hover {
		background: var(--color-primary-hover);
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(0, 174, 161, 0.25);
	}

	.footer-link {
		text-align: center;
		margin-top: 20px;
		font-size: 13px;
	}

	.footer-link a {
		color: var(--color-primary);
		text-decoration: none;
		font-weight: 500;
	}

	.footer-link a:hover {
		text-decoration: underline;
	}
	
	.bx-captcha {
		margin-bottom: 10px;
	}

	.main-user-consent-request {
		font-size: 13px;
		color: var(--color-text);
		line-height: 1.5;
		margin-bottom: 20px;
	}
	.main-user-consent-request input[type="checkbox"] {
		accent-color: var(--color-primary);
		cursor: pointer;
		margin-right: 10px;
		vertical-align: middle;
	}
	
	/* Styles for User Consent Popup */
	.main-user-consent-request-popup { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); z-index: 9999; display: flex; justify-content: center; align-items: center; padding: 15px; box-sizing: border-box; visibility: visible; }
	.main-user-consent-request-popup-cont { background: #fff; width: 100%; max-width: 600px; max-height: 90vh; border-radius: 8px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2); display: flex; flex-direction: column; overflow: hidden; font-family: inherit; }
	.main-user-consent-request-popup-header { background-color: var(--color-primary); color: #fff; padding: 15px 20px; font-size: 18px; font-weight: 600; text-align: left; flex-shrink: 0; }
	.main-user-consent-request-popup-body { padding: 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 15px; }
	.main-user-consent-request-popup-text { background: #f8f9fa; border: 1px solid var(--color-border); border-radius: 6px; padding: 15px; font-size: 13px; line-height: 1.5; color: var(--color-text); height: 300px; overflow-y: auto; margin-bottom: 15px; }
	.main-user-consent-request-popup-buttons { display: flex; gap: 15px; justify-content: flex-end; padding-top: 10px; border-top: 1px solid #f0f0f0; }
	.main-user-consent-request-popup-button { padding: 10px 24px; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.2s; text-align: center; user-select: none; }
	.main-user-consent-request-popup-button-acc { background-color: var(--color-primary); color: #fff; border: 1px solid var(--color-primary); display: flex; align-items: center; }
	.main-user-consent-request-popup-button-acc:hover { background-color: var(--color-primary-hover); box-shadow: 0 4px 12px rgba(0, 174, 161, 0.2); }
	.main-user-consent-request-popup-button-rej { background-color: transparent; color: #666; border: 1px solid #ccc; display: flex; align-items: center; }
	.main-user-consent-request-popup-button-rej:hover { background-color: #f5f5f5; color: #333; border-color: #bbb; }
	
	@media (max-width: 600px) {
		.main-user-consent-request-popup-buttons { flex-direction: column; }
		.main-user-consent-request-popup-button { width: 100%; box-sizing: border-box; }
		.main-user-consent-request-popup-text { height: 200px; }
	}
</style>

<div class="auth-form-wrapper">
	<div class="auth-form-card">
		<div class="auth-form-header">
			<h1><?=GetMessage("AUTH_REGISTER")?></h1>
		</div>
		
		<div class="auth-form-body">
			<noindex>
			<?
			if(!empty($arParams["~AUTH_RESULT"]["MESSAGE"])):
				$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
			?>
				<div class="<?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "success-box":"error-box")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
			<?endif?>

			<?if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
				<div class="success-box"><?echo GetMessage("AUTH_EMAIL_SENT")?></div>
			<?endif?>

			<?if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
				<div class="info-box"><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></div>
			<?endif?>

			<?if($arResult["SHOW_SMS_FIELD"] == true):?>

				<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="regform">
					<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />

					<div class="form-group">
						<label class="form-label"><span class="required">*</span><?echo GetMessage("main_register_sms_code")?></label>
						<input type="text" name="SMS_CODE" class="form-input" maxlength="255" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"] ?? '')?>" autocomplete="off" />
					</div>

					<div class="form-group">
						<input type="submit" class="btn-primary" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" />
					</div>
				</form>

				<script>
				new BX.PhoneAuth({
					containerId: 'bx_register_resend',
					errorContainerId: 'bx_register_error',
					interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
					data:
						<?= Json::encode([
							'signedData' => $arResult["SIGNED_DATA"],
						]) ?>,
					onError:
						function(response)
						{
							var errorNode = BX('bx_register_error');
							errorNode.innerHTML = '';
							for(var i = 0; i < response.errors.length; i++)
							{
								errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br />';
							}
							errorNode.style.display = '';
						}
				});
				</script>

				<div id="bx_register_error" style="display:none" class="error-box"></div>
				<div id="bx_register_resend"></div>

			<?elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>

				<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
					<input type="hidden" name="AUTH_FORM" value="Y" />
					<input type="hidden" name="TYPE" value="REGISTRATION" />

					<!-- СКРЫТОЕ ПОЛЕ ЛОГИН (ГЕНЕРИРУЕТСЯ АВТОМАТИЧЕСКИ) -->
					<input type="hidden" name="USER_LOGIN" value="<?=$generatedLogin?>" />
					
					<!-- СКРЫТОЕ ПОЛЕ ФАМИЛИЯ (ЧТОБЫ НЕ МЕШАЛО, НО ПЕРЕДАВАЛОСЬ ПУСТЫМ) -->
					<input type="hidden" name="USER_LAST_NAME" value="" />

					<!-- ПОЛЕ ИМЯ (ВИДИМОЕ) -->
					<div class="form-group">
						<label class="form-label"><?=GetMessage("AUTH_NAME")?></label>
						<input type="text" name="USER_NAME" class="form-input" maxlength="255" value="<?=$arResult["USER_NAME"]?>" />
					</div>

					<!-- ПОЛЕ ПАРОЛЬ -->
					<div class="form-group">
						<label class="form-label"><span class="required">*</span><?=GetMessage("AUTH_PASSWORD_REQ")?></label>
						<?if($arResult["SECURE_AUTH"]):?>
							<div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
								<div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div>
							</div>
							<script>document.getElementById('bx_auth_secure').style.display = '';</script>
						<?endif?>
						<input type="password" name="USER_PASSWORD" class="form-input" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="off" />
					</div>

					<!-- ПОЛЕ ПОДТВЕРЖДЕНИЕ ПАРОЛЯ -->
					<div class="form-group">
						<label class="form-label"><span class="required">*</span><?=GetMessage("AUTH_CONFIRM")?></label>
						<?if($arResult["SECURE_AUTH"]):?>
							<div class="bx-authform-psw-protected" id="bx_auth_secure_conf" style="display:none">
								<div class="bx-authform-psw-protected-desc"><span></span><?echo GetMessage("AUTH_SECURE_NOTE")?></div>
							</div>
							<script>document.getElementById('bx_auth_secure_conf').style.display = '';</script>
						<?endif?>
						<input type="password" name="USER_CONFIRM_PASSWORD" class="form-input" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" autocomplete="off" />
					</div>

					<?if($arResult["EMAIL_REGISTRATION"]):?>
						<div class="form-group">
							<label class="form-label">
								<?if($arResult["EMAIL_REQUIRED"]):?><span class="required">*</span><?endif?>
								<?=GetMessage("AUTH_EMAIL")?>
							</label>
							<input type="text" name="USER_EMAIL" class="form-input" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" />
						</div>
					<?endif?>

					<?if($arResult["PHONE_REGISTRATION"]):?>
						<div class="form-group">
							<label class="form-label">
								<?if($arResult["PHONE_REQUIRED"]):?><span class="required">*</span><?endif?>
								<?echo GetMessage("main_register_phone_number")?>
							</label>
							<input type="text" name="USER_PHONE_NUMBER" class="form-input" maxlength="255" value="<?=$arResult["USER_PHONE_NUMBER"]?>" />
						</div>
					<?endif?>

					<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
						<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
							<div class="form-group">
								<label class="form-label">
									<?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif?>
									<?=$arUserField["EDIT_FORM_LABEL"]?>
								</label>
								<?
								$APPLICATION->IncludeComponent(
									"bitrix:system.field.edit",
									$arUserField["USER_TYPE"]["USER_TYPE_ID"],
									array(
										"bVarsFromForm" => $arResult["bVarsFromForm"],
										"arUserField" => $arUserField,
										"form_name" => "bform"
									),
									null,
									array("HIDE_ICONS"=>"Y")
								);
								?>
							</div>
						<?endforeach;?>
					<?endif;?>

					<?if ($arResult["USE_CAPTCHA"] == "Y"):?>
						<div class="form-group">
							<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
							<label class="form-label">
								<span class="required">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>
							</label>
							<div class="bx-captcha">
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
							</div>
							<input type="text" name="captcha_word" class="form-input" maxlength="50" value="" autocomplete="off"/>
						</div>
					<?endif?>

					<div class="form-group">
						<?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
							array(
								"ID" => COption::getOptionString("main", "new_user_agreement", ""),
								"IS_CHECKED" => "Y",
								"AUTO_SAVE" => "N",
								"IS_LOADED" => "Y",
								"ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
								"ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
								"INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
								"REPLACE" => array(
									"button_caption" => GetMessage("AUTH_REGISTER"),
									"fields" => array(
										rtrim(GetMessage("AUTH_NAME"), ":"),
										rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
										rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
										rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
										rtrim(GetMessage("AUTH_EMAIL"), ":"),
									)
								),
							)
						);?>
					</div>

					<div class="form-group">
						<input type="submit" class="btn-primary" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" />
					</div>

					<div class="footer-link">
						<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
						<p><span class="required">*</span><?=GetMessage("AUTH_REQ")?></p>
						<a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a>
					</div>

				</form>

				<script>
				document.bform.USER_NAME.focus();
				</script>

			<?endif?>
			</noindex>
		</div>
	</div>
</div>