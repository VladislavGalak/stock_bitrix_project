<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
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
$this->setFrameMode(true);

if (!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
	{
		return;
	}
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<div class="pagination">

	<? if ($arResult["NavPageNomer"] > 1): ?>

		<? if ($arResult["bSavePage"]): ?>
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
               class="arrow arrow-left icon-arrow-long" title="Назад">Назад</a>
		<? else: ?>
			<? if ($arResult["NavPageNomer"] > 2): ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"
                   class="arrow arrow-left icon-arrow-long" title="Назад">Назад</a>
			<? else: ?>
                <span class="arrow arrow-left icon-arrow-long" title="Назад">Назад</span>
			<? endif ?>
		<? endif ?>
	<? endif ?>
	<? if ($arResult["NavPageNomer"] >= 4): ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"
           class="pagination-item">1</a>
	<?endif;?>
	<? if ($arResult["NavPageNomer"] > 4): ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= floor(($arResult["NavPageNomer"]-2)/2)?>"
           class="pagination-item">...</a>
	<?endif;?>
	<? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

		<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
            <i class="pagination-item active"><?= $arResult["nStartPage"] ?></i>
		<? else: ?>
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"
               class="pagination-item"><?= $arResult["nStartPage"] ?></a>
		<? endif ?>
		<? $arResult["nStartPage"]++ ?>
	<? endwhile ?>
	<? if ($arResult["NavPageNomer"]+3 < $arResult["NavPageCount"]): ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= floor(($arResult["NavPageCount"]-$arResult["nEndPage"])/2) + $arResult['nEndPage'] ?>"
           class="pagination-item">...</a>
	<?endif;?>
	<? if ($arResult["nEndPage"] < $arResult["NavPageCount"]): ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"
           class="pagination-item"><?= $arResult["NavPageCount"] ?></a>
    <?endif;?>
	<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"
           class="arrow arrow-right icon-arrow-long" title="Вперед">Вперед</a>
	<? endif ?>
</div>
