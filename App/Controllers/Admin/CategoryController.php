<?php

namespace App\Controllers\Admin;

use Core\View;
use Core\Router;
use App\Models\Category;

/**
 * Account controller
 *
 * PHP version 7.0
 */
class CategoryController extends \Core\Controller
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
        $categories = Category::getAll();

        View::renderTemplate('Admin/Category/index.html', ['categories' => $categories]);
    }

    public function addAction()
    {
        View::renderTemplate('Admin/Category/add.html');
    }

    public function insertAction()
    {
        $isInserted = Category::insert($_POST);
        if ($isInserted)
        {
            $this->redirect('/admin/category');
        }else
        {
            return false; 
        }
    }

    public function editAction(){
        View::renderTemplate('Admin/Category/edit.html');
    }

    public function updateAction(){
        
    }

    public function deleteAction(){
        
    }
}