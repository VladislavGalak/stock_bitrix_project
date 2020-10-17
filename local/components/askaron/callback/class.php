<?php

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Application;


class CallbackAsk extends CBitrixComponent
{
	const HL_BLOCK_ID = 2;



	public function executeComponent()
	{
		Loader::includeModule('askaron.recaptcha');
		if ($this->arParams['AJAX_CALL'] == 'Y')
		{
			$captcha = new \askaronReCaptcha\BitrixCaptcha();
			if ($captcha->checkSpam() === false)
			{
				$result = ['status' => 'F', 'message' => 'Внимание бот!', 'errors' => 'You look like a bot'];
			}
			else
			{
				global $USER;
				$this->checkRequest();
				Loader::includeModule("highloadblock");

				$this->addMailEvent($this->arParams);
				$hlBlock = $this->getEntity();
				$res = $hlBlock::add([
					'UF_PHONE' => $this->arParams['PHONE'],
					'UF_NAME' => $this->arParams['NAME'],
					'UF_TEXT' => $this->arParams['TEXT'],
					'UF_USER' => (int)$USER->GetID(),
				]);
				if ($res->isSuccess())
				{
					$_SESSION['ASKARON_CALLBACK_SENT']='Y';
					$result = ['status' => 'S', 'message' => 'Сообщение доставлено, мы скоро с вами свяжемся!', 'errors' => []];
				}
				else
				{
					$result = ['status' => 'F', 'message' => 'Произошла ошибка', 'errors' => $res->getErrorMessages()];
				}
			}
			Application::getInstance()->getContext()->getResponse()->flush(json_encode($result));
		}
		else
		{
			$this->includeComponentTemplate();

		}


	}

	private function getEntity($hlID = self::HL_BLOCK_ID)
	{
		$hlblock = HL\HighloadBlockTable::getById($hlID)->fetch();

		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		return ($entity->getDataClass());
	}

	private function checkRequest()
	{
		$result = [];
		if (strlen($this->arParams['PHONE']) == 0)
		{
			$result ['status'] = 'F';
			$result ['message'] = 'Произошла ошибка';
			$result['errors'][] = 'Поле "Телефон" не может быть пустым';
		}

		if (strlen($this->arParams['NAME']) == 0)
		{
			$result ['status'] = 'F';
			$result ['message'] = 'Произошла ошибка';
			$result['errors'][] = 'Поле "Имя" не может быть пустым';
		}
		if ($result['status'] == 'F')
		{
			Application::getInstance()->getContext()->getResponse()->flush(json_encode($result));
		}
	}

	private function addMailEvent($fields)
	{
		$res = Event::send([
			"EVENT_NAME" => "ASK_CALLBACK",
			"LID" => "s1",
			"C_FIELDS" => [
				"NAME" => $fields['NAME'],
				"PHONE" => $fields['PHONE'],
				"TEXT" => $fields['TEXT'],
			],
		]);
		return $res->isSuccess();
	}
}