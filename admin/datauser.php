<?php
session_start();

// Mencegah caching halaman yang terlindungi
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit;
}
?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sekolah | Data User</title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="AdminLTE 4 | Data User" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="description"
    content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
  <!--end::Primary Meta Tags-->
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
  <!--end::Fonts-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->
  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="dist/css/adminlte.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--end::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
          <li class="nav-item d-none d-md-block"><a href="index.php" class="nav-link">Home</a></li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
          <!--begin::Navbar Search-->

          <!--end::Navbar Search-->
          <!--begin::Messages Dropdown Menu-->
          <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#">
              <i class="bi bi-chat-text"></i>
              <span class="navbar-badge badge text-bg-danger">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <a href="#" class="dropdown-item">
                <!--begin::Message-->
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <img src="dist/assets/img/user1-128x128.jpg" alt="User Avatar"
                      class="img-size-50 rounded-circle me-3" />
                  </div>
                  <div class="flex-grow-1">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span>
                    </h3>
                    <p class="fs-7">Call me whenever you can...</p>
                    <p class="fs-7 text-secondary">
                      <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                    </p>
                  </div>
                </div>
                <!--end::Message-->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!--begin::Message-->
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <img src="dist/assets/img/user8-128x128.jpg" alt="User Avatar"
                      class="img-size-50 rounded-circle me-3" />
                  </div>
                  <div class="flex-grow-1">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-end fs-7 text-secondary">
                        <i class="bi bi-star-fill"></i>
                      </span>
                    </h3>
                    <p class="fs-7">I got your message bro</p>
                    <p class="fs-7 text-secondary">
                      <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                    </p>
                  </div>
                </div>
                <!--end::Message-->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!--begin::Message-->
                <div class="d-flex">
                  <div class="flex-shrink-0">
                    <img src="dist/assets/img/user3-128x128.jpg" alt="User Avatar"
                      class="img-size-50 rounded-circle me-3" />
                  </div>
                  <div class="flex-grow-1">
                    <h3 class="dropdown-item-title">
                      Nora Silvester
                      <span class="float-end fs-7 text-warning">
                        <i class="bi bi-star-fill"></i>
                      </span>
                    </h3>
                    <p class="fs-7">The subject goes here</p>
                    <p class="fs-7 text-secondary">
                      <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                    </p>
                  </div>
                </div>
                <!--end::Message-->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>
          <!--end::Messages Dropdown Menu-->
          <!--begin::Notifications Dropdown Menu-->
          <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#">
              <i class="bi bi-bell-fill"></i>
              <span class="navbar-badge badge text-bg-warning">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <span class="dropdown-item dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="bi bi-envelope me-2"></i> 4 new messages
                <span class="float-end text-secondary fs-7">3 mins</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="bi bi-people-fill me-2"></i> 8 friend requests
                <span class="float-end text-secondary fs-7">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                <span class="float-end text-secondary fs-7">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
            </div>
          </li>
          <!--end::Notifications Dropdown Menu-->
          <!--begin::Fullscreen Toggle-->
          <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
            </a>
          </li>
          <!--end::Fullscreen Toggle-->
          <!--begin::User Menu Dropdown-->

          <?php include 'user_menu.php'; ?>
          <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
      </div>
      <!--end::Container-->
    </nav>
    <!--end::Header-->
    <?php include "sidebar.php"; ?>
    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">Data User</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data User</li>
              </ol>
            </div>
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content Header-->
      <!--begin::App Content-->
      <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <!-- /.col -->
            <div class="col-md-12">

              <!-- /.card -->
              <div class="card mb-4">

                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table id="dataUser" class="table table-bordered table-striped table-hover">

                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Role</th>
                        <th>Jurusan</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include "koneksi.php";
                      $db = new database();
                      $no = 1;
                      // Query untuk mengambil data user dengan join ke tabel jurusan dan agama
                      $query = "SELECT u.*, j.namajurusan
                                FROM user u
                                LEFT JOIN jurusan j ON u.kodejurusan = j.kodejurusan";
                      $data = mysqli_query($db->koneksi, $query);
                      while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $row['username']; ?></td>
                          <td><?php echo $row['nama']; ?></td>
                          <td><?php echo ucfirst($row['role']); ?></td>
                          <td><?php echo !empty($row['namajurusan']) ? $row['namajurusan'] : '-'; ?></td>
                          <td>
                            <button onclick="showEditForm('<?php echo $row['id']; ?>')"
                              class="btn btn-success btn-sm">Edit</button>
                            <a href="#"
                              onclick="confirmDeleteUser('<?php echo $row['id']; ?>', '<?php echo $row['username']; ?>')"
                              class="btn btn-danger btn-sm">Hapus</a>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <a href="formuser.php" class="btn btn-primary">Tambah Data</a>
            </div>
            <!-- /.col -->
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content-->
    </main>
    <!--end::App Main-->
    <!--begin::Footer-->
    <footer class="app-footer">
      <!--begin::To the end-->
      <div class="float-end d-none d-sm-inline">Anything you want</div>
      <!--end::To the end-->
      <!--begin::Copyright-->
      <strong>
        Copyright &copy; 2014-2024&nbsp;
        <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
      </strong>
      All rights reserved.
      <!--end::Copyright-->
    </footer>
    <!--end::Footer-->
  </div>
  <!--end::App Wrapper-->
  <!--begin::Script-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="dist/js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });

    $(document).ready(function () {
      $('#dataUser').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "ajax": {
          "url": "get_users_data.php", // Buat file ini untuk mengambil data user
          "dataSrc": ""
        },
        "columns": [
          { "data": "no" },
          { "data": "username" },
          { "data": "nama" },
          { "data": "role" },
          { "data": "jurusan" },
          { "data": "opsi" }
        ]
      });
    });

    // Fungsi untuk konfirmasi hapus
    function confirmDeleteUser(id, username) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Anda akan menghapus data user ${username} (ID: ${id})`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `proses_user.php?id=${id}&aksi=hapus`;
        }
      });
    }

    // Function to show edit form in modal
    // Function to show edit form in modal
    function showEditForm(id) {
      // Show loading state
      $('#editModalBody').html(`
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `);

      // Show modal
      var editModal = new bootstrap.Modal(document.getElementById('editModal'));
      editModal.show();

      // Load form via AJAX
      $.ajax({
        url: 'get_edit_form_user.php?id=' + id,
        type: 'GET',
        success: function (response) {
          $('#editModalBody').html(response);
        },
        error: function () {
          $('#editModalBody').html(`
                <div class="alert alert-danger">
                    Gagal memuat formulir edit. Silakan coba lagi.
                </div>
            `);
        }
      });
    }

    // Function to save edited data
    function saveEdit() {
      // Get form data
      var formData = $('#editForm').serialize();

      // Show loading state
      $('#editModalBody').html(`
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Menyimpan perubahan...</p>
        </div>
    `);

      // Submit form via AJAX
      $.ajax({
        url: 'proses_edit_user.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            $('#editModalBody').html(`
                    <div class="alert alert-success">
                        ${response.message}
                    </div>
                `);

            setTimeout(function () {
              $('#editModal').modal('hide');

              // Perbarui navbar dan user menu
              updateUserName(response.new_name);

              // Perbarui tabel DataTable
              updateDataTableRow(response.id, response.new_name);

              if (response.password_changed) {
                window.location.href = 'logout.php';
              }
            }, 1500);
          } else {
            $('#editModalBody').html(`
                    <div class="alert alert-danger">
                        ${response.message}
                        <button onclick="showEditForm('${$('#editForm input[name="id"]').val()}')" 
                            class="btn btn-warning mt-2">
                            Coba Lagi
                        </button>
                    </div>
                `);
          }
        },
        error: function (xhr, status, error) {
          let errorMsg = 'Terjadi kesalahan sistem';
          try {
            const response = JSON.parse(xhr.responseText);
            errorMsg = response.message || errorMsg;
          } catch (e) {
            errorMsg = 'Terjadi kesalahan: ' + error;
          }

          $('#editModalBody').html(`
                <div class="alert alert-danger">
                    ${errorMsg}
                    <button onclick="showEditForm('${$('#editForm input[name="id"]').val()}')" 
                        class="btn btn-warning mt-2">
                        Coba Lagi
                    </button>
                </div>
            `);
        }
      });
    }

    // Fungsi untuk memperbarui baris di DataTable
    function updateDataTableRow(userId, newName) {
      var table = $('#dataUser').DataTable();
      var rowIndex = -1;

      // Cari baris yang sesuai dengan ID user
      table.rows().every(function (index) {
        var rowData = this.data();
        if (rowData[1] === userId) { // Asumsikan kolom username ada di index 1
          rowIndex = index;
          return false; // Keluar dari loop
        }
      });

      // Jika baris ditemukan, perbarui
      if (rowIndex >= 0) {
        var row = table.row(rowIndex);
        var rowData = row.data();
        rowData[2] = newName; // Asumsikan kolom nama ada di index 2
        row.data(rowData).draw();
      } else {
        // Jika tidak ditemukan, reload tabel (fallback)
        table.ajax.reload(null, false);
      }
    }

    // Tambahkan fungsi baru untuk update nama
    function updateUserName(newName) {
      // Update di navbar
      $('.user-menu .d-none.d-md-inline').text(newName);
      $('.user-header p').html(`${newName} - ${$('.user-header p').text().split('-')[1]}`);

      // Update di session client-side (jika diperlukan)
      if (typeof (Storage) !== 'undefined') {
        sessionStorage.setItem('userName', newName);
      }
    }

    // ... (kode JavaScript lainnya yang sudah ada)

    // Fungsi untuk konfirmasi logout
    function confirmLogout(username) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Anda akan sign out dari akun ${username}.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Sign Out!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Jika user menekan 'Ya, Sign Out!', arahkan ke logout.php
          window.location.href = 'logout.php';
        }
      });
    }
  </script>
  <!--end::OverlayScrollbars Configure-->
  <!--end::Script-->
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="editModalBody">
          <!-- Content will be loaded via AJAX -->
          <div class="text-center">
            <div class="spinner-border" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="button" class="btn btn-primary" onclick="saveEdit()">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>
</body>
<!--end::Body-->

</html>