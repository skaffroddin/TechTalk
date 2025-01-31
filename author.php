<?php 
include 'header.php'; 
include 'admin/config.php'; // Make sure to include the database connection

// Define pagination variables
$posts_per_page = 5; // Number of posts per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $posts_per_page;

// Fetch posts from the database
$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $offset, $posts_per_page";
$result = mysqli_query($conn, $sql);

?>

<div id="main-content">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <!-- post-container -->
        <div class="post-container">
          <h2 class="page-heading">Author Name</h2>

          <?php while ($post = mysqli_fetch_assoc($result)): ?>
          <div class="post-content">
            <div class="row">
              <div class="col-md-4">
                <a class="post-img" href="single.php?id=<?php echo $post['id']; ?>">
                  <img src="images/<?php echo $post['image']; ?>" alt=""/>
                </a>
              </div>
              <div class="col-md-8">
                <div class="inner-content clearfix">
                  <h3><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h3>
                  <div class="post-information">
                    <span>
                      <i class="fa fa-tags" aria-hidden="true"></i>
                      <a href="category.php?id=<?php echo $post['category_id']; ?>"><?php echo $post['category']; ?></a>
                    </span>
                    <span>
                      <i class="fa fa-user" aria-hidden="true"></i>
                      <a href="author.php?id=<?php echo $post['author_id']; ?>"><?php echo $post['author']; ?></a>
                    </span>
                    <span>
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                      <?php echo date('d M, Y', strtotime($post['created_at'])); ?>
                    </span>
                  </div>
                  <p class="description">
                    <?php echo substr($post['content'], 0, 150); ?>...
                  </p>
                  <a class="read-more pull-right" href="single.php?id=<?php echo $post['id']; ?>">read more</a>
                </div>
              </div>
            </div>
          </div>
          <?php endwhile; ?>

          <!-- Pagination -->
          <ul class="pagination">
            <?php
            // Get the total number of posts
            $sql_count = "SELECT COUNT(*) AS total_posts FROM posts";
            $result_count = mysqli_query($conn, $sql_count);
            $total_posts = mysqli_fetch_assoc($result_count)['total_posts'];
            $total_pages = ceil($total_posts / $posts_per_page);

            // Generate pagination links
            for ($i = 1; $i <= $total_pages; $i++) {
              echo "<li class='".($i == $page ? 'active' : '')."'><a href='?page=$i'>$i</a></li>";
            }
            ?>
          </ul>
        </div><!-- /post-container -->
      </div>

      <?php include 'sidebar.php'; ?>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
