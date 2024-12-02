<?php
session_start();
include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand active">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php">HOME</a></li>
			</ul>
			<?php
			if (isset($_SESSION['login_user'])) { ?>
				<ul class="nav navbar-nav">
					<li><a href="books.php">BOOKS</a></li> 
					<li><a href="feedback.php">FEEDBACK</a></li>
          <li><a href="fine.php">FINES</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="profile.php">
						<div style="color: white">
							<?php
							echo "<img class='img-circle profile_img' height=30 width=30 src='images/" . $_SESSION['pic'] . "'>";
							echo " " . $_SESSION['login_user']; 
							?>
						</div>
					</a></li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
				</ul>
			<?php } else { ?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
					<li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></li>
				</ul>
			<?php } ?>
		</div>
	</nav>
	<?php 
	if (isset($_SESSION['login_user'])) {
		$_SESSION['day'] = 0; // Default value
    $day=0;//initilize
		$exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
		$res = mysqli_query($db, "SELECT return_date FROM issue_book WHERE username='$_SESSION[login_user]' AND approve='$exp';");

		while ($row = mysqli_fetch_assoc($res)) {
			$d = strtotime($row['return_date']);
			$c = strtotime(date("Y-m-d"));
			$diff = $c - $d;

			if ($diff >= 0) {
				$day = +floor($diff / (60 * 60 * 24));
			}
		}
    $_SESSION['fine'] = $day*1;
	}
	?>
</body>
</html>
