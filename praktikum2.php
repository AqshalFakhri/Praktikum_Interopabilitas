<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;a
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        td {
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Data Posts</h1>

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
                // Inisialisasi URL dan pengaturan CURL
                $url = 'http://jsonplaceholder.typicode.com/posts';
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                
                // Ubah respon JSON menjadi array
                $data = json_decode($response, true);

                // Loop untuk menampilkan data dalam tabel
                foreach ($data as $post) {
                    echo "<tr>";
                    echo "<td>" . $post['id'] . "</td>";
                    echo "<td>" . $post['title'] . "</td>";
                    echo "<td>" . $post['body'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</body>
</html>