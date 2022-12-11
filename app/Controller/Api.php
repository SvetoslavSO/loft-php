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
        $messages = (Message::getUserMessages($userId));
        if (!$messages) {
            return $this->response(['error' => 'no_messages']);
        }

        $data = array_map($this->getData($message), $message);
        echo $data;

        return $this->response(['messages' => $data]);
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'author_id' => $this->authorId,
            'text' => $this->text,
            'created_at' => $this->createdAt,
            'image' => $this->image
        ];
    }
}