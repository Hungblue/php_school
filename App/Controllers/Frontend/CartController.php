<?php

namespace App\Controllers\Frontend;

use App\Auth;
use App\Flash;
use Core\View;
use App\JoinTable;
use App\Models\Cart;
use App\Models\Product;

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

  public function addAction()
  {
    $data['user_id'] = Auth::getUser()->id;
    $data['product_id'] = $_POST['product_id'];
    $data['product_qty'] = $_POST['product_qty'];

    $check_cart = Cart::getByProductId($data['product_id']);
    if($check_cart)
    {
        Flash::addMessage('Already add to cart', Flash::WARNING);
        $this->back();
    } else
    {
        Cart::insert($data);
        Flash::addMessage('Added to cart', Flash::SUCCESS);
        $this->back();
    }
  }

  public function deleteAction()
  {
    $data['product_id'] = $_POST['product_id'];

    Cart::delete($data['product_id']);

    Flash::addMessage('Deleted is successfully', Flash::SUCCESS);
    $this->back();
  }
}