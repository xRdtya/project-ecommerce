<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Produk</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <style>
        .trix-button-group--file-tools,
        .trix-button--icon-strike,
        .trix-button--icon-code {
            display: none !important;
        }
    </style>
</head>
<body>

<div class="auth-container card-surface">

    <h2>Upload Produk Baru</h2>

    <form id="uploadForm" method="POST" action="/seller/create" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="seller" value="{{ auth()->user()->name }}">
        <input type="hidden" name="category_id" value="2">
        <input type="text" name="title" id="prodTitle" placeholder="Judul Produk" required>

        <input type="number" name="price" id="prodPrice" placeholder="Harga" required>

        {{-- Trix --}}
        <input type="hidden" id="description" name="description">
        <trix-editor input="description"></trix-editor>
        
        <label>Gambar Produk:</label>
        <input type="file" name="image" id="prodImage" accept="image/*" required>
        <div id="previewWrap"></div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <br>
    <a href="/seller" class="btn">Kembali ke Dashboard</a>

</div>

<script src="../assets/js/upload.js"></script>
<script>
    document.addEventListener("trix-file-accept", function(event) {
        event.preventDefault();
    });
</script>

</body>
</html>
