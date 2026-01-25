<div class="container">
    <h2>🧾 Passer la commande</h2>

    <form action="index.php?page=place-order" method="POST">
        <input type="text" name="fullname" placeholder="Nom complet" required>
        <input type="tel" name="phone" placeholder="Téléphone" required>
        <textarea name="address" placeholder="Adresse complète" required></textarea>

        <button class="btn checkout">Confirmer la commande</button>
    </form>
</div>
<?php
