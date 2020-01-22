<?
class CSearchLanguage
{
	var $arStemInfo;
	var $_lang_id;
	var $_lang_bigramm_cache;
	var $_trigrams = array();

	function __construct($lang_id)
	{
		$this->_lang_id = $lang_id;
	}

	//Function loads language class
	static function GetLanguage($sLang)
	{
		static $arLanguages = array();

		if(!isset($arLanguages[$sLang]))
		{
			$class_name = strtolower("CSearchLanguage".$sLang);
			if(!class_exists($class_name))
			{
				//First try to load customized class
				$strDirName = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/php_interface/".$sLang."/search";
				$strFileName = $strDirName."/language.php";
				if(file_exists($strFileName))
					@include($strFileName);
				if(!class_exists($class_name))
				{
					//Then module class
					$strDirName = $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/search/tools/".$sLang;
					$strFileName = $strDirName."/language.php";
					if(file_exists($strFileName))
						@include($strFileName);
					if(!class_exists($class_name))
					{
						$class_name = "CSearchLanguage";
					}
				}
			}
			$arLanguages[$sLang] =  new $class_name($sLang);
			$arLanguages[$sLang]->LoadTrigrams($strDirName);
			$arLanguages[$sLang]->arStemInfo = stemming_init($sLang);
		}

		return $arLanguages[$sLang];
	}

	//Reads file with trigrams (combinations not allowed in the words)
	function LoadTrigrams($dir_name)
	{
		if(empty($this->_trigrams))
		{
			$file_name = $dir_name."/trigram";
			if(file_exists($file_name) && is_file($file_name))
			{
				$text = file_get_contents($file_name);
				$ar = explode("\n", $text);
				foreach($ar as $trigramm)
				{
					if(strlen($trigramm) == 3)
					{
						$arScanCodesTmp1 = $this->ConvertToScancode($trigramm);
						$arScanCodesTmp2 = array_filter($arScanCodesTmp1);
						if(count($arScanCodesTmp2) == 3)
						{
							$key = implode(" ", $arScanCodesTmp2);
							$this->_trigrams[$key] = true;
						}
					}
				}
			}
		}
	}

	function HasTrigrams()
	{
		return !empty($this->_trigrams);
	}

	//Check phrase against trigrams
	function CheckTrigrams($arScanCodes)
	{
		$result = 0;
		$c = count($arScanCodes)-2;
		for($i = 0; $i < $c; $i++)
		{
			if(isset($this->_trigrams[$arScanCodes[$i]." ".$arScanCodes[$i+1]." ".$arScanCodes[$i+2]]))
			{
//debug code
//$GLOBALS["proto2"][$this->_lang_id][$this->ConvertFromScancode(array($arScanCodes[$i], $arScanCodes[$i+1], $arScanCodes[$i+2]))]++;
				$result++;
			}
		}
		return $result;
	}

	//This function returns positions of the letters
	//on the keyboard. This one is default English layout
	function GetKeyboardLayout()
	{
		return array(
			"lo" => "`          - ".
				"qwertyuiop[]".
				"asdfghjkl;'".
				"zxcvbnm,. ",
			"hi" => "~            ".
				"QWERTYUIOP{}".
				"ASDFGHJKL:\"".
				"ZXCVBNM<> "
		);
	}

	function ConvertFromScancode($arScancode)
	{
		$result = "";
		$keyboard = $this->GetKeyboardLayout();
		foreach($arScancode as $code)
			$result .= substr($keyboard["lo"], $code, 1);
		return $result;
	}

	function StrToArray($str)
	{
		if(defined("BX_UTF"))
		{
			$result = array();
			$len = strlen($str);
			for($i = 0;$i < $len; $i++)
				$result[] = substr($str, $i, 1);
			return $result;
		}
		else
		{
			return str_split($str);
		}
	}

