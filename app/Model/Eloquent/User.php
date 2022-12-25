<?php

namespace App\Model\Eloquent;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'created_at'
    ];
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    
    private $isAdmin = false;

    public function __construct()
    {
      if (in_array($this->id, ADMINS)) {
          $this->isAdmin = true;
      }
    }

    public function getRole () : bool
    {
      return $this->isAdmin;
    }

    public function getGenderInString() : string
    {
        return $this->gender == self::GENDER_MALE ? 'male' : 'female';
    }

    public static function getById(int $id) : ?self
    {
        return (self::where('id', $id)->get())[0];
    }

    public static function getUserNameById(int $id) : ?string
    {
        return (self::where('id', $id)->get())[0]['name'];
    }

    public static function getByName(string $name) : ?self
    {
        return self::where('name', $name)->get();
    }

    public static function getByEmail(string $email) : ?self
    {
        return (self::where('email', $email)->get())[0];
    }

    public static function getPasswordHash(string $password)
    {
        return sha1('thisIsOurSalt5' . $password);
    }
}