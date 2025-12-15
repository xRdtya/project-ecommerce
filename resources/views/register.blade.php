<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Daftar</title>
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>

    <div class="auth-container">
        <h2>Daftar Akun</h2>

        <form class="auth-form" method="post" action="/register">
            @csrf
            <input type="text" name="name" class="@error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label>Pilih Peran:</label>
            <select class="@error('roles') is-invalid @enderror" name="roles">
                <option value="buyer">Pembeli</option>
                <option value="seller">Penjual</option>
            </select>
            <input class="@error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <input class="@error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>

        <div class="auth-switch">
            Sudah punya akun? <a href="/register">Login</a>
        </div>
    </div>

    </body>
</html>
