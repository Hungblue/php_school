<?php

namespace App\Models;

use PDO;

class Product extends \Core\Model
{
    /**
     * Class constructor
     *
     * @param array $data  Initial property values (optional)
     *
     * @return void
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public static function getAll(){
        $sql = 'SELECT * FROM products Where is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($data){
        $sql = 'SELECT * FROM products Where id = :id AND is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLastProduct(){
        $sql = 'SELECT * FROM products Order BY id Desc Limit 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByCode($data){
        $sql = 'SELECT * FROM products Where code = :code';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':code', $data['code'], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getByCode2($data){
        $sql = 'SELECT * FROM products Where code = :code AND id != :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindValue(':code', $data['code'], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBySlug($data){
        $sql = 'SELECT * FROM products Where slug = :slug';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getBySlug2($data){
        $sql = 'SELECT * FROM products Where slug = :slug AND id != :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public function insert($data)
    {
        $sql = 'INSERT INTO products (code, name, slug, price, sale_price, quantity, short_description, description, featured, trending, sku, thumbnail, user_id, is_active) 
        VALUES (:code, :name, :slug, :price, :sale_price, :quantity, :short_description, :description, :featured, :trending, :sku, :thumbnail, :user_id, 1)';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':code', $data['code'], PDO::PARAM_STR);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':price', $data['price'], PDO::PARAM_INT);
        $stmt->bindValue(':sale_price', $data['sale_price'], PDO::PARAM_INT);
        $stmt->bindValue(':quantity', $data['qty'], PDO::PARAM_INT);
        $stmt->bindValue(':short_description', $data['short_describe'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['describe'], PDO::PARAM_STR);
        $stmt->bindValue(':featured', $data['featured'], PDO::PARAM_INT);
        $stmt->bindValue(':trending', $data['trending'], PDO::PARAM_INT);
        $stmt->bindValue(':sku', $data['sku'], PDO::PARAM_STR);
        $stmt->bindValue(':thumbnail', $data['thumbnail'], PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function update($data)
    {
        $sql = 'UPDATE products SET code = :code, name = :name, slug = :slug, price = :price, sale_price = :sale_price, quantity = :quantity, short_description = :short_description, description = :description, featured = :featured, trending = :trending, sku = :sku, thumbnail = :thumbnail, user_id = :user_id WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':code', $data['code'], PDO::PARAM_STR);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':price', $data['price'], PDO::PARAM_INT);
        $stmt->bindValue(':sale_price', $data['sale_price'], PDO::PARAM_INT);
        $stmt->bindValue(':quantity', $data['qty'], PDO::PARAM_INT);
        $stmt->bindValue(':short_description', $data['short_describe'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['describe'], PDO::PARAM_STR);
        $stmt->bindValue(':featured', $data['featured'], PDO::PARAM_INT);
        $stmt->bindValue(':trending', $data['trending'], PDO::PARAM_INT);
        $stmt->bindValue(':sku', $data['sku'], PDO::PARAM_STR);
        $stmt->bindValue(':thumbnail', $data['thumbnail'], PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function delete($data)
    {
        $sql = 'UPDATE products SET is_active = 0 WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    // categories has product
    public function insertCategoriesProduct($data)
    {
        if(!empty($data['categories'])){
            foreach($data['categories'] as $value){
                $sql = 'INSERT INTO categories_has_product (category_id, product_id)  VALUES (:category_id, :product_id)';
                $db = static::getDB();
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':category_id', $value, PDO::PARAM_INT);
                $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
                $stmt->execute();
            }  
        }
        
    }
    public function getCategoryIdByProductId($data){
        $sql = 'SELECT * FROM categories_has_product Where product_id = :product_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':product_id', $data, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function deleteByProductId($data){
        $sql = 'DELETE FROM categories_has_product Where product_id = :product_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':product_id', $data, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
    /**
     * Validate current property values, adding valiation error messages to the errors array property
     *
     * @return void
     */
    public function validateInsert($data)
    {
        $errors = [];
        if ($data['code'] == '') {
            $errors['code'] = 'Code is required!';
        }
        if ($data['name'] == '') {
            $errors['name'] = 'Name is required!';
        }
        if(!empty(Product::getByCode($data))){
            $errors['code'] = 'Code already exists!';
        }
        if(!empty(Product::getBySlug($data))){
            $errors['slug'] = 'Product already exists!';
        }
        if ($data['price'] == '') {
            $errors['price'] = 'Price is required!';
        }
        if ($data['price'] < $data['sale_price']) {
            $errors['sale_price'] = 'Promotion price must be less than or equal to default price!';
        }
        if ($data['qty'] == '') {
            $errors['qty'] = 'Quantity is required!';
        }
        return $errors;    
    }
    public function validateUpdate($data)
    {
        $errors = [];
        if ($data['code'] == '') {
            $errors['code'] = 'Code is required!';
        }
        if ($data['name'] == '') {
            $errors['name'] = 'Name is required!';
        }
        if(!empty(Product::getByCode2($data))){
            $errors['code'] = 'Code already exists!';
        }
        if(!empty(Product::getBySlug2($data))){
            $errors['slug'] = 'Product already exists!';
        }
        if ($data['price'] == '') {
            $errors['price'] = 'Price is required!';
        }
        if ($data['price'] < $data['sale_price']) {
            $errors['sale_price'] = 'Promotion price must be less than or equal to default price!';
        }
        if ($data['qty'] == '') {
            $errors['qty'] = 'Quantity is required!';
        }
        return $errors;    
    }

}