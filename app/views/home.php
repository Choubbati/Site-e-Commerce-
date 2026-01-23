<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Électronique de pointe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar">
    <div class="container">
        <a href="index.html" class="logo">
            <i class="fas fa-bolt"></i> TechStore
        </a>
        <ul class="nav-links">
            <li><a href="index.html" class="nav-item">Accueil</a></li>
            <li><a href="#products" class="nav-item">Produits</a></li>
            <li><a href="#" class="nav-item">Promotions</a></li>
            <li><a href="#" class="nav-item">Assistance</a></li>
        </ul>
        <div class="nav-actions">
            <a href="#" class="icon-btn"><i class="fas fa-search"></i></a>
            <a href="index.php?page=do-login" class="icon-btn"><i class="fas fa-user"></i></a>
            <a href="cart.html" class="icon-btn" style="position: relative;">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </div>
</nav>
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Le Futur de la Technologie</h1>
        <p>Découvrez notre sélection exclusive d'ordinateurs, smartphones et accessoires de dernière génération.</p>
        <a href="#products" class="btn btn-primary">Voir le catalogue</a>
    </div>
</section>
<!-- Main Content -->
<main class="container">

    <!-- Filters -->
    <div class="filters" id="products">
        <button class="filter-btn active" data-category="all">Tout</button>
        <button class="filter-btn" data-category="computers">Ordinateurs</button>
        <button class="filter-btn" data-category="smartphones">Smartphones</button>
        <button class="filter-btn" data-category="accessoires">Accessoires</button>
    </div>
    <!-- Product Grid -->
<div class="product-grid">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img 
                    src="assets/images/<?= htmlspecialchars($product['image']) ?>" 
                    alt="<?= htmlspecialchars($product['name']) ?>"
                >

                <div class="product-info">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><?= htmlspecialchars($product['description']) ?></p>

                    <div class="product-footer">
                        <span class="price">
                            <?= number_format($product['price'], 2) ?> MAD
                        </span>
                        <button class="btn btn-primary">
                            <i class="fas fa-cart-plus"></i>
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center">Aucun produit disponible</p>
    <?php endif; ?>
</div>

</main>
<!-- Footer -->
<footer>
    <div class="container footer-content">
        <div>
            <h3>TechStore</h3>
            <p>Votre destination pour le meilleur de la tech.</p>
        </div>
        <div>
            <h4>Liens Rapides</h4>
            <ul>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Conditions</a></li>
            </ul>
        </div>
        <div>
            <h4>Suivez-nous</h4>
            <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>
<script src="js/main.js"></script>
</body>
</html>