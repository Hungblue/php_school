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
}