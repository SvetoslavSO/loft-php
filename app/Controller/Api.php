<?php
namespace App\Controller;

use App\Model\Message;
use Core\AbstractController;

class Api extends AbstractController
{
    public function getUserMessagesAction()
    {
        $userId = (int) $_GET['user_id'] ?? 0;
        if (!$userId) {
            return $this->response(['error' => 'no_user_id']);
        }
        $messages = (new Message());
        $userMessages = $messages->getUserMessages($userId);
        if (!$userMessages) {
            return $this->response(['error' => 'no_messages']);
        }
        echo $this->response(['messages' => $userMessages]);
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}