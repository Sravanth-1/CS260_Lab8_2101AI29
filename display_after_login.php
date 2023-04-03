<?php
session_start(); // start the session
if(isset($_SESSION['email'])) { // check if user is logged in
  $email = $_SESSION['email']; // get user's email from session
  // query the database to get user's information
  $conn = new mysqli('localhost', 'root', 'Devisyam@2003', 'dblab8');
  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $id = $row['id'];
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
    }
    
    h1 {
      text-align: center;
      color: #555;
    }
    
    .info {
      background-color: #fff;
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0px 2px 5px rgba(0,0,0,0.3);
    }
    
    .info p {
      font-size: 16px;
      color: #333;
      margin-bottom: 10px;
    }
    
    .info p strong {
      font-weight: bold;
      color: #555;
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <h1>My Information</h1>
  <div class="info">
    <p><strong>First Name:</strong> <?php echo $first_name; ?></p>
    <p><strong>Last Name:</strong> <?php echo $last_name; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>UserID:</strong> <?php echo $id; ?></p>
  </div>
</body>
</html>


<?php
} else { // if user is not logged in, redirect to login page
  header("Location: login.php");
  exit();
}
?>
