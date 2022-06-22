<?php

namespace App\Controllers\Frontend;

use App\Auth;
use Core\View;
use App\JoinTable;
use App\Models\Cart;



class CheckoutController extends \Core\Controller
{
  public function indexAction()
  {
    $user_id = Auth::getUser()->id;

    $user = Auth::getUser();
  
    //$cart_items = Cart::getByUserId($user_id);

    $product_join_cart = JoinTable::cartJoinProduct($user_id);

    View::renderTemplate('/frontend/checkout.html', ['user' => $user, 'product_join_cart' => $product_join_cart]);
  }

  
}