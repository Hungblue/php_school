<?php

namespace App\Controllers\Frontend;

use App\Auth;
use App\Flash;
use Core\View;
use App\Models\Product;
use App\Models\ReviewProduct;


/**
 * Account controller
 *
 * PHP version 7.0
 */
class ReviewProductController extends \Core\Controller
{
    public function insertAction()
    {
        $data['user_id'] = Auth::getUser()->id;
        $data['product_id'] = intval($_POST['product_id']);

        $product_check = Product::getByID($data['product_id']);
        if($product_check)
        {
            $verified_purchase = ReviewProduct::verifiedPurchase($data);
            
            if(count($verified_purchase) > 0)
            {
              $existing_rating = ReviewProduct::getByUserIdAndProductId($data['user_id'], $data['product_id']);
              if($existing_rating)
              {
                $data['rate'] = $_POST['product_rating'];
                ReviewProduct::update($data);
              } 
              else {              
                ReviewProduct::insert($data); 
              }
              Flash::addMessage('Thank you for Rating this product', Flash::SUCCESS);
              $this->back();
            } 
            else {
                Flash::addMessage('Your cannot  rate a product without purchase', Flash::WARNING);
                $this->back();
            }
        } 
        else {
            Flash::addMessage('The link you followed was broken', Flash::WARNING);
            $this->back();
        }
    }
}