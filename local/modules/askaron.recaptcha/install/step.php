<?php

use Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid()) return;

if ($ex = $APPLICATION->GetException())
{
    print CAdminMessage::ShowMessage(
    [
        'TYPE' => 'ERROR',
        'MESSAGE' => Loc::getMessage('MOD_INST_ERR'),
        'DETAILS' => $ex->GetString(),
        'HTML' => true
    ]);
}
else
{
    CAdminMessage::ShowNote(Loc::getMessage('MOD_INST_OK'));
}
?>

<form action="<?=$APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
    <input type="submit" value="<?=Loc::getMessage('MOD_BACK')?>">
</form>