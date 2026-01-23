<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2>Connexion</h2>

        <form method="POST" action="/login">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>

            <button class="btn-login">Se connecter</button>

            <div class="login-links">
                <a href="index.php?page=register">Créer un compte</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
