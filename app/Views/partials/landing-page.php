        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
            </div>
        </header>

        <!--Daftar Buku-->
        <section class="page-section" id="daftar-buku">
            <div class="container">
              <div class="text-center">
                <h2 class="section-heading text-uppercase">Daftar Buku</h2>
              </div>
              <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                <!-- Card -->
                <?php foreach ($buku as $item) : ?>
                <div class="col">
                  <div class="card h-100 shadow-sm">
                    <img class="card-img-top" src="<?= base_url('/uploads/' . $item['CoverBuku']); ?>" alt="Cover Buku">
                    <div class="card-body">
                      <h5 class="card-title text-center"><?= $item['Judul']; ?></h5>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
        </section>

