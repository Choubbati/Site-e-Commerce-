<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Commandes</title>
    <style>
        body{font-family:Arial;background:#f4f6f8;}
        .container{
            max-width:1100px;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:10px;
        }
        table{
            width:100%;
            border-collapse:collapse;
        }
        th,td{
            padding:12px;
            border-bottom:1px solid #eee;
            text-align:left;
        }
        .status{
            padding:4px 10px;
            border-radius:6px;
            font-size:12px;
        }
        .pending{background:#f1c40f;}
        .processing{background:#3498db;color:white;}
        .completed{background:#2ecc71;color:white;}
        .cancelled{background:#e74c3c;color:white;}
        select{
            padding:5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📦 Gestion des commandes</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php foreach ($orders as $o): ?>
            <tr>
                <td>#<?= $o['id'] ?></td>
                <td><?= htmlspecialchars($o['email']) ?></td>
                <td><?= $o['total'] ?> DH</td>
                <td>
        <span class="status <?= $o['status'] ?>">
            <?= $o['status'] ?>
        </span>
                </td>
                <td>
                    <a href="index.php?page=admin-order-detail&id=<?= $o['id'] ?>">
                        Voir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
</body>
</html>
