<?php

namespace App\Controller;

use Core\AbstractController;
use App\Model\User as UserModel;

class User extends AbstractController
{
    function loginAction ()
    {
        $email = trim($_POST['email']);
        $confirmPassword = trim($_POST['confirmPassword']);
        

        if ($email) {
            $password = $_POST['password'];
            $user = UserModel::getByEmail($email);
            if (!$user) {
                $this->view->assign('error', 'Неверный логин или пароль');
            } else {
              if ($user->getPassword() != UserModel::getPasswordHash($password)) {
                  $this->view->assign('error', 'Неверный логин или пароль');
              } else {
                $_SESSION['id'] = $user->getId();
                $this->redirect('/blog/index');
              }
            }
        }

        return $this->view->render('User/register.phtml', [
          'user' => UserModel::getById((int) $_GET['id'])
        ]);
    }

    function registerAction()
    {
        $email = trim($_POST['email']);
        $name = trim($_POST['name']);
        $gender = UserModel::GENDER_MALE;
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirmPassword']);
        $success = true;

        if (isset($_POST['email'])) {
            if (UserModel::getPasswordHash($password) != UserModel::getPasswordHash($confirmPassword)) {
                $this->view->assign('error', 'Пароли не совпадают');
                $success = false;
            }
            if (!$email) {
                $this->view->assign('error', 'Email не может быть пустым');
                $success = false;
            }
          
            if (!$password) {
                $this->view->assign('error', 'Пароль не может быть пустым');
                $success = false;
            }

            if (strlen($password) < 4) {
                $this->view->assign('error', 'Пароль должен быть длиннее 4 символов');
                $success = false;
            }

            if (!$name) {
                $this->view->assign('error', 'Имя не может быть пустым');
                $success = false;
            }

            $user = UserModel::getByEmail($email);

            if ($user) {
              $this->view->assign('error', 'Пользователь с таким email уже существует');
              $success = false;
            }
          
            if ($success) {
                $user = (new UserModel())
                    ->setName($name)
                    ->setGender($gender)
                    ->setEmail($email)
                    ->setPassword(UserModel::getPasswordHash($password));
            
                $user->save();
            
                $_SESSION['id'] = $user->getId();
                $this->setUser($user);
            
                $this->redirect('/blog/index');
            }
        }

      return $this->view->render('User/register.phtml', [
        'user' => UserModel::getById((int) $_GET['id'])
      ]);
  }

  public function profileAction()
  {
      return $this->view->render('User/profile.phtml', [
          'user' => UserModel::getById((int) $_GET['id'])
      ]);
  }

  public function logoutAction()
  {
    session_destroy();

    $this->redirect('/user/login');
  }
}