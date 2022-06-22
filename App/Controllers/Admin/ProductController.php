<?php

namespace App\Controllers\Admin;

use Core\View;
use App\Models\Product;
use App\Models\Category;
use App\Auth;

/**
 * Account controller
 *
 * PHP version 7.0
 */
class ProductController extends \Core\Controller
{
            /**
     * Require the user to be authenticated before giving access to all methods in the controller
     *
     * @return void
     */
    
    protected function before()
    {
        $this->requireLogin();
    }

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
        $product_categories = [];
        foreach($products as $value){
            $product_id = $value->id;
            $data['id'] = [];
            if(!empty(Product::getCategoryIdByProductId($product_id))){
                $categories = Product::getCategoryIdByProductId($product_id);
                foreach($categories as $value2){
                    $cate_id = $value2->category_id;
                    $product_categories[$value->id][$value2->category_id] = Category::getById($cate_id);
                }
                
            }
        }
        View::renderTemplate('Admin/Product/index.html', ['products' => $products, 'product_categories' => $product_categories]);
    }

    public function addAction()
    {
        $categories = Category::getAll();
        if (isset($_POST['submit'])){
            if(!empty($_POST['categories'])){
                $data['categories'] = $_POST['categories'];
            }else{
                $data['categories'] = [];
            }
            $data['code'] = $_POST['code'];
            $data['name'] = $_POST['name'];
            $data['slug'] = $_POST['slug'];
            if($data['slug'] == ''){
                $data['slug'] = $data['name'];
            }
            $data['slug'] = vn_to_str($data['slug']);
            $data['price'] = $_POST['price'];
            $data['sale_price'] = $_POST['sale_price'];
            if($data['sale_price'] == 0){
                $data['sale_price'] = NULL;
            }
            $data['qty'] = $_POST['qty'];
            $data['sku'] = $_POST['sku'];
            $data['short_describe'] = $_POST['short_describe'];
            $data['describe'] = $_POST['describe'];

            $data['featured'] = $data['trending'] = 0;
            if(!empty($_POST['featured'])){
                $data['featured'] = 1;
            }
            if(!empty($_POST['trending'])){
                $data['trending'] = 1;
            }
            $data['thumbnail'] = add_image('thumbnail')['image'];
            if($data['thumbnail'] == ''){
                $data['thumbnail'] = 'import-img.png';
            }
            $data['user_id'] = Auth::getUser()->id;
            // validate
            $errors = Product::validateInsert($data);
            if(!empty(add_image('thumbnail')['error'])){
               $errors['image'] = add_image('thumbnail')['error']; 
            }
            if(!empty($errors)){
                View::renderTemplate('Admin/Product/add.html', ['categories' => $categories, 'errors'=> $errors]);
            }else{
                Product::insert($data);
                $data['product_id'] = Product::getlastProduct()[0]['id'];
                Product::insertCategoriesProduct($data);
                $this->redirect('/admin/product');
            }

        }else{
            View::renderTemplate('Admin/Product/add.html', ['categories' => $categories]);
        }   
    }

    public function editAction(){
        $categories = Category::getAll();
        $data['id'] = $this->route_params['id'];
        $product = Product::getById($data)[0];
        $categories_product = Product::getCategoryIdByProductId($data['id']);
        if (isset($_POST['submit'])){
            if(!empty($_POST['categories'])){
                $data['categories'] = $_POST['categories'];
            }else{
                $data['categories'] = [];
            }
            $data['code'] = $_POST['code'];
            $data['name'] = $_POST['name'];
            $data['slug'] = $_POST['slug'];
            if($data['slug'] == ''){
                $data['slug'] = $data['name'];
            }
            $data['slug'] = vn_to_str($data['slug']);
            $data['price'] = $_POST['price'];
            $data['sale_price'] = $_POST['sale_price'];
            if($data['sale_price'] == 0){
                $data['sale_price'] = NULL;
            }
            $data['qty'] = $_POST['qty'];
            $data['sku'] = $_POST['sku'];
            $data['short_describe'] = $_POST['short_describe'];
            $data['describe'] = $_POST['describe'];

            $data['featured'] = $data['trending'] = 0;
            if(!empty($_POST['featured'])){
                $data['featured'] = 1;
            }
            if(!empty($_POST['trending'])){
                $data['trending'] = 1;
            }
            $data['thumbnail'] = add_image('thumbnail')['image'];
            if($data['thumbnail'] == ''){
                $data['thumbnail'] = $product->thumbnail;
            }
            $data['user_id'] = Auth::getUser()->id;
            var_dump($data);
            // validate
            $errors = Product::validateUpdate($data);
            if(!empty(add_image('thumbnail')['error'])){
               $errors['image'] = add_image('thumbnail')['error']; 
            }

            if(!empty($errors)){
                View::renderTemplate('Admin/Product/edit.html', ['categories' => $categories, 'product' => $product, 'categories_product' => $categories_product, 'errors'=>$errors]);
            }else{
                $data['product_id'] = $product->id;
                Product::update($data);
                Product::deleteByProductId($product->id);
                Product::insertCategoriesProduct($data);
                $this->redirect('/admin/product');
            }
        }else{
            View::renderTemplate('Admin/Product/edit.html', ['categories' => $categories, 'product' => $product, 'categories_product' => $categories_product]);
        }
    }

    public function deleteAction(){
        $data['id'] = $this->route_params['id'];
        Product::delete($data);
        $this->redirect('/admin/product');
    }
}