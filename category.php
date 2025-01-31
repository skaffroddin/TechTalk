<?php
include 'admin/config.php';
$query = "SELECT * FROM posts WHERE category = 'PHP' LIMIT 10";
$result = mysqli_query($conn, $query);

// Loop through posts and display them
while($post = mysqli_fetch_assoc($result)) {
    ?>
    <div class="post-content">
        <div class="row">
            <div class="col-md-4">
                <a class="post-img" href="single.php?id=<?php echo $post['id']; ?>"><img src="images/<?php echo $post['image']; ?>" alt=""/></a>
            </div>
            <div class="col-md-8">
                <div class="inner-content clearfix">
                    <h3><a href='single.php?id=<?php echo $post['id']; ?>'><?php echo $post['title']; ?></a></h3>
                    <div class="post-information">
                        <span><i class="fa fa-tags" aria-hidden="true"></i><a href='category.php'><?php echo $post['category']; ?></a></span>
                        <span><i class="fa fa-user" aria-hidden="true"></i><a href='author.php'><?php echo $post['author']; ?></a></span>
                        <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $post['date']; ?></span>
                    </div>
                    <p class="description"><?php echo substr($post['content'], 0, 150); ?>...</p>
                    <a class='read-more pull-right' href='single.php?id=<?php echo $post['id']; ?>'>read more</a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
