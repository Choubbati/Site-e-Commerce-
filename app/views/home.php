<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// lien user (profile / login)
$userLink = isset($_SESSION['user_id'])
    ? 'index.php?page=profile'
    : 'index.php?page=login';

// nombre produits panier
$cartCount = isset($_SESSION['cart'])
    ? array_sum($_SESSION['cart'])
    : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Électronique de pointe</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="container">
        <a href="index.php?page=home" class="logo">
            <i class="fas fa-bolt"></i> TechStore
        </a>

        <ul class="nav-links">
            <li><a href="index.php?page=home" class="nav-item">Accueil</a></li>
            <li><a href="#products" class="nav-item">Produits</a></li>
            <li><a href="#" class="nav-item">Promotions</a></li>
            <li><a href="#" class="nav-item">Assistance</a></li>
        </ul>

        <div class="nav-actions">
            <a href="#" class="icon-btn"><i class="fas fa-search"></i></a>

            <!-- USER -->
            <a href="<?= $userLink ?>" class="icon-btn">
                <i class="fas fa-user"></i>
            </a>

            <!-- CART -->
            <a href="index.php?page=cart" class="icon-btn" style="position:relative">
                <i class="fas fa-shopping-cart"></i>
                <?php if ($cartCount > 0): ?>
                    <span class="cart-count"><?= $cartCount ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <h1>Le Futur de la Technologie</h1>
        <p>Découvrez notre sélection exclusive d'ordinateurs, smartphones et accessoires.</p>
        <a href="#products" class="btn btn-primary">Voir le catalogue</a>
    </div>
</section>

<!-- MAIN -->
<main class="container">

    <!-- FILTERS -->
    <div class="filters" id="products">
        <button class="filter-btn active">Tout</button>
        <button class="filter-btn">Ordinateurs</button>
        <button class="filter-btn">Smartphones</button>
        <button class="filter-btn">Accessoires</button>
    </div>

    <!-- PRODUCTS -->
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

                            <!-- ADD TO CART -->
                            <button
                                    class="btn btn-primary add-to-cart-btn"
                                    data-id="<?= $product['id'] ?>"
                            >
                                <i class="fas fa-cart-plus"></i> Ajouter
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

<!-- FOOTER -->
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
            <div style="display:flex;gap:1rem">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;

            fetch('index.php?page=add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `product_id=${productId}&quantity=1`
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount) {
                            cartCount.textContent = data.count;
                        } else {
                            const span = document.createElement('span');
                            span.className = 'cart-count';
                            span.textContent = data.count;
                            document.querySelector('.fa-shopping-cart').after(span);
                        }
                    } else if (data.message === 'not_logged') {
                        window.location.href = 'index.php?page=login';
                    }
                });
        });
    });
</script>


</body>
</html>
