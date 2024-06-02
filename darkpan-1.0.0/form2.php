<!DOCTYPE html>
<html>
<head>
    <title>Expense Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
            }

            .form-container,
            .data-container {
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 1200px;
                margin: 20px auto;
            }

            .form-container form,
            .data-container {
                display: flex;
                flex-wrap: wrap;
            }

            .form-container form div,
            .data-container .data-row {
                display: flex;
                width: 100%;
                margin-bottom: 10px;
            }

            .form-container form div label,
            .data-container .data-label {
                width: 20%;
                font-weight: bold;
                padding-right: 10px;
            }

            .form-container form div input,
            .data-container .data-value {
                width: 30%;
                padding: 12px 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .form-container .button-container {
                display: flex;
                justify-content: space-between;
                width: 100%;
            }

            .form-container button {
                background-color: #4CAF50;
                color: white;
                padding: 10px 14px;
                margin-top: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .form-container button.clear-button {
                background-color: #f44336;
            }

            .form-container button:hover {
                background-color: #45a049;
            }

            .form-container button.clear-button:hover {
                background-color: #e53935;
            }

            .data-container .data-value button.delete-button {
                background-color: #f44336;
                color: white;
                padding: 5px 10px ;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .data-container .data-value button.delete-button:hover {
                background-color: #e53935;
            }

            @media (max-width: 600px) {
                .form-container,
                .data-container {
                    margin: 10px;
                    padding: 10px;
                }

                .form-container form div,
                .data-container .data-row {
                    display: flex;
                    width: 100%;
                    margin-bottom: 10px;
                }

                .form-container form div label,
                .data-container .data-label,
                .form-container form div input,
                .data-container .data-value {
                    width: 100%;
                }

                .form-container form div label {
                    margin-bottom: 5px;
                }

                .form-container .button-container {
                    flex-direction: column;
                    align-items: stretch;
                }

                .form-container button {
                    width: 100%;
                    margin: 5px 0;
                }
                
            }

            .data-container {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
    margin: 20px auto;
    overflow-x: auto; /* Add this to allow horizontal scrolling if needed */
}

.data-container .data-row {
    display: flex;
    flex-wrap: nowrap; /* Ensure items stay in a single line */
    justify-content: space-between; /* Distribute items evenly */
    align-items: center; /* Center items vertically */
    padding: 8px 0; /* Adjust padding for better spacing */
}

.data-container .data-value {
    flex: 1; /* Distribute space evenly among values */
    padding: 8px 12px; /* Adjust padding for better spacing */
    overflow: hidden; /* Prevent content from overflowing */
    text-overflow: ellipsis; /* Add ellipsis for overflow text */
    white-space: nowrap; /* Prevent wrapping of text */
    border-right: 1px solid #ccc; /* Add border for clarity */
}

.data-container .data-value:last-child {
    border-right: none; /* Remove border from the last column */
}

.data-container .data-value button.delete-button {
    background-color: #f44336;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.data-container .data-value button.delete-button:hover {
    background-color: #e53935;
}


        

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Expense Management System</h2>
        <form action="" method="post">
            <div>
                <label for="ge_date">Date:</label>
                <input type="date" id="ge_date" name="ge_date">
            </div>
            <div>
                <label for="ge_id">ID:</label>
                <input type="text" id="ge_id" name="ge_id">
            </div>
            <div>
                <label for="ge_description">Description:</label>
                <input type="text" id="ge_description" name="ge_description">
            </div>
            <div>
                <label for="ge_site">Site:</label>
                <input type="text" id="ge_site" name="ge_site">
            </div>
            <div>
                <label for="ge_m_labour">Labour-M:</label>
                <input type="text" id="ge_m_labour" name="ge_m_labour">
            </div>
            <div>
                <label for="ge_f_labour">Labour-F:</label>
                <input type="text" id="ge_f_labour" name="ge_f_labour">
            </div>
            <div>
                <label for="ge_labour_payment">Labour Payment:</label>
                <input type="text" id="ge_labour_payment" name="ge_labour_payment">
            </div>
            <div>
                <label for="ge_paymentmode">Payment mode:</label>
                <input type="text" id="ge_paymentmode" name="ge_paymentmode">
            </div>
            <div>
                <label for="ge_machine">Machine:</label>
                <input type="text" id="ge_machine" name="ge_machine">
            </div>
            <div>
                <label for="ge_machine_payment">Machine Payment:</label>
                <input type="text" id="ge_machine_payment" name="ge_machine_payment">
            </div>
            <div>
                <label for="ge_vendor">Vendor:</label>
                <input type="text" id="ge_vendor" name="ge_vendor">
            </div>
            <div>
                <label for="ge_transportation">Transportation:</label>
                <input type="text" id="ge_transportation" name="ge_transportation">
            </div>
            <div>
                <label for="ge_fuel">Fuel:</label>
                <input type="text" id="ge_fuel" name="ge_fuel">
            </div>
            <div>
                <label for="ge_food">Food:</label>
                <input type="text" id="ge_food" name="ge_food">
            </div>
            <div>
                <label for="ge_other_expenses">Other Expense:</label>
                <input type="text" id="ge_other_expenses" name="ge_other_expenses">
            </div>
            <div class="button-container">
                <button type="submit">Submit</button>
                <button type="reset" class="clear-button">Clear</button>
            </div>
        </form>
    </div>

    <div class="data-container">
        <h2>Expense Data</h2>
        <?php
        $connection = mysqli_connect("195.35.33.43", "u563041017_adishesha", "Vitvara@123", "u563041017_adishesha");

        if (!$connection) {
            die("Could not connect: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ge_id = $_POST['ge_id'];
            $ge_site = $_POST['ge_site'];
            $ge_date = $_POST['ge_date'];
            $ge_f_labour = $_POST['ge_f_labour'];
            $ge_m_labour = $_POST['ge_m_labour'];
            $ge_machine_payment = $_POST['ge_machine_payment'];
            $ge_labour_payment = $_POST['ge_labour_payment'];
            $ge_vendor = $_POST['ge_vendor'];
            $ge_transportation = $_POST['ge_transportation'];
            $ge_fuel = $_POST['ge_fuel'];
            $ge_food = $_POST['ge_food'];
            $ge_other_expenses = $_POST['ge_other_expenses'];
            $ge_description = $_POST['ge_description'];
            $ge_paymentmode = $_POST['ge_paymentmode'];
            $ge_machine = $_POST['ge_machine'];

            $insert_query = "INSERT INTO u563041017_adishesha.expense_form (ge_id, ge_site, ge_date, ge_f_labour, ge_m_labour, ge_labour_payment, ge_machine_payment, ge_vendor, ge_transportation, ge_fuel, ge_food, ge_other_expenses, ge_description, ge_paymentmode, ge_machine)
                            VALUES ('$ge_id', '$ge_site', '$ge_date', '$ge_f_labour', '$ge_m_labour', '$ge_labour_payment', '$ge_machine_payment', '$ge_vendor', '$ge_transportation', '$ge_fuel', '$ge_food', '$ge_other_expenses', '$ge_description', '$ge_paymentmode', '$ge_machine')";

            if (mysqli_query($connection, $insert_query)) {
                echo "New record created successfully.<br>";
            } else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($connection);
            }
        }

        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $query_delete = "DELETE FROM expense_form WHERE ge_id='$delete_id'";
            $stmt_delete = mysqli_query($connection, $query_delete);
            if (!$stmt_delete) {
                die("Delete query failed: " . mysqli_error($connection));
            }
        }


        $query = "SELECT * FROM u563041017_adishesha.expense_form";
        $stmt = mysqli_query($connection, $query);


        

        if ($stmt) {
            echo '<div class="data-row"><div class="data-label">ID</div><div class="data-label">Site</div><div class="data-label">Date</div><div class="data-label">Labour-M</div><div class="data-label">Labour-F</div><div class="data-label">Labour Payment</div><div class="data-label">Machine Payment</div><div class="data-label">Vendor</div><div class="data-label">Transportation</div><div class="data-label">Fuel</div><div class="data-label">Food</div><div class="data-label">Other Expense</div><div class="data-label">Description</div><div class="data-label">Payment Mode</div><div class="data-label">Machine</div><div class="data-label">Action</div></div>';
            while ($row = mysqli_fetch_assoc($stmt)) {
                echo '<div class="data-row">';
                echo '<div class="data-value">' . $row['ge_id'] . '</div>';
                echo '<div class="data-value">' . $row['ge_site'] . '</div>';
                echo '<div class="data-value">' . $row['ge_date'] . '</div>';
                echo '<div class="data-value">' . $row['ge_m_labour'] . '</div>';
                echo '<div class="data-value">' . $row['ge_f_labour'] . '</div>';
                echo '<div class="data-value">' . $row['ge_labour_payment'] . '</div>';
                echo '<div class="data-value">' . $row['ge_machine_payment'] . '</div>';
                echo '<div class="data-value">' . $row['ge_vendor'] . '</div>';
                echo '<div class="data-value">' . $row['ge_transportation'] . '</div>';
                echo '<div class="data-value">' . $row['ge_fuel'] . '</div>';
                echo '<div class="data-value">' . $row['ge_food'] . '</div>';
                echo '<div class="data-value">' . $row['ge_other_expenses'] . '</div>';
                echo '<div class="data-value">' . $row['ge_description'] . '</div>';
                echo '<div class="data-value">' . $row['ge_paymentmode'] . '</div>';
                echo '<div class="data-value">' . $row['ge_machine'] . '</div>';
                echo '<div class="data-value"><a href="form2.php?delete_id=' . $row['ge_id'] . '"><button class="delete-button">Delete</button></a></div>';
                echo '</div>';
            }
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($connection);
        }

        mysqli_close($connection);
        ?>
    </div>
</body>
</html>
