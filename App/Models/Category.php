<?php

namespace App\Models;

use PDO;

class Category extends \Core\Model
{
      /**
     * Error messages
     *
     * @var array
     */
    public $errors = [];

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

    /**
     * Save the user model with the current property values
     *
     * @return boolean  True if the user was saved, false otherwise
     */

  public static function getAll()
  {
    $sql = 'SELECT * FROM categories_product';

    $db = static::getDB();
    $stmt = $db->prepare($sql);
    //$stmt->bindValue(':id', $id, PDO::PARAM_INT);

    $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

    $stmt->execute();

    return $stmt->fetchAll();
  }

  public static function insert($data)
  {
    $sql = 'INSERT INTO categories (name, slug, description) VALUES (:name, :slug, :description)';
    $db = static::getDB();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
    $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
    $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);

    return $stmt->execute();
  }
}