	//This function converts text between layouts
	static function ConvertKeyboardLayout($text, $from, $to)
	{
		static $keyboards = array();
		//Fill local cache
		if(!array_key_exists($from, $keyboards))
		{
			$ob = CSearchLanguage::GetLanguage($from);
			$keyboard = $ob->GetKeyboardLayout();
			if(is_array($keyboard))
				$keyboards[$from] = array_merge($ob->StrToArray($keyboard["lo"]), $ob->StrToArray($keyboard["hi"]));
			else
				$keyboards[$from] = null;
		}

		if(!array_key_exists($to, $keyboards))
		{
			$ob = CSearchLanguage::GetLanguage($to);
			$keyboard = $ob->GetKeyboardLayout();
			if(is_array($keyboard))
				$keyboards[$to] = array_merge($ob->StrToArray($keyboard["lo"]), $ob->StrToArray($keyboard["hi"]));
			else
				$keyboards[$to] = null;
		}

		//when both layouts defined
		if(isset($keyboards[$from]) && isset($keyboards[$to]))
		{
			$combo = $from."|".$to;
			if(!isset($keyboards[$combo]))
			{
				$keyboards[$combo] = array();
				foreach($keyboards[$from] as $i => $ch)
					if($ch != false)
						$keyboards[$combo][$ch] = $keyboards[$to][$i];
			}
			return strtr($text, $keyboards[$combo]);
			$result = "";
			//go throught text char by char
			$len = strlen($text);
			for($i = 0; $i < $len; $i++)
			{
				$ch = substr($text, $i ,1);
				if($ch !== " ")
				{
					//and replace char with alternative
					$p = strpos($keyboards[$from], $ch);
					if($p != false)
						$ch = substr($keyboards[$to], $p, 1);
				}
				$result .= $ch;
			}

			return $result;
		}
		else
		{
			return $text;
		}
	}

	//This function converts text into array of character positions
	//on the keyboard. Not defined chars turns into "false" value.
	function ConvertToScancode($text, $strict=false)
	{
		static $cache = array();
		if(!isset($cache[$this->_lang_id]))
		{
			$cache[$this->_lang_id] = array();
			$keyboard = $this->GetKeyboardLayout();

			foreach($this->StrToArray($keyboard["lo"]) as $pos => $ch)
				$cache[$this->_lang_id][$ch] = $pos;

			foreach($this->StrToArray($keyboard["hi"]) as $pos => $ch)
				$cache[$this->_lang_id][$ch] = $pos;
		}

		$scancodes = &$cache[$this->_lang_id];
		if($strict && is_array($this->arStemInfo))
			$abc = $this->arStemInfo["abc"];
		else
			$abc = "";

		$result = array();
		foreach($this->StrToArray($text) as $ch)
		{
			if($ch === " ")
				$result[] = false;
			elseif($abc && strpos($abc, $ch) === false)
				$result[] = false;
			elseif(isset($scancodes[$ch]))
				$result[] = $scancodes[$ch];
			else
				$result[] = false;
		}
		return $result;
	}

	function GuessLanguage($text, $lang=false)
	{
		if(strlen($text) <= 0)
			return false;

		static $cache = array();
		if(empty($cache))
		{
			$cache[] = "en";//English is always in mind and on the first place
			$rsLanguages = CLanguage::GetList(($b=""), ($o=""));
			while($arLanguage = $rsLanguages->Fetch())
				if($arLanguage["LID"] != "en")
					$cache[] = $arLanguage["LID"];
		}

		if(is_array($lang))
			$arLanguages = $lang;
		else
			$arLanguages = $cache;

		if(count($arLanguages) < 2)
			return false;

		$languages_from = array();
		$max_len = 0;

		//First try to detect language which
		//was used to type the phrase
		foreach($arLanguages as $lang)
		{
			$ob = CSearchLanguage::GetLanguage($lang);

			$arScanCodesTmp1 = $ob->ConvertToScancode($text, true);
			$arScanCodesTmp2_cnt = count(array_filter($arScanCodesTmp1));

			//It will be one with most converted chars
			if($arScanCodesTmp2_cnt > $max_len)
			{
				$max_len = $arScanCodesTmp2_cnt;
				$languages_from = array($lang => $arScanCodesTmp1);
			}
			elseif($arScanCodesTmp2_cnt == $max_len)
			{
				$languages_from[$lang] = $arScanCodesTmp1;
			}
		}

		if($max_len < 2)
			return false;

		if(count($languages_from) <= 0)
			return false;

		//If more than one language is detected as input
		//try to get one with best trigram info
		$arDetectionFrom = array();
		$i = 0;
		foreach($languages_from as $lang => $arScanCodes)
		{
			$arDetectionFrom[$lang] = array();

			$ob = CSearchLanguage::GetLanguage($lang);

			$arDetectionFrom[$lang][] = $ob->HasTrigrams();
			$arDetectionFrom[$lang][] = $ob->CheckTrigrams($arScanCodes);
			$deviation = $ob->GetDeviation($arScanCodes);
			$arDetectionFrom[$lang][] = $deviation[1];
			$arDetectionFrom[$lang][] = $deviation[0];
			$arDetectionFrom[$lang][] = $i;
			$i++;
		}
		uasort($arDetectionFrom, array("CSearchLanguage", "cmp"));
		//echo "<pre>",print_r($arDetectionFrom,1),"<pre>";

		//Now try the best to detect the language
		$arDetection = array();
		$i = 0;
		foreach($arDetectionFrom as $lang_from => $arTemp)
		{
			$arScanCodes = $languages_from[$lang_from];
			foreach($arLanguages as $lang)
			{
				$lang_from_to = $lang_from."=>".$lang;

				$arDetection[$lang_from_to] = array();

				$ob = CSearchLanguage::GetLanguage($lang);

				$arDetection[$lang_from_to][] = $ob->HasBigrammInfo();
				$arDetection[$lang_from_to][] = $ob->CheckTrigrams($arScanCodes);

				//Calculate how far sequence of scan codes
				//is from language model
				$deviation = $ob->GetDeviation($arScanCodes);

				$arDetection[$lang_from_to][] = $deviation[1];
				$arDetection[$lang_from_to][] = intval($deviation[0]*100);
				$alt_text = CSearchLanguage::ConvertKeyboardLayout($text, $lang_from, $lang);
				$arDetection[$lang_from_to][] = $alt_text !== $text;
				$arDetection[$lang_from_to][] = $i;
				$i++;
			}
		}

		uasort($arDetection, array("CSearchLanguage", "cmp"));
		$language_from_to = key($arDetection);
		list($language_from, $language_to) = explode("=>", $language_from_to);
		//echo "<pre>",print_r($arDetection,1),"<pre>";
		$alt_text = CSearchLanguage::ConvertKeyboardLayout($text, $language_from, $language_to);
		if($alt_text === $text)
			return false;

		return array("from" => $language_from, "to" => $language_to);
	}

