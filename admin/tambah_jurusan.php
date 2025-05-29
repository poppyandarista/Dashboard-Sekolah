<?php
include("koneksi.php");
$db = new database();

if (isset($_POST['simpan'])) {
    $db->tambah_jurusan(
        $_POST['kodejurusan'],
        $_POST['namajurusan'],
    );
    header("Location:datajurusan.php");

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Jurusan</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fafafa;
            transition: 0.3s;
            font-size: 14px;
        }

        input[type="text"]::placeholder,
        textarea::placeholder {
            color: #aaa;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #4CAF50;
            background-color: #fff;
        }

        input[type="submit"] {
            width: 100%;
            background-color: rgb(243, 152, 16);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: rgb(198, 149, 35);
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <h2>Tambah Data Jurusan</h2>

        <input type="text" name="namajurusan" id="namajurusan" placeholder="Nama Jurusan" required><br><br>

        <input type="submit" name="simpan" value="Tambah Jurusan">

    </form>
</body>

</html>