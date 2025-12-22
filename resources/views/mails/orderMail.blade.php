<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        .center {
            height: 100vh;
            display: flex;
            justify-content: center;
        }

        .grid {
            display: grid;
            align-content: center;
        }
    </style>
</head>
<body>
    <div class="center">
        <div class="grid">
            <h1>Hai, {{ $data['name'] }}</h1>
            <br>
            <p>Berikut rincian pesanan dan rincian pembayaran </p>
            <div style="display: flex; justify-content: space-around;">
            @foreach ($items as $item)   
                <div>
                    <p>Nama:</p>
                    <p>Jumlah:</p>
                    <p>Harga:</p>
                </div>
                <div class="">
                    <p>{{ $item->name }}</p>
                    <p>{{ $item->qty }}</p>
                    <p>Rp {{ number_format($item->price) }}</p>
                </div>
            @endforeach
            </div>
            <hr>
            <div style="display: flex; justify-content: space-around;">
                <div>
                    <p>Nama Penerima:</p>
                    <p>Email:</p>
                    <p>Alamat:</p>
                </div>
                <div style="width: min-content;">
                    <p>{{ $data['name'] }}</p>
                    <p>tysaluthfia1@gmail.com</p>
                    <p>{{ $data['address'] }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>