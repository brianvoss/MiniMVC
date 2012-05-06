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
 * Application Front Controller,
 * the primary entry point for application requests
 * For more information see http://en.wikipedia.org/wiki/Front_Controller_pattern
 */
// First determine where the current script is being run from
$current_dir = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

// Now make sure our app files are accessible
set_include_path(implode(PATH_SEPARATOR, array(
    PATH_SEPARATOR . $current_dir . DIRECTORY_SEPARATOR . "config",
    PATH_SEPARATOR . $current_dir . DIRECTORY_SEPARATOR . "library",
    PATH_SEPARATOR . $current_dir . DIRECTORY_SEPARATOR . "templates",
    get_include_path()
)));

// Register an autoloader to streamline class loading
spl_autoload_register(function($class){
    global $current_dir;
    $path = strtolower(preg_replace('/(?<=[a-z])(?=[A-Z])/', DIRECTORY_SEPARATOR ,$class));
    $library_path = $current_dir . DIRECTORY_SEPARATOR . "library" . DIRECTORY_SEPARATOR . $path . ".php";
    //echo $library_path;
    if ( file_exists($library_path))
    {
        try {
            require_once $library_path;
        } catch (Exception $e){
            //throw new Exception("Could not load class $class");
        }

    } 
});

// Initialize and Register the Application
$application = new Application($current_dir);
Registry::setItem('application', $application);

// Dispatch the request to appropriate controller
$application->dispatchRequest();

?>