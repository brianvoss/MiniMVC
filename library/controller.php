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
 * Base Controller
 * This is the base Controller definition for the application,
 * which all controllers inherit
 */
abstract class Controller {
    /**
     *
     * @var stdClass
     */
    protected $request;
    /**
     *
     * @var array
     */
    protected $view_params = array();
    /**
     * Base Controller Constructor
     * @param stdClass $req 
     */
    public function  __construct($req) {
	$this->request = $req;
    }
    /**
     * Set a view parameter
     * @param string $name
     * @param mixed $value 
     */
    public function setParam($name, $value){
	$this->view_params[$name] = $value;
    }
    /**
     * Render a view template
     * @param string $template
     * @return string
     */
    public function render($template){
	ob_start();
	$path = Filesystem::getTemplateDir() . $template;
        include_once $path;
        echo ob_get_clean();
    }
    /**
     * Magic accessor method to expose view variables
     * @param string $name
     * @return mixed 
     */
    public function  __get($name) {
	return (array_key_exists($name, $this->view_params) ? $this->view_params[$name] : null);
    }
}
