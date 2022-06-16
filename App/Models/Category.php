<?php

namespace App\Models;

use PDO;
use \Core\View;
class Category extends \Core\Model
{
      /**
     * Error messages
     *
     * @var array
     */
    // public $errors = [];

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



    public static function getAll()
    {
        $sql = 'SELECT * FROM categories_product Where is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getById($data){
        $sql = 'SELECT * FROM categories_product Where id = :id AND is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $data, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getBySlug($data){
        $sql = 'SELECT * FROM categories_product Where slug = :slug';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function getBySlug2($data){
        $sql = 'SELECT * FROM categories_product Where slug = :slug AND id != :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function insert($data)
    {
        $sql = 'INSERT INTO categories_product (name, slug, description, thumbnail , is_active) VALUES (:name, :slug, :description, :thumbnail, 1)';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(':thumbnail', $data['thumbnail'], PDO::PARAM_STR);
        return $stmt->execute();
    }
    public static function update($data)
    {
        $sql = 'UPDATE categories_product SET name = :name, slug = :slug, description = :description, thumbnail = :thumbnail WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindValue(':thumbnail', $data['thumbnail'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        return $stmt->execute();
    }
    public static function delete($data)
    {
        $sql = 'UPDATE categories_product SET is_active = 0 WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        return $stmt->execute();
    }

         /**
     * Validate current property values, adding valiation error messages to the errors array property
     *
     * @return void
     */
    public static function validateInsert($data)
    {
        $errors = [];
        if ($data['name'] == '') {
            $errors['name'] = 'Name is required';
        }
        if(!empty(Category::getBySlug($data))){
            $errors['slug'] = 'Category already exists';
        }
        return $errors;    
    }
    public static function validateUpdate($data)
    {
        $errors = [];
        if ($data['name'] == '') {
            $errors['name'] = 'Name is required';
        }
        if(!empty(Category::getBySlug2($data))){
            $errors['slug'] = 'Category already exists';
        }
        return $errors;    
    }
}