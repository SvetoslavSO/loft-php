<?php

namespace App\Model;

use Core\AbstractModel;
use Core\Db;
use Intervention\Image\ImageManagerStatic as Image;

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
        $insert = "SELECT * FROM `message` WHERE user_id=:id ORDER BY `id` DESC LIMIT 20";
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
        if($file == '') {
            $this->image = '';
        } else {
            $this->image = $this->genFileName();
            $image = Image::make($file)
                    ->resize(null, 400, function($image) {
                    $image->aspectRatio();
                });
            $this->addWaterMark($image);
            $image->save(getcwd() . '/images/' . $this->image);
        }
    }

    function addWaterMark ($file) 
    {
        $file->text(
            "myPhpProject",
            5,
            15,
            function ($font) {
                $font->file(getcwd() . '/fonts/' . 'arial.ttf')->size('24');
                $font->color(array(255, 0, 0, 0.5));
                $font->align('left');
                $font->valign('top'); 
            }
        );
        return $file;
    }

    public function genFileName ()
    {
        return sha1(microtime(1) . rand(1, 1000000000)) . '.png';
    }
}