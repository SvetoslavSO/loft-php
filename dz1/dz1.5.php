<?php

$bmw = ['model' => 'X5', 'speed' => '120', 'doors' => '5', 'year' => '2015'];

$toyota = ['model' => 'camry', 'speed' => '110', 'doors' => '5', 'year' => '2018'];

$opel = ['model' => 'astra', 'speed' => '100', 'doors' => '5', 'year' => '2016'];

$cars = array(
  'bmw' => $bmw,
  'toyota' => $toyota,
  'opel' => $opel
);

foreach ($cars as $key => $value) {
  echo '<pre>';
  echo 'CAR', ' ', $key, '<br>';
  foreach ($value as $meaning) {
    echo $meaning, ' ';
  };
};