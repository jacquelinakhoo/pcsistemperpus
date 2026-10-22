<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <?= session('Username') ?></p>
    <p>Role: <?= session('Role') ?></p>

    <p><a href="/logout">Logout</a></p>

    <h2>Daftar Karyawan</h2>
    <a href="/tambah/karyawan"><button type="button">Tambah Karyawan</button></a>

    <table border="1" width="600">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Sesi Kerja</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        foreach ($karyawan as $worker) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $worker->NamaKaryawan ?></td>
            <td><?= $worker->NoTelp_K ?></td>
            <td><?= $worker->SesiKerja ?></td>
            <td><?= $worker->Jabatan ?></td>
            <td>
                <a href="/edit/karyawan/<?= $worker->IDKaryawan ?>">Edit</a> 
                <a href="/hapus/karyawan/<?= $worker->IDKaryawan ?>">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <br><hr><br>

    <h2>Daftar Buku</h2>
    <a href="/tambah/buku"><button type="button">Tambah Buku</button></a>

    <table border="1" width="800">
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
        $no_buku = 1; 
        foreach ($buku as $b) {
        ?>
        <tr>
            <td><?= $no_buku++ ?></td>
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
                <a href="/edit/buku/<?= $b->IDBuku ?>">Edit</a> 
                <a href="/hapus/buku/<?= $b->IDBuku ?>">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>