<?php

try {
  $pdo = new PDO ('mysql:host=127.0.0.1; dbname=burgers', 'root', '');
} catch (PDOException $e) {
  echo $e->getMessage();
  die;
}

$name = $_GET['name'] ?? 0;
$phone = $_GET['phone'] ?? 0;
$email = $_GET['email'] ?? 0;
$street = $_GET['street'] ?? 0;
$home = $_GET['home'] ?? 0;
$part = $_GET['part'] ?? 0;
$apprtament = $_GET['appt'] ?? 0;
$floor = $_GET['floor'] ?? 0;
$comment = $_GET['comment'] ?? 0;
$address = $street. '/' . $home . '/' . $part . '/' . $apprtament . '/' . $floor;

if ($email) {
  $userId = getUserId($pdo, $email);
  if (!$userId) {
    $userId = addUser($pdo, $email, $phone, $name);
  } else {
    getOrders($pdo, $email, $phone, $name);
  }
  newOrder($pdo, $address, $comment, $email, $userId);
  $orderResult = getOrderCount($pdo, $email);
  $usersResult = getUserAnswer($pdo, $userId);
  echo 'Спасибо, ваш заказ будет доставлен по адресу:', $usersResult['address'], '<br>', 'Номер вашего заказа:', $usersResult['id'], '<br>', 'Это ваш ', $orderResult['orders'], ' заказ';
}

function addUser ($pdo, $email, $phone, $name) 
{
    $newRet = $pdo->prepare("INSERT INTO `users` (`email`, `orders`, `phone`, `name`) VALUES (?, ?, ?, ?)");
    $newRet->execute([$email, 1, $phone, $name]);
    return getUserId($pdo, $email);
}

function getOrders ($pdo, $email, $phone, $name)
{
    $getOrders = $pdo->prepare("UPDATE `users` SET `orders`=`orders`+ 1, `phone`=?, `name`=? WHERE email=?");
    $getOrders->execute([$phone, $name, $email]);
}

function getUserId ($pdo, $email)
{
    $getUserId = $pdo->prepare("SELECT `id` FROM `users` WHERE email=?");
    $getUserId->execute([$email]);
    return $userId = ($getUserId->fetch())[0];
}

function newOrder ($pdo, $address, $comment, $email, $userId)
{
    $date = date("Y-m-d");
    $newOrder = $pdo->prepare("INSERT INTO `orders` (`id`, `address`, `comment`, `email`, `user_id`, `date`) VALUES(?, ?, ?, ?, ?, ?)");
    $newOrder->execute([null, $address, $comment, $email, $userId, $date]);
}

function getOrderCount ($pdo, $email)
{
      $usersAnswer = $pdo->prepare("SELECT `orders` FROM `users` WHERE email=?");
      $usersAnswer->execute([$email]);
      return $usersAnswer->fetch();
}

function getUserAnswer ($pdo, $userId)
{
    $orderAnswer = $pdo->prepare("SELECT `id`, `address` FROM `orders` WHERE `user_id`=?  ORDER BY `id` DESC LIMIT 1 ");
    $orderAnswer->execute([$userId]);
    return $orderAnswer->fetch();
}