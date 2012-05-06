<?php
/**
 * Mini MVC
 * A minimalistic PHP application framework
 * 
 * @package   MiniMVC
 * @author    Brian Voss <brian@brianvoss.com>
 * @license   MIT License
 * @version   $Id$
 */
/**
 * Router class - used to parse and
 * route a request
 */
class Router {
    /**
     * Dispatch a request
     */
    public static function dispatchRequest(){
	$request = self::parseRequest();

	// Initialize the Controller object
	$class = ucfirst($request['object']) . 'Controller';
	$file = Filesystem::getControllerDir() . $request['object'] . ".php";
	if (!class_exists($class)){
	    $loaded = Loader::load($file);
	}

	$controller = new $class($request);
	if ( method_exists($controller, $request['action'])){
	    call_user_func(array($controller,$request['action']));
	} else {
	    // 404
	    header("HTTP/1.0 404 Not Found");
	}

    }
    /**
     * Parse a request based on URL parameters
     * @return array
     */
    public static function parseRequest(){
	$config = Registry::getItem('application')->getConfig('settings');
	// Format any GET parameters
	parse_str($_SERVER['QUERY_STRING'],$get_params);
	// Do some basic sanitization
	//array_walk($get_params, 'urlencode');
	//array_walk($_POST, 'urlencode');
	$request = array(
	    "object" => array_key_exists('object', $get_params) ? $get_params['object'] : $config["default_controller"],
	    "action" => array_key_exists('action', $get_params) ? $get_params['action'] : $config["default_action"],
	    "get" => $get_params,
	    "post" => $_POST
	);
	return $request;
    }

}