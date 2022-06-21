<?php

namespace App\Models;

use PDO;

class ReviewProduct extends \Core\Model
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

    public static function getByIdProduct($product_id)
    {
        $sql = 'SELECT * FROM review_product Where product_id = :product_id AND is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getAVGRate($product_id)
    {
        $sql = 'SELECT AVG(rate) as avg_rate FROM review_product Where product_id = :product_id AND is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function getRateUser($product_id, $user_id)
    {
        $sql = 'SELECT * FROM review_product Where product_id = :product_id AND user_id = :user_id AND is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function insert($data)
    {
        $sql = 'INSERT INTO review_product (user_id, comment, rate, product_id, is_active) 
        VALUES (:user_id, :comment, :rate, :product_id, 1)';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':comment', $data['comment'], PDO::PARAM_STR);
        $stmt->bindValue(':rate', $data['rate'], PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        return $stmt->execute();
    }
    //take records to orders table with order_id in order_detail table have product_id exist
    public static function verifiedPurchase($data)
    {
        $sql = 'SELECT orders.user_id, order_detail.product_id FROM orders INNER JOIN order_detail ON orders.id = order_detail.order_id WHERE orders.user_id = :user_id AND order_detail.product_id = :product_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getByUserIdAndProductId($user_id, $product_id)
    {
        $sql = 'SELECT * FROM review_product WHERE user_id = :user_id AND product_id = :product_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function update($data)
    {
        $sql = 'UPDATE review_product SET rate = :rate WHERE user_id = :user_id AND product_id = :product_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        $stmt->bindValue(':rate', $data['rate'], PDO::PARAM_INT);
        return $stmt->execute();
    }
}