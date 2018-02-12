<?php 
session_start();

if (isset($_SESSION['user_id'])) {
	header("Location:/index.php");
}
require 'database.php';
$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])):

	//Enter new user into the database
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', password_hash($_POST['password'],PASSWORD_BCRYPT));
	if($stmt->execute()):
		$message = 'Successfully created new user';
	else:
		$message = 'Sorry, there was a problem creating your account';
	endif;		
	
	endif; 
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Below</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="http://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="header">
		<a href="index.php">My App</a>	
	</div>
	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>	

	<h1>Register</h1>
	<span>or <a href="login.php">login here</a></span>
	<form action="register.php" method="POST">
		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder="Enter your password" name="password">
		<input type="password" placeholder="Re-nter your password" name="confirm_password">
		<input type="submit" name="">
		
	</form>
</body>
</html>