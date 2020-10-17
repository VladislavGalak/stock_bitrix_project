<?php
foreach ($arResult['ITEMS'] as &$arItem){
	$arItem['PIC_SET']=	\Askaron\WebpConverter::resizeImageGet(
		$arItem['PREVIEW_PICTURE'],
		['HEIGHT'=>300,'WIDTH'=>300,'HEIGHT_M'=>420,'WIDTH_M'=>420,'QUALITY'=>70]
	);
}