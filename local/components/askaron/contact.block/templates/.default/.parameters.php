<?php

$set = array(
	['CODE' => 'WHATSAPP','TYPE'=> 'STRING', 'NAME' => 'Телефон для сообщений в whatsapp','ROWS'=>1,'COLS'=>4],
	['CODE' => 'TELEGRAM','TYPE'=> 'STRING', 'NAME' => 'Логин аккаунта для связи в telegram','ROWS'=>1,'COLS'=>4],
);

$arTemplateParameters = array();
foreach ($set as $prop) {
	$arTemplateParameters[$prop['CODE']]= $prop;
}