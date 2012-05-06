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
 * Loader Class - loads helpers and classes
 */
class Loader {
    /**
     *
     * @var string
     */
    public static $default_file_extension = "php";
    /**
     * Our main class loader - follows the
     * Factory pattern.  Resolve the class name to a filesystem
     * path and include the file, returning an instantiated object
     *
     * @param string $class_name
     */
    public static function load($filename){
	$paths = array(
	    Filesystem::getConfigDir(),
	    Filesystem::getLibraryDir(),
	    Filesystem::getTemplateDir(),
	    Filesystem::getControllerDir()
	);
	$found = true;
	/**
	while (!$found && count($paths) > 0){
	    try {
		$path = array_pop($paths) . $filename;
		//echo $path;
		require_once $path;
		$found = true;
		break;
	    } catch (Exception $e) {
		$found = false;
	    }
	}
	 *
	 */
	require_once $filename;
	return $found;
    }
    /**
     *
     * @param string $class_name
     * @param [array $params]
     * @return $class_name
     */
    public static function loadClass($class_name, $params=null){
	$filename = self::classToFilename($class_name);
	$class_loaded = self::load($filename);
	if ($class_loaded){
	    return new $class_name($params);
	}
	return false;
    }
    /**
     *
     * @access protected
     * @param string $class_name
     * @return string
     */
    protected static function classToFilename($class_name){
	$base_name = strtolower($class_name);
	$translated_name = str_replace("_", ".", $class_name);
	return $translated_name . self::$default_file_extension;
    }
    /**
     *
     * @param <type> $class_name
     * @return <type> 
     */
    protected static function filenameToClass($file_name){
	$class_name = '';
	// Strip the file extension
	$r = preg_replace("/\.[a-z1-3]*$/", "", $file_name);
	$file_name = basename($file_name);
	if (stristr($file_name, ".")){
	    $parts = explode(".", $file_name);
	    array_walk($parts, 'ucfirst');
	    $class_name = implode("_", $parts);
	}
	else
	{
	    $class_name = ucfirst($file_name);
	}
	$translated_name = str_replace("_", ".", $class_name);
	return $translated_name . self::$default_file_extension;
    }
}