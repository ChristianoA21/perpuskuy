<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku - Perpuskuy</title>
    <link href="<?= base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo.jpg" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/daftarBuku.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/partialsCSS/navbar.css">
  </head>
  <body>
    <?php echo view('partials/alertPengembalianBuku'); ?> 
    
    <?php echo view('partials/navbar'); ?>  
  
  <div class="container-fluid bg-transparent my-4 p-3" style="position: relative;">

    <!-- Modal Pinjaman -->
    <?php foreach ($buku as $item) : ?>
    <div class="modal fade" id="staticBackdrop<?= $item['BukuID'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                          <div class="col">
                            <div class="informasi-buku">
                                <img class="card-img-top" src="<?= base_url('/uploads/' . $item['CoverBuku']); ?>" alt="Cover Buku">
                                <p>Judul: <?= $item['Judul']; ?></p>
                                <p>Penulis: <?= $item['Penulis']; ?></p>
                                <p>Penerbit: <?= $item['Penerbit']; ?> <?= $item['TahunTerbit']; ?></p>
                                <p>Kategori: <?= $item['NamaKategori']; ?></p>
                                <p>Sub kategori: <?= $item['SubKategori']; ?></p>
                            </div>
                          </div>
                          <div class="col">
                            <form method="post" action="<?= site_url('/tambahKoleksi') ?>" enctype="multipart/form-data">
                              <div class="mb-3">
                                <input type="hidden" class="form-control" id="BukuID" name="BukuID" value="<?= $item['BukuID'] ?>" readonly>
                              </div>
                              <div class="mb-3">
                                <input type="hidden" class="form-control" id="Judul" name="Judul" value="<?= $item['Judul'] ?>" readonly>
                              </div>
                                <button type="submit" class="btn btn-primary">tambah koleksi</button>
                            </form>
                            <form method="post" action="<?= site_url('/daftarBuku/tambahPeminjaman') ?>" enctype="multipart/form-data">
                              <h3 class="mb-3">Peminjaman Buku</h3>
                              <div class="mb-3">
                                <label for="UserID" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="UserID" aria-describedby="emailHelp" name="UserID" value="<?= $userID; ?>" readonly>
                              </div>
                              <div class="mb-3">
                                <label for="BukuID" class="form-label">Buku ID</label>
                                <input type="text" class="form-control" id="BukuID" name="BukuID" value="<?= $item['BukuID'] ?>" readonly>
                              </div>
                              <div class="mb-3">
                                <label for="TanggalPeminjaman" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="TanggalPeminjaman" name="TanggalPeminjaman">
                              </div>
                              <div class="mb-3">
                                <label for="TanggalPengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="TanggalPengembalian" name="TanggalPengembalian">
                              </div>
                              <div class="mb-3">
                                <label for="TotalBuku" class="form-label">Total Buku</label>
                                <input type="text" class="form-control" id="TotalBuku" name="TotalBuku">
                              </div>
                              <button type="submit" class="btn btn-primary">Pinjam</button>
                            </form>
                          </div>
                        </div>
                        <div class="ulasan">
                            <ul class="nav nav-tabs" id="myTabs<?= $item['BukuID'] ?>">
                                <li class="nav-item">
                                    <a class="nav-link active text-secondary" aria-current="page" href="<?= base_url() ?>#content1<?= $item['BukuID'] ?>" data-bs-toggle="tab" data-bs-target="#content1<?= $item['BukuID'] ?>">Ulasan & Rating</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="<?= base_url() ?>#content2<?= $item['BukuID'] ?>" data-bs-toggle="tab" data-bs-target="#content2<?= $item['BukuID'] ?>">Lihat Ulasan</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="content1<?= $item['BukuID'] ?>">
                                    <!-- Konten Form Ulasan -->
                                    <div class="tab-pane fade show active" id="content1">
                                    <form action="<?= base_url() ?>tambahUlasan" method="post">
                                        <input type="hidden" name="UserID" value="<?= $userID; ?>">
                                        <input type="hidden" name="BukuID"  value="<?= $item['BukuID'] ?>">
                                        <input type="hidden" name="Judul" value="<?= $item['Judul'] ?>">
                                        <div class="form-floating mt-3">
                                            <textarea class="form-control" placeholder="Tambahkan Komentar" id="floatingTextarea" name="Ulasan"></textarea>
                                            <label for="floatingTextarea" class=" text-secondary">Berikan Ulasan</label>
                                        </div>
                                        <div id="rateYo" class="mt-2 mb-2"
                                            data-rateyo-full-star="true">
                                        </div>
                                        <span class="result mt-3">Rating: 0</span>
                                        <input type="hidden" name="Rating">
                                        <button type="submit" class="btn w-100 mt-3" style="background-color: #DF791E; color: #ffff;">Kirim</button>
                                    </form>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="content2<?= $item['BukuID'] ?>">
                                    <!-- Konten Lihat Ulasan -->
                                     <div class="user-ulasan text-secondary mt-2">
                                        <?php if(empty($ulasan) ): ?>
                                            <span style="color: #DF791E">Belum ada ulasan...</span>
                                        <?php endif; ?>
                                        <?php foreach($ulasan as $ulasanItem): ?>
                                        <div class="profil">
                                            <div class="row">
                                                <div class="col">
                                                    <span><?= $ulasanItem['TanggalUlasan'] ?></span>
                                                    <br>
                                                    <i class="fa-solid fa-user"></i>   
                                                    <span><?= $ulasanItem['Username']?></span>
                                                    <br>
                                                    <span><?= $ulasanItem['Ulasan'] ?></span>
                                                </div>
                                                <div class="col text-end">
                                                    <div class="rating" data-rating="<?= $ulasanItem['Rating'] ?>" id="rating-data<?= $ulasanItem['UserID'] ?>"></div>
                                                    <span>Rating: <?= $ulasanItem['Rating'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
      
      <!-- Card -->
      <?php foreach ($buku as $item) : ?>
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img class="card-img-top" src="<?= base_url('/uploads/' . $item['CoverBuku']); ?>" alt="Cover Buku">
          <div class="card-body">
            <h5 class="card-title text-center"><?= $item['Judul']; ?></h5>
            <div class="text-center my-4">
              <?php if (session()->get('Status_login')): ?>
              <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $item['BukuID'] ?>">Lihat Selengkapnya</a>
            <?php else: ?>
              <div class="modal-body">
                <a href="<?= base_url() ?>" role="button" class="btn btn-warning" data-bs-toggle="popover" title="Belum Melakukan Login" data-bs-content="Sebelum meminjam buku, sebaiknya melakukan Register atau Login terlebih dahulu!">Pinjam</a>
            </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
    
    <script src="<?= base_url() ?>rateyo/jquery.rateyo.min.js"></script>
    <script>
      $(function () {
        $("#rateYo").rateYo({
          onChange: function (Rating, rateYoInstance) {
            $(this).parent().find('.result').text('Rating: ' + Rating);
            $(this).parent().find('input[name=Rating]').val(Rating);
          }
        });
      });
    </script>
    <script>
    $(function () {
      <?php foreach ($ulasan as  $ulasan): ?>
      $("#rating-data<?= $ulasan['UserID'] ?>").rateYo({
        rating: <?= $ulasan['Rating'] ?>,
        readOnly: true, 
      });
      <?php endforeach; ?>

    });
  </script>

    <script type="text/javascript">
      const myModal = document.getElementById('myModal')
      const myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
      })
    </script>
     <script src="<?= base_url() ?>bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>