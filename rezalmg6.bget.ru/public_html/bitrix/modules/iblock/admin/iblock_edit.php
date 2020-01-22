<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/iblock.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/prolog.php");
IncludeModuleLangFile(__FILE__);

global $DB;
global $APPLICATION;

$APPLICATION->AddHeadScript('/bitrix/js/iblock/iblock_edit.js');

define('CATALOG_NEW_OFFERS_IBLOCK_NEED','-1');
define('PROPERTY_EMPTY_ROW_SIZE',5);
$strPREFIX_OF_PROPERTY = 'OF_PROPERTY_';
$strPREFIX_IB_PROPERTY = 'IB_PROPERTY_';

$arDefPropInfo = array(
	'ID' => 0,
	'IBLOCK_ID' => 0,
	'FILE_TYPE' => '',
	'LIST_TYPE' => 'L',
	'ROW_COUNT' => '1',
	'COL_COUNT' => '30',
	'LINK_IBLOCK_ID' => '0',
	'DEFAULT_VALUE' => '',
	'USER_TYPE_SETTINGS' => '',
	'WITH_DESCRIPTION' => '',
	'SEARCHABLE' => '',
	'FILTRABLE' => '',
	'ACTIVE' => 'Y',
	'MULTIPLE_CNT' => '5',
	'XML_ID' => '',
	'PROPERTY_TYPE' => 'S',
	'NAME' => '',
	'USER_TYPE' => '',
	'MULTIPLE' => 'N',
	'IS_REQUIRED' => 'N',
	'SORT' => '500',
	'CODE' => '',
	'SHOW_DEL' => 'N',
);

$arDisabledPropFields = array(
	'ID',
	'IBLOCK_ID',
	'TIMESTAMP_X',
	'TMP_ID',
	'VERSION',
	'DEFAULT_VALUE',
	'USER_TYPE_SETTINGS',
	'VALUES',
	'VALUES_DEF',
	'VALUES_XML',
	'VALUES_SORT',
);

function CheckIBlockTypeID($strIBlockTypeID,$strNewIBlockTypeID,$strNeedAdd)
{
	$arResult = false;
	$strNeedAdd = ('Y' == $strNeedAdd ? 'Y': 'N');
	$strNewIBlockTypeID = trim($strNewIBlockTypeID);
	$strIBlockTypeID = trim($strIBlockTypeID);
	if ('Y' == $strNeedAdd)
	{
		if ('' != $strNewIBlockTypeID)
		{
			$rsIBlockTypes = CIBlockType::GetByID($strNewIBlockTypeID);
			if ($arIBlockType = $rsIBlockTypes->Fetch())
			{
				$arResult = array(
					'RESULT' => 'OK',
					'VALUE' => $strNewIBlockTypeID,
				);
			}
			else
			{
				$arFields = array(
					'ID' => $strNewIBlockTypeID,
					'SECTIONS' => 'N',
					'IN_RSS' => 'N',
					'SORT' => 500,
				);
				$rsLanguages = CLanguage::GetList($by="sort", $order="desc",array('ACTIVE' => 'Y'));
				while ($arLanguage = $rsLanguages->Fetch())
				{
					$arFields['LANG'][$arLanguage['LID']]['NAME'] = $OF_NEW_IBLOCK_TYPE_ID;
				}
				$mxOffersType = $obIBlockType->Add($arFields);
				if (false == $mxOffersType)
				{
					$arResult = array(
						'RESULT' => 'ERROR',
						'MESSAGE' => $obIBlockType->LAST_ERROR,
					);
				}
				else
				{
					$arResult = array(
						'RESULT' => 'OK',
						'VALUE' => $strNewIBlockTypeID,
					);
				}
			}
		}
		else
		{
			$arResult = array(
				'RESULT' => 'ERROR',
				'MESSAGE' => GetMessage('IB_E_OF_ERR_NEW_IBLOCK_TYPE_ABSENT'),
			);
		}
	}
	else
	{
		if ('' == $strIBlockTypeID)
		{
			$arResult = array(
				'RESULT' => 'ERROR',
				'MESSAGE' => GetMessage('IB_E_OF_ERR_IBLOCK_TYPE_ABSENT')
			);
		}
		else
		{
			$rsIBlockTypes = CIBlockType::GetByID($strIBlockTypeID);
			if (!($arIBlockType = $rsIBlockTypes->Fetch()))
			{
				$arResult = array(
					'RESULT' => 'ERROR',
					'MESSAGE' => GetMessage('IB_E_OF_ERR_IBLOCK_TYPE_BAD')
				);
			}
			else
			{
				$arResult = array(
					'RESULT' => 'OK',
					'VALUE' => $strIBlockTypeID,
				);
			}
		}
	}
	return $arResult;
}

function GetPropertyInfo($strPrefix,$ID,$bVarsFromForm = false)
{
	$bVarsFromForm = (true == $bVarsFromForm ? true : false);
	$arResult = false;

	if ((true == isset($_POST[$strPrefix.$ID.'_NAME'])) && (0 < strlen($_POST[$strPrefix.$ID.'_NAME'])))
	{
		$arResult = array(
			'ID' => (true == isset($_POST[$strPrefix.$ID.'_ID']) && 0 < intval($_POST[$strPrefix.$ID.'_ID']) ? intval($_POST[$strPrefix.$ID.'_ID']) : 0),
			"NAME" => $_POST[$strPrefix.$ID."_NAME"],
			"ACTIVE" => ('Y' == $_POST[$strPrefix.$ID."_ACTIVE"] ? 'Y' : 'N'),
			"SORT" => (0 < intval($_POST[$strPrefix.$ID."_SORT"]) ? intval($_POST[$strPrefix.$ID."_SORT"]) : 500),
			"CODE" => $_POST[$strPrefix.$ID."_CODE"],
			"ROW_COUNT" => (0 < intval($_POST[$strPrefix.$ID."_ROW_COUNT"]) ? intval($_POST[$strPrefix.$ID."_ROW_COUNT"]) : 1),
			"COL_COUNT" => (0 < intval($_POST[$strPrefix.$ID."_COL_COUNT"]) ? intval($_POST[$strPrefix.$ID."_COL_COUNT"]) : 30),
			"LINK_IBLOCK_ID" => (0 < intval($_POST[$strPrefix.$ID."_LINK_IBLOCK_ID"]) ? intval($_POST[$strPrefix.$ID."_LINK_IBLOCK_ID"]) : 0),
			"WITH_DESCRIPTION" => ('Y' == $_POST[$strPrefix.$ID."_WITH_DESCRIPTION"] ? 'Y' : 'N'),
			"FILTRABLE" => ('Y' == $_POST[$strPrefix.$ID."_FILTRABLE"] ? 'Y' : 'N'),
			"SEARCHABLE" => ('Y' == $_POST[$strPrefix.$ID."_SEARCHABLE"] ? 'Y' : 'N'),
			"MULTIPLE"  => ('Y' == $_POST[$strPrefix.$ID."_MULTIPLE"] ? 'Y' : 'N'),
			"MULTIPLE_CNT" => (0 < intval($_POST[$strPrefix.$ID."_MULTIPLE_CNT"]) ? intval($_POST[$strPrefix.$ID."_MULTIPLE_CNT"]) : 5),
			"IS_REQUIRED" => ('Y' == $_POST[$strPrefix.$ID."_IS_REQUIRED"] ? 'Y' : 'N'),
			"FILE_TYPE" => $_POST[$strPrefix.$ID."_FILE_TYPE"],
			"LIST_TYPE" => ('C' == $_POST[$strPrefix.$ID."_LIST_TYPE"] ? 'C' : 'L'),
			"DEFAULT_VALUE" => '',
			"USER_TYPE_SETTINGS" => false,
		);
		if ((true == isset($_POST[$strPrefix.$ID."_DEFAULT_VALUE"])) && ('' != $_POST[$strPrefix.$ID."_DEFAULT_VALUE"]))
		{
			//$arResult["DEFAULT_VALUE"] = unserialize(base64_decode($_POST[$strPrefix.$ID."_DEFAULT_VALUE"]));
			$arTempo = base64_decode($_POST[$strPrefix.$ID."_DEFAULT_VALUE"]);
			$arResult["DEFAULT_VALUE"] = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : '');
		}
		if(false !== strpos($_POST[$strPrefix.$ID."_PROPERTY_TYPE"], ":"))
		{
			list($arResult["PROPERTY_TYPE"], $arResult["USER_TYPE"]) = explode(':', $_POST[$strPrefix.$ID."_PROPERTY_TYPE"], 2);
			$arResult["USER_TYPE_SETTINGS"] = false;
			if ((true == isset($_POST[$strPrefix.$ID."_USER_TYPE_SETTINGS"])) && ('' != $_POST[$strPrefix.$ID."_USER_TYPE_SETTINGS"]))
			{
				//$arResult["USER_TYPE_SETTINGS"] = unserialize(base64_decode($_POST[$strPrefix.$ID."_USER_TYPE_SETTINGS"]));
				$arTempo = base64_decode($_POST[$strPrefix.$ID."_USER_TYPE_SETTINGS"]);
				$arResult["USER_TYPE_SETTINGS"] = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : false);
			}
		}
		else
		{
			$arResult["PROPERTY_TYPE"] = $_POST[$strPrefix.$ID."_PROPERTY_TYPE"];
			$arResult["USER_TYPE"] = false;
			$arResult["USER_TYPE_SETTINGS"] = false;
		}

		if(COption::GetOptionString("iblock", "show_xml_id", "N")=="Y" && is_set($_POST, $strPrefix.$ID."_XML_ID"))
			$arResult["XML_ID"] = $_POST[$strPrefix.$ID."_XML_ID"];

		if (true == $bVarsFromForm)
		{
			$arResult['VALUES'] = array();
			if ((true == isset($_POST[$strPrefix.$ID."_VALUES"])) && ('' != $_POST[$strPrefix.$ID."_VALUES"]))
			{
				//$arResult['VALUES'] = unserialize(base64_decode($_POST[$strPrefix.$ID."_VALUES"]));
				$arTempo = base64_decode($_POST[$strPrefix.$ID."_VALUES"]);
				$arResult['VALUES'] = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : array());
			}
			if (false == is_array($arResult['VALUES']))
				$arResult['VALUES'] = array();

			$arResult['VALUES_DEF'] = array();
			if ((true == isset($_POST[$strPrefix.$ID."_VALUES_DEF"])) && ('' != $_POST[$strPrefix.$ID."_VALUES_DEF"]))
			{
				//$arResult['VALUES_DEF'] = unserialize(base64_decode($_POST[$strPrefix.$ID."_VALUES_DEF"]));
				$arTempo = base64_decode($_POST[$strPrefix.$ID."_VALUES_DEF"]);
				$arResult['VALUES_DEF'] = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : array());
			}
			if (false == is_array($arResult['VALUES_DEF']))
				$arResult['VALUES_DEF'] = array();

			$arResult['VALUES_SORT'] = array();
			if ((true == isset($_POST[$strPrefix.$ID."_VALUES_SORT"])) && ('' != $_POST[$strPrefix.$ID."_VALUES_SORT"]))
			{
				//$arResult['VALUES_SORT'] = unserialize(base64_decode($_POST[$strPrefix.$ID."_VALUES_SORT"]));
				$arTempo = base64_decode($_POST[$strPrefix.$ID."_VALUES_SORT"]);
				$arResult['VALUES_SORT'] = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : array());
			}
			if (false == is_array($arResult['VALUES_SORT']))
				$arResult['VALUES_SORT'] = array();

			$arResult['VALUES_XML'] = array();
			if ((true == isset($_POST[$strPrefix.$ID."_VALUES_XML"])) && ('' != $_POST[$strPrefix.$ID."_VALUES_XML"]))
			{
				//$arResult['VALUES_XML'] = unserialize(base64_decode($_POST[$strPrefix.$ID."_VALUES_XML"]));
				$arTempo = base64_decode($_POST[$strPrefix.$ID."_VALUES_XML"]);
				$arResult['VALUES_XML'] = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : array());
			}
			if (false == is_array($arResult['VALUES_XML']))
				$arResult['VALUES_XML'] = array();

			$arResult['CNT'] = intval($_POST[$strPrefix.$ID."_CNT"]);
			if (0 >= $arResult['CNT'])
				$arResult['CNT'] = sizeof($arResult['VALUES']);
		}
		else
		{
			if ((true == isset($_POST[$strPrefix.$ID."_CNT"])) && (0 < intval($_POST[$strPrefix.$ID."_CNT"])))
			{
				$arResult["VALUES"] = Array();

				$arDEFS = array();
				if ((true == isset($_POST[$strPrefix.$ID."_VALUES_DEF"])) && ('' != $_POST[$strPrefix.$ID."_VALUES_DEF"]))
				{
					//$arDEFS = unserialize(base64_decode($_POST[$strPrefix.$ID."_VALUES_DEF"]));
					$arTempo = base64_decode($_POST[$strPrefix.$ID."_VALUES_DEF"]);
					$arDEFS = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : array());
				}
				if (false == is_array($arDEFS))
					$arDEFS = array();

				$arSORTS = array();
				if ((true == isset($_POST[$strPrefix.$ID."_VALUES_SORT"])) && ('' != $_POST[$strPrefix.$ID."_VALUES_SORT"]))
				{
					//$arSORTS = unserialize(base64_decode($_POST[$strPrefix.$ID."_VALUES_SORT"]));
					$arTempo = base64_decode($_POST[$strPrefix.$ID."_VALUES_SORT"]);
					$arSORTS = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : array());
				}
				if (false == is_array($arSORTS))
					$arSORTS = array();

				$arXML = array();
				if ((true == isset($_POST[$strPrefix.$ID."_VALUES_XML"])) && ('' != $_POST[$strPrefix.$ID."_VALUES_XML"]))
				{
					//$arXML = unserialize(base64_decode($_POST[$strPrefix.$ID."_VALUES_XML"]));
					$arTempo = base64_decode($_POST[$strPrefix.$ID."_VALUES_XML"]);
					$arXML = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : array());
				}
				if (false == is_array($arXML))
					$arXML = array();

				$arValues = array();
				if ((true == isset($_POST[$strPrefix.$ID."_VALUES"])) && ('' != $_POST[$strPrefix.$ID."_VALUES"]))
				{
					//$arValues = unserialize(base64_decode($_POST[$strPrefix.$ID."_VALUES"]));
					$arTempo = base64_decode($_POST[$strPrefix.$ID."_VALUES"]);
					$arValues = (true == CheckSerializedData($arTempo) ? unserialize($arTempo) : array());
				}
				if (false == is_array($arValues))
					$arValues = array();

				if(false == empty($arValues))
				{
					foreach($arValues as $key=>$val)
					{
						$arResult["VALUES"][$key] = array(
							"VALUE" => $val,
							"DEF" => (true == in_array($key, $arDEFS) ? "Y" : "N")
						);
						if (0 < intval($arSORTS[$key]))
							$arResult["VALUES"][$key]["SORT"] = intval($arSORTS[$key]);
						if (0 < strlen($arXML[$key]))
							$arResult["VALUES"][$key]["XML_ID"] = $arXML[$key];
					}
				}
			}
		}
		if (0 < intval($ID))
		{
			$arResult['DEL'] = (true == isset($_POST[$strPrefix.$ID."_DEL"]) && ('Y' == $_POST[$strPrefix.$ID."_DEL"]) ? 'Y' : 'N');
		}
	}
	return $arResult;
}

function GetSKUProperty($ID,$SKUID)
{
	$arResult = false;
	$ID = intval($ID);
	$SKUID = intval($SKUID);
	if ((0 < $ID) && (0 < $SKUID))
	{
		$rsProps = CIBlockProperty::GetList(array(),array('IBLOCK_ID' => $SKUID,'PROPERTY_TYPE' => 'E','LINK_IBLOCK_ID' => $ID,'ACTIVE' => 'Y'));
		while ($arProp = $rsProps->Fetch())
		{
			if ((true == is_array($arProp)) && ('N' == $arProp['MULTIPLE']))
			{
				$arResult = $arProp;
				break;
			}
		}
	}
	return $arResult;
}

function CheckSKUProperty($ID,$SKUID)
{
	$arResult = false;
	$ID = intval($ID);
	$SKUID = intval($SKUID);
	if ((0 < $ID) && (0 < $SKUID))
	{
		$intSKUPropID = 0;
		$ibp = new CIBlockProperty();
		$arProp = GetSKUProperty($ID,$SKUID);

		if ((false === $arProp) || ((true == is_array($arProp)) && ('N' != $arProp['MULTIPLE'])))
		{
			$arOFProperty = array(
				'NAME' => GetMessage('IB_E_OF_SKU_PROPERTY_NAME'),
				'IBLOCK_ID' => $SKUID,
				'PROPERTY_TYPE' => 'E',
				'USER_TYPE' =>'SKU',
				'LINK_IBLOCK_ID' => $ID,
				'ACTIVE' => 'Y',
				'SORT' => '5',
				'MULTIPLE' => 'N',
				'CODE' => 'CML2_LINK',
				'XML_ID' => 'CML2_LINK',
				'IS_REQUIRED' => 'Y',
				"FILTRABLE" => "Y",
				"SEARCHABLE" => "N",
			);
			$intSKUPropID = $ibp->Add($arOFProperty);
			if (!$intSKUPropID)
			{
				$arResult = array(
					'RESULT' => 'ERROR',
					'MESSAGE' => $ibp->LAST_ERROR,
				);
			}
		}
		elseif (('Y' != $arProp['IS_REQUIRED']) || ('SKU' != $arProp['USER_TYPE']) || ('CML2_LINK' != $arProp['XML_ID']))
		{
			$boolFlag = $ibp->Update($arProp['ID'],array('IS_REQUIRED' => 'Y','USER_TYPE' => 'SKU','XML_ID' => 'CML2_LINK'));
			if (false === $boolFlag)
			{
				$arResult = array(
					'RESULT' => 'ERROR',
					'MESSAGE' => $ibp->LAST_ERROR,
				);
			}
			else
				$intSKUPropID = $arProp['ID'];
		}
		else
		{
			$intSKUPropID = $arProp['ID'];
		}
		if (0 < intval($intSKUPropID))
			$arResult = array(
				'RESULT' => 'OK',
				'VALUE' => $intSKUPropID,
			);
	}
	else
	{
		$arResult = array(
			'RESULT' => 'ERROR',
			'MESSAGE' => GetMessage('IB_E_OF_ERR_SKU_IBLOCKS_IS_ABSENT'),
		);
	}
	return $arResult;
}

