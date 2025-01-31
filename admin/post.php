<?php 
include "header.php"; 
include "config.php"; // Ensure your database connection is included here

// Pagination logic
$posts_per_page = 5; // Number of posts per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page or default to 1
$offset = ($page - 1) * $posts_per_page; // Offset for LIMIT

// Fetch posts from the database with LIMIT and OFFSET for pagination
$sql = "SELECT post.post_id, post.title, post.category, post.post_date, user.username AS author
        FROM post
        JOIN user ON post.author = user.user_id
        ORDER BY post.post_date DESC
        LIMIT $offset, $posts_per_page"; // Add limit for pagination

$result = mysqli_query($conn, $sql);
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">Add Post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        // Check if any posts are found
                        if (mysqli_num_rows($result) > 0) {
                            $counter = $offset + 1; // To display the correct post number based on page
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                          <td class='id'>" . $counter++ . "</td>
                                          <td>" . $row['title'] . "</td>
                                          <td>" . $row['category'] . "</td>
                                          <td>" . $row['post_date'] . "</td>
                                          <td>" . $row['author'] . "</td>
                                          <td class='edit'><a href='update-post.php?id=" . $row['post_id'] . "'><i class='fa fa-edit'></i></a></td>
                                          <td class='delete'><a href='delete-post.php?id=" . $row['post_id'] . "'><i class='fa fa-trash-o'></i></a></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No posts found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                // Get the total number of posts for pagination
                $sql_count = "SELECT COUNT(*) FROM post"; 
                $result_count = mysqli_query($conn, $sql_count);
                $total_posts = mysqli_fetch_row($result_count)[0];
                $total_pages = ceil($total_posts / $posts_per_page); // Calculate total pages
                ?>

                <ul class='pagination admin-pagination'>
                    <?php 
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='" . ($i == $page ? 'active' : '') . "'><a href='?page=$i'>$i</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
