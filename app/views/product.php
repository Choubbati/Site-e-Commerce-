<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
<h1><?= htmlspecialchars($product['name']) ?></h1>

<img src="<?= htmlspecialchars($product['image'] ?? 'assets/img/default.png') ?>" width="300">

<p><?= htmlspecialchars($product['description']) ?></p>
<p>Prix: <?= $product['price'] ?> MAD</p>
<p>Stock: <?= $product['stock'] ?></p>

<?php if ($product['stock'] > 0): ?>
    <form action="cart_add.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width: 100px;">
        <button type="submit" class="btn btn-success">Ajouter au panier</button>
    </form>
<?php else: ?>
    <p class="text-danger">Produit indisponible</p>
<?php endif; ?>

<a href="index.php?page=home" class="btn btn-secondary mt-3">Retour au catalogue</a>
</body>
</html>
