@extends('template')
@section('content')

<div class="pagetitle">
  <h1>Data Peminjaman</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Transaksi Peminjaman</h5>
          
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($peminjaman as $p) { ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $p->NamaSiswa ?></td>
                <td><?= $p->JudulBuku ?></td>
                <td><?= $p->TglPeminjaman ?></td>
                <td>
                  <?php if ($p->Status == 'Belum') { ?>
                    <span class="badge bg-warning">Dipinjam</span>
                  <?php } else { ?>
                    <span class="badge bg-success">Selesai</span>
                  <?php } ?>
                </td>
                <td>
                  <?php if ($p->Status == 'Belum') { ?>
                    <a href="/kembalikan/<?= $p->IDPeminjaman ?>" class="btn btn-sm btn-success">Kembalikan</a>
                    <a href="/denda/<?= $p->IDPeminjaman ?>" class="btn btn-sm btn-danger">Beri Denda</a>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection