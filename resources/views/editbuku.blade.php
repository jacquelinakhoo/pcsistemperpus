@extends('template')
@section('content')

<div class="pagetitle">
  <h1>Edit Buku</h1>
</div>

<section class="section">
  <div class="card">
    <div class="card-body pt-3">
      <form action="/edit/buku/<?= $buku->IDBuku ?>" method="post">
        @csrf
        
        <div class="mb-3">
            <label>Judul Buku:</label>
            <input type="text" name="JudulBuku" class="form-control" value="<?= $buku->JudulBuku ?>" required>
        </div>
        <div class="mb-3">
            <label>Kategori:</label>
            <input type="text" name="KategoriBuku" class="form-control" value="<?= $buku->KategoriBuku ?>" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Halaman:</label>
            <input type="number" name="JumlahHal" class="form-control" value="<?= $buku->JumlahHal ?>" required>
        </div>
        <div class="mb-3">
            <label>Stok:</label>
            <input type="number" name="Stok" class="form-control" value="<?= $buku->Stok ?>" required>
        </div>

        <?php if(session('Role') == 'Admin') { ?>
            <div class="mb-3">
                <label>Bahasa:</label>
                <input type="text" name="Bahasa" class="form-control" value="<?= $buku->Bahasa ?>">
            </div>
            <div class="mb-3">
                <label>Cover:</label>
                <input type="text" name="Cover" class="form-control" value="<?= $buku->Cover ?>">
            </div>
            <div class="mb-3">
                <label>Tahun Terbit:</label>
                <input type="text" name="TahunTerbit" class="form-control" value="<?= $buku->TahunTerbit ?>">
            </div>
            <div class="mb-3">
                <label>ISBN:</label>
                <input type="text" name="ISBN" class="form-control" value="<?= $buku->ISBN ?>">
            </div>
            <div class="mb-3">
                <label>Penulis:</label>
                <input type="text" name="NamaPenulis" class="form-control" value="<?= $buku->NamaPenulis ?>">
            </div>
            <div class="mb-3">
                <label>ID Penerbit:</label>
                <input type="number" name="IDPenerbit" class="form-control" value="<?= $buku->IDPenerbit ?>">
            </div>
            <div class="mb-3">
                <label>Lokasi Rak:</label>
                <input type="text" name="LokasiRak" class="form-control" value="<?= $buku->LokasiRak ?>">
            </div>
        <?php } ?>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/dashboard/petugas" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</section>

@endsection