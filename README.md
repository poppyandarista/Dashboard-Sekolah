# 🎓 Dashboard Sekolah

Aplikasi ini merupakan sistem manajemen data sekolah berbasis web. Menggunakan **PHP + MySQL** dan template **AdminLTE** untuk tampilan dashboard. Aplikasi mendukung berbagai role pengguna: **Admin**, **Guru**, dan **Siswa**.

---

## 🏠 Dashboard Utama

Menampilkan tampilan utama sesuai dengan role login.

### 📘 Dashboard Siswa
Menampilkan informasi siswa, jurusan dan agama dengan statistik, namun hanya dapat melihat(read-only) informasi detail data siswa.

![Dashboard Siswa](images/dashboard-siswa.png)

### 🧑‍🏫 Dashboard Guru
Menampilkan informasi siswa, jurusan, dan agama dengan statistik, dapat melihat semua data namun hanya read-only.

![Dashboard Guru](images/dashboard-guru.png)

### 🛠️ Dashboard Admin
Menampilkan informasi siswa, jurusan, agama dan user dengan statistik, dapat mengakses semua data termasuk data user, dapat melakukan CRUD (Create, Read, Update, dan Delete).

![Dashboard Admin](images/dashboard-admin.png)

---

## 🗂️ Halaman Data

### 👥 Data Siswa
Menampilkan seluruh data siswa yang terdaftar.

![Data Siswa](images/datasiswa.png)

### 🏫 Data Jurusan
Mengelola jurusan yang tersedia di sekolah.

![Data Jurusan](images/datajurusan.png)

### 🙏 Data Agama
Daftar agama yang digunakan dalam data siswa.

![Data Agama](images/dataagama.png)

### 🔐 Data User
Daftar semua user yang bisa login ke sistem (admin, guru, siswa).

![Data User](images/datauser.png)

---
---

## 🔧 Hak Akses Role

> **Role Admin** memiliki akses penuh untuk input, edit, dan hapus data.  
> **Role Guru dan Siswa** hanya memiliki akses **melihat data** (read-only) untuk halaman berikut:

- Data Siswa
- Data Jurusan
- Data Agama
- Data User

---

## ➕ Tambah Data

Berikut tampilan form untuk menambahkan data (khusus untuk role **Admin**):

### ➕ Tambah Siswa

![Tambah Siswa](images/tambahsiswa.png)

### ➕ Tambah Jurusan

![Tambah Jurusan](images/tambahjurusan.png)

### ➕ Tambah Agama

![Tambah Agama](images/tambahaagama.png)

### ➕ Tambah User

![Tambah User](images/tambahuser.png)

---

## ✏️ Edit Data

Role Admin dapat mengedit seluruh data berikut:

### ✏️ Edit Siswa
![Edit Siswa](images/editsiswa.png)

### ✏️ Edit Jurusan
![Edit Jurusan](images/editjurusan.png)

### ✏️ Edit Agama
![Edit Agama](images/editagama.png)

### ✏️ Edit User
![Edit User](images/edituser.png)

---

## 🗑️ Hapus Data

Role Admin juga dapat menghapus data jika diperlukan:

### ❌ Hapus Siswa
![Hapus Siswa](images/hapus-siswa.png)

### ❌ Hapus Jurusan
![Hapus Jurusan](images/hapus-jurusan.png)

### ❌ Hapus Agama
![Hapus Agama](images/hapusagama.png)

### ❌ Hapus User
![Hapus User](images/hapususer.png)

---

## 🔐 Halaman Login & Logout

### 🔑 Login Page

![Login Page](images/login-page.png)

### 🚪 Validasi Logout

![Validasi Logout](images/validasi-logout.png)

---

## 👤 Profil Pengguna

Menampilkan informasi akun pengguna yang sedang login.

![Profil Page](images/profil-page.png)

---

## 🧩 Rancangan Database

Berikut adalah struktur database yang digunakan dalam aplikasi ini.

---

### 📄 Database `sekolah`

![Database Sekolah](images/tabelsekolah.png)

---

### 📄 Tabel `agama`

![Tabel Agama](images/tabelagama.png)

---

### 📄 Tabel `jurusan`

![Tabel Jurusan](images/tabeljurusan.png)

---

### 📄 Tabel `siswa`

![Tabel Siswa](images/tabelsiswa.png)

---

### 📄 Tabel `user`

![Tabel User](images/tabeluser.png)
