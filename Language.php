<?php
use JW3B\core\Config;
// language function
function l($words, $find=[], $rep=[]){
	$ret = $words;
	if($words != ''){
		$ret = isset(Config::$l['lang_update'][$words])
			? str_replace($find, $rep, Config::$l['lang_update'][$words])
			: str_replace($find, $rep, $words);
		if(!isset(Config::$l['lang'][$words])){
			$file = Config::$w['root'].'/config/DefaultLanguage.php';
			//include($file);
			if(!isset(Config::$l['lang'][$words])){
				// we gotta add it to the main language file..
				$word = str_replace("'", "\'", $words);
				$fp = fopen($file, 'a+');
				flock($fp, 2);
				fwrite($fp, '$Sets[\'lang\'][\''.$word.'\'] = \''.$word."';\n");
				flock($fp, 3);
				fclose($fp);
			}
		}
	}
	return $ret;
}