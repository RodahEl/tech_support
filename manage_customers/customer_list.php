<?php include '../view/header.php'; ?>
<main>
    <h1>Customer Search</h1>
    <form action="index.php" method="post" id="search_customer_form">
        <input type="hidden" name="action" value="search_customers">

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $last_name ?>" />
        <input type="submit" value="Search" />

    </form>
    <section>
        <!-- display a table of customers -->

        <h1>Results</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
            <tr>
                <td><?php echo $customer['firstName'] . ' ' . $customer['lastName']; ?></td>
                <td><?php echo $customer['email']; ?></td>
                <td><?php echo $customer['city']; ?></td>
                <td>
                    <form action="index.php" method="post" id="customer_edit_form">
                        <input type="hidden" name="action" value="show_edit_form">
                        <input type="hidden" name="customer_id" value="<?php echo $customer['customerID'] ?>">
                        <input type="submit" value="Select" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>
<?php include '../view/footer.php'; ?>