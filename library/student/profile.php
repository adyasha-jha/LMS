<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style type="text/css">
        .wrapper {
            width: 350px;
            margin: 0 auto;
            color: white;
        }
    </style>
</head>
<body style="background-color:#24989ce6;">
    <div class="container">
        <form action="" method="post">
            <button class="btn btn-default" style="float:right; width:70px;" name="submit1" type="submit">EDIT</button>
        </form>
        <div class="wrapper">
            <h2 style="text-align:center;">MY PROFILE</h2>
            <?php
            if (isset($_POST['submit1'])) {
                echo "<script type='text/javascript'>window.location='edit.php'</script>";
            }

            $q = mysqli_query($db, "SELECT * FROM student WHERE username = '$_SESSION[login_user]';");

            // Check if the query returned any results
            if ($q && mysqli_num_rows($q) > 0) {
                $row = mysqli_fetch_assoc($q);
            } else {
                echo "<p style='color:red; text-align:center;'>Profile not found.</p>";
                $row = [];
            }

            if (!empty($_SESSION['pic'])) {
                echo "<div style='text-align:center'>
                        <img class='img-circle profile-img' height=110 width=120 src='images/" . htmlspecialchars($_SESSION['pic']) . "'>
                    </div>";
            } else {
                echo "<div style='text-align:center'><p>No Profile Picture</p></div>";
            }
            ?>
            <div style="text-align:center;"><strong>Welcome, </strong>
                <h4>
                    <?php
                    echo htmlspecialchars($_SESSION['login_user']);
                    ?>
                </h4>
            </div>
            <?php
            if (!empty($row)) {
                echo "<b>";
                echo "<table class='table table-bordered'>";
                echo "<tr><td><b>FIRSTNAME: </b></td><td>" . htmlspecialchars($row['firstname'] ?? 'N/A') . "</td></tr>";
                echo "<tr><td><b>LASTNAME: </b></td><td>" . htmlspecialchars($row['lastname'] ?? 'N/A') . "</td></tr>";
                echo "<tr><td><b>USERNAME: </b></td><td>" . htmlspecialchars($row['username'] ?? 'N/A') . "</td></tr>";
                echo "<tr><td><b>PASSWORD: </b></td><td>" . htmlspecialchars($row['password'] ?? 'N/A') . "</td></tr>";
                echo "<tr><td><b>EMAIL: </b></td><td>" . htmlspecialchars($row['email'] ?? 'N/A') . "</td></tr>";
                echo "<tr><td><b>ROLL NO: </b></td><td>" . htmlspecialchars($row['rollno'] ?? 'N/A') . "</td></tr>";
                echo "<tr><td><b>CONTACT: </b></td><td>" . htmlspecialchars($row['phone'] ?? 'N/A') . "</td></tr>";
                echo "</table>";
                echo "</b>";
            }
            ?>
        </div>
    </div>
</body>
</html>
