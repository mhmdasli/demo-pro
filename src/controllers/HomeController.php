<?php

/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 31/12/2018
 */

namespace App\Controllers;

use App\Classes\ControllerBase;
use App\Models\Product;
use App\traits\Theme;
use Symfony\Component\HttpFoundation\Request;
use App\models\Category;

class HomeController extends ControllerBase
{
    /*
     * Constructor
     */
    public function __construct(Request $request, $controller)
    {
        parent::__construct($request, $controller);
    }

    /*
     * @return homepage
     */
    public function index()
    {
        // prepare records
        $table = new Category();
        $categories = $table->getAll();

        $table = new Product();
        $slider = $table->where('category_id','=',0);
        $table = new Product();
        $products = $table->where('category_id','<>',0);
        //prepare layout
        $theme = Theme::create( $this->controller['theme']);
        $layout = $theme->render('pages/home.html', ['categories' => $categories,'products'=>$products,'slider'=>$slider]);
        $this->response->setContent($layout);
        $this->response->setStatusCode(200);
        //return response
        return $this->response;
    }

    /*
     * return products by category
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


}