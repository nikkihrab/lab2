<DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>lab 4</title>
  <style>
    table {
      border-collapse: collapse;
      margin: 20px;
    }
    td {
      border: 1px solid #000000;
      padding: 5px;
      text-align: center;
    }
    .highlight {
      background-color: #0000ff;
    }
    .highlight_min {
      background-color: #00ffee;
    }
  </style>
</head>
<body>
  <?php

$a = array();

for ($y = 0; $y < 20; $y++) {
  for ($x = 0; $x < 20; $x++) {
    $a[$y][$x] = rand(min: 0, max:99);
  }
}

echo "<h3>Початкова матриця 20х20</h3>";
echo "<table>";
for ($y = 0; $y < 20; $y++) {
  echo "<tr>";
  for ($x = 0; $x < 20; $x++) {
    echo "<td>".$a[$y][$x]."</td>";
  }
  echo "</tr>";
}
echo "</table><br>";

$result = array();

for ($y = 0; $y < 20; $y++) {
  $row = $a[$y];
  $maxIndex = array_search(needle: max($row), haystack: $row);
  $minIndex = array_search(needle: min($row), haystack: $row);

  $maxValue = $row[$maxIndex];
  $minValue = $row[$minIndex];

  $newRow = array($maxValue);
  foreach ($row as $key => $value) {
    if($key !== $maxIndex && $key !== $minIndex) {
      $newRow[] = $value;
    }
  }
  $newRow[] = $minValue;
  $result[] = $newRow;
}

echo "<h3>Результат, з максимумом на початку та мінімумом в кінці</h3>";
echo "<table>";
for ($y = 0; $y < 20; $y++) {
  echo "<tr>";
  for ($x = 0; $x < count(value: $result[$y]); $x++) {
    if ($x == 0) {
      echo "<td class='highlight'>".$result[$y][$x]."</td>";
    } elseif ($x == count(value: $result[$y]) - 1) {
      echo "<td class='highlight_min'>".$result[$y][$x]."</td>";
    } else {
      echo "<td>".$result[$y][$x]."</td>";
    }
  }
  echo "</tr>";
}
echo "</table>";
?>
</body>
</html>
