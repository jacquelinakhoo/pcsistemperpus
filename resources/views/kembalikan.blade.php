@extends('template')
@section('content')
    <h2>Form Pengembalian Buku</h2>
    <form action="/kembalikan/<?= $peminjaman->IDPeminjaman ?>" method="post">
        @csrf
        <div class="mb-3">
            <label>Kondisi Buku:</label>
            <select name="KondisiBuku" class="form-control" required>
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
    </form>
@endsection