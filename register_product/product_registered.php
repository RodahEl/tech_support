<?php include '../view/header.php'; ?>
<main>
    <h1>Register Product</h1>
    <form action="index.php" method="post" id="product_registered">
        <input type="hidden" name="action" value="product_registered">

        <label>Product (<?php echo $product_code ?>) was registerd successfully</label>
        <br>
        
    </form>
</main>
<?php include '../view/footer.php'; ?>