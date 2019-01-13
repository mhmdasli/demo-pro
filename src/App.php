<?php namespace App;
/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 31/12/2018
 */

use App\console\AppInstall;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class App
{
    /*
     * App Request
     */
    public $request;

    /*
     * matched Route
     */
    public $route;

    /*
     *  Define Routes Array
     */
    protected $routes = array(
        '/' => [                                                     //url
            'controller' => '\App\Controllers\HomeController',       //controller name
            '@' => 'index',                                          //controller method
            'secure' => 'false',                                     //if true request will Authenticated
            'theme' => '/site',                                      //theme name to load views from ,if empty json will be returned
        ],
        '/login' => [
            'controller' => '\App\Controllers\AdminController',
            '@' => 'login',
            'secure' => 'false',
            'theme' => '/admin',
        ],
        '/admin' => [
            'controller' => '\App\Controllers\AdminController',
            '@' => 'index',
            'secure' => 'true',
            'theme' => '/admin',
        ]
    );

    /*
     * App Constructor
     */
    public function __construct()
    {
        //Todo:: For Development
        if (!getenv('APP_DEBUG')) {
            $dot_env = new \Symfony\Component\Dotenv\Dotenv();
            $dot_env->load(__DIR__ . '\..\.env');
        }
    }

    /*
     * Run The App
     * @return Response
     */
    public function run()
    {
        //create the app request
        $request = Request::createFromGlobals();
        $this->request = $request;
        //match route
        $this->route = $this->routes[$request->getPathInfo()];
        if (isset($this->route)) {
            //match controller
            return $this->matcher();
        } else {
            $response = new Response('Not Found', 404);
            return $response;
        }
    }

    /*
     * match Controller
     * @return Response
     */
    private function matcher()
    {
        // get controller name
        $class = $this->route['controller'];
        // create new controller instance
        $controller = new $class($this->request, $this->route);
        // navigate to method inside controller
        $response = $controller->Navigator($this->route);
        //response
        return $response;
    }

    /*
     * handel the console command
     * @return  string to STDOUT
     */
    public function install()
    {
        {
            $version = require 'database/version.php';
            $command = new AppInstall();
            $status = $command->handle($version);
            return $status;
        }
    }
}