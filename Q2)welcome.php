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
  }
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
	<p>You can view your information <a href="http://localhost/Q2)myinfo.php">here</a>.</p>
	<form method="post" action="http://localhost/Q2)Login.php">
		<input type="submit" name="logout" value="Logout">
	</form>
</body>
</html>

  