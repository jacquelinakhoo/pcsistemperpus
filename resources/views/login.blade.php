<!DOCTYPE html>
<html>
<head>
    <title>Login - SistemPerpus</title>
</head>
<body>

    <h1>Login SistemPerpus</h1>

    <form method="POST" action="/login">
        @csrf

        <p>
            <label>Username</label><br>
            <input type="text" name="Username">
        </p>

        <p>
            <label>Password</label><br>
            <input type="password" name="Password">
        </p>

        <p>
            <button type="submit">Login</button>
        </p>
    </form>

    <p>
        Belum punya akun? <a href="/register">Daftar</a>
    </p>

</body>
</html>