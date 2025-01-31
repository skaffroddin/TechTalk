<?php 
include "header.php";
include "config.php";

$eid = $_GET['id'];
// Fetch user details from the database
$sql = "SELECT * FROM `user` WHERE user_id = '$eid'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $data = $result->fetch_assoc();
} else {
    die("User not found or query failed: " . mysqli_error($conn));
}

// Handle form submission
if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['f_name'];
    $last_name = $_POST['l_name'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Update the user details in the database
    $update_sql = "UPDATE `user` 
                   SET first_name = '$first_name', last_name = '$last_name', username = '$username', role = '$role' 
                   WHERE user_id = '$user_id'";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: users.php"); // Redirect to users page
        exit;
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value="<?php echo $data['user_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $data['first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $data['last_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0" <?php echo ($data['role'] == 0) ? 'selected' : ''; ?>>Normal User</option>
                            <option value="1" <?php echo ($data['role'] == 1) ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
