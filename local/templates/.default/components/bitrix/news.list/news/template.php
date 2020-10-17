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
<div class="blog-block">
	<div class="regular-container">
		<div class="blog-grid">
			<? foreach ($arResult['ITEMS'] as $arItem):?>
				<div class="grid-item">
					<div class="item-box">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="item-picture">
							<picture>
								<source type="image/webp" media="(max-width: 460px)"
								        srcset="<?= $arItem['PIC_SET']['WEBP_RESIZE_M'] ?>" loading="lazy">
								<source type="image/webp" srcset="<?= $arItem['PIC_SET']['WEBP_RESIZE'] ?>"
								        loading="lazy">
								<source type="image/png" media="(max-width: 460px)"
								        srcset="<?= $arItem['PIC_SET']['RESIZE_M'] ?>" loading="lazy">
								<img src="<?= $arItem['PIC_SET']['RESIZE'] ?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" loading="lazy">
							</picture>
						</a>
						<div class="item-info">
							<a href="" class="item-heading">
								<?=$arItem['NAME']?>
							</a>
							<div class="item-desc">
								<?=$arItem['PREVIEW_TEXT']?>
							</div>
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="item-link button">Подробнее</a>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
		<?=$arResult['NAV_STRING']?>
	</div>
</div>