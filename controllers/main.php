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
 * Main Controller
 * Default application controller
 */
class MainController extends Controller {

    public function  __construct($request) {
	parent::__construct($request);
    }

    public function index(){
	// Get our application reference
	$app = Registry::getItem('application');
	// Set the language strings for the view to use
	$this->setParam('lang', $app->getConfig('language'));
	// Set the Application object for the view to use
	$this->setParam('application', $app);
        // Render the template output
	$this->render('main.php');
    }

}
?>