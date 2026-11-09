@extends('template')
@section('content')

<div class="pagetitle">
  <h1>Dashboard Admin</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Selamat Datang, {{session('Username')}}! Kamu adalah {{session('Role')}} </h5>

          <p>Silakan pilih menu di sebelah kiri untuk mengelola data Sistem Perpustakaan.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection