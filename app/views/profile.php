<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <style>
        body{font-family:Arial;background:#f5f5f5;}
        .container{
            max-width:900px;
            margin:50px auto;
            background:white;
            padding:30px;
            border-radius:10px;
        }
        .order{
            border-bottom:1px solid #eee;
            padding:15px 0;
        }
        .status{
            padding:5px 10px;
            border-radius:6px;
            font-size:12px;
            background:#eee;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>👤 Mon profil</h2>
    <p><strong>UserName:</strong> <?= $_SESSION['user_name'] ?></p>

    <h3>🧾 Mes commandes</h3>

    <?php if (empty($orders)): ?>
        <p>Aucune commande.</p>
    <?php else: ?>
        <?php foreach ($orders as $o): ?>
            <div class="order">
                <strong>Commande #<?= $o['id'] ?></strong><br>
                Total : <?= $o['total'] ?> DH<br>
                Date : <?= $o['created_at'] ?><br>
                <span class="status"><?= $o['status'] ?></span><br><br>

                <a href="index.php?page=order-detail&id=<?= $o['id'] ?>">
                    Voir détail
                </a>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
