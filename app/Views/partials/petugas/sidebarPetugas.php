<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url() ?>petugas/dashboard">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard Petugas</span>
      </a>
    </li>
    <li class="nav-item nav-category">Forms and Datas</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="menu-icon mdi mdi-table"></i>
        <span class="menu-title">Tables</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>petugas/daftarBuku">Book List Table</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>petugas/kategoriBuku">Book Category Table</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?= base_url() ?>petugas/peminjaman">Borrowing Books Table</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url() ?>petugas/user" aria-expanded="false" aria-controls="users">
        <i class="mdi-account mdi mdi-account-group menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
  </ul>
</nav>