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
			padding-left: 650px;
            padding-top:20px;
		}

        .form-control{
            width:300px;
            height:30px;
            background-color:black;
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
		padding-top: 40px;
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

        .container{
			height: 600px;
			background-color:black;
			opacity:0.6;
			color:white;
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
        <a href="add.php">Add Books</a>
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

        <div class="container">
            <div class="srch">
                <form method="post" action="" name="form1">
                    <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
                    <input type="text" name="book_id" class="form-control" placeholder="Book ID" required=""><br>
                    <button class="btn btn-default" name="submit" type="submit">Submit</button><br>
                </form>
            </div>
            <h3 style="text-align:center;">Request of Book</h3>
        <?php
            if(isset($_SESSION['login_user'])){
                $sql= "SELECT student.username, rollno, books.book_id, name, authors, edition, status FROM student inner join issue_book ON student.username=issue_book.username inner join books ON issue_book.book_id=books.book_id WHERE issue_book.approve=''";

                $res=mysqli_query($db, $sql);

                if(mysqli_num_rows($res)==0){
                    echo "<h3><br>";
                    echo "There is no pending request.";
                    echo "</h3></br>";
                }
                else{
                    echo "<table class='table table-bordered' >";
                        echo "<tr style='background-color: #6db6b9e6;'>";
                        //Table header
                            echo "<th>"; echo "Username";  echo "</th>";
                            echo "<th>"; echo "Roll No";  echo "</th>";
                            echo "<th>"; echo "Book ID";  echo "</th>";
                            echo "<th>"; echo "Book Name";  echo "</th>";
                            echo "<th>"; echo "Author";  echo "</th>";
                            echo "<th>"; echo "Edition";  echo "</th>";
                            echo "<th>"; echo "Status";  echo "</th>";

                        echo "</tr>";	

                        while($row=mysqli_fetch_assoc($res)){
                            echo "<tr>";

                            echo "<td>"; echo $row['username']; echo "</td>";
                            echo "<td>"; echo $row['rollno']; echo "</td>";
                            echo "<td>"; echo $row['book_id']; echo "</td>";
                            echo "<td>"; echo $row['name']; echo "</td>";
                            echo "<td>"; echo $row['authors']; echo "</td>";
                            echo "<td>"; echo $row['edition']; echo "</td>";
                            echo "<td>"; echo $row['status']; echo "</td>";

                            echo "</tr>";
                        }
                    echo "</table>";
                }
            }

        if(isset($_POST['submit'])){
            $_SESSION['st_name']=$_POST['username'];
            $_SESSION['book_id']=$_POST['book_id'];

            ?>
                <script type="text/javascript">
                    window.location="approve.php"
                </script>
            <?php
        }
        ?>
        </div>
    </div>
</body>
</html>