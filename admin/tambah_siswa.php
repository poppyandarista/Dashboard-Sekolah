<?php
include("koneksi.php");
$db = new database();

if (isset($_POST['simpan'])) {
    $db->tambah_siswa(
        $_POST['nisn'],
        $_POST['nama'],
        $_POST['jeniskelamin'],
        $_POST['kodejurusan'],
        $_POST['kelas'],
        $_POST['alamat'],
        $_POST['agama'],
        $_POST['nohp']
    );
    header("Location:datasiswa.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
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
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: 500;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fafafa;
            transition: 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #4CAF50;
            background-color: #fff;
        }

        input[type="radio"] {
            margin-right: 8px;
        }

        .radio-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: rgb(64, 162, 232);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            ;
        }

        input[type="submit"]:hover {
            background-color: rgb(69, 113, 160);
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <h2>Tambah Data Siswa</h2>

        <label for="nisn">NISN</label>
        <input type="text" name="nisn" id="nisn" required>

        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required>

        <label>Jenis Kelamin</label>
        <div class="radio-group">
            <label><input type="radio" name="jeniskelamin" value="L" required> Laki-laki</label>
            <label><input type="radio" name="jeniskelamin" value="P" required> Perempuan</label>
        </div>

        <label for="kodejurusan">Jurusan</label>
        <input type="text" name="kodejurusan" id="kodejurusan" required>

        <label for="kelas">Kelas</label>
        <input type="text" name="kelas" id="kelas" required>

        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" rows="3" required></textarea>

        <label for="agama">Agama</label>
        <input type="text" name="agama" id="agama" required>

        <label for="nohp">No HP</label>
        <input type="text" name="nohp" id="nohp" required>

        <input type="submit" name="simpan" value="Tambah Siswa">
    </form>
</body>

</html>