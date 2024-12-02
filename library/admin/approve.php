<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Request</title>

    <style type="text/css">
        .srch {
            padding-left: 650px;
            padding-top: 20px;
        }

        .form-control {
            width: 300px;
            height: 30px;
            background-color: black;
            color: white; /* Added for better readability */
        }

        body {
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }

        .sidenav {
            height: 100%;
            margin-top: 60px;
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
            .sidenav { padding-top: 15px; }
            .sidenav a { font-size: 18px; }
        }

        .container {
            height: 600px;
            background-color: black;
            opacity: 0.6;
            color: white;
        }

        .Approve {
            margin-left: 350px;
        }
    </style>
</head>
<body>

<!-----------------------------------------SIDE NAV---------------------------------->

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style="color: black; font-size: 30px; text-align: center;">
        <?php
        echo "<img class='img-circle profile_img' height='100' width='100' src='images/" . $_SESSION['pic'] . "'>";
        echo "<br>";
        echo " " . $_SESSION['login_user'];
        ?>
    </div>
    <a href="add.php">Add Books</a>
    <a href="request.php">Book Request</a>
    <a href="issue_info.php">Issue Information</a>
    <a href="expired.php">Expired List</a>	
</div>

<div id="main">
    <span style="font-size: 30px; cursor: pointer" onclick="openNav()">&#9776;</span>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }
    </script>
    <div class="container">
        <br><br>
        <h3 style="text-align: center;">Approve Request</h3>
        <br><br>
        <form class="Approve" action="" method="post">
            <input class="form-control" type="text" name="approve" placeholder="Yes or No" required=""><br>
            <input class="form-control" type="text" name="issue_date" placeholder="Issue Date yyyy-mm-dd" required=""><br>
            <input class="form-control" type="text" name="return_date" placeholder="Return Date yyyy-mm-dd" required=""><br>
            <button class="btn btn-default" type="submit" name="submit">APPROVE</button>
        </form>    
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // Get the approval value from the form
    $approval = $_POST['approve'];

    // Update the request in the issue_book table
    mysqli_query($db, "UPDATE issue_book SET approve='$approval', issue_date='$_POST[issue_date]', return_date='$_POST[return_date]' WHERE username='$_SESSION[st_name]' and book_id='$_SESSION[book_id]'");

    // Only decrease the quantity if the approval is "Yes"
    if (strtolower($approval) === 'yes') {
        mysqli_query($db, "UPDATE books SET quantity = quantity - 1 WHERE book_id='$_SESSION[book_id]'");

        $res = mysqli_query($db, "SELECT quantity FROM books WHERE book_id='$_SESSION[book_id]'");
        
        while ($row = mysqli_fetch_assoc($res)) {
            if ($row['quantity'] == 0) {
                mysqli_query($db, "UPDATE books SET status='not-available' WHERE book_id='$_SESSION[book_id]'");
            }
        }
    }
    ?>
    <script type="text/javascript">
        alert("UPDATED SUCCESSFULLY.");
        window.location = "request.php";
    </script>
    <?php
}
?>
 
</body>
</html>
