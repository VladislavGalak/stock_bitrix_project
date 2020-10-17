<?php


class TopBar extends CBitrixComponent
{
	public function executeComponent()
	{
		global $USER;
		if ($this->arParams['SHOW_PANEL'] === 'Y' && CSite::InGroup((array)$this->arParams['GROUPS_TO_SHOW']) || $USER->IsAdmin())
		{
			$this->includeComponentTemplate();
		}
	}
}