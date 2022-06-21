<?php

namespace App\Controllers\Frontend;

use App\Auth;
use Core\View;
use App\Models\Product;
use App\Models\ReviewProduct;
use App\Models\CommentProduct;


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
        $user = Auth::getUser();
        $user_id = $user->id;
        
        $product_id = $this->route_params['id'];
        $product = Product::getByID($product_id);

        $rates = ReviewProduct::getByIdProduct($product_id);
        $count_rate = count($rates);
        //avg rate
        $avg_rate = ReviewProduct::getAVGRate($product_id);
        $format_rate = ceil($avg_rate->avg_rate);
        
        //
        $user_rating = ReviewProduct::getRateUser($product_id, $user_id);
        
        //$comments = CommentProduct::getPagination(0, 5);

        $comments = CommentProduct::getUserName(0,5);
        
        View::renderTemplate('frontend/products/view.html', ['comments' => $comments, 'user_rating' => $user_rating, 'product' => $product, 'avg_rate' => $avg_rate->avg_rate, 'count_rate' => $count_rate, 'format_rate' => $format_rate]);
    }
}