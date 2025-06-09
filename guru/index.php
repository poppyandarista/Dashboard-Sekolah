<?php
// Gunakan di semua file yang membutuhkan session
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
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
  <title>Dashboard Sekolah</title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="AdminLTE v4 | Dashboard" />
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
  <!--end::Required Plugin(AdminLTE)-->
  <!-- apexcharts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
  <!-- jsvectormap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
              <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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

          <?php
          include "koneksi.php";
          $db = new database();

          $totalSiswa = $db->jumlah_siswa();
          $totalJurusan = $db->jumlah_jurusan();
          $totalAgama = $db->jumlah_agama();
          ?>
          <div class="row">
            <!--begin::Col-->

            <div class="col-lg-3 col-6">
              <div class="small-box text-bg-success">
                <div class="inner">
                  <h3><?= $db->jumlah_siswa(); ?></h3>
                  <p>Siswa</p>
                </div>
                <div class="small-box-icon">
                  <i class="fas fa-user-graduate fa-1x"></i>
                </div>
                <a href="datasiswa.php"
                  class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                  Lihat Selengkapnya<i class="bi bi-link-45deg"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box text-bg-warning">
                <div class="inner">
                  <h3><?= $db->jumlah_jurusan(); ?></h3>
                  <p>Jurusan</p>
                </div>
                <div class="small-box-icon">
                  <i class="fas fa-school fa-1x"></i>
                </div>
                <a href="datajurusan.php"
                  class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                  Lihat Selengkapnya<i class="bi bi-link-45deg"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box text-bg-danger">
                <div class="inner">
                  <h3><?= $db->jumlah_agama(); ?></h3>
                  <p>Agama</p>
                </div>
                <div class="small-box-icon">
                  <i class="fa-solid fa-book-quran"></i>
                </div>
                <a href="dataagama.php"
                  class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                  Lihat Selengkapnya<i class="bi bi-link-45deg"></i>
                </a>
              </div>
            </div>

            <!--end::Col-->
          </div>
          <!--end::Row-->
          <!--begin::Row-->
          <div class="row">
            <!-- Start col -->
            <div class="col-lg-7 connectedSortable">
              <div class="card mb-4">
                <div class="card-header">
                  <h3 class="card-title">Jumlah Siswa Per Jurusan</h3>
                </div>
                <div class="card-body">
                  <div id="revenue-chart"></div>
                </div>
              </div>
              <!-- /.card -->

            </div>
            <!-- /.Start col -->

          </div>
          <!-- /.row (main row) -->
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
  </script>
  <!--end::OverlayScrollbars Configure-->
  <!-- OPTIONAL SCRIPTS -->
  <!-- sortablejs -->
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
    integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
  <!-- sortablejs -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const connectedSortables = document.querySelectorAll('.connectedSortable');
      connectedSortables.forEach((connectedSortable) => {
        let sortable = new Sortable(connectedSortable, {
          group: 'shared',
          handle: '.card-header',
        });
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    });
  </script>
  <!-- apexcharts -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
  <!-- jsvectormap -->
  <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
    integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>

  <!-- Main Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
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
            window.location.href = 'logout.php';
          }
        });
      }

      // Mengambil data dari PHP
      const dataSiswa = <?php echo json_encode($db->get_jumlah_siswa_per_jurusan()); ?>;

      // Menyiapkan data untuk chart
      const jurusan = [];
      const kelasX = [];
      const kelasXI = [];
      const kelasXII = [];

      dataSiswa.forEach(item => {
        jurusan.push(item.namajurusan);
        kelasX.push(parseInt(item.kelas_x));
        kelasXI.push(parseInt(item.kelas_xi));
        kelasXII.push(parseInt(item.kelas_xii));
      });

      // Chart Siswa Per Jurusan
      if (document.querySelector('#revenue-chart')) {
        const siswa_chart_options = {
          series: [
            {
              name: 'Kelas X',
              data: kelasX,
            },
            {
              name: 'Kelas XI',
              data: kelasXI,
            },
            {
              name: 'Kelas XII',
              data: kelasXII,
            },
          ],
          chart: {
            height: 300,
            type: 'area',
            stacked: false,
            toolbar: {
              show: false,
            },
          },
          legend: {
            position: 'top',
          },
          colors: ['#0d6efd', '#20c997', '#fd7e14'],
          dataLabels: {
            enabled: false,
          },
          stroke: {
            curve: 'smooth',
          },
          xaxis: {
            categories: jurusan,
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return val + " siswa";
              }
            }
          },
        };

        const siswa_chart = new ApexCharts(
          document.querySelector('#revenue-chart'),
          siswa_chart_options
        );
        siswa_chart.render();
      }

      // Hapus kode yang tidak digunakan (sparkline dan world map)
    });
  </script>
  <!--end::Script-->
</body>
<!--end::Body-->

</html>