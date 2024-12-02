<?php
  include "connection.php";
  include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Book</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.srch
		{
			padding-left: 900px;
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

        .book{
            width:400px;
            margin:0px auto;
        }

        .form-control{
            background-color:#6db6b999;
            color:black;
            height:28px;
        }
	</style>
</head>
<body>
	<!--------------side nav----------------->

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<div style="color: black; font-size:30px; text-align:center;">
                      <?php
                       echo "<img class='img-circle profile_img'  height=100 width=100 src='images/".$_SESSION['pic']."'>";
					   echo"</br>";

                        echo "  ".$_SESSION['login_user']; 
                      ?>
        </div>
		<a href="add.php">Add Books</a>
		<a href="request.php">Book Request</a>
		<a href="issue_info.php">Issue Information</a>  
		<a href="expired.php">Expired List</a>	
	</div>

	<div id="main">
		<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <div class="container">
            <h2 style="color:black; text-align:center;">Add New Books</h2>
            <form style="text-align:center;" class="book" action="" method="post">
                <input type="text"  name="book_id" class="form-control" placeholder="Book ID" required=""><br>
                <input type="text"  name="name" class="form-control" placeholder="Book Name" required=""><br>
                <input type="text"  name="authors" class="form-control" placeholder="Authors Name" required=""><br>
                <input type="text"  name="edition" class="form-control" placeholder="Edition" required=""><br>
                <input type="text"  name="status" class="form-control" placeholder="Status" required=""><br>
                <input type="text"  name="quantity" class="form-control" placeholder="Quantity" required=""><br>
                <input type="text"  name="department" class="form-control" placeholder="Department" required=""><br>
                <button  class="btn btn-default" type="submit" name="submit">ADD</button>
            </form>
        </div>    
    </div>

    <?php
        if(isset($_POST['submit'])){
            mysqli_query($db,"INSERT INTO `books`(`book_id`, `name`, `authors`, `edition`, `status`, `quantity`, `department`) VALUES ('$_POST[book_id]','$_POST[name]','$_POST[authors]','$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]');");

            ?>
                <script type="text/javascript">
                    alert("Book Added Successfully.");
                </script>
            <?php
        }
    ?>
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
    </body>
