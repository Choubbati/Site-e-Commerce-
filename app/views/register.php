<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>

<div class="auth-container">
    <div class="auth-card">
        <h2>Créer un compte</h2>

        <form method="POST" action="/register">
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" placeholder="Votre nom" required>
            </div>

            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="********" required>
            </div>

            <button type="submit" class="btn-submit">
                Créer un compte
            </button>

            <p class="auth-link">
                Déjà un compte ?
                <a href="index.php?page=do-login">Se connecter</a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
