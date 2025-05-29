<?php
include "koneksi.php";
$db = new database();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            text-align: left;
        }

        tr:nth-child(odd) {
            background-color: rgb(228, 240, 250);
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }



        td[data-type="number"],
        th[data-type="number"] {
            text-align: center;
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
    <h2>Data Siswa</h2>
    <table>
        <tr>
            <th data-type="number">No</th>
            <th data-type="number">NISN</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>Agama</th>
            <th data-type="number">No HP</th>
            <th>Option</th>
        </tr>
        <?php
        $no = 1;
        foreach ($db->tampil_data_siswa() as $x) {
            ?>
            <tr>
                <td data-type="number"><?php echo $no++; ?></td>
                <td data-type="number"><?php echo $x['nisn']; ?></td>
                <td><?php echo $x['nama']; ?></td>
                <td><?php echo $x['jeniskelamin']; ?></td>
                <td><?php echo $x['namajurusan']; ?></td>
                <td><?php echo $x['kelas']; ?></td>
                <td><?php echo $x['alamat']; ?></td>
                <td><?php echo $x['agama']; ?></td>
                <td data-type="number"><?php echo $x['nohp']; ?></td>
                <td>
                    <a href="edit_siswa.php?nisn=<?php echo $x['nisn']; ?>&aksi=edit" class="edit">Edit</a>
                    <a href="proses.php?nisn=<?php echo $x['nisn']; ?>&aksi=hapus" class="hapus">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="tambah_siswa.php" class="tambah-data">Tambah Data</a>
</body>

</html>