function ConvertToSafe($arProp,$arDisFields)
{
	if (true == is_array($arProp))
	{
		foreach ($arProp as $key => $value)
		{
			if (false == in_array($key,$arDisFields))
			{
				if (false == is_array($value))
				{
					$arProp[$key] = htmlspecialchars($value);
				}
				else
				{
					$arTempo = array();
					foreach ($value as $subkey => $subvalue)
					{
						$arTempo[$subkey] = htmlspecialchars($subvalue);
					}
					$arProp[$key] = $arTempo;
				}
			}
		}
	}
	else
	{
		$arProp = htmlspecialchars($arProp);
	}
	return $arProp;
}

function __AddPropCellID($intOFPropID,$strPrefix,$arPropInfo)
{
	return (0 < intval($intOFPropID) ? $intOFPropID : '');
}

function __AddPropCellName($intOFPropID,$strPrefix,$arPropInfo)
{
	$strResult = '';
	ob_start();
	?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_FILE_TYPE" id="<?echo $strPrefix.$intOFPropID?>_FILE_TYPE" value="<?echo $arPropInfo['FILE_TYPE']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_LIST_TYPE" id="<?echo $strPrefix.$intOFPropID?>_LIST_TYPE" value="<?echo $arPropInfo['LIST_TYPE']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_ROW_COUNT" id="<?echo $strPrefix.$intOFPropID?>_ROW_COUNT" value="<?echo $arPropInfo['ROW_COUNT']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_COL_COUNT" id="<?echo $strPrefix.$intOFPropID?>_COL_COUNT" value="<?echo $arPropInfo['COL_COUNT']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_LINK_IBLOCK_ID" id="<?echo $strPrefix.$intOFPropID?>_LINK_IBLOCK_ID" value="<?echo $arPropInfo['LINK_IBLOCK_ID']?>">
	<?if(is_array($arPropInfo['DEFAULT_VALUE'])):
		$arSerial = array();
		foreach($arPropInfo['DEFAULT_VALUE'] as $key=>$value):
			$arSerial[$key] = htmlspecialchars($value);
		endforeach; ?>
		<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_DEFAULT_VALUE" id="<?echo $strPrefix.$intOFPropID?>_DEFAULT_VALUE" value="<?echo base64_encode(serialize($arSerial));?>"><?
		unset($arSerial);
	else:?>
		<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_DEFAULT_VALUE" id="<?echo $strPrefix.$intOFPropID?>_DEFAULT_VALUE" value="<?echo ('' != $arPropInfo['DEFAULT_VALUE'] ? base64_encode(serialize(htmlspecialchars($arPropInfo['DEFAULT_VALUE']))) : '');?>">
	<?endif?>
	<?if(is_array($arPropInfo['USER_TYPE_SETTINGS'])):
		$arSerial = array();
		foreach($arPropInfo['USER_TYPE_SETTINGS'] as $key=>$value):
			//$arSerial[$key] = htmlspecialchars($value);
			$arSerial[$key] = $value;
		endforeach?>
		<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_USER_TYPE_SETTINGS" id="<?echo $strPrefix.$intOFPropID?>_USER_TYPE_SETTINGS" value="<?echo base64_encode(serialize($arSerial)); ?>"><?
		unset($arSerial);
	else:?>
		<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_USER_TYPE_SETTINGS" id="<?echo $strPrefix.$intOFPropID?>_USER_TYPE_SETTINGS" value="<?echo ('' != $arPropInfo['USER_TYPE_SETTINGS'] ? base64_encode(serialize(htmlspecialchars($arPropInfo['USER_TYPE_SETTINGS']))) : '');?>">
	<?endif?>
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_WITH_DESCRIPTION" id="<?echo $strPrefix.$intOFPropID?>_WITH_DESCRIPTION" value="<?echo $arPropInfo['WITH_DESCRIPTION']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_SEARCHABLE" id="<?echo $strPrefix.$intOFPropID?>_SEARCHABLE" value="<?echo $arPropInfo['SEARCHABLE']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_FILTRABLE" id="<?echo $strPrefix.$intOFPropID?>_FILTRABLE" value="<?echo $arPropInfo['FILTRABLE']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_ACTIVE" id="<?echo $strPrefix.$intOFPropID?>_ACTIVE" value="<?echo $arPropInfo['ACTIVE']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_MULTIPLE_CNT" id="<?echo $strPrefix.$intOFPropID?>_MULTIPLE_CNT" value="<?echo $arPropInfo['MULTIPLE_CNT']?>">
	<input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_XML_ID" id="<?echo $strPrefix.$intOFPropID?>_XML_ID" value="<?echo $arPropInfo['XML_ID']?>">
	<?
	if($arPropInfo['PROPERTY_TYPE']=="L")
	{
		$arPROPERTY_VALUES = $arPropInfo['VALUES'];
		if(is_array($arPROPERTY_VALUES))
		{
			$arSerial = array();
			foreach($arPROPERTY_VALUES as $key=>$value)
			{
				if(strlen($value)<=0)
					continue;
				//$arSerial[$key] = htmlspecialchars($value);
				$arSerial[$key] = $value;
			}
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES" id="<? echo $strPrefix.$intOFPropID?>_VALUES" value="<? echo base64_encode(serialize($arSerial));?>"><?
			unset($arSerial);
		}
		else
		{
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES" id="<? echo $strPrefix.$intOFPropID?>_VALUES" value=""><?
		}

		$arPROPERTY_VALUES_DEF = $arPropInfo['VALUES_DEF'];
		if(is_array($arPROPERTY_VALUES_DEF))
		{
			$arSerial = array();
			foreach($arPROPERTY_VALUES_DEF as $key=>$value)
			{
				if(strlen($value)<=0)
					continue;
				//$arSerial[$key] = htmlspecialchars($value);
				$arSerial[$key] = $value;
			}
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_DEF" id="<? echo $strPrefix.$intOFPropID?>_VALUES_DEF" value="<? echo base64_encode(serialize($arSerial));?>"><?
			unset($arSerial);
		}
		else
		{
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_DEF" id="<? echo $strPrefix.$intOFPropID?>_VALUES_DEF" value=""><?
		}

		//$arPROPERTY_VALUES_XML = ${"PROPERTY_".$intOFPropID."_VALUES_XML"};
		$arPROPERTY_VALUES_XML = $arPropInfo['VALUES_XML'];
		if(is_array($arPROPERTY_VALUES_XML))
		{
			$arSerial = array();
			foreach($arPROPERTY_VALUES_XML as $key=>$value)
			{
				if(strlen($value)<=0)
					continue;
				//$arSerial[$key] = htmlspecialchars($value);
				$arSerial[$key] = $value;
			}
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_XML" id="<? echo $strPrefix.$intOFPropID?>_VALUES_XML" value="<? echo base64_encode(serialize($arSerial));?>"><?
			unset($arSerial);
		}
		else
		{
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_XML" id="<? echo $strPrefix.$intOFPropID?>_VALUES_XML" value=""><?
		}

		//$arPROPERTY_VALUES_SORT = ${"PROPERTY_".$intOFPropID."_VALUES_SORT"};
		$arPROPERTY_VALUES_SORT = $arPropInfo['VALUES_SORT'];
		if(is_array($arPROPERTY_VALUES_SORT))
		{
			$arSerial = array();
			foreach($arPROPERTY_VALUES_SORT as $key=>$value)
			{
				if(strlen($value)<=0)
					continue;
				//$arSerial[$key] = htmlspecialchars($value);
				$arSerial[$key] = $value;
			}
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_SORT" id="<? echo $strPrefix.$intOFPropID?>_VALUES_SORT" value="<? echo base64_encode(serialize($arSerial));?>"><?
			unset($arSerial);
		}
		else
		{
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_SORT" id="<? echo $strPrefix.$intOFPropID?>_VALUES_SORT" value=""><?
		}

		//if(IntVal(${"PROPERTY_".$intOFPropID."_CNT"})>0):
		if(0 < intval($arPropInfo['CNT']))
		{
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_CNT" id="<? echo $strPrefix.$intOFPropID?>_CNT" value="<? echo intval($arPropInfo['CNT'])?>"><?
		}
		else
		{
			?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_CNT" id="<? echo $strPrefix.$intOFPropID?>_CNT" value="0"><?
		}
	}
	else
	{
		?><input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES" id="<? echo $strPrefix.$intOFPropID?>_VALUES" value="">
		<input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_DEF" id="<? echo $strPrefix.$intOFPropID?>_VALUES_DEF" value="">
		<input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_XML" id="<? echo $strPrefix.$intOFPropID?>_VALUES_XML" value="">
		<input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_VALUES_SORT" id="<? echo $strPrefix.$intOFPropID?>_VALUES_SORT" value="">
		<input type="hidden" name="<? echo $strPrefix.$intOFPropID?>_CNT" id="<? echo $strPrefix.$intOFPropID?>_CNT" value="0">
		<?
	}
	?>
	<input type="text" size="20"  maxlength="50" name="<?echo $strPrefix.$intOFPropID?>_NAME" id="<?echo $strPrefix.$intOFPropID?>_NAME" value="<?echo $arPropInfo['NAME']?>">
	<?
	$strResult = ob_get_contents();
	ob_end_clean();
	return $strResult;
}

function __AddPropCellType($intOFPropID,$strPrefix,$arPropInfo)
{
	$strResult = '';
	ob_start();
	?><select name="<?echo $strPrefix.$intOFPropID?>_PROPERTY_TYPE" id="<?echo $strPrefix.$intOFPropID?>_PROPERTY_TYPE">
		<option value="S" <?if($arPropInfo['PROPERTY_TYPE']=="S" && !$arPropInfo['USER_TYPE'])echo " selected"?>><?echo GetMessage("IB_E_PROP_TYPE_S")?></option>
		<option value="N" <?if($arPropInfo['PROPERTY_TYPE']=="N" && !$arPropInfo['USER_TYPE'])echo " selected"?>><?echo GetMessage("IB_E_PROP_TYPE_N")?></option>
		<option value="L" <?if($arPropInfo['PROPERTY_TYPE']=="L" && !$arPropInfo['USER_TYPE'])echo " selected"?>><?echo GetMessage("IB_E_PROP_TYPE_L")?></option>
		<option value="F" <?if($arPropInfo['PROPERTY_TYPE']=="F" && !$arPropInfo['USER_TYPE'])echo " selected"?>><?echo GetMessage("IB_E_PROP_TYPE_F")?></option>
		<option value="G" <?if($arPropInfo['PROPERTY_TYPE']=="G" && !$arPropInfo['USER_TYPE'])echo " selected"?>><?echo GetMessage("IB_E_PROP_TYPE_G")?></option>
		<option value="E" <?if($arPropInfo['PROPERTY_TYPE']=="E" && !$arPropInfo['USER_TYPE'])echo " selected"?>><?echo GetMessage("IB_E_PROP_TYPE_E")?></option>
		<?foreach(CIBlockProperty::GetUserType() as  $ar):?>
		<option value="<?=htmlspecialchars($ar["PROPERTY_TYPE"].":".$ar["USER_TYPE"])?>" <?if($arPropInfo['PROPERTY_TYPE']==$ar["PROPERTY_TYPE"] && $arPropInfo['USER_TYPE']==$ar["USER_TYPE"])echo " selected"?>><?=htmlspecialchars($ar["DESCRIPTION"])?></option>
		<?endforeach;?>
	</select><?
	$strResult = ob_get_contents();
	ob_end_clean();
	return $strResult;
}

function __AddPropCellMulti($intOFPropID,$strPrefix,$arPropInfo)
{
	$strResult = '';
	ob_start();
	?><input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_MULTIPLE" id="<?echo $strPrefix.$intOFPropID?>_MULTIPLE_N" value="N">
	<input type="checkbox" name="<?echo $strPrefix.$intOFPropID?>_MULTIPLE" id="<?echo $strPrefix.$intOFPropID?>_MULTIPLE_Y" value="Y"<?if($arPropInfo['MULTIPLE']=="Y")echo " checked"?>>
	<?
	$strResult = ob_get_contents();
	ob_end_clean();
	return $strResult;
}

function __AddPropCellReq($intOFPropID,$strPrefix,$arPropInfo)
{
	$strResult = '';
	ob_start();
	?><input type="hidden" name="<?echo $strPrefix.$intOFPropID?>_IS_REQUIRED" id="<?echo $strPrefix.$intOFPropID?>_IS_REQUIRED_N" value="N">
	<input type="checkbox" name="<?echo $strPrefix.$intOFPropID?>_IS_REQUIRED" id="<?echo $strPrefix.$intOFPropID?>_IS_REQUIRED_Y" value="Y"<?if($arPropInfo['IS_REQUIRED']=="Y")echo " checked"?>><?
	$strResult = ob_get_contents();
	ob_end_clean();
	return $strResult;
}

function __AddPropCellSort($intOFPropID,$strPrefix,$arPropInfo)
{
	$strResult = '';
	ob_start();
	?><input type="text" size="3" maxlength="10"  name="<?echo $strPrefix.$intOFPropID?>_SORT" id="<?echo $strPrefix.$intOFPropID?>_SORT" value="<?echo $arPropInfo['SORT']?>"><?
	$strResult = ob_get_contents();
	ob_end_clean();
	return $strResult;
}

function __AddPropCellCode($intOFPropID,$strPrefix,$arPropInfo)
{
	$strResult = '';
	ob_start();
	?><input type="text" size="15" maxlength="20"  name="<?echo $strPrefix.$intOFPropID?>_CODE" id="<?echo $strPrefix.$intOFPropID?>_CODE" value="<?echo $arPropInfo['CODE']?>"><?
	$strResult = ob_get_contents();
	ob_end_clean();
	return $strResult;
}

function __AddPropCellDetail($intOFPropID,$strPrefix,$arPropInfo)
{
/*	$strResult = '';
	ob_start();
	?><input type="button" title="<?echo GetMessage("IB_E_PROP_EDIT_TITLE")?>" name="of_propedit[<?echo $intOFPropID?>]" value="..." onclick="ShowPropertyDialog('<? echo $strPrefix; ?>','<? echo $intOFPropID;?>','<? echo $arPropInfo['IBLOCK_ID']?>');"><?
	$strResult = ob_get_contents();
	ob_end_clean();
	return $strResult; */
	return '<input type="button" title="'.GetMessage("IB_E_PROP_EDIT_TITLE").'" name="'.$strPrefix.$intOFPropID.'_BTN" id="'.$strPrefix.$intOFPropID.'_BTN" value="...">';
}

function __AddPropCellDelete($intOFPropID,$strPrefix,$arPropInfo)
{
	$strResult = '&nbsp;';
	if ((true == isset($arPropInfo['SHOW_DEL'])) && ('Y' == $arPropInfo['SHOW_DEL']))
		$strResult = '<input type="checkbox" name="'.$strPrefix.$intOFPropID.'_DEL" id="'.$strPrefix.$intOFPropID.'_DEL" value="Y">';
	return $strResult;
}

function __AddPropRow($intOFPropID,$strPrefix,$arPropInfo)
{
	$strResult = '<tr id="'.$strPrefix.$intOFPropID.'">
	<td>'.__AddPropCellID($intOFPropID,$strPrefix,$arPropInfo).'</td>
	<td>'.__AddPropCellName($intOFPropID,$strPrefix,$arPropInfo).'</td>
	<td>'.__AddPropCellType($intOFPropID,$strPrefix,$arPropInfo).'</td>
	<td style="text-align: center;">'.__AddPropCellMulti($intOFPropID,$strPrefix,$arPropInfo).'</td>
	<td style="text-align: center;">'.__AddPropCellReq($intOFPropID,$strPrefix,$arPropInfo).'</td>
	<td>'.__AddPropCellSort($intOFPropID,$strPrefix,$arPropInfo).'</td>
	<td>'.__AddPropCellCode($intOFPropID,$strPrefix,$arPropInfo).'</td>
	<td style="text-align: center;">'.__AddPropCellDetail($intOFPropID,$strPrefix,$arPropInfo).'</td>
	<td style="text-align: center;">'.__AddPropCellDelete($intOFPropID,$strPrefix,$arPropInfo).'</td>
	</tr>';

	return $strResult;
}

$arCellTemplates = array();
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellID('tmp_xxx','PREFIX',$arDefPropInfo));
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellName('tmp_xxx','PREFIX',$arDefPropInfo));
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellType('tmp_xxx','PREFIX',$arDefPropInfo));
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellMulti('tmp_xxx','PREFIX',$arDefPropInfo));
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellReq('tmp_xxx','PREFIX',$arDefPropInfo));
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellSort('tmp_xxx','PREFIX',$arDefPropInfo));
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellCode('tmp_xxx','PREFIX',$arDefPropInfo));
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellDetail('tmp_xxx','PREFIX',$arDefPropInfo));
$arCellTemplates[] = CUtil::JSEscape(__AddPropCellDelete('tmp_xxx','PREFIX',$arDefPropInfo));

$arCellAttr = array(4,5,8,9);

$bBizproc = CModule::IncludeModule("bizproc");
$bCatalog = false;
$bCatalog = CModule::IncludeModule('catalog');

$arIBTYPE = CIBlockType::GetByIDLang($type, LANG);

if($arIBTYPE!==false):

$strWarning="";
$bVarsFromForm = false;
$ID=IntVal($ID);

