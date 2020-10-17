<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var CBitrixComponent $component */?>
<div class="item-box">
    <div class="item-area">
        <div class="item-heading comment svg-icon"><span>Связаться</span></div>
        <div class="messengers-box">
            <?if(strlen($arParams['WHATSAPP'])>0):?>
                <a href="https://api.whatsapp.com/send/?phone=<?=$arParams['WHATSAPP']?>&text&app_absent=0" target="_blank" class="message-link svg-icon whatsapp"><span>Whatsapp</span></a>
            <?endif;?>
	        <?if(strlen($arParams['TELEGRAM'])>0):?>
                <a href="https://t.me/<?=$arParams['TELEGRAM']?>" target="_blank" class="message-link svg-icon telegram"><span>Telegram</span></a>
	        <?endif;?>
        </div>
        <div class="actions-line">
            <button type="button" data-modale="#modale-callback" class="button">Связаться</button>
        </div>
    </div>
</div>