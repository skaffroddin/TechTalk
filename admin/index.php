<?php
session_start();
include 'config.php'; 

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (md5($password, $row['password'])) { 
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id']; 
            header("Location: {$hostname}/admin/post.php"); 
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No such user found!";
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin Login</h3>
                        
                        <!-- Display error if any -->
                        <?php if (isset($error)) { ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="Login" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
