<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin - Petugas</title>
 <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/admin/tambahPetugas.css">
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
  	.edit-buku {
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
    <?php echo view('partials/admin/navbarAdmin'); ?>
    <!-- partial -->

    <!-- Tambah petugas -->
	<div class="content-wrapper" id="tambah-petugas">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8 grid-margin stretch-card tambah">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center mb-2">
								<h4>Tambah Petugas</h4>
							</div>
							<form method="post" action="<?= site_url('admin/tambahPetugas') ?>" enctype="multipart/form-data">
								<div class="mb-3">
									<label for="NamaPetugas" class="form-label">Nama Petugas</label>
									<input type="text" class="form-control" id="NamaPetugas" name="NamaPetugas">
								</div>
								<div class="mb-3">
									<label for="UsernamePetugas" class="form-label">Username Petugas</label>
									<input type="text" class="form-control" name="UsernamePetugas" id="UsernamePetugas">
								</div>
								<div class="mb-3">
									<label for="PasswordPetugas" class="form-label">Password Petugas</label>
									<input type="text" class="form-control" name="PasswordPetugas" id="PasswordPetugas">
								</div>
								<div class="mb-3">
									 <label for="Level" class="form-label">Level:</label>
							    <select name="Level" required>
							        <option value="petugas">Petugas</option>
							        <option value="admin">Admin</option>
							    </select>
							  </div>
							  <div class="mb-3">
									<label for="Email">Email Petugas</label>
									<input type="text" class="form-control" name="Email" id="Email">
								</div>
								<button type="submit" class="btn btn-primary">Tambah</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2"></div>
			</div>
	</div>
	<!-- Akhir Tambah Buku -->

	<!-- Edit Petugas -->
	<?php foreach ($petugas as $item) : ?>
	<div class="content-wrapper edit-buku" id="editForm<?= $item['PetugasID']; ?>" style="display: none;">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center mb-2">
								<h4>Edit Petugas</h4>
							</div>
							<form method="post" action="<?= site_url('admin/editPetugas/' . $item['PetugasID']); ?>">
								<div class="mb-3">
									<label for="NamaPetugas" class="form-label">Nama Petugas</label>
									<input type="text" class="form-control" id="NamaPetugas" name="NamaPetugas" value="<?= $item['NamaPetugas']; ?>">
								</div>
								<div class="mb-3">
									<label for="UsernamePetugas" class="form-label">Username Petugas</label>
									<input type="text" class="form-control" name="UsernamePetugas" id="UsernamePetugas"  value="<?= $item['UsernamePetugas']; ?>">
								</div>
								<div class="mb-3">
									<label for="PasswordPetugas" class="form-label">Password Petugas</label>
									<input type="text" class="form-control" name="PasswordPetugas" id="PasswordPetugas"  value="<?= $item['PasswordPetugas']; ?>">
								</div>
								<div class="mb-3">
									<label for="Email" class="form-label">Level</label>
									<select name="Level" required>
							        <option value="petugas">Petugas</option>
							        <option value="admin">Admin</option>
							    </select>
								</div>
								<div class="mb-3">
									<label for="Email" class="form-label">Email</label>
									<input type="text" class="form-control" name="Email" id="Email"  value="<?= $item['Email']; ?>">
								</div>
								<button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="hideEditForm(<?= $item['PetugasID']; ?>)">Batal</button>
            </form>
						</div>
					</div>
				</div>
				<div class="col-lg-2"></div>
			</div>
	</div>
	<?php endforeach; ?>
	<!-- Akhir Edit Petugas -->

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
	                            <h4 class="card-title">Petugas List Table</h4>
	                            <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white"><i class="mdi mdi-plus"></i></button>
	                        </div>
	                        <div class="table-responsive">
	                            <table class="table">
	                                <thead>
	                                    <tr>
	                                        <th>Id</th>
	                                        <th>Nama Petugas</th>
	                                        <th>Username Petugas</th>
	                                        <th>Password Petugas</th>
	                                        <th>Level</th>
	                                        <th>Email Petugas</th>
	                                        <th>Edit</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                	<?php foreach ($petugas as $item) : ?>
	                                    <tr>
	                                        <td><?= $item['PetugasID']; ?></td>
											                    <td><?= $item['NamaPetugas']; ?></td>
											                    <td><?= $item['UsernamePetugas']; ?></td>
											                    <td><?= $item['PasswordPetugas']; ?></td>
											                    <td><?= $item['Level']; ?></td>
											                    <td><?= $item['Email']; ?></td>
	                                        <td>
	                                            <button onclick="showEditForm(<?= $item['PetugasID']; ?>)" class="badge badge-danger">Edit</button>
	                                            <button onclick="hapusPetugas(<?= $item['PetugasID'] ?>)" class="badge badge-danger">Hapus</button>
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
	    <?php echo view('partials/admin/footerAdmin'); ?>
	    <!-- partial -->
	</div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- Tambah Data -->
  <script type="text/javascript" src="<?= base_url() ?>js/tambahPetugas.js"></script>

  <!-- Edit Data -->
  <script type="text/javascript">
  	function showEditForm(PetugasID) {
        // Sembunyikan semua formulir edit
        hideAllEditForms();
        // Tampilkan formulir edit yang sesuai dengan PetugasID
        document.getElementById('editForm' + PetugasID).style.display = 'table-row';
		}

		function hideEditForm(PetugasID) {
		        // Sembunyikan formulir edit yang sesuai dengan PetugasID
		        document.getElementById('editForm' + PetugasID).style.display = 'none';
		}

		function hideAllEditForms() {
		        // Sembunyikan semua formulir edit
		        <?php foreach ($petugas as $item) : ?>
		            document.getElementById('editForm<?= $item['PetugasID']; ?>').style.display = 'none';
		        <?php endforeach; ?>
		}
  </script>

  <!-- Hapus Data -->
  <script type="text/javascript">
  	function hapusPetugas(PetugasID) {
        if (confirm('Apakah Anda yakin ingin menghapus akun petugas ini?')) {
            window.location.href = `<?= site_url('admin/hapusPetugas/') ?>${PetugasID}`;
        }
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