$Perm = CIBlock::GetPermission($ID);
if($Perm>="X" && $REQUEST_METHOD=="POST" && strlen($_POST["Update"])>0 && !isset($_POST["propedit"]) && check_bitrix_sessid())
{
	$DB->StartTransaction();

	$arPICTURE = $HTTP_POST_FILES["PICTURE"];
	$arPICTURE["del"] = ${"PICTURE_del"};
	$arPICTURE["MODULE_ID"] = "iblock";

	if ($VERSION != 2) $VERSION = 1;
	if ($RSS_ACTIVE != "Y") $RSS_ACTIVE = "N";
	if ($RSS_FILE_ACTIVE != "Y") $RSS_FILE_ACTIVE = "N";
	if ($RSS_YANDEX_ACTIVE != "Y") $RSS_YANDEX_ACTIVE = "N";

	$ib = new CIBlock();
	$arFields = Array(
		"ACTIVE"=>$ACTIVE,
		"NAME"=>$NAME,
		"CODE"=>$CODE,
		"LIST_PAGE_URL"=>$LIST_PAGE_URL,
		"DETAIL_PAGE_URL"=>$DETAIL_PAGE_URL,
		"INDEX_ELEMENT"=>$INDEX_ELEMENT,
		"IBLOCK_TYPE_ID"=>$type,
		"LID"=>$LID,
		"SORT"=>$SORT,
		"PICTURE"=>$arPICTURE,
		"DESCRIPTION"=>$DESCRIPTION,
		"DESCRIPTION_TYPE"=>$DESCRIPTION_TYPE,
		"EDIT_FILE_BEFORE"=>$EDIT_FILE_BEFORE,
		"EDIT_FILE_AFTER"=>$EDIT_FILE_AFTER,
		"WORKFLOW"=>$WF_TYPE=="WF"? "Y": "N",
		"BIZPROC"=>$WF_TYPE=="BP"? "Y": "N",
		"SECTION_CHOOSER"=>$SECTION_CHOOSER,
		"LIST_MODE"=>$LIST_MODE,
		"FIELDS" => $_REQUEST["FIELDS"],
		//MESSAGES
		"ELEMENTS_NAME"=>$ELEMENTS_NAME,
		"ELEMENT_NAME"=>$ELEMENT_NAME,
		"ELEMENT_ADD"=>$ELEMENT_ADD,
		"ELEMENT_EDIT"=>$ELEMENT_EDIT,
		"ELEMENT_DELETE"=>$ELEMENT_DELETE,
		);

	if($arIBTYPE["SECTIONS"]=="Y")
	{
		$arFields["SECTION_PAGE_URL"]=$SECTION_PAGE_URL;
		$arFields["INDEX_SECTION"]=$INDEX_SECTION;
		//MESSAGES
		$arFields["SECTIONS_NAME"]=$SECTIONS_NAME;
		$arFields["SECTION_NAME"]=$SECTION_NAME;
		$arFields["SECTION_ADD"]=$SECTION_ADD;
		$arFields["SECTION_EDIT"]=$SECTION_EDIT;
		$arFields["SECTION_DELETE"]=$SECTION_DELETE;
	}

	if(COption::GetOptionString("iblock", "show_xml_id", "N")=="Y" && is_set($_POST, "XML_ID"))
		$arFields["XML_ID"] = $_POST["XML_ID"];

	if($arIBTYPE["IN_RSS"]=="Y")
	{
		$arFields = array_merge($arFields, Array(
			"RSS_ACTIVE"=>$RSS_ACTIVE,
			"RSS_FILE_ACTIVE"=>$RSS_FILE_ACTIVE,
			"RSS_YANDEX_ACTIVE"=>$RSS_YANDEX_ACTIVE,
			"RSS_FILE_LIMIT"=>$RSS_FILE_LIMIT,
			"RSS_FILE_DAYS"=>$RSS_FILE_DAYS,
			"RSS_TTL"=>$RSS_TTL)
			);
	}

	if($Perm=="X")
		$arFields["GROUP_ID"]=$GROUP;

	//Assembly properties for check followed by add/update
	$arProperties = array();
	if($ID > 0)
	{
		$props = CIBlock::GetProperties($ID);
		while($p = $props->Fetch())
		{
/*			$arProperty = array(
				//All but IBLOCK_ID
				"NAME" => ${"PROPERTY_".$p["ID"]."_NAME"},
				"ACTIVE" => ${"PROPERTY_".$p["ID"]."_ACTIVE"},
				"SORT" => ${"PROPERTY_".$p["ID"]."_SORT"},
				"DEFAULT_VALUE" => ${"PROPERTY_".$p["ID"]."_DEFAULT_VALUE"},
				"CODE" => ${"PROPERTY_".$p["ID"]."_CODE"},
				"ROW_COUNT" => ${"PROPERTY_".$p["ID"]."_ROW_COUNT"},
				"COL_COUNT" => ${"PROPERTY_".$p["ID"]."_COL_COUNT"},
				"LINK_IBLOCK_ID" => ${"PROPERTY_".$p["ID"]."_LINK_IBLOCK_ID"},
				"WITH_DESCRIPTION" => ${"PROPERTY_".$p["ID"]."_WITH_DESCRIPTION"},
				"FILTRABLE" => ${"PROPERTY_".$p["ID"]."_FILTRABLE"},
				"SEARCHABLE" => ${"PROPERTY_".$p["ID"]."_SEARCHABLE"},
				"MULTIPLE"  => ${"PROPERTY_".$p["ID"]."_MULTIPLE"},
				"MULTIPLE_CNT" => ${"PROPERTY_".$p["ID"]."_MULTIPLE_CNT"},
				"IS_REQUIRED" => ${"PROPERTY_".$p["ID"]."_IS_REQUIRED"},
				"FILE_TYPE" => ${"PROPERTY_".$p["ID"]."_FILE_TYPE"},
				"LIST_TYPE" => ${"PROPERTY_".$p["ID"]."_LIST_TYPE"},
			);
			if(strstr(${"PROPERTY_".$p["ID"]."_PROPERTY_TYPE"}, ":")!==false)
			{
				list($arProperty["PROPERTY_TYPE"], $arProperty["USER_TYPE"])=explode(":", ${"PROPERTY_".$p["ID"]."_PROPERTY_TYPE"}, 2);
				$arProperty["USER_TYPE_SETTINGS"] = ${"PROPERTY_".$p["ID"]."_USER_TYPE_SETTINGS"};
			}
			else
			{
				$arProperty["PROPERTY_TYPE"] = ${"PROPERTY_".$p["ID"]."_PROPERTY_TYPE"};
				$arProperty["USER_TYPE"] = false;
				$arProperty["USER_TYPE_SETTINGS"] = false;
			}

			if(COption::GetOptionString("iblock", "show_xml_id", "N")=="Y" && is_set($_POST, "PROPERTY_".$p["ID"]."_XML_ID"))
				$arProperty["XML_ID"] = $_POST["PROPERTY_".$p["ID"]."_XML_ID"];

			if(isset($_POST["PROPERTY_".$p["ID"]."_CNT"]))
			{
				$arProperty["VALUES"] = Array();

				$arDEFS = ${"PROPERTY_".$p["ID"]."_VALUES_DEF"};
				if(!is_array($arDEFS))
					$arDEFS = Array();
				$arSORTS = ${"PROPERTY_".$p["ID"]."_VALUES_SORT"};
				if(!is_array($arSORTS))
					$arSORTS = Array();
				$arXML = ${"PROPERTY_".$p["ID"]."_VALUES_XML"};
				if(!is_array($arXML))
					$arXML = Array();

				if(is_array(${"PROPERTY_".$p["ID"]."_VALUES"}))
				{
					foreach(${"PROPERTY_".$p["ID"]."_VALUES"} as $key=>$val)
					{
						$arProperty["VALUES"][$key] = array(
							"VALUE" => $val,
							"DEF" => (in_array($key, $arDEFS)?"Y":"N")
						);
						if(IntVal($arSORTS[$key])>0)
							$arProperty["VALUES"][$key]["SORT"] = IntVal($arSORTS[$key]);
						if(strlen($arXML[$key])>0)
							$arProperty["VALUES"][$key]["XML_ID"] = $arXML[$key];
					}
				}
			} */

			$arProperty = GetPropertyInfo($strPREFIX_IB_PROPERTY,$p['ID'],false);
			$ibp = new CIBlockProperty();
			$res = $ibp->CheckFields($arProperty, $p["ID"], true);
			if(!$res)
			{
				$strWarning .= GetMessage("IB_E_PROPERTY_ERROR").": ".$ibp->LAST_ERROR."<br>";
				$bVarsFromForm = true;
			}

			$arProperties[$p["ID"]] = $arProperty;
		}
	}

	$intPropCount = intval($_POST['IBLOCK_PROPERTY_COUNT']);
	for($i=0; $i<$intPropCount; $i++)
	{
/*		if(strlen(${"PROPERTY_n".$i."_NAME"})<=0) continue;

		$arProperty = array(
			"NAME" => ${"PROPERTY_n".$i."_NAME"},
			"ACTIVE" => ${"PROPERTY_n".$i."_ACTIVE"},
			"SORT" => ${"PROPERTY_n".$i."_SORT"},
			"DEFAULT_VALUE" => ${"PROPERTY_n".$i."_DEFAULT_VALUE"},
			"CODE" => ${"PROPERTY_n".$i."_CODE"},
			"ROW_COUNT" => ${"PROPERTY_n".$i."_ROW_COUNT"},
			"COL_COUNT" => ${"PROPERTY_n".$i."_COL_COUNT"},
			"LINK_IBLOCK_ID" => ${"PROPERTY_n".$i."_LINK_IBLOCK_ID"},
			"WITH_DESCRIPTION" => ${"PROPERTY_n".$i."_WITH_DESCRIPTION"},
			"SEARCHABLE" => ${"PROPERTY_n".$i."_SEARCHABLE"},
			"FILTRABLE" => ${"PROPERTY_n".$i."_FILTRABLE"},
			"MULTIPLE" => ${"PROPERTY_n".$i."_MULTIPLE"},
			"MULTIPLE_CNT" => ${"PROPERTY_n".$i."_MULTIPLE_CNT"},
			"IS_REQUIRED" => ${"PROPERTY_n".$i."_IS_REQUIRED"},
			"FILE_TYPE" => ${"PROPERTY_n".$i."_FILE_TYPE"},
			"LIST_TYPE" => ${"PROPERTY_n".$i."_LIST_TYPE"},
			"IBLOCK_ID" => $ID,
		);
		if(strstr(${"PROPERTY_n".$i."_PROPERTY_TYPE"}, ":")!==false)
		{
			list($arProperty["PROPERTY_TYPE"], $arProperty["USER_TYPE"])=explode(":", ${"PROPERTY_n".$i."_PROPERTY_TYPE"}, 2);
			$arProperty["USER_TYPE_SETTINGS"] = ${"PROPERTY_n".$i."_USER_TYPE_SETTINGS"};
		}
		else
		{
			$arProperty["PROPERTY_TYPE"]=${"PROPERTY_n".$i."_PROPERTY_TYPE"};
			$arProperty["USER_TYPE"]=false;
			$arProperty["USER_TYPE_SETTINGS"]=false;
		}

		if(COption::GetOptionString("iblock", "show_xml_id", "N")=="Y" && is_set($_POST, "PROPERTY_n".$i."_XML_ID"))
			$arProperty["XML_ID"] = $_POST["PROPERTY_n".$i."_XML_ID"];

		if(isset($_POST["PROPERTY_n".$i."_CNT"]))
		{
			$arProperty["VALUES"] = Array();
			$arDEFS = ${"PROPERTY_n".$i."_VALUES_DEF"};
			if(!is_array($arDEFS))
				$arDEFS = Array();
			$arSORTS = ${"PROPERTY_n".$i."_VALUES_SORT"};
			if(!is_array($arSORTS))
				$arSORTS = Array();
			$arXML = ${"PROPERTY_n".$i."_VALUES_XML"};
			if(!is_array($arXML))
				$arXML = Array();
			if(is_array(${"PROPERTY_n".$i."_VALUES"}))
			{
				foreach(${"PROPERTY_n".$i."_VALUES"} as $key=>$val)
				{
					$arProperty["VALUES"][$key] = Array(
						"VALUE" => $val,
						"DEF" => (in_array($key, $arDEFS)?"Y":"N")
					);
					if(IntVal($arSORTS[$key])>0)
						$arProperty["VALUES"][$key]["SORT"] = IntVal($arSORTS[$key]);
					if(strlen($arXML[$key])>0)
						$arProperty["VALUES"][$key]["XML_ID"] = $arXML[$key];
				}
			}
		}*/

		$arProperty = GetPropertyInfo($strPREFIX_IB_PROPERTY,'n'.$i,false);
		if (false == is_array($arProperty))
			continue;
		$ibp = new CIBlockProperty();
		$res = $ibp->CheckFields($arProperty, false, true);
		if(!$res)
		{
			$strWarning .= $ibp->LAST_ERROR."<br>";
			$bVarsFromForm = true;
		}

		$arProperties["n".$i] = $arProperty;
	}

	$bCreateRecord = $ID <= 0;

	if(!$bVarsFromForm)
	{
		if($ID>0)
		{
			$res = $ib->Update($ID, $arFields);
		}
		else
		{
			$arFields["VERSION"]=$VERSION;
			$ID = $ib->Add($arFields);
			$res = ($ID>0);
		}

		if(!$res)
		{
			$strWarning .= $ib->LAST_ERROR."<br>";
			$bVarsFromForm = true;
		}
		else
		{
			// RSS agent creation
			if ($RSS_FILE_ACTIVE == "Y")
			{
				CAgent::RemoveAgent("CIBlockRSS::PreGenerateRSS(".$ID.", false);", "iblock");
				CAgent::AddAgent("CIBlockRSS::PreGenerateRSS(".$ID.", false);", "iblock", "N", IntVal($RSS_TTL)*60*60, "", "Y");
			}
			else
				CAgent::RemoveAgent("CIBlockRSS::PreGenerateRSS(".$ID.", false);", "iblock");

			if ($RSS_YANDEX_ACTIVE == "Y")
			{
				CAgent::RemoveAgent("CIBlockRSS::PreGenerateRSS(".$ID.", true);", "iblock");
				CAgent::AddAgent("CIBlockRSS::PreGenerateRSS(".$ID.", true);", "iblock", "N", IntVal($RSS_TTL)*60*60, "", "Y");
			}
			else
				CAgent::RemoveAgent("CIBlockRSS::PreGenerateRSS(".$ID.", true);", "iblock");

			/********************/
			foreach($arProperties as $property_id => $arProperty)
			{
				$arProperty["IBLOCK_ID"] = $ID;
				if(intval($property_id) > 0)
				{
					if ((true == isset($arProperty['DEL'])) && ('Y' == $arProperty['DEL']))
					{
						if(!CIBlockProperty::Delete($property_id) && ($ex = $APPLICATION->GetException()))
						{
							$strWarning .= GetMessage("IB_E_PROPERTY_ERROR").": ".$ex->GetString()."<br>";
							$bVarsFromForm = true;
						}
					}
					else
					{
						$ibp = new CIBlockProperty();
						$res = $ibp->Update($property_id, $arProperty);
						if(!$res)
						{
							$strWarning .= GetMessage("IB_E_PROPERTY_ERROR").": ".$ibp->LAST_ERROR."<br>";
							$bVarsFromForm = true;
						}
					}
				}
				else
				{
					$ibp = new CIBlockProperty();
					$PropID = $ibp->Add($arProperty);
					if(IntVal($PropID)<=0)
					{
						$strWarning .= $ibp->LAST_ERROR."<br>";
						$bVarsFromForm = true;
					}
				}
			}
			/*******************************************/

			if(!$bVarsFromForm && $arIBTYPE["IN_RSS"]=="Y")
			{
				CIBlockRSS::Delete($ID);
				$arNodesRSS = CIBlockRSS::GetRSSNodes();
				foreach($arNodesRSS as $key => $val)
				{
					if(strlen(${"RSS_NODE_VALUE_".$key}) > 0)
						CIBlockRSS::Add($ID, $val, ${"RSS_NODE_VALUE_".$key});
				}
			}

			if(!$bVarsFromForm && !$bCreateRecord && $bBizproc)
			{
				$arWorkflowTemplates = CBPDocument::GetWorkflowTemplatesForDocumentType(array("iblock", "CIBlockDocument", "iblock_".$ID));
				foreach ($arWorkflowTemplates as $t)
				{
					$create_bizproc = (array_key_exists("create_bizproc_".$t["ID"], $_REQUEST) && $_REQUEST["create_bizproc_".$t["ID"]] == "Y");
					$edit_bizproc = (array_key_exists("edit_bizproc_".$t["ID"], $_REQUEST) && $_REQUEST["edit_bizproc_".$t["ID"]] == "Y");

					$create_bizproc1 = (($t["AUTO_EXECUTE"] & 1) != 0);
					$edit_bizproc1 = (($t["AUTO_EXECUTE"] & 2) != 0);

					if ($create_bizproc != $create_bizproc1 || $edit_bizproc != $edit_bizproc1)
					{
						CBPDocument::UpdateWorkflowTemplate(
							$t["ID"],
							array("iblock", "CIBlockDocument", "iblock_".$ID),
							array(
								"AUTO_EXECUTE" => (($create_bizproc ? 1 : 0) | ($edit_bizproc ? 2 : 0))
							),
							$arErrorsTmp
						);
					}
				}
			}

			if (!$bVarsFromForm && $bCatalog)
			{
				$boolFlag = true;
				$obCatalog = new CCatalog();
				$arCatalog = $obCatalog->GetByIDExt($ID);

				$IS_CATALOG = ('Y' == $IS_CATALOG ? 'Y' : 'N');
				$SUBSCRIPTION = ('Y' == $SUBSCRIPTION ? 'Y' : 'N');
				$YANDEX_EXPORT = ('Y' == $YANDEX_EXPORT ? 'Y' : 'N');
				$VAT_ID = (0 < intval($VAT_ID) ? intval($VAT_ID) : 0);

				if ((true == is_array($arCatalog)) && ('O' == $arCatalog['CATALOG_TYPE']))
				{
					$IS_CATALOG = 'Y';
					$arOffersFields = array(
						'IBLOCK_ID' => $ID,
						'SUBSCRIPTION' => $SUBSCRIPTION,
						'YANDEX_EXPORT' => $YANDEX_EXPORT,
						'VAT_ID' => $VAT_ID,
					);
					$boolFlag = $obCatalog->Update($ID,$arCatalog);
					if (false == $boolFlag)
					{
						$bVarsFromForm = true;
						$ex = $APPLICATION->GetException();
						if (true == is_object($ex))
						{
							$strWarning .= $ex->GetString()."<br>";
						}
					}
				}
				else
				{
					$arOffersFields = array(
						'IBLOCK_ID' => $ID,
						'SUBSCRIPTION' => $SUBSCRIPTION,
						'YANDEX_EXPORT' => $YANDEX_EXPORT,
						'VAT_ID' => $VAT_ID,
					);

					if (false == $arCatalog || 'P' == $arCatalog['CATALOG_TYPE'])
					{
						if ('Y' == $IS_CATALOG)
						{
							$boolFlag = $obCatalog->Add($arOffersFields);
						}
					}
					else
					{
						if (('Y' == $IS_CATALOG) || ('Y' == $SUBSCRIPTION))
						{
							$boolFlag = $obCatalog->Update($ID,$arOffersFields);
						}
						elseif (('Y' != $IS_CATALOG) && ('Y' != $SUBSCRIPTION))
						{
							$boolFlag = $obCatalog->Delete($ID);
						}
					}
					if (false == $boolFlag)
					{
						$bVarsFromForm = true;
						if($ex = $APPLICATION->GetException())
						{
							$strWarning .= $ex->GetString()."<br>";
						}
					}
					if (!$bVarsFromForm)
					{
						// start offers
						if ('Y' == $USED_SKU)
						{
							if (0 == $OF_IBLOCK_ID)
							{
								$bVarsFromForm = true;
								$strWarning .= GetMessage('IB_E_OF_ERR_OFFERS_IS_ABSENT').'<br>';
							}
							elseif (CATALOG_NEW_OFFERS_IBLOCK_NEED == $OF_IBLOCK_ID)
							{
								$arCheckIBlockType = CheckIBlockTypeID($OF_IBLOCK_TYPE_ID,$OF_NEW_IBLOCK_TYPE_ID,$CREATE_OFFERS_TYPE);
								if (false === $arCheckIBlockType)
								{
									$bVarsFromForm = true;
									$strWarning .= GetMessage('IB_E_OF_ERR_IBLOCK_TYPE_UNKNOWN_ERR').'<br>';
								}
								else
								{
									if ('ERROR' == $arCheckIBlockType['RESULT'])
									{
										$bVarsFromForm = true;
										$strWarning .= $arCheckIBlockType['MESSAGE'].'<br>';
									}
									else
									{
										$OF_IBLOCK_TYPE_ID = $arCheckIBlockType['VALUE'];
										$CREATE_OFFERS_TYPE = 'N';
									}
								}
								if (!$bVarsFromForm)
								{
									$arGroup = $GROUP;
									foreach ($arGroup as $key => $value)
										if ('U' == $value)
											$arGroup[$key] = 'W';

									$arOffersFields = Array(
										"ACTIVE"=>'Y',
										"NAME"=>$OF_IBLOCK_NAME,
										"IBLOCK_TYPE_ID"=>$OF_IBLOCK_TYPE_ID,
										"LID"=>$LID,
										"WORKFLOW"=>"N",
										"BIZPROC"=>"N",
										'GROUP_ID' => $arGroup,
									);

									$obIBlock = new CIBlock();
									$mxOffersID = $obIBlock->Add($arOffersFields);
									if (false == $mxOffersID)
									{
										$strWarning .= $obIBlock->LAST_ERROR."<br>";
										$bVarsFromForm = true;
									}
									else
									{
										$OF_IBLOCK_ID = $mxOffersID;
									}
								}
							}
							if (!$bVarsFromForm)
							{
								$intCountOFProp = intval($OFFERS_PROPERTY_COUNT);
								$arOfPropList = array();
								for ($i = 0; $i < $intCountOFProp; $i++)
								{
									$arOFProperty = GetPropertyInfo($strPREFIX_OF_PROPERTY,'n'.$i);
									if (false !== $arOFProperty)
									{
										$ibp = new CIBlockProperty();
										$res = $ibp->CheckFields($arOFProperty, false, true);
										if(!$res)
										{
											$strWarning .= GetMessage("IB_E_PROPERTY_ERROR").": ".$ibp->LAST_ERROR."<br>";
											$bVarsFromForm = true;
										}
										$arOFProperty['IBLOCK_ID'] = $OF_IBLOCK_ID;
										$arOfPropList[] = $arOFProperty;
									}
								}
							}

							if (!$bVarsFromForm)
							{
								foreach ($arOfPropList as $arOFProperty)
								{
									$PropID = $ibp->Add($arOFProperty);
									if(IntVal($PropID)<=0)
									{
										$strWarning .= $ibp->LAST_ERROR."<br>";
										$bVarsFromForm = true;
									}
								}
							}

							if (!$bVarsFromForm)
							{
								$arSKUProp = CheckSKUProperty($ID,$OF_IBLOCK_ID);
								if ('OK' == $arSKUProp['RESULT'])
								{
									$intSKUPropID = $arSKUProp['VALUE'];
								}
								else
								{
									$bVarsFromForm = true;
									$strWarning .= $arSKUProp['MESSAGE'].'<br>';
								}
							}
							if (!$bVarsFromForm)
							{
								if ((false !== $arCatalog) && (0 < intval($arCatalog['OFFERS_IBLOCK_ID'])) &&($arCatalog['OFFERS_IBLOCK_ID'] != $OF_IBLOCK_ID))
								{
									$boolFlag = $obCatalog->UnLinkSKUIBlock($ID);
								}
								if ((false === $arCatalog) || ($arCatalog['OFFERS_IBLOCK_ID'] != $OF_IBLOCK_ID))
								{
									$arOffersFields = array(
										'IBLOCK_ID' => $OF_IBLOCK_ID,
										'PRODUCT_IBLOCK_ID' => $ID,
										'SKU_PROPERTY_ID' => $intSKUPropID
									);
									$arOFCatalog = CCatalog::GetByID($OF_IBLOCK_ID);
									if ($arOFCatalog)
									{
										$boolFlag = $obCatalog->Update($OF_IBLOCK_ID,$arOffersFields);
									}
									else
									{
										$boolFlag = $obCatalog->Add($arOffersFields);
									}
								}
								if($ex = $APPLICATION->GetException())
								{
									$strWarning .= $ex->GetString()."<br>";
									$bVarsFromForm = true;
								}
							}
						}
						else
						{
							if ((false !== $arCatalog) && (0 < intval($arCatalog['OFFERS_IBLOCK_ID'])))
							{
								$boolFlag = $obCatalog->UnLinkSKUIBlock($ID);
								if (false == $boolFlag)
								{
									$bVarsFromForm = true;
									$ex = $APPLICATION->GetException();
									if (true == is_object($ex))
									{
										$strWarning .= $ex->GetString()."<br>";
									}
								}
							}
						}
					}
				}

				if (false == $boolFlag)
				{
					if($ex = $APPLICATION->GetException())
					{
						$strWarning .= $ex->GetString()."<br>";
						$bVarsFromForm = true;
					}
				}
			}

			if(!$bVarsFromForm)
			{
				if(
					$bBizproc
					&& $_REQUEST['BIZ_PROC_ADD_DEFAULT_TEMPLATES']=='Y'
					&& CBPDocument::GetNumberOfWorkflowTemplatesForDocumentType(array("iblock", "CIBlockDocument", "iblock_".$ID))<=0
					&& $arFields["BIZPROC"] == "Y"
				)
					CBPDocument::AddDefaultWorkflowTemplates(array("iblock", "CIBlockDocument", "iblock_".$ID));

				$DB->Commit();

				//Check if index needed
				CIBlock::CheckForIndexes($ID);

				if(strlen($apply)<=0)
				{
					if(strlen($_REQUEST["return_url"])>0)
						LocalRedirect($_REQUEST["return_url"]);
					else
						LocalRedirect("/bitrix/admin/iblock_admin.php?type=".$type."&lang=".LANG."&admin=".($_REQUEST["admin"]=="Y"? "Y": "N"));
				}
				LocalRedirect("/bitrix/admin/iblock_edit.php?type=".$type."&tabControl_active_tab=".urlencode($tabControl_active_tab)."&lang=".LANG."&ID=".$ID."&admin=".($_REQUEST["admin"]=="Y"? "Y": "N").(strlen($_REQUEST["return_url"])>0? "&return_url=".urlencode($_REQUEST["return_url"]): ""));
			}
		}
	}

	$DB->Rollback();
}

