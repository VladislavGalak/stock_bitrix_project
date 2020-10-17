<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="mega-menu">
	<?
	$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>
        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
        <li class="list-item <?=$arItem["SELECTED"]?'active':''?>"><a href="<?=$arItem["LINK"]?>" class="list-link"><span><?=$arItem["TEXT"]?></span></a>
        <ul class="sub-menu<?=$arItem['DEPTH_LEVEL']>1?$arItem['DEPTH_LEVEL']:''?>">
        <?else:?>
        <li class="sub<?=$arItem['DEPTH_LEVEL']>1?$arItem['DEPTH_LEVEL']:''?>-item"><a href="<?=$arItem["LINK"]?>" class="sub<?=$arItem['DEPTH_LEVEL']>1?$arItem['DEPTH_LEVEL']:''?>-link"><span><?=$arItem["TEXT"]?></span></a>
        <ul class="sub<?=$arItem['DEPTH_LEVEL']>1?$arItem['DEPTH_LEVEL']:''?>-menu">
        <?endif?>
	<?else:?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="list-item <?=$arItem["SELECTED"]?'active':''?>"><a href="<?=$arItem["LINK"]?>" class="list-link"><span><?=$arItem["TEXT"]?></span></a>
		<?else:?>
	        <li class="sub<?=$arItem['DEPTH_LEVEL']>1?$arItem['DEPTH_LEVEL']:''?>-item"><a href="<?=$arItem["LINK"]?>" class="sub<?=$arItem['DEPTH_LEVEL']>1?$arItem['DEPTH_LEVEL']:''?>-link"><span><?=$arItem["TEXT"]?></span></a>
	    <?endif?>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>

	<?if ($previousLevel > 1)://close last item tags?>
		<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
	<?endif?>
	</ul>
<?endif?>