<?php

echo '<table border="1">';

for ($i=0; $i <= 10; $i++) {
  echo '<tr>';
  for ($j=0; $j <= 10; $j++) { 
    echo '<td>';
    $result = $i * $j;
    if($i%2 === 0 && $j%2 ===0) {
      echo $i, 'x', $j, '=', '(', $result, ')';  
    } elseif ($i%2 === 1 && $j%2 ===1) {
      echo $i, 'x', $j, '=', '[', $result, ']';  
    } else {
      echo $i, 'x', $j, '=', $result;
    }
  };
  echo '<tr>';
};