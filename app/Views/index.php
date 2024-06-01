<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpuskuy</title>
    <link href="<?= base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo.jpg" />
    
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>./css/style1.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>./css/landing-page.css">
  </head>
  <body>
    <?php if (session()->get('Status_login')): ?>
    <?php echo view('partials/alertPengembalianBuku'); ?>  
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/partialsCSS/navbar.css">
    <?php echo view('partials/navbar'); ?>
    <div class="s006">
      <form>
        <fieldset>
          <legend>Cari buku apa hari ini?</legend>
          <div class="inner-form">
            <div class="input-field">
              <button class="btn-search" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
              </button>
              <input id="search" type="text" placeholder=""/>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
    <?php else: ?>
        <?php echo view('partials/navbar-landing-page'); ?>
        <?php echo view('partials/landing-page'); ?>

      <?php endif; ?>

  <script src="<?= base_url() ?>js/script.js"></script>
  <script src="<?= base_url() ?>https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
  <script src="<?= base_url() ?>bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>