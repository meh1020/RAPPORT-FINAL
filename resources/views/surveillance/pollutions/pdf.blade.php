<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Export PDF - Pollution</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            text-align: left;
            margin: 0;
            padding: 0;
        }
        .logo {
            margin-top: 20px;
            text-align: center;
            margin-bottom: 40px; /* Espace ajouté entre logo et texte */
        }
        .logo img {
            max-width: 150px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .content {
            margin: 0 0 20px 20px;
            width: auto;
            text-align: left;
            padding: 0;
        }
        .data-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            text-align: left;
        }
        .section {
            font-size: 18px;
            flex: 1;
            text-align: left;
            margin: 0;
            padding: 0;
        }
        .section-title {
            font-weight: bold;
        }
        .data-value {
            margin-left: 10px;
        }
        .image-container {
            width: 100%;
            text-align: center;
            margin: 10px 0;
            padding: 0;
        }
        .image-container img {
            max-width: 400px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    @php
        // Logo en Base64
        $logoPath = public_path('images/aaaaaaaa.jpeg');
        $logoType = pathinfo($logoPath, PATHINFO_EXTENSION);
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoBase64 = "data:image/{$logoType};base64,{$logoData}";
    @endphp

    <div class="logo">
        <img src="{{ $logoBase64 }}" alt="Logo">
    </div>

    <div class="content">
        <div class="data-container">
            <div class="section">
                <span class="section-title">Pollution SRR Madagascar N° :</span>
                <span class="data-value">{{ $pollution->numero }}</span>
            </div>
        </div>
        <div class="data-container">
            <div class="section">
                <span class="section-title">Zone :</span>
                <span class="data-value">{{ $pollution->zone }}</span>
            </div>
        </div>
        <div class="data-container">
            <div class="section">
                <span class="section-title">Coordonnées Géographiques :</span>
                <span class="data-value">{{ $pollution->coordonnees }}</span>
            </div>
        </div>
        <div class="data-container">
            <div class="section">
                <span class="section-title">Type de Pollution :</span>
                <span class="data-value">{{ $pollution->type_pollution }}</span>
            </div>
        </div>

        <div class="data-container">
            <div class="section section-title">Images Satellites :</div>
        </div>
        <div class="image-container">
            @if ($pollution->images->isNotEmpty())
                @foreach ($pollution->images as $image)
                    @php
                        $imgPath = public_path('storage/' . $image->image_path);
                        $imgType = pathinfo($imgPath, PATHINFO_EXTENSION);
                        $imgData = base64_encode(file_get_contents($imgPath));
                        $imgBase64 = "data:image/{$imgType};base64,{$imgData}";
                    @endphp
                    <img src="{{ $imgBase64 }}" alt="Satellite image">
                @endforeach
            @else
                <span class="text-muted">Aucune image</span>
            @endif
        </div>
    </div>
</body>
</html>