<?php

namespace App\Models;

use PDO;
use \Core\Model;

class Post extends \Core\Model
{
    public static function getAll()
    {

        try {
            $db = static::getDB();

            $stmnt = $db->query(
                "SELECT id, title, content FROM posts 
                  ORDER BY created_at");
            $results = $stmnt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}