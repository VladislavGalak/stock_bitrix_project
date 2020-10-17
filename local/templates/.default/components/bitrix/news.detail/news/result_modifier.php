<?php
$arResult['PIC_SET'] = \Askaron\WebpConverter::resizeImageGet(
	$arResult['DETAIL_PICTURE'],
	['HEIGHT' => 420, 'WIDTH' => 420, 'QUALITY' => 70]
);
