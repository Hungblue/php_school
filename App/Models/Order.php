<?php

namespace App\Models;

use PDO;

class Order extends \Core\Model
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
        $sql = 'SELECT * FROM orders Where is_active = 1';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
}