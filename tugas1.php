<?php
$url = 'http://jsonplaceholder.typicode.com/posts';


$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$response = curl_exec($ch);

// Tutup cURL
curl_close($ch);


if ($response === false) {
    die('Error saat mengambil data dari API');
}


$data = json_decode($response, true);

// Cek apakah JSON decode berhasil
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error saat memproses data JSON: ' . json_last_error_msg());
}


$posts = array_slice($data, 0, 5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data API</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: greenyellow; 
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: gray; 
        }
        h2 {
            text-align: center;
            color: black; 
        }
        body {
            background-color: white; 
        }
    </style>
</head>
<body>

<h2>Data dari API</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Body</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Tampilkan 5 data pertama
        if (!empty($posts)) {
            foreach ($posts as $post) {
                echo "<tr>";
                echo "<td>{$post['id']}</td>";
                echo "<td>{$post['title']}</td>";
                echo "<td>{$post['body']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data tersedia</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>