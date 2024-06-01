<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin - Peminjaman</title>
 <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo.jpg" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php echo view('partials/admin/navbarAdmin'); ?>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
  <div id="settings-trigger"><i class="ti-settings"></i></div>
  <div id="theme-settings" class="settings-panel">
    <i class="settings-close ti-close"></i>
    <p class="settings-heading">SIDEBAR SKINS</p>
    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
      <div class="img-ss rounded-circle bg-light border me-3"></div>Light
    </div>
    <div class="sidebar-bg-options" id="sidebar-dark-theme">
      <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
    </div>
    <p class="settings-heading mt-2">HEADER SKINS</p>
    <div class="color-tiles mx-0 px-4">
      <div class="tiles success"></div>
      <div class="tiles warning"></div>
      <div class="tiles danger"></div>
      <div class="tiles info"></div>
      <div class="tiles dark"></div>
      <div class="tiles default"></div>
    </div>
  </div>
</div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
	<?php echo view('partials/admin/sidebarAdmin'); ?>
      <!-- partial -->
	   <div class="main-panel">
	    <div class="content-wrapper">
	        <div class="row">
	            <div class="col-lg-12 grid-margin stretch-card">
	                <div class="card">
	                    <div class="card-body">
	                        <div class="d-flex justify-content-between align-items-center">
	                            <h4 class="card-title">borrowing Books List Table</h4>
	                        </div>
	                        <div class="table-responsive">
	                            <table class="table">
	                                <thead>
	                                    <tr>
	                                        <th>Peminjaman ID</th>
	                                        <th>User ID</th>
	                                        <th>Cover Buku</th>
	                                        <th>Judul</th>
	                                        <th>Tanggal Peminjaman</th>
	                                        <th>Tanggal Pengembalian</th>
	                                        <th>Status</th>
	                                        <th>Total Buku</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	<?php foreach ($peminjaman as $item): ?>
	                                    <tr>
	                                    		<td><?= $item['PeminjamanID'] ?></td>
	                                    		<td><?= $item['UserID'] ?></td>
	                                    		<td><img width="40" src="<?= base_url('/uploads/' . $item['CoverBuku']); ?>" alt="Cover Buku"></td>
											                    <td><?= $item['Judul'] ?></td>
											                    <td><?= $item['TanggalPeminjaman']; ?></td>
											                    <td><?= $item['TanggalPengembalian']; ?></td>
											                    <td><?= $item['StatusPeminjaman']; ?></td>
											                    <td><?= $item['TotalBuku']; ?></td>
	                                    </tr>
	                                    <?php endforeach; ?>
	                                </tbody>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- content-wrapper ends -->
	    <!-- partial:../../partials/_footer.html -->
	    <?php echo view('partials/admin/footerAdmin'); ?>
	    <!-- partial -->
	</div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  
 <!-- plugins:js -->
  <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= base_url() ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?= base_url() ?>assets/vendors/chart.js/Chart.min.js"></script>
  <script src="<?= base_url() ?>assets/vendors/progressbar.js/progressbar.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
  <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?= base_url() ?>assets/js/template.js"></script>
  <script src="<?= base_url() ?>assets/js/settings.js"></script>
  <script src="<?= base_url() ?>assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?= base_url() ?>assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/js/dashboard.js"></script>
  <script src="<?= base_url() ?>assets/js/proBanner.js"></script>
  <!-- <script src="../<?= base_url() ?><?= base_url() ?>assets/js/Chart.roundedBarCharts.js"></script> -->
  <script src="<?= base_url() ?>assets/js/time.js" type="text/javascript" ></script>
  <!-- End custom js for this page-->
</body>

</html>