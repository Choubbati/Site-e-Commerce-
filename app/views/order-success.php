<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande réussie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body{
            background:#f4f6f8;
            font-family:Arial, sans-serif;
        }
        .box{
            max-width:600px;
            margin:100px auto;
            background:white;
            padding:40px;
            border-radius:12px;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,.1);
        }
        .box i{
            font-size:70px;
            color:#2ecc71;
        }
        .box h1{
            margin:20px 0;
        }
        .btn{
            display:inline-block;
            margin-top:20px;
            padding:12px 25px;
            background:#000;
            color:white;
            text-decoration:none;
            border-radius:8px;
        }
    </style>
</head>
<body>

<div class="box">
    <i class="fa fa-check-circle"></i>
    <h1>Commande validée </h1>
    <p>Merci pour votre achat.</p>
    <a href="index.php?page=home" class="btn">Retour à l'accueil</a>
</div>

</body>
</html>
