<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */

if ($arParams["SET_TITLE"] == "Y") {
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}
?>

<!-- Стили для страницы завершения заказа -->
<style>
	.order-success-page {
		font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
		max-width: 700px;
		margin: 40px auto;
		padding: 40px;
		background-color: #ffffff;
		border-radius: 12px;
		box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
		text-align: center;
		color: #333;
		border: 1px solid #e9ecef;
	}

	.order-success-page__icon {
		margin-bottom: 25px;
	}

	.order-success-page__icon .icon-circle {
		width: 80px;
		height: 80px;
		border-radius: 50%;
		display: inline-flex;
		align-items: center;
		justify-content: center;
	}

	.order-success-page__icon .icon-circle--success {
		background-color: #eafbf5;
		color: #15a362;
	}

	.order-success-page__icon .icon-circle--danger {
		background-color: #fdeeee;
		color: #e53935;
	}

	.order-success-page__icon svg {
		width: 40px;
		height: 40px;
	}

	.order-success-page__title {
		font-size: 28px;
		font-weight: 600;
		margin: 0 0 15px;
		color: #111;
	}

	.order-success-page__message {
		font-size: 16px;
		line-height: 1.6;
		margin: 0 auto 25px;
		max-width: 500px;
		color: #555;
	}

	.order-success-page__order-info {
		background-color: #f8f9fa;
		border: 1px dashed #dee2e6;
		border-radius: 8px;
		padding: 20px;
		margin-bottom: 30px;
		font-size: 16px;
	}

	.order-success-page__order-info b {
		font-weight: 600;
		color: #000;
		background: #e9ecef;
		padding: 4px 10px;
		border-radius: 6px;
	}

	.order-success-page__actions {
		display: flex;
		justify-content: center;
		gap: 15px;
		flex-wrap: wrap;
	}

	.order-success-page__button {
		display: inline-block;
		text-decoration: none;
		font-size: 16px;
		font-weight: 500;
		padding: 12px 25px;
		border-radius: 8px;
		border: 1px solid transparent;
		transition: all 0.2s ease-in-out;
		cursor: pointer;
	}

	.order-success-page__button--primary {
		background-color: #00AB9A;
		color: #fff;
	}

	.order-success-page__button--primary:hover {
		background-color: #008f7d;
		box-shadow: 0 4px 15px #00ab9a3e;
		transform: translateY(-1px);
	}

	.order-success-page__actions .order-success-page__button--primary:hover {
		color: #ffffff;
	}

	.order-success-page__button--secondary {
		background-color: #f8f9fa;
		color: #333;
		border-color: #dee2e6;
	}

	.order-success-page__button--secondary:hover {
		background-color: #f8f8f8;
		border-color: #00AB9A;
		color: #00AB9A;
	}

	.order-success-page__payment-block {
		margin-top: 40px;
		padding-top: 30px;
		border-top: 1px solid #e9ecef;
	}

	.order-success-page__payment-title {
		font-size: 20px;
		font-weight: 600;
		margin-bottom: 20px;
	}

	.order-success-page__payment-system {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 15px;
		margin-bottom: 25px;
	}

	.order-success-page__payment-system-name {
		font-weight: 500;
	}

	.order-success-page__payment-system img {
		max-height: 40px;
		width: auto;
	}

	.order-success-page__payment-form {
		padding: 15px;
		border-radius: 8px;
		background: #f8f9fa;
	}

	.order-success-page__payment-form a {
		color: #007bff;
	}

	.order-success-page_alert {
		padding: 15px;
		border-radius: 8px;
		margin-bottom: 20px;
		font-size: 15px;
	}

	.order-success-page_alert--danger {
		background: #fdeeee;
		color: #a51818;
		border: 1px solid #f5c6cb;
	}

	@media (max-width: 767px) {
		.order-success-page {
			margin: 20px 15px;
			padding: 25px;
		}

		.order-success-page__title {
			font-size: 24px;
		}

		.order-success-page__message {
			font-size: 15px;
		}

		.order-success-page__actions {
			flex-direction: column;
			gap: 10px;
		}

		.order-success-page__button {
			width: 100%;
		}
	}
</style>

