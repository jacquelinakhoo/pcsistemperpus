@extends('template')
@section('content')
    <h2>Form Denda</h2>
    <form action="/denda/<?= $IDPeminjaman ?>" method="post">
        @csrf
        <div class="mb-3">
            <label>Alasan Denda:</label>
            <input type="text" name="AlasanDenda" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Denda (Angka):</label>
            <input type="number" name="JumlahDenda" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger">Simpan Denda</button>
    </form>
@endsection