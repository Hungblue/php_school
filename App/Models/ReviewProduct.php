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
}