<div class="order-success-page">
	<? if (!empty($arResult["ORDER"])): ?>

		<div class="order-success-page__icon">
			<div class="icon-circle icon-circle--success">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
					<path d="M9.9997 15.1709l-4.1992-4.1992-1.4141 1.4141 5.6133 5.6133 12-12-1.4141-1.4141z"></path>
				</svg>
			</div>
		</div>

		<h1 class="order-success-page__title"><?= Loc::getMessage("SOA_ORDER_COMPLETE") ?></h1>

		<p class="order-success-page__message">
			<?= Loc::getMessage("SOA_ORDER_SUC_TEXT") ?>
		</p>

		<div class="order-success-page__order-info">
			<?= Loc::getMessage("SOA_ORDER_SUC", array(
				"#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i'),
				"#ORDER_ID#" => '<strong>' . htmlspecialcharsbx($arResult["ORDER"]["ACCOUNT_NUMBER"]) . '</strong>'
			)) ?>
		</div>

		<?
		$showPayButton = false;
		if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y') {
			foreach ($arResult["PAYMENT"] as $payment) {
				if ($payment["PAID"] != 'Y') {
					$showPayButton = true;
					break;
				}
			}
		}
		?>

		<div class="order-success-page__actions">
			<? if ($showPayButton): ?>
				<a href="#payment"
					class="order-success-page__button order-success-page__button--primary"><?= Loc::getMessage("SOA_PAY") ?></a>
			<? endif; ?>

			<? if ($arParams['NO_PERSONAL'] !== 'Y'): ?>
				<a href="<?= $arParams['PATH_TO_PERSONAL'] ?>"
					class="order-success-page__button order-success-page__button--secondary"><?= Loc::getMessage("SOA_TO_PERSONAL_CABINET") ?></a>
			<? endif; ?>
		</div>

		<?
		if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y') {
			if (!empty($arResult["PAYMENT"])) {
				foreach ($arResult["PAYMENT"] as $payment) {
					if ($payment["PAID"] != 'Y') {
						if (!empty($arResult['PAY_SYSTEM_LIST']) && array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])) {
							$arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];

							if (empty($arPaySystem["ERROR"])) {
								?>
								<div id="payment" class="order-success-page__payment-block">
									<h3 class="order-success-page__payment-title"><?= Loc::getMessage("SOA_PAY") ?></h3>

									<div class="order-success-page__payment-system">
										<div class="order-success-page__payment-system-name"><?= $arPaySystem["NAME"] ?></div>
										<div><?= CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0", "", false) ?></div>
									</div>

									<div class="order-success-page__payment-form">
										<? if ($arPaySystem["ACTION_FILE"] <> '' && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
											<?
											$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
											$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
											?>
											<script>
												window.open('<?= $arParams["PATH_TO_PAYMENT"] ?>?ORDER_ID=<?= $orderAccountNumber ?>&PAYMENT_ID=<?= $paymentAccountNumber ?>');
											</script>
											<?= Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $orderAccountNumber . "&PAYMENT_ID=" . $paymentAccountNumber)) ?>
											<? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
												<br />
												<?= Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $orderAccountNumber . "&pdf=1&DOWNLOAD=Y")) ?>
											<? endif; ?>
										<? else: ?>
											<?= $arPaySystem["BUFFERED_OUTPUT"] ?>
										<? endif; ?>
									</div>
								</div>
								<?
							} else {
								?>
								<div class="order-success-page_alert order-success-page_alert--danger" role="alert">
									<?= Loc::getMessage("SOA_ORDER_PS_ERROR") ?>
								</div>
								<?
							}
						} else {
							?>
							<div class="order-success-page_alert order-success-page_alert--danger" role="alert">
								<?= Loc::getMessage("SOA_ORDER_PS_ERROR") ?>
							</div>
							<?
						}
					}
				}
			}
		} else {
			?>
			<div class="order-success-page_alert order-success-page_alert--danger" role="alert">
				<?= $arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] ?>
			</div>
			<?
		}
		?>

	<? else: ?>

		<div class="order-success-page__icon">
			<div class="icon-circle icon-circle--danger">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
					<path
						d="M12.0007 10.5865l-4.9497-4.9498-1.4141 1.4142 4.9497 4.9497-4.9497 4.9498 1.4141 1.4142 4.9497-4.9497 4.9497 4.9497 1.4141-1.4142-4.9497-4.9498 4.9497-4.9497-1.4141-1.4142-4.9497 4.9498z">
					</path>
				</svg>
			</div>
		</div>

		<h1 class="order-success-page__title"><?= Loc::getMessage("SOA_ERROR_ORDER") ?></h1>

		<div class="order-success-page_alert order-success-page_alert--danger" role="alert">
			<?= Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])]) ?><br />
			<?= Loc::getMessage("SOA_ERROR_ORDER_LOST1") ?>
		</div>

		<div class="order-success-page__actions">
			<a href="/"
				class="order-success-page__button order-success-page__button--secondary"><?= Loc::getMessage("SOA_TO_MAIN") ?></a>
		</div>

	<? endif; ?>
</div>