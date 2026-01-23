<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
<h1>Votre Panier</h1>

<?php if (empty($cartProducts)): ?>
    <p>Votre panier est vide.</p>
<?php else: ?>
    <table class="table">
        <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $grandTotal = 0; ?>
        <?php foreach($cartProducts as $p): ?>
            <?php $total = $p['price'] * $p['quantity']; $grandTotal += $total; ?>
            <tr>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td><?= $p['quantity'] ?></td>
                <td><?= $p['price'] ?> MAD</td>
                <td><?= $total ?> MAD</td>
                <td>
                    <form action="cart_remove.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h4>Total Général: <?= $grandTotal ?> MAD</h4>
<?php endif; ?>

<a href="index.php?page=home" class="btn btn-secondary mt-3">Continuer vos achats</a>
</body>
</html>
