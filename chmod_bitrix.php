<?php
/**
 * User: a.zemlyakov <a.zemlyakov@ad2go.ru>
 * Date: 18.01.11 16:39
 *
 * Äëÿ SSH:
 * find . -type d -exec chmod 0777 {} ';'
 * find . -type f -exec chmod 0666 {} ';'
 */

set_time_limit(120);
define("BX_FILE_PERMISSIONS", 0666);
define("BX_DIR_PERMISSIONS", 0777);

function chmod_bitrix($path) {
	if (file_exists($path)) {
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) {
			if (($file !== ".") && ($file !== "..") && ($file !== basename(__FILE__))) {
				if (is_file($path . "/" . $file)) {
					
					if (!@chmod($path . "/" . $file, BX_FILE_PERMISSIONS))
						print 'Faild: '.$path . "/" . $file."\n";
				}
				else {
					if (!@chmod($path . "/" . $file, BX_DIR_PERMISSIONS))
						print 'Faild: '.$path . "/" . $file."\n";
					chmod_bitrix($path . "/" . $file);
				}
			}
		}
		closedir($handle);
	} else return false;
}

$path = dirname(__FILE__);
umask(0);
if (!empty($_SERVER['HTTP_HOST'])) print '<pre>';
chmod_bitrix($path);
if (!empty($_SERVER['HTTP_HOST'])) print '</pre>';
?>