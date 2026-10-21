<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah Karyawan</title>
</head>
<body>
    <h1>Tambah Karyawan</h1>
    <form action="/tambah/karyawan" method="post">
        @csrf
        EmailUser:<br>
        <input type="text" name="EmailUser"><br>
        Username:<br>
        <input type="text" name="Username"><br>
        Password:<br>
        <input type="password" name="Password"><br>
        JenisKelamin:<br>
        <input type="radio" name="Gender" value="Laki-laki"> Laki-laki
        <input type="radio" name="Gender" value="Perempuan"> Perempuan<br>
        NamaKaryawan:<br>
        <input type="text" name="NamaKaryawan"><br>
        NoTelp_K:<br>
        <input type="text" name="NoTelp_K"><br>
        SesiKerja:<br>
        <input type="text" name="SesiKerja"><br>
        Jabatan:<br>
        <select name="Jabatan">
            <option value="">-Pilih-</option>
            <?php
            foreach ($jabatan as $j) {
            ?>
                <option value="<?= $j->NamaJabatan ?>"><?= $j->NamaJabatan ?></option>
            <?php } ?>
        </select><br><br>
        <input type="submit" value="Tambah Karyawan">
    </form>
</body>
</html>