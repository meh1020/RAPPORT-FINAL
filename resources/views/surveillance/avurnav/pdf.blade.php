<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>AVURNAV - {{ $avurnav->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: bold; /* Tous les textes en gras par défaut */
        }
        .normal {
            font-weight: normal; /* Texte normal pour les valeurs dynamiques */
        }
        h1 { text-align: center; font-size: 20px; }
        .highlight { font-weight: bold; }
        .bold { font-weight: bold; }
        .title { font-weight: bold; }
        .logo {
            text-align: center;
            margin-bottom: 40px;
        }
        .logo img { width: 150px; }
        .content {
            margin-left: 20px;
        }
    </style>
</head>
<body>

    <!-- Logo -->
    <div class="logo">
        <img src="{{ public_path('images/aaaaaaaa.jpeg') }}" alt="Logo">
    </div>

    <!-- Contenu -->
    <div class="content">
        <p class="title">AVURNAV LOCAL MADAGASCAR <span class="highlight">{{ $avurnav->avurnav_local }}</span></p>
        <p>ILE DE MADAGASCAR – <span class="highlight">{{ $avurnav->ile }}</span></p>

        <p>VOUS SIGNALE <span class="highlight">{{ strtoupper($avurnav->vous_signale) }}</span></p>

        <p>1- POSITION : <span class="normal">{{ $avurnav->position }}</span></p>
        <p>2- NAVIRE : <span class="normal">{{ $avurnav->navire }}</span></p>
        <p>3- POB : <span class="normal">{{ $avurnav->pob }}</span></p>
        <p>4- TYPE : <span class="normal">{{ $avurnav->type }}</span></p>
        <p>5- CARACTÉRISTIQUES : <span class="normal">{{ $avurnav->caracteristiques }}</span></p>
        <p>6- ZONE : <span class="normal">{{ $avurnav->zone }}</span></p>
        <p>7- DERNIÈRE COMMUNICATION : <span class="normal">{{ $avurnav->derniere_communication }}</span></p>
        <p>8- CONTACTS : <span class="normal">{{ $avurnav->contacts }}</span></p>

        <p>
            TOUS LES USAGERS DE LA MER DANS CETTE ZONE SONT TENUS DE RENDRE COMPTE DE TOUTES INFORMATIONS DISPONIBLES AU MRCC – APMF SOIT PAR :
        </p>
        <ul>
            <li>EMAIL : <span class="normal">mrccmadagascar@outlook.com / mrccmada@apmf.mg</span></li>
            <li>TEL : <span class="normal">032 11 258 96</span></li>
        </ul>
    </div>

</body>
</html>
