<?php

// Last Modified
\Bitrix\Main\Loader::includeModule('shestpa.lastmodified');

require_once dirname(__FILE__) .'/functions.php';
global $sape;
if (!defined('_SAPE_USER')){
    define('_SAPE_USER', 'bdba2e8b22730640fe465087a2738043');
}
require_once(realpath($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'));
$o['force_show_code'] = true;
$sape = new SAPE_client($o);

define("PATH_TO_404", "/404.php");
AddEventHandler("main", "OnEpilog", "Redirect404");
//function Redirect404() {
//    if(
//        !defined('ADMIN_SECTION') &&
//        defined("ERROR_404") &&
//        defined("PATH_TO_404") &&
//        file_exists($_SERVER["DOCUMENT_ROOT"].PATH_TO_404)
//    ) {
//        //LocalRedirect("/404.php", "404 Not Found");
//        global $APPLICATION;
//        $APPLICATION->RestartBuffer();
//        CHTTP::SetStatus("404 Not Found");
//        include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
//        include($_SERVER["DOCUMENT_ROOT"].PATH_TO_404);
//        include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");
//    }
//}

//вырезаем type="text/javascript"
AddEventHandler("main", "OnEndBufferContent", "removeType");
function removeType(&$content) {
    $content = replace_output($content);
}

function replace_output($d){
    return str_replace(' type="text/javascript"', "", $d);
}

function set_seo_link($link, $txt){
    $out = '';
    if ($_SERVER['REQUEST_URI'] != $link){
        $out = '<a href="'.$link.'">'.$txt.'</a>';
    }else{
        $out = $txt;
    }

    return $out;
}
?>
