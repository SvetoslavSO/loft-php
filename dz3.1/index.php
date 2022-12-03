<?php

require 'src/functions.php';

$newArray = task1();

task2('users.json', $newArray);

$returnedArray = task3('users.json');

$countOfNames = task4($returnedArray);

$avarageAge = task5($returnedArray);

var_dump($countOfNames);

echo '<br>';

echo $avarageAge;