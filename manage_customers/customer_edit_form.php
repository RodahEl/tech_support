<?php include '../view/header.php'; ?>

    <main>
        <h1>View/Update Customer</h1>
        <form action="index.php" method="post" id="edit_customer_form">
            <input type="hidden" name="action" value="edit_customer">
            <input type="hidden" name="customer_id" value="<?php echo $customer['customerID'] ?>">

            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo $customer['firstName'] ?>"><br>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?php echo $customer['lastName'] ?>"><br>

            <label>Address:</label>
            <input type="text" name="address" value="<?php echo $customer['address'] ?>"><br>

            <label>City:</label>
            <input type="text" name="city" value="<?php echo $customer['city'] ?>"><br>

            <label>State:</label>
            <input type="text" name="state" value="<?php echo $customer['state'] ?>"><br>
            
            <label>Postal Code:</label>
            <input type="number" name="postal_code" value="<?php echo $customer['postalCode'] ?>"><br>

            <label>Country Code:</label>
            <select name="country_code">
                <?php foreach ($countries as $country) : ?>
                    <option value="<?php echo $country['countryCode']; ?>" <?php if($country['countryCode'] == $customer['countryCode']) echo 'selected' ?>>
                        <?php echo $country['countryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            
            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $customer['phone'] ?>"><br>
            
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $customer['email'] ?>"><br>
            
            <label>Password:</label>
            <input type="text" name="password" value="<?php echo $customer['password'] ?>"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Update Customer"><br>
        </form>
        <p><a href="customer_list.php">Search Customers</a></p>
    </main>

    <?php include '../view/footer.php'; ?>