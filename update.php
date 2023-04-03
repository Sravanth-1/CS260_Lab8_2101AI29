<?php
// Start session and connect to database
session_start();

$servername = "localhost";
$username = "root";
$password = "Devisyam@2003";
$dbname = "dblab8";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user's current information
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  // Update user's information in database
  $query = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email'";
  if (!empty($password)) {
    $query .= ", password='$password'";
  }
  $query .= " WHERE id='$id'";
  mysqli_query($conn, $query);

  // Get updated user information
  $query = "SELECT * FROM users WHERE id='$id'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Update Information</title>
  <style>
		
    body {
  background-color: #f5f5f5;
  font-family: Arial, sans-serif;
}

#form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

#form-wrapper {
  text-align: center;
  background-color: #fff;
  border-radius: 10px;
  padding: 30px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
  color: #555;
}

input[type="text"],
input[type="password"] {
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: 1px solid #ccc;
  width: 100%;
}

input[type="submit"] {
  padding: 10px 20px;
  background-color: #337ab7;
  color: #fff;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #286090;
}

ul {
  margin-top: 20px;
  padding-left: 0;
}

li {
  list-style: none;
  margin-bottom: 10px;
}

li strong {
  display: inline-block;
  width: 150px;
  font-weight: normal;
  color: #555;
}

	</style>
</head>
<body>
  <h1>Update Information</h1>

  <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <p>Your information has been updated:</p>
    <ul>
      <li><strong>First Name:</strong> <?php echo $user['first_name']; ?></li>
      <li><strong>Last Name:</strong> <?php echo $user['last_name']; ?></li>
      <li><strong>Email:</strong> <?php echo $user['email']; ?></li>
    </ul>
  <?php endif; ?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <label for="email">Email:</label>
    <input type="text" name="email" value="<?php echo $user['email']; ?>">
    <br>
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>">
    <br>
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>">
    <br>
    <label for="password">New Password:</label>
    <input type="password" name="password">
    <br>
    <input type="submit" value="Update">
  </form>
</body>
</html>


<?php
// Close database connection
mysqli_close($conn);
?> 
