<?php
include "koneksi.php";
$db = new database();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jurusan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 60%;
            border-collapse: collapse;
            margin: 20px auto;
            font-size: 16px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: rgb(226, 139, 8);
            color: white;
            font-weight: bold;
        }

        th[data-type="number"],
        td[data-type="number"] {
            width: 80px;
        }

        th:last-child,
        td:last-child {
            width: 120px;
        }

        tr:nth-child(odd) {
            background-color: rgb(250, 239, 228);
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }

        a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }

        a:hover {
            opacity: 0.8;
        }

        .edit {
            background-color: #2ecc71;
        }

        .hapus {
            background-color: #e74c3c;
        }

        .tambah-data {
            display: block;
            width: 150px;
            margin: 20px auto;
            text-align: center;
            background: #3498db;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h2>Data Jurusan</h2>
    <table>
        <tr>
            <th data-type="number">Kode Jurusan</th>
            <th>Nama Jurusan</th>
            <th>Option</th>
        </tr>
        <?php
        $no = 1;
        foreach ($db->tampil_data_jurusan() as $x) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $x['namajurusan']; ?></td>
                <td>
                    <a href="edit_jurusan.php?nisn=<?php echo $x['kodejurusan']; ?>&aksi=edit" class="edit">Edit</a>
                    <a href="proses.php?nisn=<?php echo $x['kodejurusan']; ?>&aksi=hapus" class="hapus">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="tambah_jurusan.php" class="tambah-data">Tambah Data</a>
</body>

</html>