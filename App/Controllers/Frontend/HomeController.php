<?php

namespace App\Controllers\Frontend;

use Core\View;
use App\Models\Product;


/**
 * Account controller
 *
 * PHP version 7.0
 */
class HomeController extends \Core\Controller
{

    /**
     * Validate if email is available (AJAX) for a new signup or an existing user.
     * The ID of an existing user can be passed in in the querystring to ignore when
     * checking if an email already exists or not.
     *
     * @return void
     */
    public function indexAction()
    {
        $products = Product::getAll();
        // var_dump($products);
        // die();
        View::renderTemplate('frontend/index.html', ['products' => $products]);
    }

    public function viewProductAction()
    {
        $id = $this->route_params['id'];
        $product = Product::getByID($id);

        // var_dump($product);
        // die();
        View::renderTemplate('frontend/products/view.html', ['product' => $product]);
    }
}