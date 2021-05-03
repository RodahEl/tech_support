<?php
    session_start();
    if (isset($_SESSION['customer'])) { 
        // header("Location: login_customer.php");
        header("Location: index.php?action=login_customer");
    }
?>
<?php include '../view/header.php'; ?>
<main>
    <h1>Customer Login</h1>
    <form action="index.php" method="post" id="login_customer_form">
        <input type="hidden" name="action" value="login_customer">

        <p>You must login before you can register a product</p>
        <label>Email:</label>
        <input type="email" name="email" />
        <input type="submit" value="Login" />

    </form>
</main>
<?php include '../view/footer.php'; ?>