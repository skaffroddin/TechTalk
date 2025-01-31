<?php 
include "header.php"; 
include('config.php');

// Check if the form is submitted
if (isset($_POST['save'])) {
    // Sanitize the category input
    $category_name = mysqli_real_escape_string($conn, $_POST['cat']);

    // Check if the category already exists
    $sql_check = "SELECT category_name FROM category WHERE category_name = '$category_name'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "Category already exists.";
    } else {
        // Insert the new category into the database
        $sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
        if (mysqli_query($conn, $sql)) {
            echo "Category added successfully.";
            header("Location: category.php");  // Redirect to category listing page after success
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
