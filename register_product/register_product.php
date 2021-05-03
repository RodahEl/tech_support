<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product</h1>
    <form action="index.php" method="post" id="register_product_form">
        <input type="hidden" name="action" value="register_product">
        <input type="hidden" name="email" value="<?php echo $email ?>">

        <label>Customer:</label>
        <label><?php echo $email ?></label>
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

        <label>&nbsp;</label>
        <input type="submit" value="Register Product" />
        <br>
    </form>
    
    <?php if(isset($_SESSION['customer'])) { ?>
        <label>You are logged in as <?php echo $_SESSION['customer']['email']; ?></label>
        <form action="index.php" method="post" id="logout_form">
            <input type="hidden" name="action" value="logout">
            <input type="submit" value="Logout" />
        </form>
    <?php } ?>

</main>
<?php include '../view/footer.php'; ?>