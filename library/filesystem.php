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
 * Filesystem Helper Class
 */
class Filesystem {

    protected static $controller_dir;
    protected static $base_dir;
    protected static $config_dir;
    protected static $library_dir;
    protected static $template_dir;
    /**
     *
     * @return string
     */
    public static function getBaseDir(){
	return self::$base_dir;
    }
    /**
     *
     * @param string $dir
     * @return Filesystem
     */
    public static function setBaseDir($dir){
	self::$base_dir = $dir;
	
    }
    /**
     *
     * @return string
     */
    public static function getConfigDir(){
	return self::$config_dir;
    }
    /**
     *
     * @param string $dir
     * @return Filesystem
     */
    public static function setConfigDir($dir){
	self::$config_dir = $dir;
	
    }
    /**
     *
     * @return string
     */
    public static function getLibraryDir(){
	return self::$library_dir;
    }
    /**
     *
     * @param string $dir
     * @return Filesystem
     */
    public static function setLibraryDir($dir){
	self::$library_dir = $dir;
	
    }
    /**
     *
     * @return string
     */
    public static function getControllerDir(){
	return self::$controller_dir;
    }
    /**
     *
     * @param string $dir 
     */
    public static function setControllerDir($dir){
	self::$controller_dir = $dir;
    }
    /**
     *
     * @return string
     */
    public static function getTemplateDir(){
	return self::$template_dir;
    }
    /**
     *
     * @param string $dir
     * @return Filesystem
     */
    public static function setTemplateDir($dir){
	self::$template_dir = $dir;
	
    }
}
