@extends('template')
@section('content')

<div class="pagetitle">
  <h1>Dashboard Karyawan</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Selamat Datang, <?= session('Username') ?>!</h5>
          <p>Silakan pilih menu di sebelah kiri untuk mengelola data Buku dan Peminjaman.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection