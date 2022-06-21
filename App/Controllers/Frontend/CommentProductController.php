<?php

namespace App\Controllers\Frontend;

use App\Auth;
use App\Flash;
use Core\View;
use App\Models\Product;
use App\Models\ReviewProduct;
use App\Models\CommentProduct;





class CommentProductController extends \Core\Controller
{
    public function addAction()
    {
        $data['user_id'] = Auth::getUser()->id;
        $data['product_id'] = $this->route_params['id'];

        $product = Product::getByID($data['product_id']);

        if($product)
        {
            $comment = CommentProduct::getByIdUser($data['user_id']);
            if($comment)
            {
              // View::renderTemplate('/frontend/reviews/edit.html');
              $this->redirect('/edit-comment/' . $data['product_id']);
            }
            else
            {
              $verified_purchase = ReviewProduct::verifiedPurchase($data);
              
              View::renderTemplate('/frontend/reviews/index.html', ['verified_purchase' => $verified_purchase, 'product' => $product]);
            }
        }
        else {
            Flash::addMessage('The link you followed was broken', Flash::WARNING);
            $this->back();
        }
    }

    public function insertAction()
    {
        $data['user_id'] = Auth::getUser()->id;
        $data['product_id'] = intval($_POST['product_id']);
        
        
        $product_check = Product::getByID($data['product_id']);
        if($product_check)
        {
            $data['comment'] = $_POST['comment'];

            if($data['comment'])
            {
                CommentProduct::insert($data);
            }
            else
            {
                Flash::addMessage('Comment is required.', Flash::WARNING);
                $this->back();
            }
        } 
        else {
            Flash::addMessage('The link you followed was broken', Flash::WARNING);
            $this->back();
        }
    }

    public function editAction()
    {
        $data['user_id'] = Auth::getUser()->id;
        $data['product_id'] = $this->route_params['id'];

        $product = Product::getByID($data['product_id']);
        if($product)
        {
          $comment = CommentProduct::getByUserIdAndProductId($data);

          View::renderTemplate('/frontend/reviews/edit.html', ['comment' => $comment, 'product' => $product]);
        }
        else {
            Flash::addMessage('The link you followed was broken', Flash::WARNING);
            $this->back();
        }
    }

    public function updateAction()
    {
        $data['user_id'] = Auth::getUser()->id;
        $data['product_id'] = $_POST['product_id'];
        $data['comment'] = $_POST['comment'];
        $data['id'] = $_POST['comment_id'];

        if($data['comment'] != '')
        {
            $comment = CommentProduct::getById($data['id']);
            if($comment)
            {
                CommentProduct::update($data);
              
                Flash::addMessage('Review updated successfully', Flash::SUCCESS);
                $this->redirect('/product/'. $data['product_id']);
            }
            else
            {
                Flash::addMessage('The link you followed was broken', Flash::WARNING);
                $this->back();
            }
        }
        else 
        {
            Flash::addMessage('Comment is required.', Flash::WARNING);
            $this->back();
        }
        
    }
}