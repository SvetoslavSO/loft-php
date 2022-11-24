<?php

function task1($stringsArray, $isOneLine = false) {
    if($isOneLine){
        foreach ($stringsArray as $value) {
            $newLine .= $value;
        }
        echo $newLine, '<br>';
    } else {
        foreach ($stringsArray as $value) {
            echo '<p>', $value;
        };
        echo '<br>';
    }
};

function task2($operator, ...$args) {
    if($operator == '+') {
        $result = 0;
        foreach ($args as $value) {
            $result += $value;
        }
    } elseif ($operator == '-') {
      $result = 0;
      foreach ($args as $value) {
          $result -= $value;
      }
    } elseif ($operator == '*') {
        $result = 1;
        foreach ($args as $value) {
            $result *= $value;
        }
    } elseif ($operator == '/') {
        $result = $args[0];
        for ($i=1; $i < count($args); $i++) { 
          $result /= $args[$i];
        }
    };
    echo $result, '<br>';
};

function task3 ($firstInt, $secondInt) {
  if (is_int($firstInt) && is_int($secondInt)) {
    echo '<table border="1">';

    for ($i=0; $i <= $firstInt; $i++) {
      echo '<tr>';
      for ($j=0; $j <= $secondInt; $j++) { 
        echo '<td>';
        $new_number = $i * $j;
        if($i%2 === 0 && $j%2 ===0) {
          echo $i, 'x', $j, '=', '(', $new_number, ')';  
        } elseif ($i%2 === 1 && $j%2 ===1) {
          echo $i, 'x', $j, '=', '[', $new_number, ']';  
        } else {
          echo $i, 'x', $j, '=', $new_number;
        }
      };
      echo '<tr>';
    };
  } else {
    echo 'введены некорректные данные<br>';
  };
};

function task4 () {
    echo date('d.m.y, G:i'), '<br>';
};

function task5 () {
    echo strtotime('24.02.2016 00:00:00'), '<br>';
};

function task6 ($string) {
  echo str_replace('К', '', $string), '<br>';
};

function task7($string, $substr, $desired) {
  echo str_replace($substr, $desired, $string), '<br>';
}

function task8($file) {
  if(!file_exists($file)) {
    $fp = fopen($file, 'w');
    fwrite($fp, 'Hello, world');
    fclose($fp);
    echo 'File created <br>';
  } else {
    echo 'File exists <br>';
  }
}

function task9($file) {
  if(!file_exists($file)) {
    $str = 'No such file';
  } else {
    $fp = fopen($file, 'r');
    while(!feof($fp)) {
      $str .= fgets($fp);
    }
    fclose($fp);
  }
  echo $str, '<br>';
};