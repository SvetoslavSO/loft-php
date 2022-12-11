<?php

namespace App\Model;

use Core\AbstractModel;
use Core\Db;

class Message extends AbstractModel
{
    private $text;
    private $userId;
    private $image;

    public function save()
    {
        $date = date("Y-m-d H:i:s");
        $db = Db::getInstance();
        $insert = "INSERT INTO `message` (`text`, `date`, `user_id`, `image`) VALUES(
            :text, :createdAt, :userId, :image
        )";
        $db->exec($insert, __FILE__, [
          ':text' => $this->text,
          ':createdAt' => $date,
          ':userId' => $this->userId,
          ':image' => $this->image
        ]);
    }

    public function setId() : self
    {
        $this->userId =  $_SESSION['id'];
        return $this;
    }

    public function getUserMessages ($id)
    {
        $db = Db::getInstance();
        $insert = "SELECT * FROM `message` WHERE id=:id DESC LIMIT 20";
        $history = $db->fetchAll($insert, __METHOD__, [
          ':id' => $id
        ]);
        return $history;
    }

    public function setText($text) : self
    {
        $this->text = $text;
        return $this;
    }

    public function deleteMessage(int $id)
    {
        $db = Db::getInstance();
        $insert = "DELETE FROM `message` WHERE id=:id";
        $db->exec($insert, __METHOD__, [
            ':id' => $id
        ]);
    }

    public function loadFile ($file)
    {
        $this->image = $this->genFileName();
        if(file_exists($file)){
            move_uploaded_file(
                $file,
                getcwd() . '/images/' . $this->image
            );
        }
    }

    public function genFileName ()
    {
        return sha1(microtime(1) . rand(1, 1000000000)) . '.png';
    }
}