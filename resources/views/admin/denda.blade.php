@extends('template')
@section('content')

<div class="pagetitle">
  <h1>Data Denda</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Denda Siswa</h5>

          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Peminjaman</th>
                <th>Alasan Denda</th>
                <th>Jumlah Denda</th>
                <th>Status Bayar</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($denda as $d) { ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->IDPeminjaman ?></td>
                <td><?= $d->AlasanDenda ?></td>
                <td>Rp <?= $d->JumlahDenda ?></td>
                <td>
                    <?php if($d->StatusBayar == 'Belum Lunas') { ?>
                        <span class="badge bg-danger">Belum Lunas</span>
                    <?php } else { ?>
                        <span class="badge bg-success">Lunas</span>
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