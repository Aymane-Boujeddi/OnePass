<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentatives de connexion dépassées</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
        .logo {
            max-height: 60px;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="OnePass" class="logo">
        <h1>Alerte de Sécurité</h1>
    </div>

    <div class="content">
        <h2>Tentatives de connexion excessives</h2>
        
        <p>Bonjour,</p>
        
        <p>Nous avons détecté plusieurs tentatives de connexion infructueuses à votre compte.</p>
        
        <p>Pour des raisons de sécurité, votre compte a été temporairement verrouillé. Vous pourrez réessayer de vous connecter après <strong>1 heure</strong>.</p>
        
        <p>Si vous n'êtes pas à l'origine de ces tentatives, nous vous recommandons de changer votre mot de passe dès que vous aurez à nouveau accès à votre compte.</p>
        
        <p>Cordialement,<br>
        L'équipe OnePass</p>
    </div>

    <div class="footer">
        <p>Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
        <p>© {{ date('Y') }} OnePass. Tous droits réservés.</p>
    </div>
</body>
</html>