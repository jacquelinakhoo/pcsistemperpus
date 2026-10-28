@extends('template')
@section('content')

    <h2>Edit Karyawan</h2>
    
    <form action="/edit/karyawan/<?= $karyawan->IDKaryawan ?>" method="post">
        @csrf
        
        <div class="mb-3">
            <label>Username:</label>
            <input type="text" name="Username" class="form-control" value="<?= $user->Username ?>" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="EmailUser" class="form-control" value="<?= $user->EmailUser ?>" required>
        </div>

        <div class="mb-3">
            <label>Nama Karyawan:</label>
            <input type="text" name="NamaKaryawan" class="form-control" value="<?= $karyawan->NamaKaryawan ?>" required>
        </div>

        <div class="mb-3">
            <label>No Telp:</label>
            <input type="text" name="NoTelp_K" class="form-control" value="<?= $karyawan->NoTelp_K ?>" required>
        </div>

        <div class="mb-3">
            <label>Sesi Kerja:</label>
            <input type="text" name="SesiKerja" class="form-control" value="<?= $karyawan->SesiKerja ?>" required>
        </div>

        <div class="mb-3">
            <label>Jabatan:</label>
            <input type="text" name="Jabatan" class="form-control" value="<?= $karyawan->Jabatan ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="/dashboard/admin" class="btn btn-secondary">Batal</a>
    </form>

@endsection