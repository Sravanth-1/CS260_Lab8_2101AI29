<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<style>
		body {
			background-color: #f1f1f1;
			font-family: Arial, sans-serif;
		}
		h2 {
			text-align: center;
			margin-top: 50px;
			color: #333;
		}
		form {
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
			max-width: 400px;
			margin: 0 auto;
			margin-top: 30px;
		}
		label {
			display: block;
			margin-bottom: 10px;
			color: #333;
		}
		input[type="email"],
		input[type="password"] {
			width: 100%;
			padding: 10px;
			border-radius: 3px;
			border: none;
			margin-bottom: 20px;
			box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 16px;
			font-weight: bold;
			transition: background-color 0.3s ease;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		p.error {
			color: #f00;
			text-align: center;
			margin-top: 20px;
		}
	</style>
</head>
<body>
	<h2>Login Form</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>Email:</label>
		<input type="email" name="email" required><br><br>
		<label>Password:</label>
		<input type="password" name="password" required><br><br>
		<input type="submit" name="submit" value="Login">
	</form>

	<?php
		// Authenticate user
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Connect to database
			$servername = "localhost";
			$username = "root";
			$password = "Devisyam@2003";
			$dbname = "dblab8";
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			// Check connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}

			// Get user data from database
			$email = $_POST["email"];
			$password = $_POST["password"];
			$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
			$result = mysqli_query($conn, $sql);

			// Check if user exists
			if (mysqli_num_rows($result) == 1) {
				// Start session and set user data
				session_start();
				$row = mysqli_fetch_assoc($result);
				$_SESSION["email"] = $row["email"];
				$_SESSION["first_name"] = $row["first_name"];
				$_SESSION["last_name"] = $row["last_name"];

				// Redirect to welcome page
				header("Location: http://localhost/Q2)welcome.php");
				exit;
			} else {
				// Display error message
				echo "<p>Invalid email or password.</p>";
			}

			// Close database connection
			mysqli_close($conn);
		}
	?>
</body>
</html>