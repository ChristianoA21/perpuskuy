<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>petugas - Peminjaman</title>
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

  <style type="text/css">
    .pengembalian, 
    .pengembalian2 {
      display: none;
      background: transparent;
      position: absolute;
      top: 50%;
      left: 50%;
      width: 80%;
      height: 80%;
      transform: translate(-50%, -50%);
      z-index: 999;

    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php echo view('partials/petugas/navbarPetugas'); ?>
    <!-- partial -->

    <!-- form Pengembalian -->
    <?php foreach ($peminjaman as $item) : ?>
    <div class="content-wrapper pengembalian" id="pengembalian<?= $item['PeminjamanID']; ?>" style="display: none;">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h4>Pengembalian</h4>
              </div>
              <form method="post" action="<?= base_url('/petugas/printPengembalian/' . $item['PeminjamanID']) ?>">
                <div class="mb-3" style="display: none;">
                  <label for="Judul" class="form-label">Judul</label>
                  <input type="text" class="form-control" name="Judul" value="<?= $item['Judul'] ?>" readonly>
                </div>
                <div class="mb-3" style="display: none;">
                  <label for="email" class="form-label">email</label>
                  <input type="text" class="form-control" name="email" value="<?= $item['Email'] ?>" readonly>
                </div>
                <div class="mb-3" style="display: none;">
                  <label for="NamaLengkap" class="form-label">Nama Lengkap </label>
                  <input type="text" class="form-control" name="NamaLengkap" value="<?= $item['NamaLengkap'] ?>" readonly>
                </div>


                <div class="mb-3">
                  <label for="PeminjamanID" class="form-label">Peminjaman ID </label>
                  <input type="text" class="form-control" name="PeminjamanID" value="<?= $item['PeminjamanID'] ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="UserID" class="form-label">User ID </label>
                  <input type="text" class="form-control" name="UserID" value="<?= $item['UserID'] ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="uang_dibayarkan" class="form-label">Uang bayar denda: </label>
                  <input type="text" class="form-control" name="UangDibayarkan" required>
                </div>
                <div class="mb-3">
                  <label for="uang_dikembalikan" class="form-label">Kembalian: </label>
                  <input type="text" class="form-control" name="UangKembalian" required>
                </div>
                <button type="submit" class="btn btn-success">Pengembalian</button>
                <button type="button" class="btn btn-secondary" onclick="hideEditForm(<?= $item['PeminjamanID']; ?>)">Batal</button>
            </form>
            </div>
          </div>
        </div>
        <div class="col-lg-2"></div>
      </div>
  </div>
  <?php endforeach; ?>

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
	<?php echo view('partials/petugas/sidebarPetugas'); ?>
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
                                          <th>Aksi</th>
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
                                          <td>
                                             <?php if ($item['StatusPeminjaman'] == 'meminjam'): ?>
                                                <button class="btn btn-warning" onclick="showPengembalianForm(<?= $item['PeminjamanID']; ?>)">Mengembalikan</button>
                                            <?php elseif ($item['StatusPeminjaman'] == 'kembali'): ?>
                                                <a class="btn btn-success" href="<?= base_url('/petugas/viewStruk/' . $item['PeminjamanID']); ?>">Print</a>
                                            <?php endif; ?>
                                          </td>
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
	    <?php echo view('partials/petugas/footerPetugas'); ?>
	    <!-- partial -->
	</div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- Edit Data -->
  <script type="text/javascript">
    function showPengembalianForm(peminjamanID) {
        // Sembunyikan semua formulir edit
        hideAllEditForms();
        // Tampilkan formulir edit yang sesuai dengan peminjamanID
        document.getElementById('pengembalian' + peminjamanID).style.display = 'table-row';
    }

    function hideEditForm(peminjamanID) {
            // Sembunyikan formulir edit yang sesuai dengan peminjamanID
            document.getElementById('pengembalian' + peminjamanID).style.display = 'none';
    }

    function hideAllEditForms() {
            // Sembunyikan semua formulir edit
            <?php foreach ($peminjaman as $item) : ?>
                document.getElementById('pengembalian<?= $item['PeminjamanID']; ?>').style.display = 'none';
            <?php endforeach; ?>
    }
  </script>
  
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