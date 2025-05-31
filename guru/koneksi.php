<?php
class database
{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $db = "sekolah";
    var $koneksi;

    function __construct()
    {
        $this->koneksi = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->db
        );
    }

    function tampil_data_siswa()
    {
        $query = "SELECT s.idsiswa, s.nisn, s.nama, s.jeniskelamin, 
                         j.namajurusan, s.kelas, s.alamat, 
                         a.namaagama, s.nohp 
                  FROM siswa s
                  JOIN jurusan j ON s.kodejurusan = j.kodejurusan
                  JOIN agama a ON s.agama = a.idagama";

        $data = mysqli_query($this->koneksi, $query);
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $row['jeniskelamin'] = ($row['jeniskelamin'] == 'L') ? 'Laki-laki' : 'Perempuan';
            $row['jurusan'] = !empty($row['namajurusan']) ? $row['namajurusan'] : 'Tidak ada';
            $row['agama'] = !empty($row['namaagama']) ? $row['namaagama'] : 'Tidak ada';
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tampil_data_jurusan()
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM jurusan");
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tampil_data_agama()
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM agama");
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tambah_siswa(
        $nisn,
        $nama,
        $jeniskelamin,
        $kodejurusan,
        $kelas,
        $alamat,
        $agama,
        $nohp
    ) {
        mysqli_query(
            $this->koneksi,
            "insert into siswa (nisn,nama,jeniskelamin,
        kodejurusan,kelas,alamat,agama,nohp) values(
            '$nisn', '$nama', '$jeniskelamin','$kodejurusan',
            '$kelas', '$alamat', '$agama', '$nohp')"
        );
    }
    function tambah_jurusan(
        $kodejurusan,
        $namajurusan
    ) {
        mysqli_query(
            $this->koneksi,
            "insert into jurusan (namajurusan) values(
            '$namajurusan')"
        );
    }
    function tambah_agama(
        $idagama,
        $namaagama
    ) {
        mysqli_query(
            $this->koneksi,
            "insert into agama (namaagama) values(
            '$namaagama')"
        );
    }
    public function jumlah_siswa()
    {
        $data = mysqli_query($this->koneksi, "SELECT COUNT(*) as total FROM siswa");
        $row = mysqli_fetch_assoc($data);
        return $row['total'];
    }

    public function jumlah_user()
    {
        $data = mysqli_query($this->koneksi, "SELECT COUNT(*) as total FROM user");
        $row = mysqli_fetch_assoc($data);
        return $row['total'];
    }

    public function jumlah_jurusan()
    {
        $data = mysqli_query($this->koneksi, "SELECT COUNT(*) as total FROM jurusan");
        $row = mysqli_fetch_assoc($data);
        return $row['total'];
    }

    public function jumlah_agama()
    {
        $data = mysqli_query($this->koneksi, "SELECT COUNT(*) as total FROM agama");
        $row = mysqli_fetch_assoc($data);
        return $row['total'];
    }

    // Fungsi Login
    public function login_user($username, $password)
    {
        $result = mysqli_query($this->koneksi, "SELECT * FROM user WHERE username = '$username'");
        if ($row = mysqli_fetch_assoc($result)) {
            if ($password === $row['password']) { // Simple comparison since passwords are not hashed in your DB
                return $row; // Return user data if login successful
            }
        }
        return false; // Return false if login failed
    }

    function hapus_siswa($nisn)
    {
        $query = "DELETE FROM siswa WHERE nisn='$nisn'";
        return mysqli_query($this->koneksi, $query);
    }

    function tampil_data_siswa_by_nisn($nisn)
    {
        $query = "SELECT s.*, j.namajurusan, a.namaagama 
              FROM siswa s
              LEFT JOIN jurusan j ON s.kodejurusan = j.kodejurusan
              LEFT JOIN agama a ON s.agama = a.idagama
              WHERE s.nisn = '$nisn'";

        $data = mysqli_query($this->koneksi, $query);
        if ($data && mysqli_num_rows($data) > 0) {
            return mysqli_fetch_assoc($data);
        }
        return false;
    }
    function tampil_data_jurusan_by_kode($kodejurusan)
    {
        $query = "SELECT * FROM jurusan WHERE kodejurusan = '$kodejurusan'";
        $data = mysqli_query($this->koneksi, $query);
        if ($data && mysqli_num_rows($data) > 0) {
            return mysqli_fetch_assoc($data);
        }
        return false;
    }
    function tampil_data_agama_by_id($idagama)
    {
        $query = "SELECT * FROM agama WHERE idagama = '$idagama'";
        $data = mysqli_query($this->koneksi, $query);
        if ($data && mysqli_num_rows($data) > 0) {
            return mysqli_fetch_assoc($data);
        }
        return false;
    }

    // Di file koneksi.php atau file lain yang sesuai
    public function get_jumlah_siswa_per_jurusan()
    {
        $query = "SELECT 
                j.namajurusan,
                SUM(CASE WHEN s.kelas = 'X' THEN 1 ELSE 0 END) as kelas_x,
                SUM(CASE WHEN s.kelas = 'XI' THEN 1 ELSE 0 END) as kelas_xi,
                SUM(CASE WHEN s.kelas = 'XII' THEN 1 ELSE 0 END) as kelas_xii
              FROM siswa s
              JOIN jurusan j ON s.kodejurusan = j.kodejurusan
              GROUP BY j.namajurusan";
        $result = $this->koneksi->query($query);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    function tampil_data_user()
    {
        $query = "SELECT * FROM user";
        $data = mysqli_query($this->koneksi, $query);
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function update_profile($user_id, $data)
    {
        // Validasi user_id
        if (empty($user_id) || !is_numeric($user_id)) {
            throw new Exception("User ID tidak valid");
        }

        if (empty($data)) {
            throw new Exception("Data update kosong");
        }

        $query = "UPDATE user SET ";
        $updates = [];

        if (!empty($data['nama'])) {
            $nama = $this->koneksi->real_escape_string($data['nama']);
            $updates[] = "nama = '$nama'";
        }

        if (!empty($data['profile_picture'])) {
            $profile_picture = $this->koneksi->real_escape_string($data['profile_picture']);
            $updates[] = "profile_picture = '$profile_picture'";
        }

        if (empty($updates)) {
            throw new Exception("Tidak ada data yang diupdate");
        }

        $query .= implode(', ', $updates) . " WHERE id = " . (int) $user_id;

        $result = $this->koneksi->query($query);
        if (!$result) {
            throw new Exception("Error updating profile: " . $this->koneksi->error);
        }

        return $result;
    }

    function tambah_user($username, $password, $nama, $role, $kodejurusan = null)
    {
        $query = "INSERT INTO user (username, password, nama, role, kodejurusan) 
              VALUES ('$username', '$password', '$nama', '$role', " .
            ($kodejurusan !== null ? "'$kodejurusan'" : "NULL") . ")";
        return mysqli_query($this->koneksi, $query);
    }

    function tampil_data_user_by_id($id)
    {
        $query = "SELECT u.*, j.namajurusan 
              FROM user u
              LEFT JOIN jurusan j ON u.kodejurusan = j.kodejurusan
              WHERE u.id = '$id'";
        $data = mysqli_query($this->koneksi, $query);
        if ($data && mysqli_num_rows($data) > 0) {
            return mysqli_fetch_assoc($data);
        }
        return false;
    }

}
?>