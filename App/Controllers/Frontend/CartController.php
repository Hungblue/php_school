<?php

namespace App\Controllers\Frontend;

use App\Auth;
use Core\View;
use App\JoinTable;
use App\Models\Cart;

class CartController extends \Core\Controller
{
  public function viewAction()
  {
    $user_id = Auth::getUser()->id;
    
    $items_cart = Cart::getByUserId($user_id);

    $product_join_cart = JoinTable::cartJoinProduct($user_id);

    //$product = Product::getById();

    // var_dump($product_join_cart);
    // die();
    
    View::renderTemplate('/frontend/cart.html', ['product_join_cart' => $product_join_cart, 'count_items' => count($product_join_cart), 'items_cart' => $items_cart]);
  }
}