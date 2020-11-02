<?php

namespace Askaron;

class WebpConverter
{
	const UPLOAD_PATH = '/home/bitrix/www/upload/';
	const NO_PHOTO_ELEMENT_CODE = 'WEBP_CONVERTER_NO_PHOTO_IMAGE';

	public static function resizeImageGet($img, $params, $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL_ALT)
	{
		$result = [];
		if (!$img)
		{
			$img = self::tryDetectNoPhoto();
		}
		if (isset($img['SRC']))
		{
			$result['ORIGINAL'] = $img['SRC'];
		}
		$scene = self::parseParams($params);
		foreach ($scene as $action)
		{
			$resizedPicSrc = self::resize($img, $action['HEIGHT'], $action['WIDTH'], $resizeType);
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . $resizedPicSrc))
			{
				$convPicSrc = self::convertPath($resizedPicSrc);

				$result[$action['KEY']] = $resizedPicSrc;
				$result['WEBP_' . $action['KEY']] = self::convert(
					$_SERVER['DOCUMENT_ROOT'] . $resizedPicSrc,
					$_SERVER['DOCUMENT_ROOT'] . $convPicSrc,
					[
						'q' => $action['QUALITY'],
					]
				);
			}

		}

		return $result;
	}

	private static function tryDetectNoPhoto()
	{
		if ($noPhotoInDB = self::checkNoPhotoInDB())
		{
			return $noPhotoInDB;
		}
		$noPhotoVariants = [
			'no-photo.jpg',
			'no-photo.jpeg',
			'no-photo.png',
			'no_photo.jpg',
			'no_photo.jpeg',
			'no_photo.png',
			'nophoto.jpg',
			'nophoto.jpeg',
			'nophoto.png',
		];
		if (defined("STATIC_PATH"))
		{
			foreach ($noPhotoVariants as $variant)
			{
				if (file_exists(STATIC_PATH . '/img/' . $variant))
				{
					$noPhotoInDB = self::addNoPhotoInDb(STATIC_PATH . '/img/' . $variant);
					if (is_int($noPhotoInDB))
					{
						return $noPhotoInDB;
					}
				}
				if (file_exists(STATIC_PATH . '/image/' . $variant))
				{
					$noPhotoInDB = self::addNoPhotoInDb(STATIC_PATH . '/img/' . $variant);
					if (is_int($noPhotoInDB))
					{
						return $noPhotoInDB;
					}
				}
			}
		}
	}

	private static function checkNoPhotoInDB()
	{
		$dbRes = \Bitrix\Main\ElementTable()::query()
			->setSelect(['ID'])
			->where('CODE', self::NO_PHOTO_ELEMENT_CODE)
			->setCacheTtl(7200000)
			->exec();
		if ($result = $dbRes->fetch())
		{
			return (int)$result['ID'];
		}
		else
		{
			return false;
		}
	}

	private static function addNoPhotoInDb($pathToImage)
	{
		if (file_exists($pathToImage))
		{
			$el = new \CIBlockElement;
			$arLoadProductArray = [
				'MODIFIED_BY' => 1,
				'IBLOCK_SECTION_ID' => false,
				'NAME' => 'NO PHOTO СЛУЖЕБНЫЙ ЭЛЕМЕНТ(!!!НЕ НУЖНО УДАЛЯТЬ ЕГО!!!)',
				'CODE'=>self::NO_PHOTO_ELEMENT_CODE,
				'ACTIVE' => 'N',
				'DETAIL_PICTURE' => \CFile::MakeFileArray($pathToImage),
			];

			if ($PRODUCT_ID = $el->Add($arLoadProductArray))
			{
				return $PRODUCT_ID;
			}
			else
			{
				return $el->LAST_ERROR;
			}
		}
	}

	private static function getDirFromFilePath($filePath)
	{
		$arPath = explode('/', $filePath);
		array_pop($arPath);
		return implode('/', $arPath) . '/';
	}

	private static function convertPath($url)
	{
		return str_replace(['.jpeg', '.jpg', '.png'], '.webp', str_replace('upload', 'upload/webp', $url));
	}

	private static function parseParams($params)
	{
		$scene = [];
		foreach ($params as $key => $param)
		{
			if (is_array($param) && (array_key_exists('HEIGHT', $param) || array_key_exists('WIDTH', $param)))
			{
				if (isset($param['WIGHT']) && !isset($param['HEIGHT']))
				{
					$param['HEIGHT'] = 100000;
				}
				if (!isset($param['WIDTH']) && isset($params['HEIGHT']))
				{
					$param['WIDTH'] = 100000;
				}
				if (isset($params['WIDTH']) || isset($params['HEIGHT']))
				{
					$scene[] = [
						'KEY' => isset($param['KEY']) ? $param['KEY'] : 'RESIZE_' . $key,
						'HEIGHT' => $param['HEIGHT'],
						'WIDTH' => $param['WIDTH'],
						'QUALITY' => isset($param['QUALITY']) ? $param['QUALITY'] : 70,
					];
				}
			}
		}
		if (empty($scene))
		{
			if (isset($params['WIGHT']) && !isset($params['HEIGHT']))
			{
				$params['HEIGHT'] = 100000;
			}
			if (!isset($params['WIDTH']) && isset($params['HEIGHT']))
			{
				$params['WIDTH'] = 100000;
			}
			if (isset($params['WIDTH']) || isset($params['HEIGHT']))
			{
				$scene[] = [
					'KEY' => 'RESIZE',
					'HEIGHT' => $params['HEIGHT'],
					'WIDTH' => $params['WIDTH'],
					'QUALITY' => isset($params['QUALITY']) ? $params['QUALITY'] : 70,
				];
			}
			return $scene;
		}
	}

	private static function convert($inputSrc, $outputSrc, $params = [])
	{
		if (!file_exists($outputSrc))
		{
			$comand = 'cwebp -sharp_yuv ';
			if (isset($params['q']) && (int)$params['q'] > 10)
			{
				$comand .= '-q ' . $params['q'] . ' ';
			}
			else
			{
				$comand .= '-preset picture ';
			}
			$comand .= $inputSrc . ' -o ' . $outputSrc;
			$outDirPath = self::getDirFromFilePath($outputSrc);
			if (!is_dir($outDirPath))
			{
				mkdir($outDirPath, 0755, true);
			}
			exec($comand);
		}
		return str_replace($_SERVER['DOCUMENT_ROOT'], '', $outputSrc);
	}

	private static function resize($img, $height, $width, $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL_ALT)
	{
		$arFileTmp = \CFile::ResizeImageGet(
			$img,
			["width" => $width, "height" => $height],
			$resizeType
		);
		return $arFileTmp['src'];
	}
}