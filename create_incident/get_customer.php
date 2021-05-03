<?php include '../view/header.php'; ?>
<main>
    <h1>Get Customer</h1>
    <form action="index.php" method="post" id="get_customer_form">
        <input type="hidden" name="action" value="get_customer_form">

        <p>You must enter the customer's email address to select the customer</p>
        <label>Email:</label>
        <input type="email" name="email" />
        <input type="submit" value="Get Customer" />

    </form>
</main>
<?php include '../view/footer.php'; ?>