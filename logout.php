<?php
session_start(); // start the session
if(isset($_SESSION['email'])) { // check if user is logged in
  if(isset($_POST['confirm'])) { // check if user has confirmed account deletion
    $email = $_SESSION['email']; // get user's email from session
    // query the database to delete user's data
    $conn = new mysqli('localhost', 'root', 'Devisyam@2003', 'dblab8');
    $sql = "DELETE FROM users WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
      // user data deleted successfully, redirect to logout page
      header("Location: http://localhost/testing.php");
      exit();
    } else {
      echo "Error deleting record: " . $conn->error;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Account</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }
    p {
      font-size: 18px;
      margin-bottom: 20px;
    }
    form {
      display: inline-block;
      margin-right: 20px;
    }
    input[type="submit"] {
      background-color: red;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 18px;
      cursor: pointer;
    }
    button {
      background-color: #eee;
      color: black;
      border: none;
      padding: 10px 20px;
      font-size: 18px;
      cursor: pointer;
    }
    button:hover {
      background-color: #ddd;
    }
  </style>
</head>
<body>
  <h1>Delete Account</h1>
  <p>Are you sure you want to delete your account?</p>
  <form method="post">
    <input type="submit" name="confirm" value="Yes">
  </form>
  <button><a href="http://localhost/welcome.php">No</a></button>
</body>
</html>

<?php
} else { // if user is not logged in, redirect to login page
  header("Location: login.php");
  exit();
}
?>
