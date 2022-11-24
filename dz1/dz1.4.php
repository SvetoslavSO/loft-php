<?php

$day = random_int(0, 10);

var_dump($day);

switch ($day) {
  case 1:
      echo 'Это рабочий день';
      break;
  
  case 2:
      echo 'Это рабочий день';
      break;

  case 3:
      echo 'Это рабочий день';
      break;

  case 4:
      echo 'Это рабочий день';
      break;

  case 5:
      echo 'Это рабочий день';
      break;

  case 6:
      echo 'Это выходной день';
      break;
    
  case 7:
      echo 'Это выходной день';
      break;

  default:
      echo 'Это неизвестный день';
      break;
}