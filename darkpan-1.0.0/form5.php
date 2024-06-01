<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Form</title>
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
.data-container .data-value,
.form-container form div select {
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
    padding: 5px 10px;
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
        flex-direction: column;
    }

    .form-container form div label,
    .data-container .data-label,
    .form-container form div input,
    .data-container .data-value,
    .form-container form div select {
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

    </style>
</head>
<body>
<div class="form-container">
    <h2>Le Form</h2>
    <form action="form5.php" method="post">
    <div>
    <label for="le_state">State:</label>
    <select id="le_state" name="le_state" required class="custom-select">
        <option value="">Select state</option>
        <option value="received">Received</option>
        <option value="sent">Sent</option>
    </select>
    </div>
        <div>
            <label for="le_site">Site:</label>
            <input type="text" id="le_site" name="le_site" placeholder="Enter site" required>
        </div>
        <div>
            <label for="le_date">Date:</label>
            <input type="date" id="le_date" name="le_date" required>
        </div>
        <div>
            <label for="le_amount">Amount:</label>
            <input type="number" id="le_amount" name="le_amount" step="0.01" placeholder="Enter amount" required>
        </div>
        <div>
            <label for="le_payment">Payment:</label>
            <input type="text" id="le_payment" name="le_payment" placeholder="Enter payment" required>
        </div>
        <div>
            <label for="le_to">To:</label>
            <input type="text" id="le_to" name="le_to" placeholder="Enter recipient" required>
        </div>
        <div class="button-container">
            <button type="submit">Submit</button>
            <button type="reset" class="clear-button">Clear</button> 
        </div>
    </form>
</div>

<div class="data-container">
    <h2>Le Form Data</h2>
    <?php
    $connection = mysqli_connect("195.35.33.43", "u563041017_adishesha", "Vitvara@123", "u563041017_adishesha");
    if (!$connection) {
        die("Could not connect: " . mysqli_connect_error());
    }

    // Check if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $le_state = isset($_POST['le_state']) ? $_POST['le_state'] : '';
        $le_site = isset($_POST['le_site']) ? $_POST['le_site'] : '';
        $le_date = isset($_POST['le_date']) ? $_POST['le_date'] : '';
        $le_amount = isset($_POST['le_amount']) ? $_POST['le_amount'] : '';
        $le_payment = isset($_POST['le_payment']) ? $_POST['le_payment'] : '';
        $le_to = isset($_POST['le_to']) ? $_POST['le_to'] : '';

        // Insert the data into the database if all required fields are filled
        if ($le_state && $le_site && $le_date && $le_amount && $le_payment && $le_to) {
            // Prepare and bind parameters to avoid SQL injection
            $query_insert = "INSERT INTO le (le_state, le_site, le_date, le_amount, le_payment, le_to) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = mysqli_prepare($connection, $query_insert);
            mysqli_stmt_bind_param($stmt_insert, 'ssssss', $le_state, $le_site, $le_date, $le_amount, $le_payment, $le_to);

            // Execute the statement
            if (mysqli_stmt_execute($stmt_insert)) {
                //echo "Record inserted successfully.";
            } else {
                // Handle duplicate entry error
                if (mysqli_errno($connection) == 1062) {
                    echo "Duplicate entry detected. Please check your input.";
                } else {
                    echo "Error: " . mysqli_error($connection);
                }
            }

            // Close statement
            mysqli_stmt_close($stmt_insert);
        } else {
            echo "All fields are required.";
        }
    }

    // Check if delete was requested
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        // Use prepared statement to delete
        $query_delete = "DELETE FROM le WHERE le_id = ?";
        $stmt_delete = mysqli_prepare($connection, $query_delete);
        mysqli_stmt_bind_param($stmt_delete, 'i', $delete_id);

        if (mysqli_stmt_execute($stmt_delete)) {
            //echo "Record deleted successfully.";
        } else {
            echo "Delete query failed: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt_delete);
    }

    // Display query for "le" form
$query = "SELECT * FROM le";
$stmt = mysqli_query($connection, $query);
if ($stmt) {
    echo '<div class="data-row"><div class="data-label">ID</div><div class="data-label">State</div><div class="data-label">Site</div><div class="data-label">Date</div><div class="data-label">Amount</div><div class="data-label">Payment</div><div class="data-label">Recipient</div><div class="data-label">Actions</div></div>';
    while ($row = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
        echo '<div class="data-row">';
        echo '<div class="data-value">' . $row['le_id'] . '</div>';
        echo '<div class="data-value">' . $row['le_state'] . '</div>';
        echo '<div class="data-value">' . $row['le_site'] . '</div>';
        echo '<div class="data-value">' . $row['le_date'] . '</div>';
        echo '<div class="data-value">' . $row['le_amount'] . '</div>';
        echo '<div class="data-value">' . $row['le_payment'] . '</div>';
        echo '<div class="data-value">' . $row['le_to'] . '</div>';
        echo '<div class="data-value"><a href="?delete_id=' . $row['le_id'] . '"><button class="delete-button">Delete</button></a></div>';
        echo '</div>';
    }
} else {
    echo "Error displaying data: " . mysqli_error($connection);
}

    // Close connection
    mysqli_close($connection);
    ?>
</div>
</body>
</html>
