<?php
$connection = mysqli_connect("195.35.33.43", "u563041017_adishesha", "Vitvara@123", "u563041017_adishesha");
if (!$connection) {
    die("could not connect: " . mysqli_connect_error());
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data if available
    $me_id = isset($_POST['id']) ? $_POST['id'] : '';
    $me_site = isset($_POST['site']) ? $_POST['site'] : '';
    $me_material = isset($_POST['material']) ? $_POST['material'] : '';
    $me_quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $me_date = isset($_POST['date']) ? $_POST['date'] : '';
    $me_time = isset($_POST['time']) ? $_POST['time'] : '';
    $me_material_vendor = isset($_POST['material_vendor']) ? $_POST['material_vendor'] : '';
    $me_bill = isset($_POST['bill']) ? $_POST['bill'] : ''; 
    $me_payment = isset($_POST['payment']) ? $_POST['payment'] : '';

    // Insert the data into the database if all required fields are filled
    if ($me_id && $me_site && $me_material && $me_quantity && $me_date && $me_time && $me_material_vendor && $me_bill && $me_payment) {
        $query_insert = "INSERT INTO material_form (me_id, me_site, me_material, me_quantity, me_date, me_time, me_material_vendor, me_bill, me_payment) 
                         VALUES ('$me_id', '$me_site', '$me_material', '$me_quantity', '$me_date', '$me_time', '$me_material_vendor', '$me_bill', '$me_payment')";
        $stmt_insert = mysqli_query($connection, $query_insert);

        // Check for query errors
        if (!$stmt_insert) {
            die("Insert query failed: " . mysqli_error($connection));
        } else {
            echo "Data inserted successfully.";
        }
    } else {
        echo "All fields are required.";
    }
}

// Delete record if delete button is clicked
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query_delete = "DELETE FROM material_form WHERE me_id = '$delete_id'";
    $stmt_delete = mysqli_query($connection, $query_delete);

    if (!$stmt_delete) {
        die("Delete query failed: " . mysqli_error($connection));
    } else {
        echo "Record deleted successfully.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Form</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Added box-shadow */
            width: 90%;
            max-width: 600px;
            box-sizing: border-box;
            text-align: center;
            margin-top: 20px;
        }

        .records-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 1000px;
            box-sizing: border-box;
            text-align: center;
            margin-top: 20px;
        }

        .form-container h2, .records-container h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 500;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            align-self: flex-start;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 5px rgba(128, 189, 255, 0.5);
        }

        .button-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        input[type="submit"], .clear-btn {
            width: 48%;
            padding: 12px;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .clear-btn {
            background-color: #6c757d;
        }

        .clear-btn:hover {
            background-color: #5a6268;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 500;
            color: #495057;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        @media (max-width: 600px) {
            .form-container, .records-container {
                padding: 20px;
                width: 100%;
            }

            .button-container {
                flex-direction: column;
                align-items: center;
            }

            input[type="submit"], .clear-btn {
                width: 100%;
                font-size: 14px;
                padding: 10px;
                margin-top: 5px;
            }

            .form-container h2, .records-container h2 {
                font-size: 22px;
            }

            .delete-btn {
                padding: 5px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Material Expense</h2>
        <form action="" method="post">
            <label for="id">ID:</label>
            <input type="text" id="me_id" name="id" placeholder="Enter ID" required>

            <label for="site">Site:</label>
            <input type="text" id="me_site" name="site" placeholder="Enter Site" required>

            <label for="material">Material:</label>
            <input type="text" id="me_material" name="material" placeholder="Enter Material" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="me_quantity" name="quantity" placeholder="Enter Quantity" required>

            <label for="date">Date:</label>
            <input type="date" id="me_date" name="date" required>

            <label for="time">Time:</label>
            <input type="time" id="me_time" name="time" required>

            <label for="material_vendor">Vendor:</label>
            <input type="text" id="me_material_vendor" name="material_vendor" placeholder="Enter Vendor" required>

            <label for="bill">Bill:</label>
            <input type="text" id="me_bill" name="bill" placeholder="Enter Bill" required>

            <label for="payment">Payment:</label>
            <input type="text" id="me_payment" name="payment" placeholder="Enter Payment" required>

            <div class="button-container">
                <input type="submit" value="Submit">
                <button type="button" class="clear-btn" onclick="clearForm()">Clear</button>
            </div>
        </form>
    </div>

    <div class="records-container">
        <h2>Recorded Data</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Site</th>
                    <th>Material</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Vendor</th>
                    <th>Bill</th>
                    <th>Payment</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query_select = "SELECT * FROM material_form";
                $stmt_select = mysqli_query($connection, $query_select);
                while ($row = mysqli_fetch_assoc($stmt_select)) {
                    echo "<tr>";
                    echo "<td>{$row['me_id']}</td>";
                    echo "<td>{$row['me_site']}</td>";
                    echo "<td>{$row['me_material']}</td>";
                    echo "<td>{$row['me_quantity']}</td>";
                    echo "<td>{$row['me_date']}</td>";
                    echo "<td>{$row['me_time']}</td>";
                    echo "<td>{$row['me_material_vendor']}</td>";
                    echo "<td>{$row['me_bill']}</td>";
                    echo "<td>{$row['me_payment']}</td>";
                    echo "<td><a href='?delete_id={$row['me_id']}' class='delete-btn'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function clearForm() {
            document.getElementById("me_id").value = "";
            document.getElementById("me_site").value = "";
            document.getElementById("me_material").value = "";
            document.getElementById("me_quantity").value = "";
            document.getElementById("me_date").value = "";
            document.getElementById("me_time").value = "";
            document.getElementById("me_material_vendor").value = "";
            document.getElementById("me_bill").value = "";
            document.getElementById("me_payment").value = "";
        }
    </script>
</body>
</html>
