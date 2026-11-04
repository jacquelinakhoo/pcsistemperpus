@extends('template')
@section('content')

<div class="pagetitle">
  <h1>Data Karyawan</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Karyawan</h5>
          <a href="/tambah/karyawan" class="btn btn-primary mb-3">Tambah Karyawan</a>

          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Foto</th>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>No Telp</th>
                <th>Jabatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($karyawan as $worker) { ?>
              <tr>
                <td>
                    <?php if ($worker->Foto) { ?>
                        <img src="<?= asset('assets/img/' . $worker->Foto) ?>" width="50" class="rounded">
                    <?php } else { ?>
                        <span class="badge bg-secondary">No Photo</span>
                    <?php } ?>
                </td>
                <td><?= $no++ ?></td>
                <td><?= $worker->NamaKaryawan ?></td>
                <td><?= $worker->Username ?></td>
                <td><?= $worker->NoTelp_K ?></td>
                <td><?= $worker->Jabatan ?></td>
                <td>
                  <a href="/edit/karyawan/<?= $worker->IDKaryawan ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="/hapus/karyawan/<?= $worker->IDKaryawan ?>" class="btn btn-sm btn-danger">Hapus</a>
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