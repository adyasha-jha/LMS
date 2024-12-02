<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired Info</title>
    <style>
        .srch {
            padding-left: 70%;
            padding-top: 20px;
        }
        .form-control {
            width: 300px;
            height: 30px;
            background-color: black;
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
            padding-left: 10px;
        }
        .container {
            height: 800px;
            background-color: black;
            opacity: 0.6;
            color: white;
            margin-top: -65px;
            width: 85%;
        }
        .scroll {
            width: 100%;
            height: 400px;
            overflow: auto;
        }
        th, td {
            width: 10%;
        }
    </style>
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div style="color: black; font-size:30px; text-align:center;">
            <?php
            echo "<img class='img-circle profile_img' height=100 width=100 src='images/" . $_SESSION['pic'] . "'>";
            echo "<br>";
            echo "  " . $_SESSION['login_user']; 
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
                document.getElementById("main").style.marginLeft = "0";
                document.body.style.backgroundColor = "white";
            }
        </script>
        <div class="container">
            <?php
            if (isset($_SESSION['login_user'])) { ?>
                <div style="float: left; padding-left: 5px; padding-top: 30px;">
                    <form method="post" action="">
                        <button name="submit2" type="submit" class="btn btn-default" style="background-color: green; color: yellow;">RETURNED</button>
                        <button name="submit3" type="submit" class="btn btn-default" style="background-color: red; color: yellow;">EXPIRED</button>
                    </form>
                </div>
                <br><br><br><br>
                <div style="float: right; padding-top: 20px;">
                    <h3>Your fine is:
                        <?php
                        // Calculate total fine for all expired books
                        $totalFine = 0;
                        $exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
                        $res = mysqli_query($db, "SELECT return_date FROM issue_book WHERE username='$_SESSION[login_user]' AND approve='$exp';");

                        while ($row = mysqli_fetch_assoc($res)) {
                            $d = strtotime($row['return_date']);
                            $c = strtotime(date("Y-m-d"));
                            $diff = $c - $d;

                            if ($diff >= 0) {
                                $day = floor($diff / (60 * 60 * 24));
                                $totalFine += $day; // Add fine for this book
                            }
                        }

                        $var = 0;
                        $result = mysqli_query($db, "SELECT * FROM fine WHERE username='$_SESSION[login_user]' AND status='not paid';");
                        while ($r = mysqli_fetch_assoc($result)) {
                            $var = $var + $r['fine'];
                        }
                        $var2 = $var + $totalFine;
                        echo "Rs. " . $var2;
                        ?>
                    </h3>
                </div>
            <?php } ?>
            <h2 style="text-align:center;">Expired date list</h2><br>
            <?php
            $c = 0;
            if (isset($_SESSION['login_user'])) {
                $ret = '<p style="color:yellow; background-color:green;">RETURNED</p>';
                $exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
                if (isset($_POST['submit2'])) {
                    $sql = "SELECT student.username, rollno, books.book_id, name, authors, edition, approve, issue_date, issue_book.return_date FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.book_id=books.book_id WHERE issue_book.approve='$ret' AND issue_book.username='$_SESSION[login_user]' ORDER BY issue_book.return_date DESC";
                } else if (isset($_POST['submit3'])) {
                    $sql = "SELECT student.username, rollno, books.book_id, name, authors, edition, approve, issue_date, issue_book.return_date FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.book_id=books.book_id WHERE issue_book.approve='$exp' AND issue_book.username='$_SESSION[login_user]' ORDER BY issue_book.return_date DESC";
                } else {
                    $sql = "SELECT student.username, rollno, books.book_id, name, authors, edition, approve, issue_date, issue_book.return_date FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.book_id=books.book_id WHERE issue_book.approve='$exp' AND issue_book.username='$_SESSION[login_user]' ORDER BY issue_book.return_date DESC";
                }
                $res = mysqli_query($db, $sql);
                if (mysqli_num_rows($res) == 0) {
                    echo "<h2><b>No pending fines! Great job!</b></h2>";
                } else {
                    echo "<table class='table table-bordered' style='width:100%;'>";
                    echo "<tr style='background-color:#6db6b9e6;'>";
                    echo "<th>Student Username</th>";
                    echo "<th>Roll Number</th>";
                    echo "<th>Book ID</th>";
                    echo "<th>Book Name</th>";
                    echo "<th>Authors</th>";
                    echo "<th>Edition</th>";
                    echo "<th>Status</th>";
                    echo "<th>Issue Date</th>";
                    echo "<th>Return Date</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['rollno'] . "</td>";
                        echo "<td>" . $row['book_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['authors'] . "</td>";
                        echo "<td>" . $row['edition'] . "</td>";
                        echo "<td>" . $row['approve'] . "</td>";
                        echo "<td>" . $row['issue_date'] . "</td>";
                        echo "<td>" . $row['return_date'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
