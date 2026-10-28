@extends('template')
@section('content')

    <h1>Dashboard Karyawan</h1>
    <p>Selamat datang, <?= session('Username') ?></p>
    <p>Role: <?= session('Role') ?></p>

    <p><a href="/logout">Logout</a></p>

    <h2>Daftar Buku</h2>
    <table border="1" width="1000">
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Kategori</th>
            <th>Bahasa</th>
            <th>Jumlah Hal</th>
            <th>Tahun Terbit</th>
            <th>ISBN</th>
            <th>Penulis</th>
            <th>ID Penerbit</th>
            <th>Lokasi Rak</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        foreach ($buku as $b) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $b->JudulBuku ?></td>
            <td><?= $b->KategoriBuku ?></td>
            <td><?= $b->Bahasa ?></td>
            <td><?= $b->JumlahHal ?></td>
            <td><?= $b->TahunTerbit ?></td>
            <td><?= $b->ISBN ?></td>
            <td><?= $b->NamaPenulis ?></td>
            <td><?= $b->IDPenerbit ?></td>
            <td><?= $b->LokasiRak ?></td>
            <td><?= $b->Stok ?></td>
            <td>
                <a href="/edit/buku/<?= $b->IDBuku ?>"><button type="button" class="btn btn-warning">Edit</button></a> </a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

@endsection