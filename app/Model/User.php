<?php

namespace App\Model;

use Core\AbstractModel;
use Core\Db;

class User extends AbstractModel
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    private $id;
    public $name;
    private $password;
    private $createdAt;
    private $gender;
    private $email;
    private $isAdmin = false;

    public function __construct($data = [])
    {
        if($data) {
            $this->id = $data['id'];
            $this->createdAt = $data['created_at'];
            $this->email = $data['email'];
            $this->name = $data['name'];
            $this->password = $data['password'];
            $this->gender = $data['gender'];
            if (in_array($this->id, ADMINS)) {
                $this->isAdmin = true;
            }
        }
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getRole () : bool
    {
      return $this->isAdmin;
    }

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setGender(int $gender) : self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getGenderInString() : string
    {
        return $this->gender == self::GENDER_MALE ? 'male' : 'female';
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCreatedAt() : string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt) : self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;
        return $this;
    }

    public function save()
    {
        $date = date("Y-m-d H:m:s");
        $db = Db::getInstance();
        $insert = "INSERT INTO  `users` (`name`, `email`,  `password`, `gender`, `created_at`) VALUES (
            :name, :email, :password, :gender, :createdAt
        )";
        $db->exec($insert, __METHOD__, [
          ':name' => $this->name,
          ':email' => $this->email,
          ':password' => $this->password,
          ':gender' => $this->gender,
          ':createdAt' => $date
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;
        return $id;
    }

    public static function getById(int $id) : ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `users` WHERE id=$id";
        $data = $db->fetchOne($select, __METHOD__);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getByName(string $name) : ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `users` WHERE `name` = :name";
        $data = $db->fetchOne($select, __METHOD__, [
          ':name' => $name
        ]);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getByEmail(string $email) : ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `users` WHERE `email` = :email";
        $data = $db->fetchOne($select, __METHOD__, [
          ':email' => $email
        ]);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getPasswordHash(string $password)
    {
        return sha1('thisIsOurSalt5' . $password);
    }
}