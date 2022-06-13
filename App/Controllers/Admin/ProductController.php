<?php

namespace App\Controllers\Admin;

use Core\View;
use App\Models\Product;



/**
 * Account controller
 *
 * PHP version 7.0
 */
class ProductController extends \Core\Controller
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

        View::renderTemplate('Admin/Product/index.html', ['products' => $products]);
    }

    public function addAction()
    {
        View::renderTemplate('Admin/Product/add.html');
    }

    public function insertAction()
    {
        
    }

    public function editAction(){
        View::renderTemplate('Admin/Product/edit.html');
    }

    public function updateAction(){
        
    }

    public function deleteAction(){
        
    }
}