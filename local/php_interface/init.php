<?php
define("STATIC_PATH", "/local/static");
define("DEFAULT_TEMPLATE_PATH", "/local/templates/.default");
define("INCLUDE_PATH", "/local/include");



CModule::AddAutoloadClasses(
	'',
	[
		"Askaron\WebpConverter" => '/local/php_interface/askaron/webpconverter.php',
	]
);

$eventManager = \Bitrix\Main\EventManager::getInstance();