if($Perm>="X" && $REQUEST_METHOD=="GET" && intval($_REQUEST["delete_bizproc_template"])>0 && check_bitrix_sessid() && $bBizproc)
{
	$arErrorTmp = array();
	CBPDocument::DeleteWorkflowTemplate($_REQUEST["delete_bizproc_template"], array("iblock", "CIBlockDocument", "iblock_".$ID), $arErrorTmp);
	if (count($arErrorTmp) > 0)
	{
		foreach ($arErrorTmp as $e)
			$strWarning .= $e["message"]."<br />";
	}
	else
	{
		LocalRedirect($APPLICATION->GetCurPageParam("", Array("delete_bizproc_template", "sessid")));
		die();
	}
}


if($ID>0)
	$APPLICATION->SetTitle(GetMessage("IB_E_EDIT_TITLE", array("#IBLOCK_TYPE#"=>$arIBTYPE["NAME"])));
else
	$APPLICATION->SetTitle(GetMessage("IB_E_NEW_TITLE", array("#IBLOCK_TYPE#"=>$arIBTYPE["NAME"])));


ClearVars("str_");
$str_ACTIVE="Y";
$str_WORKFLOW="Y";
$str_BIZPROC="N";
$str_SECTION_CHOOSER="L";
$str_LIST_MODE="";
$str_INDEX_ELEMENT="Y";
$str_INDEX_SECTION="Y";
$str_PROPERTY_FILE_TYPE = "jpg, gif, bmp, png, jpeg";
$str_LIST_PAGE_URL="#SITE_DIR#/".$arIBTYPE["ID"]."/index.php?ID=#IBLOCK_ID#";
$str_SECTION_PAGE_URL="#SITE_DIR#/".$arIBTYPE["ID"]."/list.php?SECTION_ID=#ID#";
$str_DETAIL_PAGE_URL="#SITE_DIR#/".$arIBTYPE["ID"]."/detail.php?ID=#ID#";
$str_SORT="500";
$str_VERSION="1";
$str_RSS_ACTIVE="N";
$str_RSS_TTL="24";
$str_RSS_FILE_ACTIVE="N";
$str_RSS_FILE_LIMIT="10";
$str_RSS_FILE_DAYS="7";
$str_RSS_YANDEX_ACTIVE="N";

$str_IS_CATALOG = 'N';
$str_SUBSCRIPTION = 'N';
$str_YANDEX_EXPORT = 'N';
$str_VAT_ID = 0;
$str_USED_SKU = 'N';
$str_CATALOG_TYPE = '';

$str_OF_IBLOCK_ID = 0;
$str_OF_IBLOCK_NAME = '';
$str_OF_IBLOCK_TYPE_ID = '';
$str_OF_CREATE_IBLOCK_TYPE_ID = 'N';
$str_OF_NEW_IBLOCK_TYPE_ID = '';
$int_OFFERS_PROPERTY_COUNT = PROPERTY_EMPTY_ROW_SIZE;

$str_PRODUCT_IBLOCK_ID = 0;
$str_PRODUCT_IBLOCK_TYPE_ID = '';
$str_PRODUCT_IBLOCK_NAME = '';
$str_SKU_PROPERTY_ID = 0;

$bCurrentBPDisabled = true;

$ib = new CIBlock();
$ib_result = $ib->GetByID($ID);
if(!$ib_result->ExtractFields("str_"))
{
	$ID=0;
}
else
{
	$bCurrentBPDisabled = ($str_BIZPROC!='Y');

	$str_LID = Array();
	$db_LID = CIBlock::GetSite($ID);
	while($ar_LID = $db_LID->Fetch())
		$str_LID[] = $ar_LID["LID"];

	if (true == $bCatalog)
	{
		$arCatalog = CCatalog::GetByIDExt($ID);
		if (false !== $arCatalog)
		{
			$str_IS_CATALOG = $arCatalog['CATALOG'];
			$str_CATALOG_TYPE = $arCatalog['CATALOG_TYPE'];
			if ('Y' == $arCatalog['CATALOG'])
			{
				$str_SUBSCRIPTION = $arCatalog['SUBSCRIPTION'];
				$str_YANDEX_EXPORT = $arCatalog['YANDEX_EXPORT'];
				$str_VAT_ID = $arCatalog['VAT_ID'];
				$str_PRODUCT_IBLOCK_ID = $arCatalog['PRODUCT_IBLOCK_ID'];
				$str_SKU_PROPERTY_ID = $arCatalog['SKU_PROPERTY_ID'];
			}
			if ('D' != $arCatalog['CATALOG_TYPE'])
			{
				$str_USED_SKU = 'Y';
			}
			if (true == in_array($arCatalog['CATALOG_TYPE'],array('P','X')))
			{
				$str_OF_IBLOCK_ID = $arCatalog['OFFERS_IBLOCK_ID'];
				$str_OF_IBLOCK_NAME = CIBlock::GetArrayByID($arCatalog['OFFERS_IBLOCK_ID'],'NAME');
				$str_OF_IBLOCK_TYPE_ID = CIBlock::GetArrayByID($arCatalog['OFFERS_IBLOCK_ID'],'IBLOCK_TYPE_ID');
			}
			if (0 < $str_PRODUCT_IBLOCK_ID)
			{
				$str_PRODUCT_IBLOCK_TYPE_ID = CIBlock::GetArrayByID($str_PRODUCT_IBLOCK_ID,'IBLOCK_TYPE_ID');
				$str_PRODUCT_IBLOCK_NAME = CIBlock::GetArrayByID($str_PRODUCT_IBLOCK_ID,'NAME');
			}
		}
	}
}

endif; //$arIBTYPE!==false

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

if($arIBTYPE!==false):

/*$bVarsFromForm = ($bVarsFromForm || isset($_POST["propedit"])); */

if($bVarsFromForm)
{
	$ACTIVE = ($ACTIVE != "Y"? "N":"Y");
	$WORKFLOW = $WF_TYPE == "WF"? "Y": "N";
	$BIZPROC = $WF_TYPE == "BP"? "Y": "N";
	$RSS_FILE_ACTIVE = ($RSS_FILE_ACTIVE != "Y"? "N":"Y");
	$RSS_YANDEX_ACTIVE = ($RSS_YANDEX_ACTIVE != "Y"? "N":"Y");
	$RSS_ACTIVE = ($RSS_ACTIVE != "Y"? "N":"Y");
	$VERSION = ($VERSION != 2? 1:2);
	unset($PICTURE);
	$DB->InitTableVarsForEdit("b_iblock", "", "str_");
	$str_LID = $LID;

	if (true == $bCatalog)
	{
		$DB->InitTableVarsForEdit("b_catalog_iblock", "", "str_");
		$str_USED_SKU = ('Y' != $USED_SKU ? "N" : "Y");
		$str_IS_CATALOG = ('Y' != $IS_CATALOG ? "N" : "Y");
		$str_CATALOG_TYPE = $CATALOG_TYPE;

		$str_OF_IBLOCK_ID = intval($OF_IBLOCK_ID);
		$str_OF_IBLOCK_NAME = $OF_IBLOCK_NAME;
		$str_OF_IBLOCK_TYPE_ID = $OF_IBLOCK_TYPE_ID;
		$str_OF_CREATE_IBLOCK_TYPE_ID = ('Y' != $OF_CREATE_IBLOCK_TYPE_ID ? 'N' : 'Y');
		$str_OF_NEW_IBLOCK_TYPE_ID = $OF_NEW_IBLOCK_TYPE_ID;

		$int_OFFERS_PROPERTY_COUNT = intval($OFFERS_PROPERTY_COUNT);
		if (0 >= $int_OFFERS_PROPERTY_COUNT)
			$int_OFFERS_PROPERTY_COUNT = PROPERTY_EMPTY_ROW_SIZE;
	}
}

if($Perm>="X"):
	$aMenu = array(
		array(
			"TEXT"=>GetMessage("IBLOCK_BACK_TO_ADMIN"),
			"LINK"=>'/bitrix/admin/iblock_admin.php?lang='.$lang.'&type='.urlencode($type).'&admin='.($_REQUEST["admin"]=="Y"? "Y": "N"),
			"ICON"=>"btn_list",
		)
	);

$context = new CAdminContextMenu($aMenu);
$context->Show();

$u = new CAdminPopup(
	"mnu_LIST_PAGE_URL",
	"mnu_LIST_PAGE_URL",
	CIBlockParameters::GetPathTemplateMenuItems("LIST", "__SetUrlVar", "mnu_LIST_PAGE_URL", "LIST_PAGE_URL"),
	array("zIndex" => 2000)
);
$u->Show();
$u = new CAdminPopup(
	"mnu_SECTION_PAGE_URL",
	"mnu_SECTION_PAGE_URL",
	CIBlockParameters::GetPathTemplateMenuItems("SECTION", "__SetUrlVar", "mnu_SECTION_PAGE_URL", "SECTION_PAGE_URL"),
	array("zIndex" => 2000)
);
$u->Show();
$u = new CAdminPopup(
	"mnu_DETAIL_PAGE_URL",
	"mnu_DETAIL_PAGE_URL",
	CIBlockParameters::GetPathTemplateMenuItems("DETAIL", "__SetUrlVar", "mnu_DETAIL_PAGE_URL", "DETAIL_PAGE_URL"),
	array("zIndex" => 2000)
);
$u->Show();

