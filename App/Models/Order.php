<?php

namespace App\Models;

use PDO;

class Order extends \Core\Model
{
  // public function __construct(){
    
  // }

  public static function getAll(){
    $sql = 'SELECT * FROM orders';

    $db = static::getDB();
    $stmt = $db->prepare($sql);
    //$stmt->bindValue(':id', $id, PDO::PARAM_INT);

    $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

    $stmt->execute();

    return $stmt->fetchAll();
  }

  public static function getById(){
    
  }
}