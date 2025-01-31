<?php include 'header.php'; 
include 'admin/config.php';
?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <div class="post-content single-post">
                        <?php
                        // Assuming $conn is your database connection
                        if (isset($_GET['post_id'])) {
                            $post_id = $_GET['post_id'];
                            $query = "SELECT * FROM posts WHERE id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $post_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $post = $result->fetch_assoc();
                        }
                        ?>

                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <div class="post-information">
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <?php echo htmlspecialchars($post['tags']); ?>
                            </span>
                            <span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <a href="author.php"><?php echo htmlspecialchars($post['author']); ?></a>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php echo date('d M, Y', strtotime($post['created_at'])); ?>
                            </span>
                        </div>
                        <img class="single-feature-image" src="images/<?php echo htmlspecialchars($post['image']); ?>" alt=""/>
                        <p class="description">
                            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                        </p>
                    </div>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
