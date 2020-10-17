<?php

$set = array(
	['CODE' => 'PARAM_1','TYPE'=> 'CHECKBOX', 'NAME' => 'Параметр 1'],
	['CODE' => 'PARAM_2','TYPE'=> 'STRING', 'NAME' => 'Параметр 2','ROWS'=>1,'COLS'=>4,'MULTIPLE'=>'Y'],
);

$arTemplateParameters = array();
foreach ($set as $prop) {
	$arTemplateParameters[$prop['CODE']]= $prop;
}