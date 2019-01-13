<?php
/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 02/01/2019
 */

namespace App\Controllers;

use App\Classes\ControllerBase;
use App\models\Category;
use App\Models\Product;
use App\traits\Theme;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends ControllerBase
{
    public function __construct(Request $request, $controller)
    {
        parent::__construct($request, $controller);

    }

    /*
     * Admin page
     * return all products and categories
     */
    public function index()
    {
        $table = new Category();
        $categories = $table->getAll();
        $table = new Product();
        $products = $table->getAll();
        //prepare layout
        $theme = Theme::create($this->controller['theme']);
        $layout = $theme->render('pages/home.html', array('categories' => $categories, 'products' => $products));
        //set response
        $this->response->setContent($layout);
        $this->response->setStatusCode(200);
        return $this->response;
    }

    /*
     * return all products
     */
    public function onGetAllProducts()
    {
        // handle
        $table = new Product();
        $products = $table->getAll();
        //prepare layout
        $theme = Theme::create($this->controller['theme']);
        $layout = $theme->render('partials/sections/products.html', array('products' => $products));
        //response
        $this->response->setContent($layout);
        $this->response->setStatusCode(200);
        return $this->response;
    }

    /*
     * add new Category
     */
    public function onAddCategory()
    {
        // handle
        $title = $this->request->get('title');
        $table = new Category();
        // operation
        $table->insert(['title'], [$title]);
        $categories = $table->getAll();
        //prepare layout
        $theme = Theme::create($this->controller['theme']);
        $layout = $theme->render('partials/sections/categories.html', array('categories' => $categories));
        //response
        $this->response->setContent($layout);
        $this->response->setStatusCode(200);
        return $this->response;
    }

    /*
     * add new product
     */
    public function onAddProduct()
    {
        // handle
        $link = $this->request->get('link');
        $category_id = $this->request->get('category_id');
        $table = new Product();
        if ($table->insert(['link', 'category_id'], [$link, $category_id])) {
            //prepare layout
            $table = new Product();
            $products = $table->where('category_id', '=', $category_id);
            $theme = Theme::create($this->controller['theme']);
            $layout = $theme->render('partials/sections/products.html', array('products' => $products, 'category_id' => $category_id));
            //response
            $this->response->setContent($layout);
            $this->response->setStatusCode(200);
            return $this->response;
        } else
            return $this->response->setContent('Save Refused');


    }

    /*
     * return products by given category
     */
    public function onGetCategoryProducts()
    {
        // handle
        $category_id = $this->request->get('category_id');
        $table = new Product();
        $products = $table->where('category_id', '=', $category_id);
        //prepare layout
        $theme = Theme::create($this->controller['theme']);
        $layout = $theme->render('partials/sections/products.html', array('products' => $products, 'category_id' => $category_id));
        //response
        $this->response->setContent($layout);
        $this->response->setStatusCode(200);
        return $this->response;

    }

    /*
    * Delete category
    */
    public function onDeleteCategory()
    {
        $category_id = $this->request->get('category_id');
        $table = new Category();
        if ($table->deleteWhere('id', '=', $category_id)) {
            $categories = $table->getAll();
            //prepare layout
            $theme = Theme::create($this->controller['theme']);
            $layout = $theme->render('partials/sections/categories.html', array('categories' => $categories));
            $this->response->setContent($layout);
            $this->response->setStatusCode(200);
            return $this->response;
        } else
            return $this->response->setContent('Failed To Delete');

    }

    /*
     * Delete product
     */
    public function onDeleteProduct()
    {
        $product_id = $this->request->get('product_id');
        $table = new Product();
        if ($table->deleteWhere('id', '=', $product_id)) {
            $products = $table->getAll();
            //prepare layout
            $theme = Theme::create($this->controller['theme']);
            $layout = $theme->render('partials/sections/products.html', array('products' => $products));
            $this->response->setContent($layout);
            $this->response->setStatusCode(200);
            return $this->response;
        } else
            return $this->response->setContent('Failed To Delete');

    }

    /*
     * return login page
     */
    public function login()
    {
        //prepare layout
        $theme = Theme::create($this->controller['theme']);
        $layout = $theme->render('layout/login.html');
        //set response
        $this->response->setContent($layout);
        $this->response->setStatusCode(200);
        return $this->response;
    }

    /*
     * ajax handler
     * Authenticate user the password and username are matched with env variables
     * @return redirect
     */
    public function onLogIn()
    {
        if ($_POST['password'] == getenv('ADMIN_PASSWORD') && $_POST['username'] == getenv('ADMIN_LOGIN')) {
            $response = new Response();
            session_start();
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            setcookie('csrf_token', $_SESSION['csrf_token']);
            $response->setContent('/admin');
            $response->setStatusCode(200);
            return $response;
        } else
            return new Response('Unauthorised', 401);
    }

    /*
     * logout
     * delete the session
     * return redirect
     */
    public function onLogout()
    {
        $_SESSION['csrf_token'] = '';
        $response = new Response();
        $response->setContent('/');
        $response->setStatusCode(200);
        return $response;
    }
}