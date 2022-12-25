<?php

namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Core\AbstractModel;
use Intervention\Image\ImageManagerStatic as Image;

class Blog extends Model
{
    protected $table = 'message';
    public $timestamps = false;
    protected $fillable = [
      'text',
      'date',
      'user_id',
      'image'
  ];

    public function updateHistory()
    {
      return self::orderBy('id', 'desc')->take(20)->get();
    }

    public function getHistory()
    {
      return (self::orderBy('id', 'desc')->take(20)->get())[0];
    }

    public function getUserName($id)
    {
        return self::select('name')->where('id', $id);
    }

    public function returnHistory()
    {
        return self::orderBy('id', 'desc')->take(20)->get();
    }

    public function getUserMessages ($id)
    {
        return self::where('id', $id)->orderBy('id', 'desc')->take(20)->get();
    }

    public function deleteMessage(int $id)
    {
        self::where('id', $id)->delete();
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