<?php

$age = random_int(-50, 100);

var_dump($age);

if ($age >= 18 && $age <= 65) {
    echo 'Вам ещё работать и работать';
} elseif ($age > 65) {
    echo 'Вам пора на пенсию';
} elseif ($age >=1 && $age <= 17) {
    echo 'Вам пока рано работать';
} else {
    echo 'Неизвестный возраст';
}