<?php 
session_start();  // Start the session

include "header.php"; 
include('config.php');

if (isset($_POST['save'])) {
    $fname =  $_POST['fname'];
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT username FROM user WHERE username = '$user'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Username already exists.";
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
      

        // Insert new user into the database
        $sql1 = "INSERT INTO `user` (first_name, last_name, username, password, role)
                 VALUES ('$fname', '$lname', '$user', '$hashed_password', '$role')";
        
        if (mysqli_query($conn, $sql1)) {
            $_SESSION['success'] = "User added successfully.";
            header("Location: {$hostname}/admin/users.php");
            exit;
        } 
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
                <?php 
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
                    unset($_SESSION['success']);
                }
                ?>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0">Normal User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
