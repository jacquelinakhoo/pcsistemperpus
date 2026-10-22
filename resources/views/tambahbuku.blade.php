<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
</head>
<body>
    <h1>Tambah Buku</h1>
    <form action="/tambah/buku" method="post">
        @csrf
        
        Judul Buku:<br>
        <input type="text" name="JudulBuku"><br>
        
        Kategori:<br>
        <input type="text" name="KategoriBuku"><br>
        
        Bahasa:<br>
        <input type="text" name="Bahasa"><br>
        
        Cover:<br>
        <input type="text" name="Cover"><br>
        
        Stok:<br>
        <input type="number" name="Stok"><br>
        
        Jumlah Halaman:<br>
        <input type="number" name="JumlahHal"><br>
        
        Tahun Terbit:<br>
        <input type="text" name="TahunTerbit"><br>
        
        ISBN:<br>
        <input type="text" name="ISBN"><br>
        
        Nama Penulis:<br>
        <input type="text" name="NamaPenulis"><br>
        
        ID Penerbit:<br>
        <input type="number" name="IDPenerbit"><br>
        
        Lokasi Rak:<br>
        <input type="text" name="LokasiRak"><br><br>

        <input type="submit" value="Tambah Buku">
    </form>
    
    <br>
    <a href="/dashboard/admin">Back to Dashboard</a>
</body>
</html>