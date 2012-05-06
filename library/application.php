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
 * Application object
 */
class Application {

    protected $config = array();
    protected $default_config_extension = "ini";
    
    public function __construct($base_dir){
	// Initialize Filesystem References
	Filesystem::setBaseDir($base_dir);
	Filesystem::setConfigDir($base_dir . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR);
	Filesystem::setLibraryDir($base_dir . DIRECTORY_SEPARATOR . "library" . DIRECTORY_SEPARATOR);
	Filesystem::setTemplateDir($base_dir . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR);
	Filesystem::setControllerDir($base_dir . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR);
	// Load the Base Application Config
	$this->loadConfig('app');
	// Start Session
	$this->startSession();
    }
    /**
     *
     * @param string $item
     * @return mixed
     */
    public function getConfig($item){
	if (array_key_exists($item, $this->config)){
	    return $this->config[$item];
	}
	return false;
    }
    /**
     *
     * @param string $file_name
     */
    private function loadConfig($file_name){
	// If passed only the main part of a filename, make
	// sure to include an extension
	if ( !stristr($file_name, ".")){
	    $file_name .= "." . $this->default_config_extension;
	}
	// Find the full path to the filename
	$path = Filesystem::getConfigDir() . $file_name;
	try {
	    $this->config = parse_ini_file($path, true);
	    return true;
	} catch (Exception $e){
	    $this->config = array();
	    return false;
	}
    }
    /**
     * Initialize the current session
     */
    public function startSession(){
	// Handle cookie/session
	$config = $this->getConfig('settings');
	$cookie_name = $config["cookie_name"];
	if (array_key_exists($cookie_name, $_COOKIE)){
	    $session_id = $_COOKIE[$cookie_name];
	    session_id($session_id);
	} else {
	    $session_id = session_id();
	}
	ini_set('session.name', $cookie_name);
	session_start();
    }
    /**
     * Get the current application user
     * @return
     */
    public function getUser(){
	if ($this->isAuthenticated()){
	    return $_SESSION['user'];
	}
	return false;
    }
    /**
     * Set the current application user
     * @param array $user
     * @return Application
     */
    public function setUser($user){
	$_SESSION['user'] = $user;
	return $this;
    }
    /**
     * Return whether we have a current application user
     * @return bool
     */
    public function isAuthenticated(){
	return (isset($_SESSION['access_token']) && !empty($_SESSION['access_token']));
    }
    public function dispatchRequest(){
	Router::dispatchRequest();
    }
}

?>
