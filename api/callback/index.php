<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(	'askaron:callback',	'',
	[
		'NAME' => $_POST['name'],
		'PHONE' => $_POST['phone'],
		'TEXT' => $_POST['text'],
		'AJAX_CALL' => 'Y',
	]);