?>
<script type="text/javascript">
	function __SetUrlVar(id, mnu_id, el_id)
	{
		var mnu_list = eval(mnu_id);
		var obj_ta = document.getElementById(el_id);
		obj_ta.focus();
		obj_ta.value += id;

		mnu_list.PopupHide();
		obj_ta.focus();
	}

	function __ShUrlVars(div, el_id)
	{
		var pos = jsUtils.GetRealPos(div);
		var mnu_list = eval('mnu_'+el_id);
		setTimeout(function(){mnu_list.PopupShow(pos)}, 10);
	}
</script>
<script type="text/javascript">
var CellTPL = new Array();
<?
foreach ($arCellTemplates as $key => $value)
{
	?>CellTPL[<? echo $key; ?>] = '<? echo $value; ?>';
<?
}
?>
var CellAttr = new Array();
<?
foreach ($arCellAttr as $key => $value)
{
	?>CellAttr[<? echo $key; ?>] = '<? echo $value; ?>';
<?
}
?>
</script>
<form method="POST" name="frm" id="frm" action="/bitrix/admin/iblock_edit.php?type=<?echo htmlspecialchars($type)?>&amp;lang=<?echo LANG?>&amp;admin=<?echo ($_REQUEST["admin"]=="Y"? "Y": "N")?>"  ENCTYPE="multipart/form-data">
<?=bitrix_sessid_post()?>
<?echo GetFilterHiddens("find_");?>
<?if($bBizproc && $bCurrentBPDisabled):?>
<input type="hidden" name="BIZ_PROC_ADD_DEFAULT_TEMPLATES" value="Y">
<?endif?>
<input type="hidden" name="Update" value="Y">
<input type="hidden" name="ID" value="<?echo $ID?>">
<?if(strlen($_REQUEST["return_url"])>0):?><input type="hidden" name="return_url" value="<?=htmlspecialchars($_REQUEST["return_url"])?>"><?endif?>
<?CAdminMessage::ShowOldStyleError($strWarning);?>
<?
$bTab3 = ($arIBTYPE["IN_RSS"]=="Y");
$bWorkflow = CModule::IncludeModule("workflow");
$bBizprocTab = $bBizproc && $str_BIZPROC == "Y";

$aTabs = array();
$aTabs[] = array("DIV" => "edit1", "TAB" => GetMessage("IB_E_TAB2"), "ICON"=>"iblock", "TITLE"=>GetMessage("IB_E_TAB2_T"));
$aTabs[] = array("DIV" => "edit6", "TAB" => GetMessage("IB_E_TAB6"), "ICON"=>"iblock_fields", "TITLE"=>GetMessage("IB_E_TAB6_T"));
$aTabs[] = array("DIV" => "edit2", "TAB" => GetMessage("IB_E_TAB3"), "ICON"=>"iblock_props", "TITLE"=>GetMessage("IB_E_TAB3_T"));
$aTabs[] = array("DIV" => "edit8", "TAB" => GetMessage("IB_E_TAB8"), "ICON"=>"section_fields", "TITLE"=>GetMessage("IB_E_TAB8_T"));
if($bTab3) $aTabs[] = array("DIV" => "edit3", "TAB" => GetMessage("IB_E_TAB7"), "ICON"=>"iblock_rss", "TITLE"=>GetMessage("IB_E_TAB7_T"));
if (true == $bCatalog) $aTabs[] = array("DIV" => "edit9", "TAB" => GetMessage("IB_E_TAB9"), "ICON"=>"iblock", "TITLE"=>GetMessage("IB_E_TAB9_T"));
$aTabs[] = array("DIV" => "edit4", "TAB" => GetMessage("IB_E_TAB4"), "ICON"=>"iblock_access", "TITLE"=>GetMessage("IB_E_TAB4_T"));
$aTabs[] = array("DIV" => "edit5", "TAB" => GetMessage("IB_E_TAB5"), "ICON"=>"iblock", "TITLE"=>GetMessage("IB_E_TAB5_T"));
if ($bBizprocTab) $aTabs[] = array("DIV" => "edit7", "TAB" => GetMessage("IB_E_TAB7_BP"), "ICON"=>"iblock", "TITLE"=>GetMessage("IB_E_TAB7_BP"));
$aTabs[] = array("DIV" => "log", "TAB" => GetMessage("IB_E_TAB_LOG"), "ICON"=>"iblock", "TITLE"=>GetMessage("IB_E_TAB_LOG_TITLE"));

$tabControl = new CAdminTabControl("tabControl", $aTabs);
$tabControl->Begin();
$tabControl->BeginNextTab();
?>
	<?if($ID>0):?>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("IB_E_ID")?>:</td>
		<td valign="top" width="60%"><?echo $str_ID?></td>
	</tr>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("IB_E_PROPERTY_STORAGE")?></td>
		<td valign="top" width="60%">
			<input type="hidden" name="VERSION" value="<?=$str_VERSION?>">
			<?if($str_VERSION==1)echo GetMessage("IB_E_COMMON_STORAGE")?>
			<?if($str_VERSION==2)echo GetMessage("IB_E_SEPARATE_STORAGE")?>
			<br><a href="iblock_convert.php?lang=<?=LANG?>&amp;IBLOCK_ID=<?echo $str_ID?>"><?=$str_LAST_CONV_ELEMENT>0?"<span class=\"required\">".GetMessage("IB_E_CONVERT_CONTINUE"):GetMessage("IB_E_CONVERT_START")."</span>"?></a>
		</td>
	</tr>
	<tr>
		<td valign="top" ><?echo GetMessage("IB_E_LAST_UPDATE")?></td>
		<td valign="top"><?echo $str_TIMESTAMP_X?></td>
	</tr>
	<? else: ?>
	<tr>
		<td valign="top" width="40%"><?=GetMessage("IB_E_PROPERTY_STORAGE")?></td>
		<td valign="top" width="60%">
				<label><input type="radio" name="VERSION" value="1" <?if($str_VERSION==1)echo " checked"?>><?=GetMessage("IB_E_COMMON_STORAGE")?></label><br>
				<label><input type="radio" name="VERSION" value="2" <?if($str_VERSION==2)echo " checked"?>><?=GetMessage("IB_E_SEPARATE_STORAGE")?></label>
		</td>
	</tr>
	<? endif; ?>
	<tr>
		<td valign="top"><label for="ACTIVE"><?echo GetMessage("IB_E_ACTIVE")?>:</label></td>
		<td valign="top">
			<input type="hidden" name="ACTIVE" value="N">
			<input type="checkbox" id="ACTIVE" name="ACTIVE" value="Y"<?if($str_ACTIVE=="Y")echo " checked"?>>
			<span style="display:none;"><input type="submit" name="save" value="Y" style="width:0px;height:0px"></span>
		</td>
	</tr>
	<tr>
		<td valign="top"  width="40%"><? echo GetMessage("IB_E_CODE")?>:</td>
		<td valign="top" width="60%">
			<input type="text" name="CODE" size="20" maxlength="50" value="<?echo $str_CODE?>" >
		</td>
	</tr>

	<tr valign="top">
		<td><span class="required">*</span><?echo GetMessage("IB_E_SITES")?></td>
		<td><?=CLang::SelectBoxMulti("LID", $str_LID);?></td>
	</tr>

	<tr>
		<td valign="top" ><span class="required">*</span><? echo GetMessage("IB_E_NAME")?>:</td>
		<td valign="top">
			<input type="text" name="NAME" size="40" maxlength="255"  value="<?echo $str_NAME?>">
		</td>
	</tr>
	<tr>
		<td valign="top" ><? echo GetMessage("IB_E_SORT")?>:</td>
		<td valign="top">
			<input type="text" name="SORT" size="10"  maxlength="10" value="<?echo $str_SORT?>">
		</td>
	</tr>
	<?if(COption::GetOptionString("iblock", "show_xml_id", "N")=="Y"):?>
	<tr>
		<td valign="top" ><?echo GetMessage("IB_E_XML_ID")?>:</td>
		<td valign="top">
			<input type="text" name="XML_ID"  size="20" maxlength="50" value="<?echo $str_XML_ID?>">
		</td>
	</tr>
	<?endif?>
	<tr>
		<td valign="top" ><?echo GetMessage("IB_E_LIST_PAGE_URL")?></td>
		<td valign="top">
			<input type="text" name="LIST_PAGE_URL" id="LIST_PAGE_URL" size="40" maxlength="255" value="<?echo $str_LIST_PAGE_URL?>">
			<input type="button" onclick="__ShUrlVars(this, 'LIST_PAGE_URL')" value='...'>
		</td>
	</tr>
	<?if($arIBTYPE["SECTIONS"]=="Y"):?>
	<tr>
		<td valign="top" ><?echo GetMessage("IB_E_SECTION_PAGE_URL")?></td>
		<td valign="top">
			<input type="text" name="SECTION_PAGE_URL" id="SECTION_PAGE_URL" size="40" maxlength="255" value="<?echo $str_SECTION_PAGE_URL?>">
			<input type="button" onclick="__ShUrlVars(this, 'SECTION_PAGE_URL')" value='...'>
		</td>
	</tr>
	<?endif?>
	<tr>
		<td valign="top" ><?echo GetMessage("IB_E_DETAIL_PAGE_URL")?></td>
		<td valign="top">
			<input type="text" name="DETAIL_PAGE_URL" id="DETAIL_PAGE_URL" size="40" maxlength="255" value="<?echo $str_DETAIL_PAGE_URL?>">
			<input type="button" onclick="__ShUrlVars(this, 'DETAIL_PAGE_URL')" value='...'>
		</td>
	</tr>

	<?if($arIBTYPE["SECTIONS"]=="Y"):?>
	<tr>
		<td valign="top"><label for="INDEX_SECTION"><?echo GetMessage("IB_E_INDEX_SECTION")?></label></td>
		<td valign="top">
			<input type="hidden" name="INDEX_SECTION" value="N">
			<input type="checkbox" id="INDEX_SECTION" name="INDEX_SECTION" value="Y"<?if($str_INDEX_SECTION=="Y")echo " checked"?>>
		</td>
	</tr>
	<?endif?>
	<tr>
		<td valign="top"><label for="INDEX_ELEMENT"><?echo GetMessage("IB_E_INDEX_ELEMENT")?></label></td>
		<td valign="top">
			<input type="hidden" name="INDEX_ELEMENT" value="N">
			<input type="checkbox" id="INDEX_ELEMENT" name="INDEX_ELEMENT" value="Y"<?if($str_INDEX_ELEMENT=="Y")echo " checked"?>>
		</td>
	</tr>
	<?if($bWorkflow && $bBizproc):?>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_WF_TYPE")?></td>
		<td valign="top">
			<select name="WF_TYPE">
				<option value="N"><?echo GetMessage("IB_E_WF_TYPE_NONE")?></option>
				<option value="WF" <?if($str_WORKFLOW=="Y")echo "selected"?>><?echo GetMessage("IB_E_WF_TYPE_WORKFLOW")?></option>
				<option value="BP" <?if($str_BIZPROC=="Y")echo "selected"?>><?echo GetMessage("IB_E_WF_TYPE_BIZPROC")?></option>
			</select>
		</td>
	</tr>
	<?elseif($bWorkflow && !$bBizproc):?>
	<tr>
		<td valign="top"><label for="WF_TYPE"><?echo GetMessage("IB_E_WORKFLOW")?></label></td>
		<td valign="top">
			<input type="hidden" name="WF_TYPE" value="N">
			<input type="checkbox" id="WF_TYPE" name="WF_TYPE" value="WF"<?if($str_WORKFLOW=="Y")echo " checked"?>>
		</td>
	</tr>
	<?elseif($bBizproc && !$bWorkflow):?>
	<tr>
		<td valign="top"><label for="WF_TYPE"><?echo GetMessage("IB_E_BIZPROC")?></label></td>
		<td valign="top">
			<input type="hidden" name="WF_TYPE" value="N">
			<input type="checkbox" id="WF_TYPE" name="WF_TYPE" value="BP"<?if($str_BIZPROC=="Y")echo " checked"?>>
		</td>
	</tr>
	<?endif?>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_SECTION_CHOOSER")?>:</td>
		<td valign="top">
			<select name="SECTION_CHOOSER">
			<option value="L"<?if($str_SECTION_CHOOSER=="L")echo " selected"?>><?echo GetMessage("IB_E_SECTION_CHOOSER_LIST")?></option>
			<option value="D"<?if($str_SECTION_CHOOSER=="D")echo " selected"?>><?echo GetMessage("IB_E_SECTION_CHOOSER_DROPDOWNS")?></option>
			<option value="P"<?if($str_SECTION_CHOOSER=="P")echo " selected"?>><?echo GetMessage("IB_E_SECTION_CHOOSER_POPUP")?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_LIST_MODE")?>:</td>
		<td valign="top">
			<select name="LIST_MODE">
			<option value=""><?echo GetMessage("IB_E_LIST_MODE_GLOBAL")?></option>
			<option value="S"<?if($str_LIST_MODE=="S") echo " selected"?>><?echo GetMessage("IB_E_LIST_MODE_SECTIONS")?></option>
			<option value="C"<?if($str_LIST_MODE=="C") echo " selected"?>><?echo GetMessage("IB_E_LIST_MODE_COMBINED")?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
		<?
		CAdminFileDialog::ShowScript
		(
			Array(
				"event" => "BtnClick",
				"arResultDest" => array("FORM_NAME" => "frm", "FORM_ELEMENT_NAME" => "EDIT_FILE_BEFORE"),
				"arPath" => array("PATH" => GetDirPath($str_EDIT_FILE_BEFORE)),
				"select" => 'F',// F - file only, D - folder only
				"operation" => 'O',// O - open, S - save
				"showUploadTab" => true,
				"showAddToMenuTab" => false,
				"fileFilter" => 'php',
				"allowAllFiles" => true,
				"SaveConfig" => true,
			)
		);
		?>
		<?echo GetMessage("IB_E_FILE_BEFORE")?></td>
		<td><input type="text" name="EDIT_FILE_BEFORE" size="50"  maxlength="255" value="<?echo $str_EDIT_FILE_BEFORE?>">&nbsp;<input type="button" name="browse" value="..." onClick="BtnClick()"></td>
	</tr>
	<tr>
		<td>
		<?
		CAdminFileDialog::ShowScript
		(
			Array(
				"event" => "BtnClick2",
				"arResultDest" => array("FORM_NAME" => "frm", "FORM_ELEMENT_NAME" => "EDIT_FILE_AFTER"),
				"arPath" => array("PATH" => GetDirPath($str_EDIT_FILE_AFTER)),
				"select" => 'F',// F - file only, D - folder only
				"operation" => 'O',// O - open, S - save
				"showUploadTab" => true,
				"showAddToMenuTab" => false,
				"fileFilter" => 'php',
				"allowAllFiles" => true,
				"SaveConfig" => true,
			)
		);
		?>
		<?echo GetMessage("IB_E_FILE_AFTER")?></td>
		<td><input type="text" name="EDIT_FILE_AFTER" size="50"  maxlength="255" value="<?echo $str_EDIT_FILE_AFTER?>">&nbsp;<input type="button" name="browse" value="..." onClick="BtnClick2()"></td>
	</tr>

	<tr class="heading">
		<td colspan="2"><?echo GetMessage("IB_E_DESCRIPTION")?></td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_PICTURE")?></td>
		<td valign="top">
			<?echo CFile::InputFile("PICTURE", 20, $str_PICTURE);?><br>
			<?echo CFile::ShowImage($str_PICTURE, 200, 200, "border=0", "", true)?>
		</td>
	</tr>
	<?if(COption::GetOptionString("iblock", "use_htmledit", "Y")=="Y" && CModule::IncludeModule("fileman")):?>
	<tr>
		<td valign="top" colspan="2" align="center">
			<?CFileMan::AddHTMLEditorFrame("DESCRIPTION", $str_DESCRIPTION, "DESCRIPTION_TYPE", $str_DESCRIPTION_TYPE, 250);?>
		</td>
	</tr>
	<?else:?>
	<tr>
		<td ><?echo GetMessage("IB_E_DESCRIPTION_TYPE")?></td>
		<td >
			<input type="radio" name="DESCRIPTION_TYPE" id="DESCRIPTION_TYPE1" value="text"<?if($str_DESCRIPTION_TYPE!="html")echo " checked"?>><label for="DESCRIPTION_TYPE1"> <?echo GetMessage("IB_E_DESCRIPTION_TYPE_TEXT")?></label> /
			<input type="radio" name="DESCRIPTION_TYPE" id="DESCRIPTION_TYPE2" value="html"<?if($str_DESCRIPTION_TYPE=="html")echo " checked"?>><label for="DESCRIPTION_TYPE2"> <?echo GetMessage("IB_E_DESCRIPTION_TYPE_HTML")?></label>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<textarea cols="60" rows="15" name="DESCRIPTION" style="width:100%;"><?echo $str_DESCRIPTION?></textarea>
		</td>
	</tr>
	<?endif?>
