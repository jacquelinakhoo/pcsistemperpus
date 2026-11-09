<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <!-- DASHBOARD -->
      <li class="nav-item">
        <?php if(session('Role') == 'Admin') { ?>
            <a class="nav-link" href="/dashboard/admin">
        <?php } else if(session('Role') == 'Petugas') { ?>
            <a class="nav-link" href="/dashboard/petugas">
        <?php } else { ?>
            <a class="nav-link" href="/dashboard/siswa">
        <?php } ?>
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <!-- ADMIN ONLY MENU -->
      <?php if(session('Role') == 'Admin') { ?>
      <li class="nav-heading">Admin Master</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/karyawan">
          <i class="bi bi-person-badge"></i>
          <span>Data Karyawan</span>
        </a>
      </li>
      <?php } ?>

      <!-- KARYAWAN & ADMIN MENU -->
      <?php if(session('Role') == 'Admin' || session('Role') == 'Petugas') { ?>
      <li class="nav-heading">Perpustakaan</li>
      <li class="nav-item">
        <?php if(session('Role') == 'Admin') { ?>
            <a class="nav-link collapsed" href="/admin/buku">
        <?php } else { ?>
            <a class="nav-link collapsed" href="/karyawan/buku">
        <?php } ?>
          <i class="bi bi-book"></i>
          <span>Data Buku</span>
        </a>
      </li>
      <li class="nav-item">
        <?php if(session('Role') == 'Admin') { ?>
            <a class="nav-link collapsed" href="/admin/peminjaman">
        <?php } else { ?>
            <a class="nav-link collapsed" href="/karyawan/peminjaman">
        <?php } ?>
          <i class="bi bi-arrow-left-right"></i>
          <span>Peminjaman</span>
        </a>
      </li>
      <?php } ?>

      <!-- SISWA ONLY MENU -->
      <?php if(session('Role') == 'Siswa') { ?>
      <li class="nav-heading">Siswa</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/dashboard/siswa">
          <i class="bi bi-journal-bookmark"></i>
          <span>Daftar Buku</span>
        </a>
      </li>
      <?php } ?>

      <!-- LOGOUT (Everyone) -->
      <li class="nav-heading">Akun</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/logout">
          <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
</aside>