<?
// ini_set('display_errors','On');
// error_reporting('E_ALL');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// global $APPLICATION;

CModule::IncludeModule('iblock');

$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_UF_REGION");
$arFilter = Array("IBLOCK_ID"=>7, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");

$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

$out = array();
while($ob = $res->GetNextElement()){
	$arFields = $ob->GetFields();
	
	$params = array(
		'geocode' => 'Московская область, '.$arFields['PROPERTY_UF_REGION_VALUE'], // адрес
		'format'  => 'json',                          // формат ответа
		'sco' => 'latlong',
		'results' => 1,                               // количество выводимых результатов
	);
	$response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));

	//$response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?format=json&geocode=Москва, ул. Льва Толстого, 16'));

	if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0){
		$arr_coords = explode(' ', $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
		$arr_coords = array_reverse($arr_coords);
// 		$coords = implode(',', $arr_coords);
		//echo $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos.";
		
		$out[] = array('coords'=>$arr_coords, 'name'=>$arFields['NAME'], 'url'=>$arFields['DETAIL_PAGE_URL'], 'region'=>$arFields['PROPERTY_UF_REGION_VALUE'], 'content'=>'<b>Звоните</b>:<br />+7 (495) 792-93-92,<br />+7 (926) 339-36-53,<br />+7 (966) 178-56-56');
	}
}
$out = json_encode($out);
echo $out;
?>