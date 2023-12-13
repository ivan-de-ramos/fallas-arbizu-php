<?php 

function __($str) {
	if (isset(Translator::$key[$str]) && Translator::$key[$str] != "") {
		return Translator::$key[$str];
	} else {
		return $str;
	}
}

function ___($str) {
	if (isset(Translator::$key[$str]) && Translator::$key[$str] != "") {
		return Translator::$key[$str];
	} else {
		return "";
	}
}

function url($page, $lang_selected=null) {
	$lang = ($lang_selected)?: LANG;
	global $routes;
	if (isset($routes[$page][$lang]['url'])) {
		return $routes[$page][$lang]['url'];
	}
	return isset($routes[$page][$lang]) ? $routes[$page][$lang] : '/';
}

function change_language($language) {
	global $match;
	list($name, $lang) = explode('|', $match['name']);
	return url($name, $language);
}


function getBaseUrl() {
	return sprintf(
		"%s://%s",
		isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		$_SERVER['SERVER_NAME']
	);
}

function element($element) {
	require __DIR__ . "/../views/elements/$element.php";
}


function debug($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

function render($filename, $template = 'default') {
	ob_start();
	include $filename;
	$view_content = ob_get_contents();
	ob_end_clean();
	include __DIR__ . "/../views/layouts/$template.php";
}

function slug($text){
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // transliterate
    // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, '-');
    // remove duplicated - symbols
    $text = preg_replace('~-+~', '-', $text);
    // lowercase
    $text = strtolower($text);
    if (empty($text)) {
      return '';
    }
    return $text;
}

/* Traductor */
/* sh Console/cake i18n extract --paths /Users/ivanderamos/Library/Mobile\ Documents/com\~apple\~CloudDocs/la\ general\ -\ website/  --overwrite no --extract-core no --merge no */

function activeSection($name = '') {
	return ($name === CURRENT_ROUTE_NAME) ? "active" : "";
}

function getTagsFromProjects($projects = array()) {
	$tags = array();
	foreach ($projects as $pro) {
		foreach ($pro['tags'] as $tag) {
			$slug = slug($tag);
			if (!isset($tags[ $slug ])) {
				$tags[$slug] = $tag;
			}
		}
	}
	return $tags;
}

function getClassFromTags($pro_tags = array()) {
	$tags = array();
	foreach ($pro_tags as $tag) {
		$tag = slug($tag);
		if (!isset($tags[ $tag ])) {
			$tags['pro-'.$tag] = true;
		}
	}
	return implode(' ', array_keys($tags));
}