<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel appareil détecté</title>
</head>
<body>
    <h2>Un nouvel appareil a tenté de se connecter</h2>
    <p>IP : {{ $ip }}</p>
    <p>Appareil : {{ $userAgent }}</p>
    <p>Si c'est vous, cliquez sur le lien ci-dessous pour autoriser l'accès :</p>
    <a href="{{ url('/valider-ip?ip=' . $ip) }}">Autoriser cet appareil</a>
</body>
</html>