<?
$tabControl->BeginNextTab();
?>
	<tr>
		<td valign="top" colspan="2">
			<table border="0" cellspacing="0" cellpadding="0" class="internal" align="center">
				<tr class="heading">
					<td nowrap><?echo GetMessage("IB_E_FIELD_NAME")?></td>
					<td nowrap><?echo GetMessage("IB_E_FIELD_IS_REQUIRED")?></td>
					<td nowrap><?echo GetMessage("IB_E_FIELD_DEFAULT_VALUE")?></td>
				</tr>
				<?
				if($bVarsFromForm)
					$arFields = $_REQUEST["FIELDS"];
				else
					$arFields = CIBlock::GetFields($ID);
				$arDefFields = CIBlock::GetFieldsDefaults();
				foreach($arDefFields as $FIELD_ID => $arField):
					if(preg_match("/^(SECTION_|LOG_)/", $FIELD_ID)) continue;
					?>
					<tr valign="top">
						<td nowrap><?echo $arDefFields[$FIELD_ID]["NAME"]?></td>
						<td nowrap align="center">
							<input type="hidden" value="N" name="FIELDS[<?echo $FIELD_ID?>][IS_REQUIRED]">
							<input type="checkbox" value="Y" name="FIELDS[<?echo $FIELD_ID?>][IS_REQUIRED]" <?if($arFields[$FIELD_ID]["IS_REQUIRED"]==="Y" || $arDefFields[$FIELD_ID]["IS_REQUIRED"]!==false) echo "checked"?> <?if($arDefFields[$FIELD_ID]["IS_REQUIRED"]!==false) echo "disabled"?>>
						</td>
						<td nowrap>
						<?
						switch($FIELD_ID)
						{
							case "ACTIVE":
								?>
								<select name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" height="1">
									<option value="Y" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="Y") echo "selected"?>><?echo GetMessage("MAIN_YES")?></option>
									<option value="N" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="N") echo "selected"?>><?echo GetMessage("MAIN_NO")?></option>
								</select>
								<?
								break;
							case "ACTIVE_FROM":
								?>
								<select name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" height="1">
									<option value="" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="") echo "selected"?>><?echo GetMessage("IB_E_FIELD_ACTIVE_FROM_EMPTY")?></option>
									<option value="=now" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="=now") echo "selected"?>><?echo GetMessage("IB_E_FIELD_ACTIVE_FROM_NOW")?></option>
									<option value="=today" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="=today") echo "selected"?>><?echo GetMessage("IB_E_FIELD_ACTIVE_FROM_TODAY")?></option>
								</select>
								<?
								break;
							case "ACTIVE_TO":
								?>
								<table border="0" cellspacing="2" cellpadding="0">
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]"><?echo GetMessage("IB_E_FIELD_ACTIVE_TO")?></label></td></tr>
								<tr><td><input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"])?>" size="5"></td></tr>
								</table>
								<?
								break;
							case "NAME":
								?>
								<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"])?>" size="60">
								<?
								break;
							case "SORT":
								?>
								<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" type="hidden" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"])?>">
								<?
								break;
							case "DETAIL_TEXT_TYPE":
							case "PREVIEW_TEXT_TYPE":
								?>
								<select name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" height="1">
									<option value="text" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="text") echo "selected"?>>text</option>
									<option value="html" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="html") echo "selected"?>>html</option>
								</select>
								<?
								break;
							case "DETAIL_TEXT":
							case "PREVIEW_TEXT":
								?>
								<textarea name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" rows="5" cols="47"><?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"])?></textarea>
								<?
								break;
							case "PREVIEW_PICTURE":
								?>
								<table border="0" cellspacing="2" cellpadding="0">
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][FROM_DETAIL]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][FROM_DETAIL]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["FROM_DETAIL"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][FROM_DETAIL]"><?echo GetMessage("IB_E_FIELD_PREVIEW_PICTURE_FROM_DETAIL")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][DELETE_WITH_DETAIL]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][DELETE_WITH_DETAIL]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["DELETE_WITH_DETAIL"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][DELETE_WITH_DETAIL]"><?echo GetMessage("IB_E_FIELD_PREVIEW_PICTURE_DELETE_WITH_DETAIL")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UPDATE_WITH_DETAIL]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UPDATE_WITH_DETAIL]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["UPDATE_WITH_DETAIL"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UPDATE_WITH_DETAIL]"><?echo GetMessage("IB_E_FIELD_PREVIEW_PICTURE_UPDATE_WITH_DETAIL")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["SCALE"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]"><?echo GetMessage("IB_E_FIELD_PICTURE_SCALE")?></label></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_WIDTH")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][WIDTH]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["WIDTH"])?>" size="7"></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_HEIGHT")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][HEIGHT]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["HEIGHT"])?>" size="7"></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["IGNORE_ERRORS"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]"><?echo GetMessage("IB_E_FIELD_PICTURE_IGNORE_ERRORS")?></label></td></tr>
								<tr><td><input type="checkbox" value="resample" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["METHOD"]==="resample") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]"><?echo GetMessage("IB_E_FIELD_PICTURE_METHOD")?></label></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_COMPRESSION")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][COMPRESSION]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["COMPRESSION"])?>" size="7"></td></tr>
								</table>
								<?
								break;
							case "DETAIL_PICTURE":
								?>
								<table border="0" cellspacing="2" cellpadding="0">
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["SCALE"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]"><?echo GetMessage("IB_E_FIELD_PICTURE_SCALE")?></label></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_WIDTH")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][WIDTH]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["WIDTH"])?>" size="7"></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_HEIGHT")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][HEIGHT]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["HEIGHT"])?>" size="7"></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["IGNORE_ERRORS"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]"><?echo GetMessage("IB_E_FIELD_PICTURE_IGNORE_ERRORS")?></label></td></tr>
								<tr><td><input type="checkbox" value="resample" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["METHOD"]==="resample") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]"><?echo GetMessage("IB_E_FIELD_PICTURE_METHOD")?></label></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_COMPRESSION")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][COMPRESSION]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["COMPRESSION"])?>" size="7"></td></tr>
								</table>
								<?
								break;
							case "CODE":
								?>
								<table border="0" cellspacing="2" cellpadding="0">
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UNIQUE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UNIQUE]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["UNIQUE"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UNIQUE]"><?echo GetMessage("IB_E_FIELD_CODE_UNIQUE")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANSLITERATION]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANSLITERATION]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANSLITERATION"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANSLITERATION]"><?echo GetMessage("IB_E_FIELD_EL_TRANSLITERATION")?></label></td></tr>
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_LEN]"><?echo GetMessage("IB_E_FIELD_TRANS_LEN")?></label>&nbsp;<input type="text" size="4" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_LEN"])?>" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_LEN]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_LEN]"></td></tr>
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_CASE]"><?echo GetMessage("IB_E_FIELD_TRANS_CASE")?></label>&nbsp;<select name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_CASE]" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_CASE]">
									<option value=""><?echo GetMessage("IB_E_FIELD_TRANS_CASE_LEAVE")?></option>
									<option value="L" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_CASE"]==="L") echo "selected"?>><?echo GetMessage("IB_E_FIELD_TRANS_CASE_LOWER")?></option>
									<option value="U" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_CASE"]==="U") echo "selected"?>><?echo GetMessage("IB_E_FIELD_TRANS_CASE_UPPER")?></option>
								</select><td></tr>
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_SPACE]"><?echo GetMessage("IB_E_FIELD_TRANS_SPACE")?></label>&nbsp;<input type="text" size="2" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_SPACE"])?>" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_SPACE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_SPACE]"></td></tr>
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_OTHER]"><?echo GetMessage("IB_E_FIELD_TRANS_OTHER")?></label>&nbsp;<input type="text" size="2" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_OTHER"])?>" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_OTHER]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_OTHER]"></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_EAT]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_EAT]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_EAT"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_EAT]"><?echo GetMessage("IB_E_FIELD_TRANS_EAT")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][USE_GOOGLE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][USE_GOOGLE]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["USE_GOOGLE"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][USE_GOOGLE]"><?echo GetMessage("IB_E_FIELD_EL_TRANS_USE_GOOGLE")?></label></td></tr>
								</table>
								<?
								break;
							default:
								?>
								<input type="hidden" value="" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]">&nbsp;
								<?
								break;
						}
						?>
						</td>
					</tr>
				<?endforeach?>
			</table>
		</td>
	</tr>
<?
$tabControl->BeginNextTab();
?><tr>
		<td valign="top" colspan="2">
	<script type="text/javascript">
	var obIBProps = new JCIBlockProperty({
		'PREFIX': '<? echo $strPREFIX_IB_PROPERTY ?>',
		'FORM_ID': 'frm',
		'TABLE_PROP_ID': 'ib_prop_list',
		'PROP_COUNT_ID': 'INT_IBLOCK_PROPERTY_COUNT',
		'IBLOCK_ID': <? echo $ID; ?>,
		'LANG': '<? echo LANGUAGE_ID; ?>',
		'TITLE': '<? echo CUtil::JSEscape(GetMessage('IB_E_IB_PROPERTY_DETAIL')); ?>',
		'OBJ': 'obIBProps',
		'SESS': '<? echo bitrix_sessid_get(); ?>'
	});

	obIBProps.SetCells(CellTPL,7,CellAttr);
	</script>
			<table border="0" cellspacing="0" cellpadding="0" class="internal" align="center" id="ib_prop_list">
				<tr class="heading">
					<td>ID</td>
					<td><?echo GetMessage("IB_E_PROP_NAME_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_TYPE_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_MULT_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_REQIRED_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_SORT_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_CODE_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_MODIFY_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_DELETE_SHORT")?></td>
				</tr>
				<?
				$arPropList = array();
				if (0 < $ID)
				{
					$rsProps = CIBlock::GetProperties($ID, array("sort"=>"asc"));
					while ($arProp = $rsProps->Fetch())
					{
						if ('L' == $arProp['PROPERTY_TYPE'])
						{
							$arProp['VALUES'] = array();
							$arProp['VALUES_SORT'] = array();
							$arProp['VALUES_XML'] = array();
							$arProp['VALUES_DEF'] = array();
							$rsLists = CIBlockProperty::GetPropertyEnum($arProp['ID']);
							while($res = $rsLists->Fetch())
							{
								$arProp['VALUES'][$res["ID"]] = $res["VALUE"];
								$arProp['VALUES_SORT'][$res["ID"]] = $res["SORT"];
								$arProp['VALUES_XML'][$res["ID"]] = $res["XML_ID"];
								if($res["DEF"]=="Y")
									$arProp['VALUES_DEF'][] = $res["ID"];
							}
							$arProp['CNT'] = sizeof($arProp['VALUES']);
						}
						if (true == $bVarsFromForm)
						{
							$intPropID = $arProp['ID'];
							$arTempo = GetPropertyInfo($strPREFIX_IB_PROPERTY,$intPropID,true);
							if (true == is_array($arTempo))
								$arProp = $arTempo;
							$arProp['ID'] = $intPropID;
						}
						$arProp = ConvertToSafe($arProp,$arDisabledPropFields);
						$arProp['SHOW_DEL'] = 'Y';
						$arPropList[$arProp['ID']] = $arProp;
					}
				}
				$intPropCount = intval($_POST['IBLOCK_PROPERTY_COUNT']);
				if (0 >= $intPropCount)
					$intPropCount = PROPERTY_EMPTY_ROW_SIZE;
				$intPropNumber = 0;
				for ($i = 0; $i < $intPropCount; $i++)
				{
					$arProp = GetPropertyInfo($strPREFIX_IB_PROPERTY,'n'.$i,true);
					if (true == is_array($arProp))
					{
						$arProp = ConvertToSafe($arProp,$arDisabledPropFields);
						$arProp['ID'] = 'n'.$intPropNumber;
						$arPropList['n'.$intPropNumber] = $arProp;
						$intPropNumber++;
					}
				}
				for (0; $intPropNumber < PROPERTY_EMPTY_ROW_SIZE; $intPropNumber++)
				{
					$arProp = $arDefPropInfo;
					$arProp['ID'] = 'n'.$intPropNumber;
					$arPropList['n'.$intPropNumber] = $arProp;
				}
				foreach ($arPropList as $mxPropID => $arProp)
				{
					$arProp['IBLOCK_ID'] = $ID;
					echo __AddPropRow($mxPropID,$strPREFIX_IB_PROPERTY,$arProp);
				}
			?></table>
				<div style="width: 100%; text-align: center;">
				<input onclick="obIBProps.addPropRow();" type="button" value="<? echo GetMessage('IB_E_SHOW_ADD_PROP_ROW')?>" title="<? echo GetMessage('IB_E_SHOW_ADD_PROP_ROW_DESCR')?>">
				</div>
				<input type="hidden" name="IBLOCK_PROPERTY_COUNT" id="INT_IBLOCK_PROPERTY_COUNT" value="<? echo $intPropNumber; ?>">
		</td>
	</tr>
<?
$tabControl->BeginNextTab();
?>
	<tr>
		<td valign="top" colspan="2">
			<table border="0" cellspacing="0" cellpadding="0" class="internal" align="center">
				<tr class="heading">
					<td nowrap><?echo GetMessage("IB_E_SECTION_FIELD_NAME")?></td>
					<td nowrap><?echo GetMessage("IB_E_SECTION_FIELD_IS_REQUIRED")?></td>
					<td nowrap><?echo GetMessage("IB_E_SECTION_FIELD_DEFAULT_VALUE")?></td>
				</tr>
				<?
				if($bVarsFromForm)
					$arFields = $_REQUEST["FIELDS"];
				else
					$arFields = CIBlock::GetFields($ID);
				$arDefFields = CIBlock::GetFieldsDefaults();
				foreach($arDefFields as $FIELD_ID => $arField):
					if(!preg_match("/^SECTION_/", $FIELD_ID)) continue;
					?>
					<tr valign="top">
						<td nowrap><?echo $arDefFields[$FIELD_ID]["NAME"]?></td>
						<td nowrap align="center">
							<input type="hidden" value="N" name="FIELDS[<?echo $FIELD_ID?>][IS_REQUIRED]">
							<input type="checkbox" value="Y" name="FIELDS[<?echo $FIELD_ID?>][IS_REQUIRED]" <?if($arFields[$FIELD_ID]["IS_REQUIRED"]==="Y" || $arDefFields[$FIELD_ID]["IS_REQUIRED"]!==false) echo "checked"?> <?if($arDefFields[$FIELD_ID]["IS_REQUIRED"]!==false) echo "disabled"?>>
						</td>
						<td nowrap>
						<?
						switch($FIELD_ID)
						{
							case "SECTION_NAME":
								?>
								<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"])?>" size="60">
								<?
								break;
							case "SECTION_DESCRIPTION_TYPE":
								?>
								<select name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" height="1">
									<option value="text" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="text") echo "selected"?>>text</option>
									<option value="html" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]==="html") echo "selected"?>>html</option>
								</select>
								<?
								break;
							case "SECTION_DESCRIPTION":
								?>
								<textarea name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]" rows="5" cols="47"><?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"])?></textarea>
								<?
								break;
							case "SECTION_PICTURE":
								?>
								<table border="0" cellspacing="2" cellpadding="0">
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][FROM_DETAIL]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][FROM_DETAIL]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["FROM_DETAIL"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][FROM_DETAIL]"><?echo GetMessage("IB_E_FIELD_PREVIEW_PICTURE_FROM_DETAIL")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][DELETE_WITH_DETAIL]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][DELETE_WITH_DETAIL]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["DELETE_WITH_DETAIL"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][DELETE_WITH_DETAIL]"><?echo GetMessage("IB_E_FIELD_PREVIEW_PICTURE_DELETE_WITH_DETAIL")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UPDATE_WITH_DETAIL]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UPDATE_WITH_DETAIL]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["UPDATE_WITH_DETAIL"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UPDATE_WITH_DETAIL]"><?echo GetMessage("IB_E_FIELD_PREVIEW_PICTURE_UPDATE_WITH_DETAIL")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["SCALE"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]"><?echo GetMessage("IB_E_FIELD_PICTURE_SCALE")?></label></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_WIDTH")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][WIDTH]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["WIDTH"])?>" size="7"></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_HEIGHT")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][HEIGHT]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["HEIGHT"])?>" size="7"></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["IGNORE_ERRORS"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]"><?echo GetMessage("IB_E_FIELD_PICTURE_IGNORE_ERRORS")?></label></td></tr>
								<tr><td><input type="checkbox" value="resample" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["METHOD"]==="resample") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]"><?echo GetMessage("IB_E_FIELD_PICTURE_METHOD")?></label></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_COMPRESSION")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][COMPRESSION]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["COMPRESSION"])?>" size="7"></td></tr>
								</table>
								<?
								break;
							case "SECTION_DETAIL_PICTURE":
								?>
								<table border="0" cellspacing="2" cellpadding="0">
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["SCALE"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][SCALE]"><?echo GetMessage("IB_E_FIELD_PICTURE_SCALE")?></label></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_WIDTH")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][WIDTH]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["WIDTH"])?>" size="7"></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_HEIGHT")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][HEIGHT]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["HEIGHT"])?>" size="7"></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["IGNORE_ERRORS"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][IGNORE_ERRORS]"><?echo GetMessage("IB_E_FIELD_PICTURE_IGNORE_ERRORS")?></label></td></tr>
								<tr><td><input type="checkbox" value="resample" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["METHOD"]==="resample") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][METHOD]"><?echo GetMessage("IB_E_FIELD_PICTURE_METHOD")?></label></td></tr>
								<tr><td><?echo GetMessage("IB_E_FIELD_PICTURE_COMPRESSION")?>:&nbsp;<input name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][COMPRESSION]" type="text" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["COMPRESSION"])?>" size="7"></td></tr>
								</table>
								<?
								break;
							case "SECTION_CODE":
								?>
								<table border="0" cellspacing="2" cellpadding="0">
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UNIQUE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UNIQUE]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["UNIQUE"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][UNIQUE]"><?echo GetMessage("IB_E_FIELD_CODE_UNIQUE")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANSLITERATION]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANSLITERATION]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANSLITERATION"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANSLITERATION]"><?echo GetMessage("IB_E_FIELD_SEC_TRANSLITERATION")?></label></td></tr>
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_LEN]"><?echo GetMessage("IB_E_FIELD_TRANS_LEN")?></label>&nbsp;<input type="text" size="4" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_LEN"])?>" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_LEN]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_LEN]"></td></tr>
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_CASE]"><?echo GetMessage("IB_E_FIELD_TRANS_CASE")?></label>&nbsp;<select name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_CASE]" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_CASE]">
									<option value=""><?echo GetMessage("IB_E_FIELD_TRANS_CASE_LEAVE")?></option>
									<option value="L" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_CASE"]==="L") echo "selected"?>><?echo GetMessage("IB_E_FIELD_TRANS_CASE_LOWER")?></option>
									<option value="U" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_CASE"]==="U") echo "selected"?>><?echo GetMessage("IB_E_FIELD_TRANS_CASE_UPPER")?></option>
								</select><td></tr>
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_SPACE]"><?echo GetMessage("IB_E_FIELD_TRANS_SPACE")?></label>&nbsp;<input type="text" size="2" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_SPACE"])?>" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_SPACE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_SPACE]"></td></tr>
								<tr><td><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_OTHER]"><?echo GetMessage("IB_E_FIELD_TRANS_OTHER")?></label>&nbsp;<input type="text" size="2" value="<?echo htmlspecialchars($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_OTHER"])?>" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_OTHER]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_OTHER]"></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_EAT]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_EAT]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["TRANS_EAT"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][TRANS_EAT]"><?echo GetMessage("IB_E_FIELD_TRANS_EAT")?></label></td></tr>
								<tr><td><input type="checkbox" value="Y" id="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][USE_GOOGLE]" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][USE_GOOGLE]" <?if($arFields[$FIELD_ID]["DEFAULT_VALUE"]["USE_GOOGLE"]==="Y") echo "checked"?>><label for="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE][USE_GOOGLE]"><?echo GetMessage("IB_E_FIELD_EL_TRANS_USE_GOOGLE")?></label></td></tr>
								</table>
								<?
								break;
							default:
								?>
								<input type="hidden" value="" name="FIELDS[<?echo $FIELD_ID?>][DEFAULT_VALUE]">&nbsp;
								<?
								break;
						}
						?>
						</td>
					</tr>
				<?endforeach;?>
			</table>
		</td>
	</tr>
