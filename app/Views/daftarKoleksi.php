<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Koleksi - Perpuskuy</title>
    <link href="<?= base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo.jpg" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/daftarBuku.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/partialsCSS/navbar.css">
</head>
<body>
    <?php echo view('partials/navbar'); ?>  

    <div class="table-responsive">
	<table class="table">
        <thead>
            <tr>
            	<th>Cover Buku</th>
                <th>Judul Buku</th>
                <th>Aksi</th>
                <!-- Tambahkan kolom lain sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($koleksi as $item): ?>
                <tr>
                	<td><img width="40" src="<?= base_url('/uploads/' . $item['CoverBuku']); ?>" alt="Cover Buku"></td>
                    <td><?= $item['Judul'] ?></td>
                    <th><a href="<?= base_url() ?><?= base_url('hapus_koleksi_buku/' . $item['BukuID'])?>">hapus</a></th>
                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
	<script src="<?= base_url() ?>bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>