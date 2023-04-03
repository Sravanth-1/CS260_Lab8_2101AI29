<?php
session_start(); // start the session
if(isset($_SESSION['id'])) { // check if user is logged in
  $id = $_SESSION['id']; // get user's email from session
  // query the database to get user's information
  $conn = new mysqli('localhost', 'root', 'Devisyam@2003', 'dblab8');
  $sql = "SELECT * FROM users WHERE id='$id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
	$email = $row['email'];
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		h1 {
			text-align: center;
			margin-top: 50px;
		}

		p {
			text-align: center;
			margin-top: 20px;
		}

		a {
			color: blue;
		}

		form {
			display: flex;
			justify-content: center;
			margin-top: 20px;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 5px;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
  <h1>Welcome, <?php echo $first_name.' '.$last_name; ?></h1>
  <p>You can view your information <a href="http://localhost/display_after_login.php">here</a>.</p>
  <p>You can update your account details <a href="http://localhost/update.php">here</a>.</p>
  <p>You can delete your account after confirmation<a href="http://localhost/logout.php">here</a>.</p>
  <form method="post" action="http://localhost/login.php">
    <input type="submit" name="logout" value="Logout">
  </form>
</body>
</html>

<?php
} else { // if user is not logged in, redirect to login page
  header("Location: login.php");
  exit();
}
?>
