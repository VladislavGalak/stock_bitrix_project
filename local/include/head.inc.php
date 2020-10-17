<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta property="og:type" content="website"/>
<meta property="og:site_name" content="Green Connect Russia">
<meta property="og:locale" content="ru">
<meta property="og:title" content="<?=$APPLICATION->ShowTitle()?>">
<meta property="og:description" content="<?=$APPLICATION->ShowProperty('description')?>">
<meta property="og:url" content="<?='https://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_URL']?>">
<meta property="og:image" content="<?$APPLICATION->ShowProperty('OG_IMAGE');?>"/>
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<?$APPLICATION->SetPageProperty("OG_IMAGE", STATIC_PATH."/img/logo.png");

$app = \Bitrix\Main\Page\Asset::getInstance();
CJSCore::Init(array("jquery"));

#---requires---#
$app->addJs(STATIC_PATH . "/js/project.js");
#---main---#
$app->addCss(STATIC_PATH . "/css/project.min.css");
