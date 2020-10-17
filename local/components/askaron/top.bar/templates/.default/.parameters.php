<?php

$set = array(
	['CODE' => 'SHOW_PANEL','TYPE'=> 'CHECKBOX', 'NAME' => 'Показывать панель'],
	['CODE' => 'GROUPS_TO_SHOW','TYPE'=> 'STRING', 'NAME' => 'Группы пользовталей, для которых показывать панель','ROWS'=>1,'COLS'=>4,'MULTIPLE'=>'Y'],
	['CODE' => 'TEXT','TYPE'=> 'string', 'NAME' => 'Текст на панели','ROWS'=>3],
);

$arTemplateParameters = array();
foreach ($set as $prop) {
	$arTemplateParameters[$prop['CODE']]= $prop;
}