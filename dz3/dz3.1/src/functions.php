<?php

function task1 () 
{
  $names = ['Maria', 'Stas', 'Petya', 'Vasya', 'Dasha'];
  $newArray = [];
  for($i = 0; $i < 50; $i++){
      $newArray[$i] = ['name' => $names[array_rand($names)], 'id' => $i, 'age' => random_int(18, 45)];
  };
  return $newArray;
}

function task2 ($file, $content) 
{
  $arrayInJSON = json_encode($content);
  if (file_exists($file)) {
    echo 'File exists <br>';
    return;
  }
  $fp = fopen($file, 'w');
  fwrite($fp, $arrayInJSON);
  fclose($fp);
  echo "File created and information writed to file $file<br>";
};

function task3 ($file) 
{
  if(!file_exists($file)) {
    echo 'File is not exists <br>';
    return;
  }
  $fp = fopen($file, 'r');
  while(!feof($fp)) {
    $array .= fgets($fp);
  }
  fclose($fp);
  $arrayClassic = json_decode($array);
  return $arrayClassic;
}

function task4 ($array) {
  $names = ['Maria' => 0, 'Stas' => 0, 'Petya' => 0, 'Vasya' => 0, 'Dasha'=> 0];

  for($i = 0; $i < 50; $i++) {
    if(array_key_exists($array[$i]->name, $names)) {
      $names[$array[$i]->name]++;
    }
  }
  return $names;
}

function task5 ($array) {
  $age = 0;
  for($i = 0; $i < 50; $i++) {
    $age += $array[$i]->age;
  }
  return $age/50;
}