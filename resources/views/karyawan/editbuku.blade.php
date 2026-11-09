<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>
    <form action="/edit/buku" method="post">
        @csrf
        
        Judul Buku:<br>
        <input type="text" name="JudulBuku"><br>
        
        Kategori:<br>
        <input type="text" name="KategoriBuku"><br>
        
        Stok:<br>
        <input type="number" name="Stok"><br>

        <input type="submit" value="Save">
    </form>
    
    <br>
    <a href="/dashboard/petugas">Back</a>
</body>
</html>