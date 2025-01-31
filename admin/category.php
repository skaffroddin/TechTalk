<?php include "header.php";
include "config.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">Add Category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        // Make sure to update this query to reflect the actual table and column names
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$i}</td>";
                                echo "<td>{$row['category_name']}</td>";
                                echo "<td>{$row['post']}</td>";
                                echo "<td class='edit'><a href='update-category.php?id={$row['category_id']}'><i class='fa fa-edit'></i></a></td>";
                                echo "<td class='delete'><a href='delete-category.php?id={$row['category_id']}'><i class='fa fa-trash-o'></i></a></td>";
                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No categories found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
