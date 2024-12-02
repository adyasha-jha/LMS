<?php
  include "connection.php";
  include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Request</title>

    <style type="text/css">
		.srch
		{
			padding-left: 800px;
		}

		body {
		font-family: "Lato", sans-serif;
		transition: background-color .5s;
		}

		.sidenav {
		height: 100%;
		margin-top:60px;
		width: 0;
		position: fixed;
		z-index: 1;
		top: 0;
		left: 0;
		background-color: #6db6b9e6;
		overflow-x: hidden;
		transition: 0.5s;
		padding-top: 60px;
		}

		.sidenav a {
		padding: 8px 8px 8px 32px;
		text-decoration: none;
		font-size: 25px;
		color: black;
		display: block;
		transition: 0.3s;
		}

		.sidenav a:hover {
		color: #f1f1f1;
		}

		.sidenav .closebtn {
		position: absolute;
		top: 0;
		right: 25px;
		font-size: 36px;
		margin-left: 50px;
		}

		#main {
		transition: margin-left .5s;
		padding: 16px;
		}

		@media screen and (max-height: 450px) {
		.sidenav {padding-top: 15px;}
		.sidenav a {font-size: 18px;}
		}
	</style>
</head>
<body>

        <!-----------------------------------------SIDE NAV---------------------------------->

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<div style="color: black; font-size:30px; text-align:center;">
                      <?php
                       echo "<img class='img-circle profile_img'  height=100 width=100 src='images/".$_SESSION['pic']."'>";
					   echo"</br>";

                        echo "  ".$_SESSION['login_user']; 
                      ?>
        </div>
		<a href="request.php">Book Request</a>
		<a href="issue_info.php">Issue Information</a>
		<a href="expired.php">Expired List</a>
	</div>

	<div id="main">
		
		<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
	

	<script>
		function openNav() {
		document.getElementById("mySidenav").style.width = "250px";
		document.getElementById("main").style.marginLeft = "250px";
		document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
		}

		function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
		document.body.style.backgroundColor = "white";
		}
	</script>

<?php
    if(isset($_SESSION['login_user']))
		{
			$q=mysqli_query($db,"SELECT * from issue_book where username='$_SESSION[login_user]' and approve='';");

			if(mysqli_num_rows($q)==0)
			{
                echo"<br><b>";
				echo "There is no pending request.";
                echo"</br></b>";
			}
			else
			{
		        echo "<table class='table table-bordered table-hover' >";
			    echo "<tr style='background-color: #6db6b9e6;'>";
				//Table header
                    echo "<th>"; echo "Book-ID";  echo "</th>";
                    echo "<th>"; echo "Approve Status";  echo "</th>";
                    echo "<th>"; echo "Issue Date";  echo "</th>";
                    echo "<th>"; echo "Return Date";  echo "</th>";
			echo "</tr>";	

			while($row=mysqli_fetch_assoc($q))
			{
				echo "<tr>";

				echo "<td>"; echo $row['book_id']; echo "</td>";
				echo "<td>"; echo $row['approve']; echo "</td>";
				echo "<td>"; echo $row['issue_date']; echo "</td>";
				echo "<td>"; echo $row['return_date']; echo "</td>";

				echo "</tr>";
			}
		echo "</table>";
			}
		}
?>
</div>
</body>
</html>