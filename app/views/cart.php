<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *{
            box-sizing: border-box;
        }
        body{
            margin:0;
            font-family: 'Segoe UI', sans-serif;
            background:#f4f6f8;
        }

        .container{
            max-width:1000px;
            margin:60px auto;
            background:#fff;
            padding:30px;
            border-radius:14px;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        h2{
            margin-bottom:30px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        /* EMPTY CART */
        .empty{
            text-align:center;
            padding:60px 20px;
            color:#777;
        }
        .empty i{
            font-size:60px;
            margin-bottom:20px;
            color:#ccc;
        }

        .btn{
            display:inline-block;
            margin-top:20px;
            padding:12px 28px;
            background:#111;
            color:#fff;
            border-radius:30px;
            text-decoration:none;
            transition:.3s;
        }
        .btn:hover{
            background:#333;
        }

        /* CART LIST */
        .cart-list{
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .cart-item{
            display:grid;
            grid-template-columns:100px 1fr 120px 50px;
            align-items:center;
            gap:20px;
            padding:15px;
            border:1px solid #eee;
            border-radius:12px;
        }

        .cart-item img{
            width:100%;
            border-radius:10px;
            object-fit:cover;
        }

        .cart-info h4{
            margin:0 0 8px;
        }

        .price{
            font-weight:bold;
            color:#111;
        }

        .remove{
            color:#e74c3c;
            font-size:18px;
            text-align:center;
        }
        .remove:hover{
            color:#c0392b;
        }

        /* TOTAL */
        .cart-footer{
            margin-top:30px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            border-top:1px solid #eee;
            padding-top:20px;
        }

        .total{
            font-size:20px;
            font-weight:bold;
        }

        .checkout{
            background:#27ae60;
        }
        .checkout:hover{
            background:#1e8c4a;
        }

        @media(max-width:768px){
            .cart-item{
                grid-template-columns:1fr;
                text-align:center;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fa fa-shopping-cart"></i> Votre Panier</h2>

    <?php if (empty($produits)): ?>
        <div class="empty">
            <i class="fa fa-cart-shopping"></i>
            <p>Votre panier est vide</p>
            <a href="index.php?page=home" class="btn">Continuer vos achats</a>
        </div>
    <?php else: ?>

        <div class="cart-list">
            <?php $total = 0; ?>
            <?php foreach ($produits as $p): ?>
                <?php $total += $p['price'] * $p['quantity']; ?>

                <div class="cart-item">
                    <img src="<?= $p['image'] ?? 'https://via.placeholder.com/150' ?>" alt="product">

                    <div class="cart-info">
                        <h4><?= htmlspecialchars($p['name']) ?></h4>
                        <p>Quantité : <?= $p['quantity'] ?></p>
                    </div>

                    <div class="price">
                        <?= $p['price'] * $p['quantity'] ?> DH
                    </div>

                    <div class="remove">
                        <a href="index.php?page=remove-cart&id=<?= $p['id'] ?>">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-footer">
            <div class="total">
                Total : <?= $total ?> DH
            </div>
            <a href="index.php?page=checkout" class="btn checkout">
                Passer à la commande
            </a>
        </div>

    <?php endif; ?>
</div>

</body>
</html>
