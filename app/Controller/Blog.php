<?php

namespace App\Controller;

use Core\AbstractController;
use App\Model\Message;
use App\Model\Blog as BlogModel;
use App\Model\User;
use Core\View as View;

class Blog extends AbstractController
{
  function indexAction ()
  {
      if(!$this->user) {
         $this->redirect('/user/register');
      }
      $this->view->setRenderType(View::RENDER_TYPE_TWIG);

      return $this->view->render('Blog/index.twig', [
        'user' => $this->user,
        'blog' => $this->blog
      ]);
  }

  function addMessageAction ()
  {
      $text = $_POST['messageText'];
      if(!$text){
          $this->view->render('Blog/index.phtml', [
            'user' => $this->user,
            'blog' => $this->blog,
            'error' => 'Сообщение не может быть пустым'
          ]);
      } else {
          $message = new Message();
          if($_FILES['image']['tmp_name']){
              $message->loadFile($_FILES['image']['tmp_name']);
          } else {
              $message->loadFile('');
          }
          $message
              ->setText($text)
              ->setId()
              ->save();
          $this->setBlog((new BlogModel())
              ->getHistory());
          return $this->view->render('Blog/index.phtml', [
            'user' => $this->user,
            'blog' => $this->blog
          ]);
      }
  }

  function deleteMessageAction()
  {
      $id = $_GET['id'];
      $message = (new Message())->deleteMessage($id);
      $this->setBlog((new BlogModel())
          ->getHistory());
      return $this->view->render('Blog/index.phtml', [
        'user' => $this->user,
        'blog' => $this->blog
      ]);
  }
}