<?
if($bTab3):
	$tabControl->BeginNextTab();
	?>
	<tr>
		<td valign="top"  width="40%"><label for="RSS_ACTIVE"><?echo GetMessage("IB_E_RSS_ACTIVE")?></label></td>
		<td valign="top" width="60%">
			<input type="hidden" name="RSS_ACTIVE" value="N">
			<input type="checkbox" id="RSS_ACTIVE" name="RSS_ACTIVE" value="Y"<?if($str_RSS_ACTIVE=="Y")echo " checked"?>>
		</td>
	</tr>
	<tr>
		<td valign="top" ><? echo GetMessage("IB_E_RSS_TTL")?></td>
		<td valign="top">
			<input type="text" name="RSS_TTL" size="20"  maxlength="40" value="<?echo $str_RSS_TTL?>">
		</td>
	</tr>

	<tr>
		<td valign="top"><label for="RSS_FILE_ACTIVE"><?echo GetMessage("IB_E_RSS_FILE_ACTIVE")?></label></td>
		<td valign="top">
			<input type="hidden" name="RSS_FILE_ACTIVE" value="N">
			<input type="checkbox" id="RSS_FILE_ACTIVE" name="RSS_FILE_ACTIVE" value="Y"<?if($str_RSS_FILE_ACTIVE=="Y")echo " checked"?>>
		</td>
	</tr>
	<tr>
		<td valign="top"  ><? echo GetMessage("IB_E_RSS_FILE_LIMIT")?></td>
		<td valign="top"  >
			<input type="text" name="RSS_FILE_LIMIT"  size="20" maxlength="40" value="<?echo $str_RSS_FILE_LIMIT?>">
		</td>
	</tr>
	<tr>
		<td valign="top" ><? echo GetMessage("IB_E_RSS_FILE_DAYS")?></td>
		<td valign="top">
			<input type="text" name="RSS_FILE_DAYS"  size="20" maxlength="40" value="<?echo $str_RSS_FILE_DAYS?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><label for="RSS_YANDEX_ACTIVE"><?echo GetMessage("IB_E_RSS_YANDEX_ACTIVE")?></label></td>
		<td valign="top">
			<input type="hidden" name="RSS_YANDEX_ACTIVE" value="N">
			<input type="checkbox" id="RSS_YANDEX_ACTIVE" name="RSS_YANDEX_ACTIVE" value="Y"<?if($str_RSS_YANDEX_ACTIVE=="Y")echo " checked"?>>
		</td>
	</tr>

	<tr class="heading">
		<td colspan="2"><?echo GetMessage("IB_E_RSS_TITLE")?>:</td>
	</tr>
	<tr>
		<td valign="top"  colspan="2" align="center">
			<table>
				<tr class="heading">
					<td><?echo GetMessage("IB_E_RSS_FIELD")?></td>
					<td><?echo GetMessage("IB_E_RSS_TEMPL")?></td>
				</tr>
				<?
				$arCurNodesRSS = CIBlockRSS::GetNodeList(IntVal($ID));
				$arNodesRSS = CIBlockRSS::GetRSSNodes();
				foreach($arNodesRSS as $key => $val):
					if($bVarsFromForm)
						$DB->InitTableVarsForEdit("b_iblock_rss", "RSS_", "str_RSS_", "_".$key);
					?>
					<tr>
						<td>
							<input type="text"  size="15" readonly maxlength="50" name="RSS_NODE_<?echo $key?>" value="<?echo $val?>">
						</td>
						<td><input type="text"  name="RSS_NODE_VALUE_<?echo $key?>" value="<?echo $arCurNodesRSS[$val]?>"></td>
					</tr>
				<?endforeach;?>
			</table>
		</td>
	</tr>
	<?
endif;
if (true == $bCatalog)
{
	$arIBlockTypeIDList = array();
	$arIBlockTypeNameList = array();
	$rsIBlockTypes = CIBlockType::GetList(array("sort"=>"asc"), array("ACTIVE"=>"Y"));
	while ($arIBlockType = $rsIBlockTypes->Fetch())
	{
		if ($ar = CIBlockType::GetByIDLang($arIBlockType["ID"], LANGUAGE_ID, true))
		{
			if ($str_OF_NEW_IBLOCK_TYPE_ID == $arIBlockType["ID"])
			{
				$str_OF_NEW_IBLOCK_TYPE_ID = '';
				$str_OF_IBLOCK_TYPE_ID = $arIBlockType["ID"];
				$str_OF_CREATE_IBLOCK_TYPE_ID = 'N';
			}
			$arIBlockTypeIDList[] = htmlspecialchars($arIBlockType["ID"]);
			$arIBlockTypeNameList[] = htmlspecialchars('['.$arIBlockType["ID"].'] '.$ar["~NAME"]);
		}
	}

	$arIBlockSitesList = array();
	$arIBlockFullInfo = array();

	$rsIBlocks = CIBlock::GetList(array('IBLOCK_TYPE' => 'ASC','NAME' => 'ASC'));
	while ($arIBlock = $rsIBlocks->Fetch())
	{
		if (false == array_key_exists($arIBlock['ID'],$arIBlockSitesList))
		{
			$arLIDList = array();
			$arWithoutLinks = array();
			$rsIBlockSites = CIBlock::GetSite($arIBlock['ID']);
			while ($arIBlockSite = $rsIBlockSites->Fetch())
			{
				$arLIDList[] = $arIBlockSite['LID'];
				$arWithoutLinks[] = htmlspecialchars($arIBlockSite['LID']);
			}
			$arIBlockSitesList[$arIBlock['ID']] = array(
				'SITE_ID' => $arLIDList,
				'WITHOUT_LINKS' => implode(' ',$arWithoutLinks),
			);
		}
		$arIBlockItem = array(
			'ID' => $arIBlock['ID'],
			'IBLOCK_TYPE_ID' => $arIBlock['IBLOCK_TYPE_ID'],
			'SITE_ID' => $arIBlockSitesList[$arIBlock['ID']]['SITE_ID'],
			'NAME' => htmlspecialchars($arIBlock['NAME']),
			'ACTIVE' => $arIBlock['ACTIVE'],
			'FULL_NAME' => '['.$arIBlock['IBLOCK_TYPE_ID'].'] '.htmlspecialchars($arIBlock['NAME']).' ('.$arIBlockSitesList[$arIBlock['ID']]['WITHOUT_LINKS'].')',
			'IS_CATALOG' => 'N',
			'SUBSCRIPTION' => 'N',
			'YANDEX_EXPORT' => 'N',
			'VAT_ID' => 0,
			'PRODUCT_IBLOCK_ID' => 0,
			'SKU_PROPERTY_ID' => 0,
			'OFFERS_IBLOCK_ID' => 0,
			'IS_OFFERS' => 'N',
		);
		$ar_res1 = CCatalog::GetByID($arIBlock['ID']);
		if (true == is_array($ar_res1))
		{
			$arIBlockItem['IS_CATALOG'] = 'Y';
			$arIBlockItem['SUBSCRIPTION'] = $ar_res1['SUBSCRIPTION'];
			$arIBlockItem['YANDEX_EXPORT'] = $ar_res1['YANDEX_EXPORT'];
			$arIBlockItem['VAT_ID'] = $ar_res1['VAT_ID'];
			$arIBlockItem['PRODUCT_IBLOCK_ID'] = $ar_res1['PRODUCT_IBLOCK_ID'];
			$arIBlockItem['SKU_PROPERTY_ID'] = $ar_res1['SKU_PROPERTY_ID'];
			$arIBlockItem['OFFERS_IBLOCK_ID'] = 0;
			if (0 < $ar_res1['PRODUCT_IBLOCK_ID'])
				$arIBlockItem['IS_OFFERS'] = 'Y';
		}

		$arIBlockFullInfo[$arIBlock['ID']] = $arIBlockItem;
	}
	foreach ($arIBlockFullInfo as $res)
	{
		if (0 < $res['PRODUCT_IBLOCK_ID'])
			$arIBlockFullInfo[$res['PRODUCT_IBLOCK_ID']]['OFFERS_IBLOCK_ID'] = $res['ID'];
	}

	$tabControl->BeginNextTab();
	?>
	<script type="text/javascript">
	var obOFProps = new JCIBlockProperty({
		'PREFIX': '<? echo $strPREFIX_OF_PROPERTY ?>',
		'FORM_ID': 'frm',
		'TABLE_PROP_ID': 'of_prop_list',
		'PROP_COUNT_ID': 'INT_OFFERS_PROPERTY_COUNT',
		'IBLOCK_ID': 0,
		'LANG': '<? echo LANGUAGE_ID; ?>',
		'TITLE': '<? echo CUtil::JSEscape(GetMessage('IB_E_OF_PROPERTY_DETAIL')); ?>',
		'OBJ': 'obOFProps',
		'SESS': '<? echo bitrix_sessid_get(); ?>'
	});

	obOFProps.SetCells(CellTPL,7,CellAttr);
	</script>
	<tr class="heading">
		<td colspan="2"><?echo GetMessage("IB_E_CATALOG_TITLE")?></td>
	</tr>
	<tr>
		<td valign="top"  width="40%"><label for="IS_CATALOG_Y"><?echo GetMessage("IB_E_IS_CATALOG")?></label></td>
		<td valign="top" width="60%">
			<input type="hidden" name="IS_CATALOG" id="IS_CATALOG_N" value="N">
			<input type="checkbox" name="IS_CATALOG" id="IS_CATALOG_Y" value="Y"<?if('Y' == $str_IS_CATALOG)echo " checked"?><? if ('O' == $str_CATALOG_TYPE) echo ' disabled="disabled"'; ?> onclick="ib_checkFldActivity(0);">
		</td>
	</tr>
	<tr>
		<td valign="top"  width="40%"><label for="IS_CONTENT_Y"><?echo GetMessage("IB_E_IS_CONTENT")?></label></td>
		<td valign="top" width="60%">
			<input type="hidden" id="IS_CONTENT_N" name="SUBSCRIPTION" value="N">
			<input type="checkbox" id="IS_CONTENT_Y" name="SUBSCRIPTION" value="Y"<?if('Y' == $str_SUBSCRIPTION)echo " checked"?> onclick="ib_checkFldActivity(1)">
		</td>
	</tr>
	<tr>
		<td valign="top"  width="40%"><label for="YANDEX_EXPORT_Y"><?echo GetMessage("IB_E_YANDEX_EXPORT")?></label></td>
		<td valign="top" width="60%">
			<input type="hidden" id="YANDEX_EXPORT_N" name="YANDEX_EXPORT" value="N">
			<input type="checkbox" id="YANDEX_EXPORT_Y" name="YANDEX_EXPORT" value="Y"<?if('Y' == $str_YANDEX_EXPORT)echo " checked"?> <? if ('Y' != $str_IS_CATALOG) echo 'disabled="disabled"'; ?>>
		</td>
	</tr>
	<tr>
		<td valign="top"  width="40%"><label for="VAT_ID"><?echo GetMessage("IB_E_VAT_ID")?></label></td>
		<td valign="top" width="60%"><?
		$arVATRef = CatalogGetVATArray(array(), true);
		?><?=SelectBoxFromArray('VAT_ID', $arVATRef, $str_VAT_ID, '', ('Y' != $str_IS_CATALOG ? 'disabled="disabled"' : ''));?></td>
	</tr>
	<tr class="heading">
		<td colspan="2"><?echo GetMessage("IB_E_SKU_TITLE")?></td>
	</tr>
	<input type="hidden" name="CATALOG_TYPE" value="<? echo htmlspecialchars($str_CATALOG_TYPE);?>" id="CATALOG_TYPE">
	<?
	if ('O' == $str_CATALOG_TYPE)
	{
	?>
	<tr>
		<td valign="top"  width="40%"><?echo GetMessage("IB_E_IS_SKU")?></td>
		<td valign="top" width="60%"><a href="/bitrix/admin/iblock_edit.php?type=<? echo $str_PRODUCT_IBLOCK_TYPE_ID; ?>&lang=<? echo LANGUAGE_ID; ?>&ID=<? echo $str_PRODUCT_IBLOCK_ID; ?>&admin=Y"><? echo htmlspecialchars($str_PRODUCT_IBLOCK_NAME); ?></a></td>
	</tr>
	<?
	}
	else
	{
	?>
	<tr>
		<td valign="top"  width="40%"><label for="USED_SKU_Y"><?echo GetMessage("IB_E_USED_SKU")?></label></td>
		<td valign="top" width="60%">
			<input type="hidden" id="USED_SKU_N" name="USED_SKU" value="N">
			<input type="checkbox" id="USED_SKU_Y" name="USED_SKU" value="Y"<?if('Y' == $str_USED_SKU) echo " checked"?> onclick="ib_skumaster(this)">
		</td>
	</tr>
	<tr>
	<td colspan="2">
	<div style="display: <? echo ('Y' == $str_USED_SKU ? 'block' : 'none');?>; width: 100%;" id="SKU-SETTINGS">
		<table style="width: 100%;"><tbody>
		<tr>
		<td valign="top"  width="40%" class="field-name"><?echo GetMessage("IB_E_OF_IBLOCK_INFO")?></td>
		<td valign="top" width="60%"><select id="OF_IBLOCK_ID" name="OF_IBLOCK_ID" class="typeselect" size="1" onchange="show_add_offers(this);">
			<option value="0" <? echo (0 == $str_OF_IBLOCK_ID ? 'selected' : '');?>><? echo GetMessage('IB_E_OF_IBLOCK_EMPTY')?></option>
			<option value="<? echo CATALOG_NEW_OFFERS_IBLOCK_NEED; ?>" <? echo (CATALOG_NEW_OFFERS_IBLOCK_NEED == $str_OF_IBLOCK_ID ? 'selected' : '');?>><? echo GetMessage('IB_E_OF_IBLOCK_NEW')?></option><?
			if (0 < $ID)
			{
				// for new iblock only new offers
				foreach ($arIBlockFullInfo as $value)
				{
					$boolAdd = true;
					if ($value['ID'] == $str_OF_IBLOCK_ID)
					{
						$boolAdd = true;
					}
					elseif (('N' == $value['ACTIVE']) || ('Y' == $value['IS_OFFERS']) || (0 < $value['OFFERS_IBLOCK_ID']) || ($ID == $value['ID']))
					{
						$boolAdd = false;
					}
					else
					{
						if (0 < $ID)
						{
							$arDiffParent = array();
							$arDiffParent = array_diff($value['SITE_ID'],$str_LID);
							$arDiffOffer = array();
							$arDiffOffer = array_diff($str_LID,$value['SITE_ID']);
							if ((false == empty($arDiffParent)) || (false == empty($arDiffOffer)))
							{
								$boolAdd = false;
							}
						}
					}
					if (true == $boolAdd)
					{
						?><option value="<? echo intval($value['ID']); ?>"<? echo ($value['ID'] == $str_OF_IBLOCK_ID ? ' selected' : ''); ?>><? echo $value['FULL_NAME']; ?></option><?
					}
				}
			}
		?></select>
		</td>
		</tr>
		</tbody></table>
			<div id="offers_add_info" style="display: <? echo (CATALOG_NEW_OFFERS_IBLOCK_NEED == $str_OF_IBLOCK_ID ? 'display' : 'none'); ?>; width: 100%; text-align: center;"><table style="margin: auto;"><tbody>
			<tr><td style="text-align: right; width: 25%;" class="field-name"><? echo GetMessage('IB_E_OF_PR_TITLE'); ?>:</td><td style="text-align: left; width: 75%;"><input type="text" name="OF_IBLOCK_NAME" value="<? echo $str_OF_IBLOCK_NAME;?>" style="width: 100%;" /></td></tr>
			<tr><td style="text-align: left; width: 100%;" colspan="2" class="field-name"><input type="radio" value="N" id="OF_CREATE_IBLOCK_TYPE_ID_N" name="OF_CREATE_IBLOCK_TYPE_ID" <? echo ('N' == $str_OF_CREATE_IBLOCK_TYPE_ID ? 'checked="checked"' : '')?> onclick="change_offers_ibtype(this);"><label for="CREATE_OFFERS_TYPE_N"><? echo GetMessage('IB_E_OF_PR_OLD_IBTYPE');?></label></td></tr>
			<tr><td style="text-align: right; width: 25%;" class="field-name"><? echo GetMessage('IB_E_OF_PR_OFFERS_TYPE'); ?>:</td><td style="text-align: left; width: 75%;"><? echo SelectBoxFromArray('OF_IBLOCK_TYPE_ID',array('REFERENCE' => $arIBlockTypeNameList,'REFERENCE_ID' => $arIBlockTypeIDList),$str_OF_IBLOCK_TYPE_ID,'',('N' == $str_OF_CREATE_IBLOCK_TYPE_ID ? '' : 'disabled="disabled"')); ?></td></tr>
			<tr><td style="text-align: left; width: 100%;" colspan="2" class="field-name"><input type="radio" value="Y" id="OF_CREATE_IBLOCK_TYPE_ID_Y" name="OF_CREATE_IBLOCK_TYPE_ID" <? echo ('Y' == $str_OF_CREATE_IBLOCK_TYPE_ID ? 'checked="checked"' : '')?> onclick="change_offers_ibtype(this);"><label for="CREATE_OFFERS_TYPE_Y"><? echo GetMessage('IB_E_OF_PR_OFFERS_NEW_IBTYPE');?></label></td></tr>
			<tr><td style="text-align: right; width: 25%;" class="field-name"><? echo GetMessage('IB_E_OF_PR_OFFERS_NEWTYPE'); ?>:</td><td style="text-align: left; width: 75%;"><input type="text" name="OF_NEW_IBLOCK_TYPE_ID" id="OF_NEW_IBLOCK_TYPE_ID" value="" style="width: 100%;" <? echo ('Y' == $str_OF_CREATE_IBLOCK_TYPE_ID ? '' : 'disabled="disabled"') ?> /></td></tr>
			</tbody></table>
			<div><b><? echo GetMessage('IB_E_OFFERS_PROPERTIES'); ?></b></div>
<table border="0" cellspacing="0" cellpadding="0" class="internal" style="text-align: center; margin: auto;" id="of_prop_list">
				<tr class="heading">
					<td>ID</td>
					<td><?echo GetMessage("IB_E_PROP_NAME_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_TYPE_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_MULT_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_REQIRED_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_SORT_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_CODE_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_MODIFY_SHORT")?></td>
					<td><?echo GetMessage("IB_E_PROP_DELETE_SHORT")?></td>
				</tr>
				<?
				$arOFPropList = array();
				if (0 < intval($str_OF_IBLOCK_ID))
				{
					$rsProps = CIBlock::GetProperties($str_OF_IBLOCK_ID, array("sort"=>"asc"));
					while ($arProp = $rsProps->Fetch())
					{
						if (true == $bVarsFromForm)
						{
							$intPropID = $arProp['ID'];
							$arTempo = GetPropertyInfo($strPREFIX_OF_PROPERTY,$intPropID,true);
							if (true == is_array($arTempo))
								$arProp = $arTempo;
							$arProp['ID'] = $intPropID;
						}
						$arProp = ConvertToSafe($arProp,$arDisabledPropFields);
						$arProp['SHOW_DEL'] = 'Y';
						$arOFPropList[$arProp['ID']] = $arProp;
					}
				}

				$intPropCount = intval($_POST['OFFERS_PROPERTY_COUNT']);
				if (0 >= $intPropCount)
					$intPropCount = PROPERTY_EMPTY_ROW_SIZE;
				$intPropNumber = 0;
				for ($i = 0; $i < $intPropCount; $i++)
				{
					$arProp = GetPropertyInfo($strPREFIX_OF_PROPERTY,'n'.$i,true);
					if (true == is_array($arProp))
					{
						$arProp = ConvertToSafe($arProp,$arDisabledPropFields);
						$arProp['ID'] = 'n'.$intPropNumber;
						$arOFPropList['n'.$intPropNumber] = $arProp;
						$intPropNumber++;
					}
				}
				for (0; $intPropNumber < PROPERTY_EMPTY_ROW_SIZE; $intPropNumber++)
				{
					$arProp = $arDefPropInfo;
					$arProp['ID'] = 'n'.$intPropNumber;
					$arOFPropList['n'.$intPropNumber] = $arProp;
				}
				foreach ($arOFPropList as $mxPropID => $arProp)
				{
					$arProp['IBLOCK_ID'] = $ID;
					echo __AddPropRow($mxPropID,$strPREFIX_OF_PROPERTY,$arProp);
				}
				?></table>
				<div style="width: 100%; text-align: center;">
				<input onclick="obOFProps.addPropRow();" type="button" value="<? echo GetMessage('IB_E_SHOW_ADD_PROP_ROW')?>" title="<? echo GetMessage('IB_E_SHOW_ADD_PROP_ROW_DESCR')?>">
				</div>
				<input type="hidden" name="OFFERS_PROPERTY_COUNT" id="INT_OFFERS_PROPERTY_COUNT" value="<? echo $intPropNumber; ?>">
			</div>
	</div>
	</td>
	</tr>
	<?
	}
	?>
<script type="text/javascript">
	var is_cat = BX('IS_CATALOG_Y');
	var is_cont = BX('IS_CONTENT_Y');
	var is_yand = BX('YANDEX_EXPORT_Y');
	var vat_id = BX('VAT_ID');

	var cat_type =  BX('CATALOG_TYPE');

	var use_sku = BX('USED_SKU_Y');
	var ob_sku_settings = BX('SKU-SETTINGS');

	var ob_offers_add = BX('offers_add_info');

	var ob_of_iblock_type_id = BX('OF_IBLOCK_TYPE_ID');
	var ob_of_new_iblock_type_id = BX('OF_NEW_IBLOCK_TYPE_ID');

	function ib_checkFldActivity(flag)
	{
		if (0 == flag)
		{
			if (undefined != cat_type)
			{
				if ('O' == cat_type.value)
					is_cat.checked = true;
			}
			if (!is_cat.checked)
			{
				is_cont.checked = false;
				is_yand.checked = false;
			}
		}
		if (1 == flag)
			if (is_cont.checked)
				is_cat.checked = true;

		var bActive = is_cat.checked;
		is_yand.disabled = !bActive;
		vat_id.disabled = !bActive;
	}
	function ib_skumaster(obj)
	{
		if (undefined != ob_sku_settings)
		{
			var bActive = obj.checked;
			ob_sku_settings.style.display = (true == bActive ? 'block' : 'none');
		}
	}

	function show_add_offers(obj)
	{
		var value = obj.options[obj.selectedIndex].value;
		if (undefined !== ob_offers_add)
		{
			if (<? echo CATALOG_NEW_OFFERS_IBLOCK_NEED; ?> == value)
			{
				ob_offers_add.style.display = 'block';
			}
			else
			{
				ob_offers_add.style.display = 'none';
			}
		}
	}
	function change_offers_ibtype(obj)
	{
		var value = obj.value;
		if ('Y' == value)
		{
			ob_of_iblock_type_id.disabled = true;
			ob_of_new_iblock_type_id.disabled = false;
		}
		else if ('N' == value)
		{
			ob_of_iblock_type_id.disabled = false;
			ob_of_new_iblock_type_id.disabled = true;
		}
	}
</script>	<?
}

