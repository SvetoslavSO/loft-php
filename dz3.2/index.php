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
  $ret = $pdo->prepare("SELECT * FROM `users` WHERE email=?");
  $ret->execute([$email]);
  $user = $ret->fetch();
  if (!$user) {
    $newRet = $pdo->prepare("INSERT INTO `users` (`id`, `email`, `orders`, `phone`, `name`) VALUES(?, ?, ?)");
    $newRet->execute([null, $email, 1, $phone, $name]);
  } else {
    $getOrders = $pdo->prepare("UPDATE `users` SET `orders`=`orders`+ 1, `phone`=?, `name`=? WHERE email=?");
    $getOrders->execute([$phone, $name, $email]);
  }
  $date = date("Y-m-d");
  $getUserId = $pdo->prepare("SELECT `id` FROM `users` WHERE email=?");
  $getUserId->execute([$email]);
  $userId = ($getUserId->fetch())[0];
  $newOrder = $pdo->prepare("INSERT INTO `orders` (`id`, `address`, `comment`, `email`, `user_id`, `date`) VALUES(?, ?, ?, ?, ?, ?)");
  $newOrder->execute([null, $address, $comment, $email, $userId, $date]);
  $orderAnswer = $pdo->query("SELECT `id`, `address` FROM `orders` ORDER BY `id` DESC LIMIT 1 ");
  $orderResult = $orderAnswer->fetch();
  $usersAnswer = $pdo->prepare("SELECT `orders` FROM `users` WHERE email=?");
  $usersAnswer->execute([$email]);
  $usersResult = $usersAnswer->fetch();
  echo 'Спасибо, ваш заказ будет доставлен по адресу:', $orderResult['address'], '<br>', 'Номер вашего заказа:', $orderResult['id'], '<br>', 'Это ваш ', $usersResult['orders'], ' заказ';
}