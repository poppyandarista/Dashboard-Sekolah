<?php
session_start();

// Mencegah caching halaman yang terlindungi
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'guru') {
  header("Location: ../login.php");
  exit;
}
?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sekolah | Data Siswa</title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="AdminLTE 4 | Simple Tables" />
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
              <h3 class="mb-0">Data Siswa</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
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
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-header">
                  <h3 class="card-title">Daftar Siswa</h3>
                </div>
                <div class="card-body p-0 table-responsive">
                  <table id="dataSiswa" class="display nowrap" style="width:100%">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                        <th>Agama</th>
                        <th>No HP</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include "koneksi.php";
                      $db = new database();
                      $no = 1;
                      foreach ($db->tampil_data_siswa() as $x) {
                        ?>
                        <tr class="align-middle">
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $x['nisn']; ?></td>
                          <td><?php echo $x['nama']; ?></td>
                          <td><?php echo $x['jeniskelamin']; ?></td>
                          <td><?php echo $x['namajurusan']; ?></td>
                          <td><?php echo $x['kelas']; ?></td>
                          <td><?php echo $x['alamat']; ?></td>
                          <td><?php echo $x['agama']; ?></td>
                          <td><?php echo $x['nohp']; ?></td>

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
      $('#dataSiswa').DataTable({
        "responsive": true,
        "scrollX": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
        "pageLength": 10,
        "language": {
          "lengthMenu": "Tampilkan _MENU_ data per halaman",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
          "infoFiltered": "(disaring dari _MAX_ total data)",
          "search": "Cari:",
          "paginate": {
            "previous": "<i class='bi bi-chevron-left'></i>",
            "next": "<i class='bi bi-chevron-right'></i>"
          }
        },
        "dom": '<"top"lf>rt<"bottom"ip><"clear">'
      });
    });
  </script>

  <style>
    /* Add these styles to your existing CSS */
    .table-responsive {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    #dataSiswa {
      width: 100% !important;
    }

    /* Mobile-specific styles */
    @media (max-width: 768px) {
      body {
        font-size: 14px;
      }

      .table {
        font-size: 13px;
      }

      .card-body {
        padding: 0.5rem;
      }

      .dataTables_wrapper .dataTables_info,
      .dataTables_wrapper .dataTables_filter input {
        font-size: 13px;
      }

      .dataTables_wrapper .dataTables_length select {
        padding: 0.2rem 0.5rem;
      }
    }

    /* Ensure buttons remain usable on mobile */
    .btn {
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
      line-height: 1.5;
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

    /* Modal Styles */
    .modal-content {
      border-radius: 10px;
    }

    .modal-header {
      background-color: #f8f9fa;
      border-bottom: 1px solid #dee2e6;
      border-radius: 10px 10px 0 0;
    }

    .modal-footer {
      background-color: #f8f9fa;
      border-top: 1px solid #dee2e6;
      border-radius: 0 0 10px 10px;
    }

    /* Form Styles */
    .form-control,
    .form-select {
      border-radius: 5px;
      padding: 10px;
    }

    .form-label {
      font-weight: 600;
    }
  </style>
  <!--end::OverlayScrollbars Configure-->
  <!--end::Script-->
  <script>
    // Fungsi untuk konfirmasi hapus
    function confirmDelete(nisn, nama) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Anda akan menghapus data siswa ${nama} (NISN: ${nisn})`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `proses.php?nisn=${nisn}&aksi=hapus`;
        }
      });

      $(document).ready(function () {
        // Initialize DataTable
        var table = $('#dataSiswa').DataTable({
          "destroy": true,
          "paging": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "lengthMenu": [5, 10, 25, 50, 100]
        });

        // Check for delete success message
        <?php if (isset($_SESSION['delete_success'])): ?>
          Swal.fire({
            icon: 'success',
            title: 'Data Dihapus',
            text: 'Data siswa <?php echo $_SESSION['delete_success']['nama']; ?> (NISN: <?php echo $_SESSION['delete_success']['nisn']; ?>) telah berhasil dihapus.',
            confirmButtonText: 'OK'
          });
          <?php
          unset($_SESSION['delete_success']);
        endif;
        ?>

        // Check for delete error
        <?php if (isset($_SESSION['delete_error'])): ?>
          Swal.fire({
            icon: 'error',
            title: 'Gagal Menghapus',
            text: 'Terjadi kesalahan saat menghapus data.',
            confirmButtonText: 'OK'
          });
          <?php
          unset($_SESSION['delete_error']);
        endif;
        ?>
      });
    }

    // Function to show edit form in modal
    // Function to show edit form in modal
    function showEditForm(nisn) {
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
        url: 'get_edit_form.php?nisn=' + nisn,
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
        url: 'proses_edit.php',
        type: 'POST',
        data: formData,
        success: function (response) {
          if (response.success) {
            // Show success message
            $('#editModalBody').html(`
                    <div class="alert alert-success">
                        Data berhasil diperbarui!
                    </div>
                `);

            // Reload page after 1.5 seconds
            setTimeout(function () {
              location.reload();
            }, 1500);
          } else {
            // Show error message
            $('#editModalBody').html(`
                    <div class="alert alert-danger">
                        ${response.message || 'Gagal memperbarui data.'}
                    </div>
                `);
          }
        },
        error: function () {
          $('#editModalBody').html(`
                <div class="alert alert-danger">
                    Terjadi kesalahan saat menyimpan data.
                </div>
            `);
        }
      });
    }

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
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data Siswa</h5>
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