<?php
/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 31/12/2018
 */

namespace App\Classes;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ControllerBase
{
    public $request;
    public $controller;
    public $layout;

    /*
     * constructor
     */
    public function __construct(Request $request, $controller)
    {
        $this->response = new Response();
        $this->request = $request;
        $this->controller = $controller;
    }

    /*
     * check auth
     * Navigate to controller method
     * @return response
     */
    public function Navigator($route)
    {
        if ($this->request->getMethod() == 'POST')
            $route['@'] = $this->request->headers->get('x-project-request-handler');
        if ($route['secure'] == 'true')
            if ($this->checkAuth()) {
                $method = $route['@'];
                return $this->$method();
            } else {
                return new RedirectResponse('/login');
            }
        else {
            $method = $route['@'];
            return $this->$method();
        }
    }

    /*
     * Authenticate Request
     * @return bool
     */
    private function checkAuth()
    {
        session_start();
        if (empty($_SESSION['csrf_token']) || empty($_COOKIE['csrf_token']))
            return false;
        if ($_SESSION['csrf_token'] == $_COOKIE['csrf_token'])
            return true;
        else
            return false;
    }
}