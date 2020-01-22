<?
/*********************************************************************
						Caching
*********************************************************************/
class CPHPCacheFiles
{
	var $filename;
	var $folder;
	var $content;
	var $vars;
	var $TTL;
	var $uniq_str;
	var $initdir;
	var $bStarted = false;
	var $bInit = "NO";
	//cache stats
	var $written = false;
	var $read = false;

	function IsAvailable()
	{
		return true;
	}

	function clean($basedir, $initdir, $filename = false)
	{
		if(strlen($filename))
		{
			$fn = $_SERVER["DOCUMENT_ROOT"].$basedir.$initdir.$filename;

			//This checks for Zend Server CE in order to supress warnings
			if(function_exists('accelerator_reset'))
			{
				@chmod($fn, BX_FILE_PERMISSIONS);
				if(@unlink($fn))
				{
					bx_accelerator_reset();
					return true;
				}
			}
			else
			{
				if(file_exists($fn))
				{
					@chmod($fn, BX_FILE_PERMISSIONS);
					if(unlink($fn))
					{
						bx_accelerator_reset();
						return true;
					}
				}
			}
			return false;
		}
		else
		{
			global $DB, $APPLICATION;
			static $bAgentAdded = false;

			$source = "/".trim($basedir, "/")."/".trim($initdir, "/");
			$target = $source.".~";
			$bDelayedDelete = false;
			for($i = 0; $i < 9; $i++) //try to get new directory name no more than ten times
			{
				$suffix = rand(0, 999999);
				if(!file_exists($_SERVER["DOCUMENT_ROOT"].$target.$suffix))
				{
					if(
						$DB->Query("INSERT INTO b_cache_tag (SITE_ID, CACHE_SALT, RELATIVE_PATH, TAG)
						VALUES ('*', '*', '".$DB->ForSQL($target.$suffix)."', '*')")
					)
					{
						if(@rename($_SERVER["DOCUMENT_ROOT"].$source, $_SERVER["DOCUMENT_ROOT"].$target.$suffix))
							$bDelayedDelete = true;
					}
					break;
				}
			}

			if($bDelayedDelete)
			{
				if(!$bAgentAdded)
				{
					$bAgentAdded = true;
					$res = CAgent::AddAgent(
						"CPHPCacheFiles::DelayedDelete();",
						"", //module
						"Y", //period
						1 //interval
					);

					if(!$res)
						$APPLICATION->ResetException();
				}
			}
			else
			{
				DeleteDirFilesEx($basedir.$initdir);
			}

			bx_accelerator_reset();
		}
	}

	function read(&$arAllVars, $basedir, $initdir, $filename, $TTL)
	{
		$fn = $_SERVER["DOCUMENT_ROOT"].$basedir.$initdir.$filename;

		//This checks for Zend Server CE in order to supress warnings
		if(function_exists('accelerator_reset'))
		{
			$INCLUDE_FROM_CACHE='Y';
			if(!@include($fn))
				return false;
		}
		else
		{
			if(!file_exists($fn))
				return false;

			$INCLUDE_FROM_CACHE='Y';
			if(!include($fn))
				return false;
		}

		$this->read = filesize($fn);

		if(intval($datecreate) < (mktime() - $TTL))
			return false;

		$arAllVars = unserialize($ser_content);

		return true;
	}

	function write($arAllVars, $basedir, $initdir, $filename, $TTL)
	{

		$folder = $_SERVER["DOCUMENT_ROOT"].$basedir.$initdir;
		$fn = $folder.$filename;
		$tmp_fn = $folder.md5(mt_rand()).".tmp";

		if(!CheckDirPath($fn))
			return;

		if($handle = fopen($tmp_fn, "wb+"))
		{
			$contents = "<?";
			$contents .= "\nif(\$INCLUDE_FROM_CACHE!='Y')return false;";
			$contents .= "\n\$datecreate = '".str_pad(mktime(), 12, "0", STR_PAD_LEFT)."';";
			$contents .= "\n\$dateexpire = '".str_pad(mktime() + IntVal($TTL), 12, "0", STR_PAD_LEFT)."';";
			$contents .= "\n\$ser_content = '".str_replace("'", "\'", str_replace("\\", "\\\\", serialize($arAllVars)))."';";
			$contents .= "\nreturn true;";
			$contents .= "\n?>";
			$this->written = fwrite($handle, $contents);
			$len = function_exists('mb_strlen')? mb_strlen($contents, 'latin1'): strlen($contents);

			fclose($handle);

			//This checks for Zend Server CE in order to supress warnings
			if(function_exists('accelerator_reset'))
				@unlink($fn);
			elseif(file_exists($fn))
				unlink($fn);

			if($this->written === $len)
				rename($tmp_fn, $fn);

			//This checks for Zend Server CE in order to supress warnings
			if(function_exists('accelerator_reset'))
				@unlink($tmp_fn);
			elseif(file_exists($tmp_fn))
				unlink($tmp_fn);
		}
	}

	function IsCacheExpired($path)
	{
		if(!file_exists($path))
			return true;

		$dateexpire = 0;

		$INCLUDE_FROM_CACHE='Y';

		$dfile = fopen($path, "rb");
		$str_tmp = fread($dfile, 150);
		fclose($dfile);

		preg_match("/dateexpire\s*=\s*'([\d]+)'/im", $str_tmp, $arTmp);
		if (strlen($arTmp[1])<=0 || DoubleVal($arTmp[1])<mktime())
			return true;

		return false;
	}

	function DelayedDelete()
	{
		global $DB;
		$bDeleteFromQueue = false;

		$rs = $DB->Query("SELECT * from b_cache_tag WHERE TAG='*'");
		if($ar = $rs->Fetch())
		{
			$dir_name = $_SERVER["DOCUMENT_ROOT"].$ar["RELATIVE_PATH"];
			if(file_exists($dir_name))
			{
				$dh = opendir($dir_name);
				if(is_resource($dh))
				{
					$Counter = 0;
					while(($file = readdir($dh)) !== false)
					{
						if($file != "." && $file != "..")
						{
							DeleteDirFilesEx($ar["RELATIVE_PATH"]."/".$file);
							$Counter++;
							break;
						}
					}
					closedir($dh);

					if($Counter == 0)
					{
						rmdir($dir_name);
						$bDeleteFromQueue = true;
					}
				}
			}
			else
			{
				$bDeleteFromQueue = true;
			}

			if($bDeleteFromQueue)
			{
				$DB->Query("
					DELETE FROM b_cache_tag
					WHERE SITE_ID = '".$DB->ForSQL($ar["SITE_ID"])."'
					AND CACHE_SALT = '".$DB->ForSQL($ar["CACHE_SALT"])."'
					AND RELATIVE_PATH = '".$DB->ForSQL($ar["RELATIVE_PATH"])."'
				");
			}

			return "CPHPCacheFiles::DelayedDelete();";
		}
		else
		{
			return "";
		}
	}
}
?>