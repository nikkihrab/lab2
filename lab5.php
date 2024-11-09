<DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>lab 5</title>
  <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1, h3 {
            text-align: center;
            color: #4CAF50;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        td a {
            text-decoration: none;
            color: #4CAF50;
            padding: 5px 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        td a:hover {
            background-color: #e8f5e9;
        }
        .sort-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .sort-buttons a {
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .sort-buttons a:hover {
            background-color: #45a049;
        }
  </style>
</head>
<body>
  <h1>Музика на сервері</h1>
    <div class="container">
        <div class="sort-buttons">
            <a href="?sort_by=artist">По виконавцю</a>
            <a href="?sort_by=year">По року</a>
            <a href="?sort_by=album">По альбому</a>
            <a href="?sort_by=song">По назві пісні</a>
        </div>
  <?php
$directory = 'C://music';

$files = scandir($directory);
$songs = [];

foreach ($files as $file) {
    if (strpos($file, '.mp3') !== false) {
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $parts = explode(' -- ', $filename);
        if (count($parts) === 4) {
            $songs[] = [
                'artist' => $parts[0],
                'year' => $parts[1],
                'album' => $parts[2],
                'song' => $parts[3],
                'file' => $file
            ];
        }
    }
}

$sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'artist'; 

usort($songs, function($a, $b) use ($sortBy) {
    return strcmp($a[$sortBy], $b[$sortBy]);
});

echo "<h3>Музика</h3>";
echo "<table border='1'>";
echo "<tr><th>Виконавець</th><th>Рік</th><th>Альбом</th><th>Назва пісні</th><th>Дія</th></tr>";
foreach ($songs as $song) {
    echo "<tr>";
    echo "<td>" . $song['artist'] . "</td>";
    echo "<td>" . $song['year'] . "</td>";
    echo "<td>" . $song['album'] . "</td>";
    echo "<td>" . $song['song'] . "</td>";
    echo "<td>
            <a href='" . $directory . '/' . $song['file'] . "' download>Завантажити</a> |
            <audio controls>
                <source src='" . $directory . '/' . $song['file'] . "' type='audio/mp3'>
                Ваш браузер не підтримує елемент <code>audio</code>.
            </audio>
          </td>";
    echo "</tr>";
}
echo "</table>";
?>
 </div>
</body>
</html>
