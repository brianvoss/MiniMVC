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
 * Registry Class - used to implement 
 * Registry pattern and persist objects
 * in memory through the course of a request
 */
class Registry {

    protected static $items = array();

    public static function getItem($name){
	return self::$items[$name];
    }

    public static function setItem($name, $value){
	self::$items[$name] = $value;
    }

    public static function removeItem($name){
	unset(self::$items[$name]);
    }

}