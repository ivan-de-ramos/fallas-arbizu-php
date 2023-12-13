<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define("ROOT", dirname(dirname(__FILE__)));

include ROOT . '/config/config.php';
include ROOT . '/config/routes.php';
include ROOT . '/lib/functions.php';
include ROOT . '/lib/AltoRouter.php';

global $config;
$config['base_url'] = getBaseUrl();
$router = new AltoRouter();

$langs = $config['langs'];
$default_lang = $config['default_lang'];

foreach ($routes as $name => $routed_lang) {
	foreach ($langs as $lang) {
		if (isset($routed_lang[$lang])) {
			$route = $routed_lang[$lang];
			$url = (is_array($route) && isset($route['url'])) ? $route['url'] : $route;
			$viewfile = (is_array($route) && isset($route['viewfile'])) ? $route['viewfile'].".php" : "$name.php";
			$method = (is_array($route) && isset($route['method'])) ? $route['method'] : 'GET';
			$params = isset($route['params']) ? $route['params'] : false;
			$layout = isset($route['layout']) ? $route['layout'] : 'default';

			$router->map($method, $url, function() use ($lang, $viewfile, $params, $url, $name, $layout) {
				global $config;
				define('LANG', $lang);
				define('CURRENT_URL', $url);
				define('CURRENT_ROUTE_NAME', $name);
				if ($params) {
					$config['view_params'] = $params;
				}
				require __DIR__ . "/../locale/" . $lang . ".php";
				$viewfile = __DIR__ . "/../views/$viewfile";
				render($viewfile, $layout);
			}, "$name|$lang");
			
		}
	}
}


$match = $router->match();

// call closure or throw 404 status
if( $match && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

