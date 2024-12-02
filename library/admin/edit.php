<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style type="text/css">
        .form-control {
            width: 300px;
            height: 30px;
        }
        form {
            padding-left: 500px;
        }
        label {
            color: white;
        }
    </style>
</head>
<body style="background-color: #24989ce6;">
    <h2 style="text-align: center; color: #fff;">Edit Information</h2>
    <?php
    $sql = "SELECT * FROM admin WHERE username='$_SESSION[login_user]'";
    $result = mysqli_query($db, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $firstname = $row['firstname'] ?? '';
        $lastname = $row['lastname'] ?? '';
        $username = $row['username'] ?? '';
        $password = $row['password'] ?? '';
        $email = $row['email'] ?? '';
        $phone = $row['phone'] ?? '';
    } else {
        echo "<p style='color:red; text-align:center;'>Profile data not found.</p>";
        exit();
    }
    ?>
    <div class="profile-info" style="text-align: center;">
        <span style="color: white;">Welcome,</span>
        <h4 style="color: white;"><?php echo htmlspecialchars($_SESSION['login_user']); ?></h4>
    </div><br><br>

    <div class="form1">
        <form action="" method="post" enctype="multipart/form-data">
            <label><h4>Profile Photo:</h4></label>
            <input class="form-control" type="file" name="file">
            <label><h4>First Name:</h4></label>
            <input class="form-control" type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
            <label><h4>Last Name:</h4></label>
            <input class="form-control" type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
            <label><h4>Username:</h4></label>
            <input class="form-control" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <label><h4>Password:</h4></label>
            <input class="form-control" type="text" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <label><h4>Email:</h4></label>
            <input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <label><h4>Phone:</h4></label>
            <input class="form-control" type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br>
            <div style="padding-left:100px;">
                <button class="btn btn-default" type="submit" name="submit">Save</button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
        $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $pic=$_FILES['file']['name'];

        $sql1 = "UPDATE admin SET pic='$pic', firstname='$firstname', lastname='$lastname', username='$username', password='$password', email='$email', phone='$phone' WHERE username='$_SESSION[login_user]';";

        if (mysqli_query($db, $sql1)) {
            echo "<script type='text/javascript'>alert('Saved Successfully.');</script>";
        } else {
            echo "<p style='color:red; text-align:center;'>Error updating profile. Please try again.</p>";
        }
    }
    ?>
</body>
</html>