	//Compare to results of text analysis
	function cmp($a, $b)
	{
		if($a[0] && !$b[0]) //On first place we check if model supports bigrams check
			return -1;
		elseif($b[0] && !$a[0])
			return 1;
		else
		{
			$c = count($a);
			for($i = 1; $i < $c; $i++)
			{
				if($a[$i] < $b[$i])
					return -1;
				elseif($a[$i] > $b[$i])
					return 1;
			}
			return 0;//never happens
		}
	}

	//Function returns distance of the text (sequence of scan codes)
	//from language model
	function GetDeviation($arScanCodes)
	{
		//This is language model
		$lang_bigrams = $this->GetBigrammScancodeFreq();
		$lang_count = $lang_bigrams["count"];
		unset($lang_bigrams["count"]);

		//This is text model
		$text_bigrams = $this->ConvertToBigramms($arScanCodes);
		$count = $text_bigrams["count"];
		unset($text_bigrams["count"]);

		$deviation = 0;
		$zeroes = 0;
		foreach($text_bigrams as $key => $value)
		{
			if(!isset($lang_bigrams[$key]))
			{
//debug code
//$GLOBALS["proto2"][$this->_lang_id][
//$this->ConvertFromScancode(array($arScanCodes[$i], $arScanCodes[$i+1], $arScanCodes[$i+2]))
//$key
//]++;
				$zeroes++;
				$deviation += $value/$count;
			}
			else
			{
				$deviation += abs($value/$count - $lang_bigrams[$key]/$lang_count);
			}
		}

		return array($deviation, $zeroes);
	}

	//Function returns bigramms of the text (array of scancodes)
	//For example "FAT RAT" will be
	//array("FA", "AT", "RA", "AT")
	//This is model of the text
	function ConvertToBigramms($arScancodes)
	{
		$result = array();

		$len = count($arScancodes)-1;
		for($i = 0; $i < $len; $i++)
		{
			$code1 = $arScancodes[$i];
			$code2 = $arScancodes[$i+1];
			if($code1 !== false && $code2 !== false)
			{
				$result["count"]++;
				$result[$code1." ".$code2]++;
			}
		}
		return $result;
	}

	function HasBigrammInfo()
	{
		return is_callable(array($this, "getbigrammletterfreq"));
	}

	//Function returns model of the language
	function GetBigrammScancodeFreq()
	{
		if(!$this->HasBigrammInfo())
			return array("count"=>1);

		if(!isset($this->_lang_bigramm_cache))
		{
			$bigramms = $this->GetBigrammLetterFreq();
			$keyboard = $this->GetKeyboardLayout();
			$keyboard_lo = $keyboard["lo"];
			$keyboard_hi = $keyboard["hi"];

			$result = array();
			foreach($bigramms as $letter1 => $row)
			{
				$p1 = strpos($keyboard_lo, $letter1);
				if($p1 === false)
					$p1 = strpos($keyboard_hi, $letter1);

				$i = 0;
				foreach($bigramms as $letter2 => $tmp)
				{
					$p2 = strpos($keyboard_lo, $letter2);
					if($p2 === false)
						$p2 = strpos($keyboard_hi, $letter2);

					$weight = $row[$i];
					$result["count"] += $weight;
					$result[$p1." ".$p2] = $weight;
					$i++;
				}
			}
			$this->_lang_bigramm_cache = $result;
		}
		return $this->_lang_bigramm_cache;
	}
}
?>