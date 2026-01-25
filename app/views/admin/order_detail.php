<form method="post" action="index.php?page=update-order-status">
    <input type="hidden" name="id" value="<?= $order['id'] ?>">

    <select name="status">
        <option value="pending">pending</option>
        <option value="processing">processing</option>
        <option value="completed">completed</option>
        <option value="cancelled">cancelled</option>
    </select>

    <button>Mettre à jour</button>
</form>
