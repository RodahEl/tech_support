<?php include '../view/header.php'; ?>
<main>
    <h1>Create Incident</h1>
    <form action="index.php" method="post" id="register_incident_form">
        <input type="hidden" name="action" value="register_incident">
        <input type="hidden" name="customer_id" value="<?php echo $customer['customerID'] ?>">

        <label>Customer:</label>
        <label><?php echo $customer['firstName'] . ' ' . $customer['lastName'] ?></label>
        <br>
        
        <label>Product:</label>
        <select name="product_code">
            <?php foreach ($products as $product) : ?>
                <option value="<?php echo $product['productCode']; ?>">
                    <?php echo $product['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        
        <label>Title:</label>
        <input type="text" name="title" />
        <br>

        <label>Description:</label>
        <textarea name="description" rows="5" cols="40"></textarea>
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Create Incident" />
        <br>
    </form>
</main>
<?php include '../view/footer.php'; ?>