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
<section class="section-page">
	<div class="regular-container">
		<div class="breadcrumbs-wrapper">
			<div class="breadcrumbs">
				<a href="./">Главная</a>
				<a href="./">Первая категория</a>
				<a href="./">Вторая категория</a>
				<a href="./">Третья категория</a>
				<a href="./">Четвертая категория</a>
				<span>Конечный элемент без ссылки</span>
			</div>
		</div>
		<article class="regular-article">
			<h1><?=$arResult['NAME']?></h1>
			<p><?=$arResult['PREVIEW_TEXT']?></p>
            <?if ($arResult['DETAIL_PICTURE']):?>
                <a class="item-picture">
                    <picture>
                        <source type="image/webp" srcset="<?=$arResult['PIC_SET']['WEBP_RESIZE']?>" loading="lazy">
                        <img src="<?=$arResult['PIC_SET']['RESIZE']?>" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>" loading="lazy">
                    </picture>
                </a>
            <?endif;?>
			<?=$arResult['DETAIL_TEXT']?>
		</article>
		<br>
		<a href="<?=$arResult['LIST_PAGE_URL']?>">Назад к списку</a>
	</div>
</section>
<?
