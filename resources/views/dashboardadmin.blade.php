<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>dashboard admin</title>
</head>
<body>
    <h1>Welcome, {{ session('Username') }}!</h1>
    <p>Role: {{ session('Role') }}</p>

    <a href="/logout">Logout</a>

    <h2>Karyawan</h2>
    <a href="/tambah/karyawan"><button type="button">Tambah Karyawan</button></a>

    <table border="1" width="600">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Sesi Kerja</th>
            <th>ID User</th>
            <th>Jabatan</th>
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
            <td><?= $worker->IDUser ?></td>
            <td><?= $worker->Jabatan ?></td>
        </tr>
        <?php
        }
        ?>
    </table>

</body>
</html>