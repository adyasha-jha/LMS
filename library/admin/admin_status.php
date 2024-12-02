<?php
include "connection.php";
include "navbar.php";

// Handle Approve and Reject actions
if (isset($_GET['approve_id'])) {
    $approve_id = mysqli_real_escape_string($db, $_GET['approve_id']);
    $approve_query = "UPDATE `admin` SET status='approved' WHERE username='$approve_id'";
    if (mysqli_query($db, $approve_query)) {
        echo "<script>alert('Admin approved successfully');</script>";
    } else {
        echo "<script>alert('Error approving admin');</script>";
    }
}

if (isset($_GET['reject_id'])) {
    $reject_id = mysqli_real_escape_string($db, $_GET['reject_id']);
    $reject_query = "UPDATE `admin` SET status='rejected' WHERE username='$reject_id'";
    if (mysqli_query($db, $reject_query)) {
        echo "<script>alert('Admin request rejected');</script>";
    } else {
        echo "<script>alert('Error rejecting admin');</script>";
    }
}
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <title>Approve New Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .srch { padding-left: 800px; }
        body { font-family: "Lato", sans-serif; transition: background-color .5s; }
        .sidenav { height: 100%; margin-top:60px; width: 0; position: fixed; z-index: 1; top: 0; left: 0; background-color: #6db6b9e6; overflow-x: hidden; transition: 0.5s; padding-top: 60px; }
        .sidenav a { padding: 8px 8px 8px 32px; text-decoration: none; font-size: 25px; color: black; display: block; transition: 0.3s; }
        .sidenav a:hover { color: #f1f1f1; }
        .sidenav .closebtn { position: absolute; top: 0; right: 25px; font-size: 36px; margin-left: 50px; }
        #main { transition: margin-left .5s; padding: 16px; }
        @media screen and (max-height: 450px) { .sidenav { padding-top: 15px; } .sidenav a { font-size: 18px; } }
    </style>
</head>
<body>
    <div class="container">
        <!-- SIDE NAV -->
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div style="color: black; font-size:30px; text-align:center;">
                <?php
                    echo "<img class='img-circle profile_img' height=100 width=100 src='images/".$_SESSION['pic']."'>";
                    echo "</br>";
                    echo "  ".$_SESSION['login_user']; 
                ?>
            </div>
            <a href="request.php">Book Request</a>
            <a href="add.php">Add Books</a>
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

            <!-- SEARCH BAR -->
            <h3>Search one username at a time to approve or reject the request.</h3>
            <div style="float:right;" class="srch">
                <form class="navbar-form" method="post" name="form1">
                    <input class="form-control" type="text" name="search" placeholder="New username" required="">
                    <button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </form>
            </div>

            <h2>New Requests</h2>

            <?php
            if(isset($_POST['submit'])) {
                $search = mysqli_real_escape_string($db, $_POST['search']);
                $q = mysqli_query($db, "SELECT firstname, lastname, username, email, phone FROM `admin` WHERE username LIKE '%$search%' AND status=''");
                if(mysqli_num_rows($q) == 0) {
                    echo "Sorry! No new request found with that username. Try searching again.";
                } else {
                    echo "<table class='table table-bordered table-hover'>";
                    echo "<tr style='background-color: #6db6b9e6;'>";
                    echo "<th>First Name</th><th>Last Name</th><th>Username</th><th>Email</th><th>Contact</th><th>Action</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_assoc($q)) {
                        echo "<tr>";
                        echo "<td>".$row['firstname']."</td>";
                        echo "<td>".$row['lastname']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['phone']."</td>";
                        echo "<td>
                                <a href='?approve_id=".$row['username']."' class='btn btn-success'>Approve</a> 
                                <a href='?reject_id=".$row['username']."' class='btn btn-danger'>Reject</a>
                              </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            } else {
                $res = mysqli_query($db, "SELECT firstname, lastname, username, email, phone FROM `admin` WHERE status=''");
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #6db6b9e6;'>";
                echo "<th>First Name</th><th>Last Name</th><th>Username</th><th>Email</th><th>Contact</th><th>Action</th>";
                echo "</tr>";
                while($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>".$row['firstname']."</td>";
                    echo "<td>".$row['lastname']."</td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['phone']."</td>";
                    echo "<td>
                            <a href='?approve_id=".$row['username']."' class='btn btn-success'>Approve</a> 
                            <a href='?reject_id=".$row['username']."' class='btn btn-danger'>Reject</a>
                          </td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            ?>
        </div>
    </div>
</body>
</html>
