<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Nouvel appareil détecté</title>
</head>
<body class="bg-gray-100 text-gray-900 font-sans flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
        <h2 class="text-2xl font-semibold mb-4 text-center">Un nouvel appareil a tenté de se connecter</h2>
        <div class="mb-4">
            <p class="text-lg">IP : <span class="font-semibold text-blue-600">{{ $ip }}</span></p>
            <p class="text-lg">Appareil : <span class="font-semibold text-blue-600">{{ $appareil }}</span></p>
        </div>
        <p class="mb-4">Si c'est vous, cliquez sur le lien ci-dessous pour autoriser ou refuser l'accès :</p>
        <div class="flex justify-between">
            <a href="{{ url('/valider-ip?ip='.$id_ip) }}" 
               class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors">Autoriser cet appareil</a>
            <a href="{{ url('/refuser-ip?ip=' . $id_ip) }}" 
               class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition-colors">Refuser cet appareil</a>
        </div>
    </div>
</body>
</html>
