<?php 
include "header.php"; 
include "config.php"; // Ensure the database connection is included

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the category ID and category name from the form
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];

    // Update the category in the database
    $sql = "UPDATE category SET category_name = ? WHERE category_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "si", $cat_name, $cat_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='alert alert-success'>Category updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating category: " . mysqli_error($conn) . "</div>";
    }

    mysqli_stmt_close($stmt);
}

// Retrieve the category to pre-populate the form
$cat_id = 1; // For demonstration, replace with dynamic value based on URL parameter or other logic
$sql = "SELECT * FROM category WHERE category_id = $cat_id";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($result);
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="<?php echo $category['category_id']; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" class="form-control" value="<?php echo $category['category_name']; ?>" placeholder="" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
