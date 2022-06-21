<?php

namespace App\Models;

use PDO;

class CommentProduct extends \Core\Model
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

    public static function getById($id)
    {
        $sql = 'SELECT * FROM comment_product Where id = :id AND is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getByIdUser($user_id)
    {
        $sql = 'SELECT * FROM comment_product Where user_id = :user_id AND is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function insert($data)
    {
        $sql = 'INSERT INTO comment_product (user_id, product_id, comment) 
        VALUES (:user_id, :product_id, :comment)';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        $stmt->bindValue(':comment', $data['comment'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function getByUserIdAndProductId($data)
    {
        $sql = 'SELECT * FROM comment_product WHERE user_id = :user_id AND product_id = :product_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function validateInsert($data)
    {
        $errors = [];
        if ($data['user_id'] == '') {
            $errors['user_id'] = 'Code is required!';
        }
        if ($data['product_id'] == '') {
            $errors['product_id'] = 'Code is required!';
        }
        if ($data['comment'] == '') {
            $errors['comment'] = 'Code is required!';
        }

        return $errors;
    }

    public static function update($data)
    {
        $sql = 'UPDATE comment_product SET comment = :comment WHERE user_id = :user_id AND product_id = :product_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        $stmt->bindValue(':comment', $data['comment'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function getPagination($value1, $value2)
    {
        $sql = 'SELECT * FROM comment_product Where is_active = 1 LIMIT :value1, :value2';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':value1', $value1, PDO::PARAM_INT);
        $stmt->bindValue(':value2', $value2, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getUserName($value1, $value2)
    {
        $sql = 'SELECT * FROM comment_product INNER JOIN users ON comment_product.user_id = users.id WHERE comment_product.is_active = 1 LIMIT :value1, :value2';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':value1', $value1, PDO::PARAM_INT);
        $stmt->bindValue(':value2', $value2, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
}