<?php

namespace App\Model;

use Core\AbstractModel;
use Core\Db;

class Blog extends AbstractModel
{
    private $history = [];

    public function updateHistory()
    {
      $db = Db::getInstance();
      $insert = "SELECT * FROM `message` ORDER BY 'id' DESC LIMIT 20";
      $history = $db->fetchAll($insert, __METHOD__);
      return $this;
    }

    public function getHistory()
    {
        $db = Db::getInstance();
        $insert = "SELECT * FROM `message` ORDER BY 'id' DESC LIMIT 20";
        $history = $db->fetchAll($insert, __METHOD__);
        $this->history = $history;
        return $this;
    }

    public function getUserName($id)
    {
        $db = Db::getInstance();
        $select = "SELECT `name` FROM `users` WHERE id=:id";
        $userName = $db->fetchAll($select, __METHOD__, [
          ':id' => $id,
        ]);
        return $userName[0]['name'];
    }

    public function returnHistory()
    {
        return $this->history;
    }
}