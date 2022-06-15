<?php

namespace App\Controllers\Admin;

use Core\View;
use Core\Router;
use App\Models\Category;
use \App\Token;
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
        if (isset($_POST['submit'])){
            $data['name'] = $_POST['name'];
            $data['slug'] = $_POST['slug'];
            if($data['slug'] == ''){
                $data['slug'] = $data['name'];
            }
            $data['slug'] = vn_to_str($data['slug']);
            $data['description'] = $_POST['description'];
            $data['thumbnail'] = add_image('thumbnail')['image'];
            if($data['thumbnail'] == ''){
                $data['thumbnail'] = 'import-img.png';
            }
            // validate
            $errors = Category::validateInsert($data);
            if(!empty(add_image('thumbnail')['error'])){
               $errors['image'] = add_image('thumbnail')['error']; 
            }
            if(!empty($errors)){
                View::renderTemplate('Admin/Category/add.html', ['errors'=> $errors]);
            }else{
                Category::insert($data);
                $this->redirect('/admin/category');
            }

        }else{
            View::renderTemplate('Admin/Category/add.html');
        }
        
    }

    // public function insertAction()
    // {
    //     $isInserted = Category::insert($_POST);
    //     if ($isInserted)
    //     {
    //         $this->redirect('/admin/category');
    //     }else
    //     {
    //         return false; 
    //     }
    // }

    public function editAction(){
        $data['id'] = $this->route_params['id'];
        $category = Category::getById($data)[0];

        if (isset($_POST['submit'])){
            $data['name'] = $_POST['name'];
            $data['slug'] = $_POST['slug'];
            if($data['slug'] == ''){
                $data['slug'] = $data['name'];
            }
            $data['slug'] = vn_to_str($data['slug']);
            $data['description'] = $_POST['description'];
            $data['thumbnail'] = add_image('thumbnail')['image'];
            if($data['thumbnail'] == ''){
                $data['thumbnail'] = $category->thumbnail;
            }
            
            // validate
            $errors = Category::validateUpdate($data);
            if(!empty(add_image('thumbnail')['error'])){
               $errors['image'] = add_image('thumbnail')['error']; 
            }

            if(!empty($errors)){
                View::renderTemplate('Admin/Category/edit.html', ['category'=>$category, 'errors'=> $errors]);
            }else{
                Category::update($data);
            $this->redirect('/admin/category');
            }
        }else{
            View::renderTemplate('Admin/Category/edit.html', ['category'=>$category]);
        }
    }

    // public function updateAction(){
        
    // }

    public function deleteAction(){
        $data['id'] = $this->route_params['id'];
        Category::delete($data);
        $this->redirect('/admin/category');
    }
}