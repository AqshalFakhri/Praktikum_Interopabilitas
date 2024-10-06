<?php


$url = 'http://jsonplaceholder.typicode.com/posts';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['body'])) {

    $new_data = array(
        'title' => $_POST['title'],
        'body' => $_POST['body'],
    );

    
    $ch_post = curl_init();
    curl_setopt($ch_post, CURLOPT_URL, $url);
    curl_setopt($ch_post, CURLOPT_POST, 1);
    curl_setopt($ch_post, CURLOPT_POSTFIELDS, json_encode($new_data));
    curl_setopt($ch_post, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch_post, CURLOPT_RETURNTRANSFER, true);

    
    $post_response = curl_exec($ch_post);

    
    curl_close($ch_post);

    
    $post_response_data = json_decode($post_response, true);
}

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    
    $delete_url = $url . '/' . $delete_id;

    
    $ch_delete = curl_init();
    curl_setopt($ch_delete, CURLOPT_URL, $delete_url);
    curl_setopt($ch_delete, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch_delete, CURLOPT_RETURNTRANSFER, true);

    
    $delete_response = curl_exec($ch_delete);

    
    curl_close($ch_delete);

    
    if ($delete_response === "") {
        $delete_message = "Post ID $delete_id berhasil dihapus.";
    } else {
        $delete_message = "Post ID $delete_id gagal dihapus.";
    }
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$response = curl_exec($ch);


curl_close($ch);


$responseData = json_decode($response, true);


$first_five = array_slice($responseData, 0, 5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Post Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: wheat; 
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            text-align: left;
            color: black; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid blue; 
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: gray; 
            color: white;
        }
        form {
            margin: 20px;
            padding: 20px;
            background-color: skyblue; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 1100px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: blue; 
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid gray; 
        }
        button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 14px;
            background-color: black; 
            color: white;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <h1>Tambah Data</h1>

    
    <form method="POST" action="">
        <label for="title">Judul</label>
        <input type="text" id="title" name="title" required>

        <label for="body">Isi</label>
        <textarea id="body" name="body" rows="4" required></textarea>

        <button type="submit">Submit Data</button>
    </form>

    <?php if (!empty($post_response_data)): ?>
        <h2>Data baru yang ditambahkan</h2>
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Isi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($post_response_data['title']); ?></td>
                    <td><?php echo htmlspecialchars($post_response_data['body']); ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (isset($delete_message)): ?>
        <h2><?php echo $delete_message; ?></h2>
    <?php endif; ?>

    <h1>Daftar GET Teratas 5</h1>
    
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Isi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($first_five as $post): ?>
                <tr>
                    <td><?php echo htmlspecialchars($post['title']); ?></td>
                    <td><?php echo htmlspecialchars($post['body']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>