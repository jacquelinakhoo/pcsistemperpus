@extends('template')
@section('content')

<div class="pagetitle">
  <h1>Data Buku</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Buku Perpustakaan</h5>
          <a href="/tambah/buku" class="btn btn-primary mb-3">Tambah Buku</a>

          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($buku as $b) { ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $b->JudulBuku ?></td>
                <td><?= $b->KategoriBuku ?></td>
                <td><?= $b->NamaPenulis ?></td>
                <td><?= $b->Stok ?></td>
                <td>
                  <a href="/edit/buku/<?= $b->IDBuku ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="/hapus/buku/<?= $b->IDBuku ?>" class="btn btn-sm btn-danger">Hapus</a>
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