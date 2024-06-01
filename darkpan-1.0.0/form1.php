<!DOCTYPE html>
<html>
<head>
  <title>Project Form</title>
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
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Project Form 1</h2>
    <form action="form1.php" method="post">
      <div>
        <label for="site">Site:</label>
        <input type="text" id="site" name="site" placeholder="Enter site name" required>
      </div>
      <div>
        <label for="sqft">Sqft:</label>
        <input type="number" id="sqft" name="sqft" placeholder="Enter square footage" required>
      </div>
      <div>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" placeholder="Enter location" required>
      </div>
      <div>
        <label for="estimate">Estimate:</label>
        <input type="number" id="estimate" name="estimate" placeholder="Enter estimate amount" required>
      </div>
      <div>
        <label for="total">Total:</label>
        <input type="number" id="total" name="total" placeholder="Enter total amount" required>
      </div>
      <div>
        <label for="advance">Advance:</label>
        <input type="number" id="advance" name="advance" placeholder="Enter advance amount" required>
      </div>
      <div>
        <label for="completion-date">Completion Date:</label>
        <input type="date" id="completion-date" name="completion-date" required>
      </div>
      <div class="button-container">
        <button type="submit">Submit</button>
        <button type="reset" class="clear-button">Clear</button>
      </div>
    </form>
  </div>

  <div class="data-container">
    <h2>Project Data</h2>
    <?php
$connection = mysqli_connect("195.35.33.43", "u563041017_adishesha", "Vitvara@123", "u563041017_adishesha");
if (!$connection) {
    die("could not connect: " . mysqli_connect_error());
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data if available
    $le_site = isset($_POST['site']) ? $_POST['site'] : '';
    $le_date = isset($_POST['sqft']) ? $_POST['sqft'] : ''; // Fixed variable name
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $estimate = isset($_POST['estimate']) ? $_POST['estimate'] : '';
    $total = isset($_POST['total']) ? $_POST['total'] : '';
    $advance = isset($_POST['advance']) ? $_POST['advance'] : '';
    $completion_date = isset($_POST['completion-date']) ? $_POST['completion-date'] : '';

    // Insert the data into the database if all required fields are filled
    if ($le_site && $le_date && $location && $estimate && $total && $advance && $completion_date) {
        $query_insert = "INSERT INTO project_form (site, sqft, location, estimate, total, advance, completion_date)
        VALUES ('$le_site', '$le_date', '$location', '$estimate', '$total', '$advance', '$completion_date')";
        $stmt_insert = mysqli_query($connection, $query_insert);

        // Check for query errors
        if (!$stmt_insert) {
            die("Insert query failed: " . mysqli_error($connection));
        }
    } else {
        echo "All fields are required.";
    }
}

// Check if delete was requested
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query_delete = "DELETE FROM project_form WHERE id='$delete_id'";
    $stmt_delete = mysqli_query($connection, $query_delete);
    if (!$stmt_delete) {
        die("Delete query failed: " . mysqli_error($connection));
    }
}

// Display query
$query = "SELECT * FROM u563041017_adishesha.project_form";
$stmt = mysqli_query($connection, $query);
if ($stmt) {
    echo '<div class="data-row"><div class="data-label">ID</div><div class="data-label">Site</div><div class="data-label">Sqft</div><div class="data-label">Location</div><div class="data-label">Estimate</div><div class="data-label">Total</div><div class="data-label">Advance</div><div class="data-label">Completion Date</div><div class="data-label">Actions</div></div>';
    while ($row = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
        echo '<div class="data-row">';
        echo '<div class="data-value">' . $row['id'] . '</div>';
        echo '<div class="data-value">' . $row['site'] . '</div>';
        echo '<div class="data-value">' . $row['sqft'] . '</div>';
        echo '<div class="data-value">' . $row['location'] . '</div>';
        echo '<div class="data-value">' . $row['estimate'] . '</div>';
        echo '<div class="data-value">' . $row['total'] . '</div>';
        echo '<div class="data-value">' . $row['advance'] . '</div>';
        echo '<div class="data-value">' . $row['completion_date'] . '</div>';
        echo '<div class="data-value"><a href="form1.php?delete_id=' . $row['id'] . '"><button class="delete-button">Delete</button></a></div>';
        echo '</div>';
    }
}
?>
  </div>
</body>
</html>
