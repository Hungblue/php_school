<?php

namespace App;

use PDO;

class JoinTable extends \Core\Model
{

  
  public static function innerJoin($table_name1, $table_name2, $key1, $key2, $where1)
  {
      $sql = 'SELECT * FROM :table_name1 INNER JOIN :table_name2 ON :table_name1.:key1 = :table_name2.:key2 WHERE :table_name1.:key1 = :where1';
      $db = static::getDB();
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':table_name1', $table_name1, PDO::PARAM_STR);
      $stmt->bindValue(':table_name2', $table_name2, PDO::PARAM_STR);
      $stmt->bindValue(':key1', $key1, PDO::PARAM_STR);
      $stmt->bindValue(':key2', $key2, PDO::PARAM_STR);
      $stmt->bindValue(':where1', $where1, PDO::PARAM_INT);
      $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
      $stmt->execute();
      return $stmt->fetchAll();
  }

  public static function cartJoinProduct($user_id)
  {
      $sql = 'SELECT * FROM products INNER JOIN carts ON products.id = carts.product_id WHERE carts.user_id = :user_id';
      $db = static::getDB();
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
      $stmt->execute();
      return $stmt->fetchAll();
  }
}   