<?php include '../view/header.php'; ?>

    <main>
        <h1>View/Update Customer</h1>
        <form action="index.php" method="post" id="edit_customer_form">
            <input type="hidden" name="action" value="edit_customer">
            <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">

            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo $first_name ?>">
            <?php if (!empty($first_name_error_message)) { ?>
                <p class="error"><?php echo $first_name_error_message; ?></p>
            <?php } // end if ?>
            <br>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?php echo $last_name ?>">
            <?php if (!empty($last_name_error_message)) { ?>
                <p class="error"><?php echo $last_name_error_message; ?></p>
            <?php } // end if ?>
            <br>

            <label>Address:</label>
            <input type="text" name="address" value="<?php echo $address ?>">
            <?php if (!empty($address_error_message)) { ?>
                <p class="error"><?php echo $address_error_message; ?></p>
            <?php } // end if ?>
            <br>

            <label>City:</label>
            <input type="text" name="city" value="<?php echo $city ?>">
            <?php if (!empty($city_error_message)) { ?>
                <p class="error"><?php echo $city_error_message; ?></p>
            <?php } // end if ?>
            <br>

            <label>State:</label>
            <input type="text" name="state" value="<?php echo $state ?>">
            <?php if (!empty($state_error_message)) { ?>
                <p class="error"><?php echo $state_error_message; ?></p>
            <?php } // end if ?>
            <br>
            
            <label>Postal Code:</label>
            <input type="number" name="postal_code" value="<?php echo $postal_code ?>">
            <?php if (!empty($postal_code_error_message)) { ?>
                <p class="error"><?php echo $postal_code_error_message; ?></p>
            <?php } // end if ?>
            <br>

            <label>Country Code:</label>
            <select name="country_code">
                <?php foreach ($countries as $country) : ?>
                    <option value="<?php echo $country['countryCode']; ?>" <?php if($country['countryCode'] == $country_code) echo 'selected' ?>>
                        <?php echo $country['countryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            
            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $phone ?>">
            <?php if (!empty($phone_error_message)) { ?>
                <p class="error"><?php echo $phone_error_message; ?></p>
            <?php } // end if ?>
            <br>
            
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email ?>">
            <?php if (!empty($email_error_message)) { ?>
                <p class="error"><?php echo $email_error_message; ?></p>
            <?php } // end if ?>
            <br>
            
            <label>Password:</label>
            <input type="text" name="password" value="<?php echo $password ?>">
            <?php if (!empty($password_error_message)) { ?>
                <p class="error"><?php echo $password_error_message; ?></p>
            <?php } // end if ?>
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Update Customer"><br>
        </form>
        <p><a href="customer_list.php">Search Customers</a></p>
    </main>

    <?php include '../view/footer.php'; ?>