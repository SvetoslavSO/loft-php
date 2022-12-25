<?php
// Пароль для почты предназначенной для php
// login php-loft@mail.ru
// password 1qsz3A1ta4gx_O
// application password i57eUn7PWju9dKhkv89g

namespace App\Controller;


require_once './../vendor/autoload.php';

use Core\AbstractController;
use Core\View as View;

class Mail extends AbstractController
{
    function indexAction ()
    {
        if(!$this->user) {
           $this->redirect('/user/register');
        }
        $this->view->setRenderType(View::RENDER_TYPE_NATIVE);

        return $this->view->render('Mail/mail.phtml', [
          'user' => $this->user,
          'blog' => $this->blog
        ]);
    }

    function sendAction() 
    {
        $mailContent = $_POST['mailText'];
        $transport = (new \Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
            ->setUsername('php-loft@mail.ru')
            ->setPassword('i57eUn7PWju9dKhkv89g');
        $mailer = new \Swift_Mailer($transport);
        $message = (new \Swift_Message('wonderful subject'))
            ->setFrom(['php-loft@mail.ru' => 'php-loft@mail.ru'])
            ->setTo(['sshaunin@mail.ru'])
            ->setBody($mailContent);
        $result = $mailer->send($message);
        var_dump(['res' => $result]);
    }
}