<!DOCTYPE html>
<html>

<head>
    <title>Bienvenue</title>
</head>

<body>
    <h1>Bienvenue sur la plateforme maisons de jeunes!</h1>
    <p>Nous sommes ravis de vous avoir parmi nous.</p>
    <p>Pour finaliser votre inscription, veuillez cliquer sur le lien ci-dessous :</p>
    <a href={{ route('register', ['token' => $token, 'userId' => $userId]) }}>Finaliser mon inscription</a>
</body>

</html>
