<?php 

namespace App\Models;

use PDO;

class Cart extends \Core\Model
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

    public static function getByUserId($user_id)
    {
        $sql = 'SELECT * FROM carts WHERE user_id = :user_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getByProductId($product_id)
    {
        $sql = 'SELECT * FROM carts WHERE product_id = :product_id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function insert($data)
    {
        $sql = 'INSERT INTO carts (user_id, product_id, product_qty) VALUES (:user_id, :product_id, :product_qty)';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        $stmt->bindValue(':product_qty', $data['product_qty'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function delete($id)
    {
        $sql = 'DELETE FROM carts WHERE id = :id';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}