<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Profil</title>
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>

    <div class="profile-card">

        <img src="https://placehold.co/150" class="profile-photo">
        <h2 id="profileName">{{ auth()->user()->name }}</h2>
        <p id="profileEmail">{{ auth()->user()->email }}</p>

        <p>Role: <strong id="roleText">{{ auth()->user()->roles }}</strong></p>
        @if (auth()->user()->roles == 'buyer')
        <a id="roleBtn" href="/buyer" class="btn btn-primary">Menu Pembeli</a>
        @endif
        
        <a id="roleBtn" href="/seller" class="btn btn-primary">Menu Penjual</a>
        <br><br>
        <form action="/logout" method="post">
            @csrf
            <button class="btn">Logout</button>
        </form>
    </div>

    </body>
</html>
