<!DOCTYPE html>  
<html lang="en">  

<head>  
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Petugas - Laporan</title>  
</head>  

<body>   
    <div class="judul" width="100%" style="margin-bottom: 20px; text-align:center">
        <h2>Laporan Petugas</h2>
        <hr>
    </div>
    <table border="1" width="100%" cellpadding="2" cellspacing="0" style="margin-top: 20px; text-align:center">
        <thead>
            <tr>
                <th>Users</th>
                <th>Books</th>
                <th>Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><h3 class="rate-percentage"><?= count($user); ?></h3></td>
                <td><h3 class="rate-percentage"><?= count($buku); ?></h3></td>
                <td><h3 class="rate-percentage"><?= count($peminjaman); ?></h3></td>
            </tr>
        </tbody>
    </table>

    <div class="table-responsive">
        <h4 class="card-title">Book Table</h4>
        <table class="table" border="1" width="100%" cellpadding="2" cellspacing="0" style="margin-top: 5px; text-align:center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Cover Buku</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Stok Buku</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buku as $item) : ?>
                    <tr>
                        <td><?= $item['BukuID']; ?></td>
                        <td><img src="<?= base64_encode(file_get_contents('uploads/' . $item['CoverBuku'])) ?>" alt="Cover Buku" width="50" type="image/jpg"></td>
                        <td><?= $item['Judul']; ?></td>
                        <td><?= $item['Penulis']; ?></td>
                        <td><?= $item['Penerbit']; ?></td>
                        <td><?= $item['TahunTerbit']; ?></td>
                        <td><?= $item['NamaKategori']; ?></td>
                        <td><?= $item['SubKategori']; ?></td>
                        <td><?= $item['stok']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <h4 class="card-title">Borrowing Table</h4>
        <table class="table" border="1" width="100%" cellpadding="2" cellspacing="0" style="margin-top: 5px; text-align:center">
            <thead>
                <tr>
                    <th>Peminjaman ID</th>
                    <th>User ID</th>
                    <th>Buku ID</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjaman</th>
                    <th>Total Buku</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peminjaman as $item) : ?>
                    <tr>
                        <td><?= $item['PeminjamanID']; ?></td>
                        <td><?= $item['UserID']; ?></td>
                        <td><?= $item['BukuID']; ?></td>
                        <td><?= $item['TanggalPeminjaman']; ?></td>
                        <td><?= $item['TanggalPengembalian']; ?></td>
                        <td><?= $item['StatusPeminjaman']; ?></td>
                        <td><?= $item['TotalBuku']; ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <h4 class="card-title">User Table</h4>
        <table class="table" border="1" width="100%" cellpadding="2" cellspacing="0" style="margin-top: 5px; text-align:center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $item) : ?>
                    <tr>
                        <td><?= $item['UserID']; ?></td>
                        <td><?= $item['Username']; ?></td>
                        <td><?= $item['Password']; ?></td>
                        <td><?= $item['Email']; ?></td>
                        <td><?= $item['NamaLengkap']; ?></td>
                        <td><?= $item['Alamat']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>  

</html>
