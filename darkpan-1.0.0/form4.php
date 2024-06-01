<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .form-container {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 1000px;
      margin: 20px auto;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    .form-group {
      margin-bottom: 10px;
      
    }
    
    
    

    label {
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 12px 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      order: 1;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }

    button[type="reset"] {
      background-color: #f44336;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      order: 2;
    }

    button[type="reset"]:hover {
      background-color: #d32f2f;
    }

    .data-container {
        background-color: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 1000px;
      margin: 20px auto;
    }

    
    .data-row {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #ccc;
      padding: 10px 0;
    }

    .data-label {
      font-weight: bold;
      flex-basis: 15%;
    }

    .data-value {
      flex-basis: 15%;
    }

    .delete-button {
      background-color: #f44336;
      color: white;
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .delete-button:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Project Form 4</h1>
    <form action="form4.php" method="post">
      <div class="form-group">
        <label for="pe_id">ID:</label>
        <input type="text" id="pe_id" name="pe_id" placeholder="Enter ID" required>
      </div>
      <div class="form-group">
        <label for="pe_site">Site:</label>
        <input type="text" id="pe_site" name="pe_site" placeholder="Enter site" required>
      </div>
      <div class="form-group">
        <label for="pe_date">Date:</label>
        <input type="date" id="pe_date" name="pe_date" required>
      </div>
      <div class="form-group">
        <label for="pe_type">Type:</label>
        <select id="pe_type" name="pe_type" required>
          <option value="" disabled selected>Select Type</option>
          <option value="earthwork">Earth work</option>
          <option value="shuttering-barbending">Shuttering and Barbending</option>
          <option value="stone-masonry">Stone Masonry</option>
          <option value="electrical">Electrical</option>
          <option value="plumbing">Plumbing</option>
          <option value="plastering">Plastering</option>
          <option value="painting">Painting</option>
          <option value="doors-windows">Doors and Windows</option>
          <option value="flooring">Flooring</option>
          <option value="interior">Interior</option>
          <option value="other">Other Works</option>
        </select>
      </div>
      <div class="form-group">
        <label for="pe_payment">Payment:</label>
        <input type="text" id="pe_payment" name="pe_payment" placeholder="Enter payment" required>
      </div>
      <div class="form-group">
        <label for="pe_sqft">Sqft:</label>
        <input type="number" id="pe_sqft" name="pe_sqft" placeholder="Enter square feet" required>
      </div>
      <div class="button-container">
        <button type="submit">Submit</button>
        <button type="reset">Clear</button>
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
        $pe_id = isset($_POST['pe_id']) ? $_POST['pe_id'] : '';
        $pe_site = isset($_POST['pe_site']) ? $_POST['pe_site'] : '';
        $pe_date = isset($_POST['pe_date']) ? $_POST['pe_date'] : '';
        $pe_type = isset($_POST['pe_type']) ? $_POST['pe_type'] : '';
        $pe_payment = isset($_POST['pe_payment']) ? $_POST['pe_payment'] : '';
        $pe_sqft = isset($_POST['pe_sqft']) ? $_POST['pe_sqft'] : '';

        if ($pe_id && $pe_site && $pe_date && $pe_type && $pe_payment && $pe_sqft) {
            $query_insert = "INSERT INTO expense (pe_id, pe_site, pe_date, pe_type, pe_payment, pe_sqft)
            VALUES ('$pe_id', '$pe_site', '$pe_date', '$pe_type', '$pe_payment', '$pe_sqft')";
            $stmt_insert = mysqli_query($connection, $query_insert);

            if (!$stmt_insert) {
                die("Insert query failed: " . mysqli_error($connection));
            }
        } else {
            echo "All fields are required.";
        }
    }

    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $query_delete = "DELETE FROM expense WHERE pe_id='$delete_id'";
        $stmt_delete = mysqli_query($connection, $query_delete);
        if (!$stmt_delete) {
            die("Delete query failed: " . mysqli_error($connection));
        }
    }

    $query = "SELECT * FROM expense";
    $stmt = mysqli_query($connection, $query);
    if ($stmt) {
        echo '<div class="data-row"><div class="data-label">ID</div><div class="data-label">Site</div><div class="data-label">Date</div><div class="data-label">Type</div><div class="data-label">Payment</div><div class="data-label">Sqft</div><div class="data-label">Actions</div></div>';
        while ($row = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
            echo '<div class="data-row">';
            echo '<div class="data-value">' . $row['pe_id'] . '</div>';
            echo '<div class="data-value">' . $row['pe_site'] . '</div>';
            echo '<div class="data-value">' . $row['pe_date'] . '</div>';
            echo '<div class="data-value">' . $row['pe_type'] . '</div>';
            echo '<div class="data-value">' . $row['pe_payment'] . '</div>';
            echo '<div class="data-value">' . $row['pe_sqft'] . '</div>';
            echo '<div class="data-value"><a href="form4.php?delete_id=' . $row['pe_id'] . '"><button class="delete-button">Delete</button></a></div>';
            echo '</div>';
        }
    }
    ?>
  </div>
</body>
</html>