<!DOCTYPE html>
<html>
<head>
	<title>User Registration Form</title>
	<style>
		form {
			max-width: 500px;
			margin: 0 auto;
			padding: 20px;
			background-color: #f2f2f2;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		h2 {
			text-align: center;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		label {
			display: block;
			margin-bottom: 10px;
		}
		input[type="text"], input[type="email"], input[type="password"] {
			display: block;
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 20px;
			font-size: 16px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		p {
			margin-top: 20px;
			text-align: center;
		}
	</style>
</head>
<body>
	<h2>User Registration Form</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="firstname">Enter Your First Name:</label>
		<input type="text" name="firstname" required>

		<label for="lastname">Enter Your Last Name:</label>
		<input type="text" name="lastname" required>

		<label for="email">Enter Your Email:</label>
		<input type="email" name="email" required>

		<label for="password">Create Password:</label>
		<input type="password" name="password" required>

		<label for="confirmpassword">Confirm Password:</label>
		<input type="password" name="confirmpassword" required>

		<input type="submit" value="Submit">
	</form>

	<?php
	// Set up MySQL database connection
	$servername = "localhost";
	$username = "root";
	$password = "Devisyam@2003";
	$dbname = "dblab8";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Create "users" table if it doesn't exist
	mysqli_select_db($conn, $dbname);
	$sql = "CREATE TABLE IF NOT EXISTS users (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		first_name VARCHAR(30) NOT NULL,
		last_name VARCHAR(30) NOT NULL,
		email VARCHAR(50) NOT NULL,
		password VARCHAR(255) NOT NULL
	)";
	if (!mysqli_query($conn, $sql)) {
		echo "Error creating table: " . mysqli_error($conn) . "<br>";
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

		// Email validation
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email format. Please enter a valid email address.<br>";
		}

		// Password validation
		if (strlen($password) < 8) {
			echo "Password must be at least 8 characters long.<br>";
		}
		if (!preg_match("#[0-9]+#", $password)) {
			echo "Password must include at least one number.<br>";
		}
		if (!preg_match("#[a-zA-Z]+#", $password)) {
			echo "Password must include at least one letter.<br>";
		}
		if ($password != $confirmpassword) {
			echo "Passwords do not match.<br>";
		}

		// Insert form data into MySQL database if validation passes
	if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 8 && preg_match("#[0-9]+#", $password) && preg_match("#[a-zA-Z]+#", $password) && ($password == $confirmpassword)) {
		$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
		if (mysqli_query($conn, $sql)) {
			$id = mysqli_insert_id($conn);
			echo "<p style='font-size: 16px; font-weight: bold;'>User registration successful. Your user ID is $id.</p>";
			echo "<p style='font-size: 16px;'>Please remember your id in order to login.</p>";

		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}

mysqli_close($conn);
?>
 <p>Need to update your account? <a href="http://localhost/login.php">to login & update</a></p>
	   <p>Need to delete account? <a href="http://localhost/login.php">to login & delete</a></p>