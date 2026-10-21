<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>dashboard petugas</title>
</head>
<body>
    <h1>Welcome, {{ session('Username') }}!</h1>
    <p>Role: {{ session('Role') }}</p>

    <a href="/logout">Logout</a>
</body>
</html>