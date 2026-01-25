<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail commande</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body{
            font-family:Arial;
            background:#f5f5f5;
        }
        .container{
            max-width:900px;
            margin:50px auto;
            background:white;
            padding:30px;
            border-radius:10px;
        }
        .item{
            display:flex;
            align-items:center;
            justify-content:space-between;
            border-bottom:1px solid #eee;
            padding:15px 0;
        }
        .item img{
            width:70px;
            border-radius:8px;
        }
        .total{
            text-align:right;
            font-size:20px;
            margin-top:20px;
        }
        .back{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🧾 Commande #<?= $order['id'] ?></h2>
    <p>
        Date : <?= $order['created_at'] ?><br>
        Statut : <strong><?= $order['status'] ?></strong>
    </p>

    <hr>

    <?php foreach ($items as $i): ?>
        <div class="item">
            <div style="display:flex;gap:15px;align-items:center;">
                <img src="assets/images/<?= htmlspecialchars($i['image']) ?>">
                <div>
                    <strong><?= htmlspecialchars($i['name']) ?></strong><br>
                    Quantité : <?= $i['quantity'] ?>
                </div>
            </div>
            <div>
                <?= $i['price'] ?> DH
            </div>
        </div>
    <?php endforeach; ?>

    <div class="total">
        Total : <strong><?= $order['total'] ?> DH</strong>
    </div>
    <a href="index.php?page=invoice&id=<?= $order['id'] ?>" target="_blank">
        📄 Télécharger la facture PDF
    </a>


    <a href="index.php?page=profile" class="back">
        ← Retour au profil
    </a>
</div>

</body>
</html>
