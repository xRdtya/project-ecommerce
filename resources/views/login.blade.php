<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link rel="stylesheet" href="./assets/css/main.css">
    </head>
    <body>
        <div class="auth-container">
            <h2>Login</h2>

            <form action="http://127.0.0.1:8000/login" method="POST" class="auth-form">
                @csrf
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <div class="auth-switch">
                Belum punya akun? <a href="/register">Daftar</a>
            </div>
        </div>
    </body>
</html>