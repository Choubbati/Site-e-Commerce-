


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - TechStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a href="index.html" class="logo">
            <i class="fas fa-bolt"></i> TechStore
        </a>
        <ul class="nav-links">
            <li><a href="index.html" class="nav-item">Accueil</a></li>
        </ul>
    </div>
</nav>
<div class="auth-container">
    <div class="auth-header">
        <h2>Bienvenue</h2>
        <p style="color: var(--accent-color);">Connectez-vous à votre compte</p>
    </div>

    <form id="login-form" method="POST" action="index.php?page=do-login">
        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <div style="position: relative;">
                    <span style="position: absolute; left: 10px; top: 10px; color: var(--accent-color);">
                        <i class="far fa-envelope"></i>
                    </span>
                <input type="email" id="email" name="email" class="form-input" style="padding-left: 2.5rem;"
                       placeholder="exemple@email.com" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Mot de passe</label>
            <div style="position: relative;">
                    <span style="position: absolute; left: 10px; top: 10px; color: var(--accent-color);">
                        <i class="fas fa-lock"></i>
                    </span>
                <input type="password" name="password" id="password" class="form-input" style="padding-left: 2.5rem;"
                       placeholder="••••••••" required>
            </div>
        </div>
        <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; font-size: 0.9rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox"> Se souvenir de moi
            </label>
            <a href="#" style="color: var(--secondary-color);">Mot de passe oublié ?</a>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">
            Se connecter
        </button>
    </form>
    <p style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem;">
        Pas encore de compte ?
        <a href="index.php?page=register" style="color: var(--secondary-color); font-weight: 600;">S'inscrire</a>
    </p>
</div>

</body>
</html>