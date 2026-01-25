<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TechStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a href="index.html" class="logo">
            <i class="fas fa-bolt"></i> TechStore Admin
        </a>
        <div class="nav-actions">
            <span style="font-size: 0.9rem; margin-right: 1rem;">Admin User</span>
            <a href="index.html" class="btn btn-secondary"
               onclick="localStorage.removeItem('isLoggedIn')">Déconnexion</a>
        </div>
    </div>
</nav>
<div class="container admin-layout">
    <aside class="sidebar">
        <nav>
            <a href="#products" class="sidebar-link active" onclick="showSection('products')">
                <i class="fas fa-box" style="width: 20px;"></i> Produits
            </a>
            <a href="#categories" class="sidebar-link" onclick="showSection('categories')">
                <i class="fas fa-tags" style="width: 20px;"></i> Catégories
            </a>
            <a href="#orders" class="sidebar-link" onclick="showSection('orders')">
                <i class="fas fa-shopping-bag" style="width: 20px;"></i> Commandes
            </a>
        </nav>
    </aside>
    <main style="padding: 2rem;">
        <!-- Products Section -->
        <section id="products-section">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1>Gestion des Produits</h1>
                <button class="btn btn-primary" onclick="alert('Ouvrir modal ajout produit')">
                    <i class="fas fa-plus"></i> Nouveau Produit
                </button>
            </div>
            <div
                    style="background: white; border-radius: var(--radius); border: 1px solid var(--border-color); overflow: hidden;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #f8fafc; border-bottom: 1px solid var(--border-color);">
                    <tr>
                        <th style="padding: 1rem; text-align: left;">Produit</th>
                        <th style="padding: 1rem; text-align: left;">Catégorie</th>
                        <th style="padding: 1rem; text-align: left;">Prix</th>
                        <th style="padding: 1rem; text-align: right;">Actions</th>
                    </tr>
                    </thead>
<tbody>
<?php foreach ($products as $product): ?>
    <tr>
        <td>
            <div style="display:flex;align-items:center;gap:10px">
                <img src="../public/assets/images/<?= htmlspecialchars($product['image']) ?>" width="40">
                <?= htmlspecialchars($product['name']) ?>
            </div>
        </td>
        <td><?= htmlspecialchars($product['category']) ?></td>
        <td><?= number_format($product['price'],2) ?> MAD</td>
        <td style="text-align:right">
            <a href="index.php?page=edit-product&id=<?= $product['id'] ?>">
                <i class="fas fa-edit"></i>
            </a>
            |
            <a href="index.php?page=delete-product&id=<?= $product['id'] ?>"
               onclick="return confirm('Supprimer ?')">
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>

                </table>
            </div>
        </section>
        <!-- Categories Section (Placeholder) -->
        <section id="categories-section" style="display: none;">
            <h1>Gestion des Catégories</h1>
            <p>Fonctionnalité à venir...</p>
        </section>
    </main>
</div>
<script src="js/main.js"></script>
<script>
    // Inline script for Admin specific logic to avoid cluttering main.js too much with mock admin code
    // Render Admin Product List
    const adminProductList = document.getElementById('admin-product-list');
    function renderAdminProducts() {
        adminProductList.innerHTML = products.map(product => `
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <img src="${product.image}" style="width: 40px; height: 40px; border-radius: 4px; object-fit: cover;">
                            <span style="font-weight: 500;">${product.name}</span>
                        </div>
                    </td>
                    <td style="padding: 1rem;">
                        <span class="badge" style="--dummy-color: var(--accent-color);">${product.category}</span>
                    </td>
                    <td style="padding: 1rem;">$${product.price.toFixed(2)}</td>
                    <td style="padding: 1rem; text-align: right;">
                        <button class="icon-btn" style="color: var(--secondary-color); margin-right: 0.5rem;"><i class="fas fa-edit"></i></button>
                        <button class="icon-btn" style="color: var(--danger-color);"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `).join('');
    }
    renderAdminProducts();
    // Simple Tab Switching
    function showSection(sectionId) {
        document.getElementById('products-section').style.display = 'none';
        document.getElementById('categories-section').style.display = 'none';
        document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
        event.currentTarget.classList.add('active');
        if (sectionId === 'products') document.getElementById('products-section').style.display = 'block';
        if (sectionId === 'categories') document.getElementById('categories-section').style.display = 'block';
    }
</script>
</body>
</html>