$tabControl->BeginNextTab();
?>
	<?
	if ($bWorkflow && $str_WORKFLOW=="Y") :
		$arPermType = Array(
			"D"=>GetMessage("IB_E_ACCESS_D"),
			"R"=>GetMessage("IB_E_ACCESS_R"),
			"U"=>GetMessage("IB_E_ACCESS_U"),
			"W"=>GetMessage("IB_E_ACCESS_W"),
			"X"=>GetMessage("IB_E_ACCESS_X"));
	elseif ($bBizprocTab) :
		$arPermType = Array(
			"D"=>GetMessage("IB_E_ACCESS_D"),
			"R"=>GetMessage("IB_E_ACCESS_R"),
			"U"=>GetMessage("IB_E_ACCESS_U2"),
			"W"=>GetMessage("IB_E_ACCESS_W"),
			"X"=>GetMessage("IB_E_ACCESS_X"));
	else :
		$arPermType = Array(
			"D"=>GetMessage("IB_E_ACCESS_D"),
			"R"=>GetMessage("IB_E_ACCESS_R"),
			"W"=>GetMessage("IB_E_ACCESS_W"),
			"X"=>GetMessage("IB_E_ACCESS_X"));
	endif;
	$perm = $ib->GetGroupPermissions($ID);
	if(!array_key_exists(1, $perm))
		$perm[1] = "X";
	?>
	<tr class="heading">
		<td colspan="2"><?echo GetMessage("IB_E_DEFAULT_ACCESS_TITLE")?></td>
	</tr>
	<tr>
		<td valign="top" nowrap width="40%"><?echo GetMessage("IB_E_EVERYONE")?> [<a class="tablebodylink" href="/bitrix/admin/group_edit.php?ID=2&amp;lang=<?=LANGUAGE_ID?>">2</a>]:</td>
		<td valign="top" width="60%">

				<select name="GROUP[2]" id="group_2">
				<?
				if($bVarsFromForm)
					$strSelected = $GROUP[2];
				else
					$strSelected = $perm[2];
				foreach($arPermType as $key => $val):
				?>
					<option value="<?echo $key?>"<?if($strSelected == $key)echo " selected"?>><?echo htmlspecialcharsex($val)?></option>
				<?endforeach?>
				</select>

				<script language="JavaScript">
				function OnGroupChange(control, message)
				{
					var all = document.getElementById('group_2');
					var msg = document.getElementById(message);
					if(all && all.value >= control.value && control.value != '')
					{
						if(msg) msg.innerHTML = '<?echo CUtil::JSEscape(GetMessage("IB_E_ACCESS_WARNING"))?>';
					}
					else
					{
						if(msg) msg.innerHTML = '';
					}
				}
				</script>

		</td>
	</tr>
	<tr class="heading">
		<td colspan="2"><?echo GetMessage("IB_E_GROUP_ACCESS_TITLE")?></td>
	</tr>
	<?
	$groups = CGroup::GetList($by="sort", $order="asc", Array("ID"=>"~2"));
	while($r = $groups->GetNext()):
		if($bVarsFromForm)
			$strSelected = $GROUP[$r["ID"]];
		else
			$strSelected = $perm[$r["ID"]];

		if($strSelected=="U" && !CModule::IncludeModule("workflow"))
			$strSelected="R";

		if($strSelected!="R" &&
			$strSelected!="U" &&
			$strSelected!="W" &&
			$strSelected!="X" &&
			$ID>0 && !$bVarsFromForm)
				$strSelected="";
		?>
	<tr>
		<td valign="top" nowrap width="40%"><?echo $r["NAME"]?> [<a class="tablebodylink" href="/bitrix/admin/group_edit.php?ID=<?=$r["ID"]?>&lang=<?=LANGUAGE_ID?>"><?=$r["ID"]?></a>]:</td>
		<td valign="top" width="60%">

				<select name="GROUP[<?echo $r["ID"]?>]" OnChange="OnGroupChange(this, 'spn_group_<?echo $r["ID"]?>');">
					<option value=""><?echo GetMessage("IB_E_DEFAULT_ACCESS")?></option>
				<?
				foreach($arPermType as $key => $val):
				?>
					<option value="<?echo $key?>"<?if($strSelected == $key)echo " selected"?>><?echo htmlspecialcharsex($val)?></option>
				<?endforeach?>
				</select>
				<span id="spn_group_<?echo $r["ID"]?>"></span>
		</td>
	</tr>
	<?endwhile?>
	<?
$tabControl->BeginNextTab();
	$arMessages = CIBlock::GetMessages($ID);
	if($bVarsFromForm)
	{
		foreach($arMessages as $MESSAGE_ID => $MESSAGE_TEXT)
			$arMessages[$MESSAGE_ID] = $_REQUEST[$MESSAGE_ID];
	}
	if($arIBTYPE["SECTIONS"]=="Y"):?>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_SECTIONS_NAME")?></td>
		<td valign="top">
			<input type="text" name="SECTIONS_NAME" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["SECTIONS_NAME"])?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_SECTION_NAME")?></td>
		<td valign="top">
			<input type="text" name="SECTION_NAME" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["SECTION_NAME"])?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_SECTION_ADD")?></td>
		<td valign="top">
			<input type="text" name="SECTION_ADD" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["SECTION_ADD"])?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_SECTION_EDIT")?></td>
		<td valign="top">
			<input type="text" name="SECTION_EDIT" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["SECTION_EDIT"])?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_SECTION_DELETE")?></td>
		<td valign="top">
			<input type="text" name="SECTION_DELETE" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["SECTION_DELETE"])?>">
		</td>
	</tr>
	<?endif?>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_ELEMENTS_NAME")?></td>
		<td valign="top">
			<input type="text" name="ELEMENTS_NAME" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["ELEMENTS_NAME"])?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_ELEMENT_NAME")?></td>
		<td valign="top">
			<input type="text" name="ELEMENT_NAME" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["ELEMENT_NAME"])?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_ELEMENT_ADD")?></td>
		<td valign="top">
			<input type="text" name="ELEMENT_ADD" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["ELEMENT_ADD"])?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_ELEMENT_EDIT")?></td>
		<td valign="top">
			<input type="text" name="ELEMENT_EDIT" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["ELEMENT_EDIT"])?>">
		</td>
	</tr>
	<tr>
		<td valign="top"><?echo GetMessage("IB_E_ELEMENT_DELETE")?></td>
		<td valign="top">
			<input type="text" name="ELEMENT_DELETE" size="20" maxlength="100" value="<?echo htmlspecialchars($arMessages["ELEMENT_DELETE"])?>">
		</td>
	</tr>
	<?
if ($bBizprocTab):
$tabControl->BeginNextTab();

	if (!isset($arWorkflowTemplates))
		$arWorkflowTemplates = CBPDocument::GetWorkflowTemplatesForDocumentType(array("iblock", "CIBlockDocument", "iblock_".$ID));
	?>
	<tr>
		<td valign="top" colspan="2">
			<?if (count($arWorkflowTemplates) > 0):?>
				<table border="0" cellspacing="0" cellpadding="0" class="internal">
					<tr class="heading">
						<td><?echo GetMessage("IB_E_BP_NAME")?></td>
						<td><?echo GetMessage("IB_E_BP_CHANGED")?></td>
						<td><?echo GetMessage("IB_E_BP_AUTORUN")?></td>
					</tr>
					<?
					foreach ($arWorkflowTemplates as $arTemplate)
					{
						?>
						<tr>
							<td valign="top">
								<?if(IsModuleInstalled("bizprocdesigner")):?>
									<a href="/bitrix/admin/iblock_bizproc_workflow_edit.php?document_type=iblock_<?= $ID ?>&lang=<?=LANGUAGE_ID?>&ID=<?=$arTemplate["ID"]?>&back_url_list=<?= urlencode($APPLICATION->GetCurPageParam("", array()))?>" target="_blank"><?= $arTemplate["NAME"] ?> [<?=$arTemplate["ID"]?>]</a>
								<?else:?>
									<?= $arTemplate["NAME"] ?>
								<?endif?>
								<br /><small><?= $arTemplate["DESCRIPTION"] ?></small></td>
							<td valign="top"><?= $arTemplate["MODIFIED"] ?><br />[<a href="user_edit.php?ID=<?= $arTemplate["USER_ID"] ?>"><?= $arTemplate["USER_ID"] ?></a>] <?= $arTemplate["USER"] ?></td>
							<td valign="top">
								<?
									if($bVarsFromForm)
										$checked = $_REQUEST["create_bizproc_".$arTemplate["ID"]] == "Y";
									else
										$checked = ($arTemplate["AUTO_EXECUTE"] & 1) != 0;
								?>
								<label><input type="checkbox" id="id_create_bizproc_<?= $arTemplate["ID"] ?>" name="create_bizproc_<?= $arTemplate["ID"] ?>" value="Y"<?echo $checked? " checked" : ""?>><?echo GetMessage("IB_E_BP_AUTORUN_CREATE")?></label><br />
								<?
									if($bVarsFromForm)
										$checked = $_REQUEST["edit_bizproc_".$arTemplate["ID"]] == "Y";
									else
										$checked = ($arTemplate["AUTO_EXECUTE"] & 2) != 0;
								?>
								<label><input type="checkbox" id="id_edit_bizproc_<?= $arTemplate["ID"] ?>" name="edit_bizproc_<?= $arTemplate["ID"] ?>" value="Y"<?echo $checked? " checked" : ""?>><?echo GetMessage("IB_E_BP_AUTORUN_UPDATE")?></label><br />
							</td>
						</tr>
						<?
					}
					?>
				</table>
				<br>
			<?endif;?>
			<?if(IsModuleInstalled("bizprocdesigner")):?>
			<a href="/bitrix/admin/iblock_bizproc_workflow_admin.php?document_type=iblock_<?= $ID ?>&lang=<?=LANGUAGE_ID?>&back_url_list=<?= urlencode($APPLICATION->GetCurPageParam("", array())) ?>" target="_blank"><?echo GetMessage("IB_E_GOTO_BP")?></a>
			<?endif?>
		</td>
	</tr>
	<?
endif;

$tabControl->BeginNextTab();
	if($bVarsFromForm)
		$arFields = $_REQUEST["FIELDS"];
	else
		$arFields = CIBlock::GetFields($ID);
	$arDefFields = CIBlock::GetFieldsDefaults();
	foreach($arDefFields as $FIELD_ID => $arField):
		if(!preg_match("/^LOG_/", $FIELD_ID)) continue;
		?>
		<tr valign="top">
			<td width="40%"><label for="<?echo $FIELD_ID?>"><?echo GetMessage("IB_E_".$FIELD_ID)?></label>:</td>
			<td>
				<input type="hidden" value="N" name="FIELDS[<?echo $FIELD_ID?>][IS_REQUIRED]">
				<input type="checkbox" value="Y" name="FIELDS[<?echo $FIELD_ID?>][IS_REQUIRED]" <?if($arFields[$FIELD_ID]["IS_REQUIRED"]==="Y" || $arDefFields[$FIELD_ID]["IS_REQUIRED"]!==false) echo "checked"?> <?if($arDefFields[$FIELD_ID]["IS_REQUIRED"]!==false) echo "disabled"?>>
			</td>
		</tr>
	<?endforeach?>
<?
	$tabControl->Buttons(array("disabled"=>false, "back_url"=>'iblock_admin.php?lang='.$lang.'&type='.urlencode($type).'&admin='.($_REQUEST["admin"]=="Y"? "Y": "N")));
	$tabControl->End();
	?>
</form>

<?else: //if($Perm<="X"):?>
<br>
<?echo ShowError(GetMessage("IBLOCK_BAD_IBLOCK"));?>

<?
endif;

else: //if($arIBTYPE!==false):?>
<br>
<?echo ShowError(GetMessage("IBLOCK_BAD_BLOCK_TYPE_ID"));?>

<?
endif;// if($arIBTYPE!==false):

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>