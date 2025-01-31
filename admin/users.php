<?php 
include "header.php"; 
include "config.php";

// Set the number of records per page
$records_per_page = 10;

// Get the current page from the URL (default is 1 if not set)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record for the current page
$start_from = ($current_page - 1) * $records_per_page;

// Get the total number of records
$sql = "SELECT COUNT(*) FROM `user`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$total_records = $row[0];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

// Fetch the records for the current page
$sql = "SELECT * FROM `user` ORDER BY user_id DESC LIMIT $start_from, $records_per_page";
$result = mysqli_query($conn, $sql) or die("Query Failed");

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                          <?php while($row=$result->fetch_assoc()) { ?> 
                              <tr>
                                  <td class='id'><?php echo $row['user_id']; ?></td>
                                  <td><?php echo $row['first_name'] ." ". $row['last_name']; ?></td>
                                  <td><?php echo $row['username']; ?></td>
                                  <td><?php echo ($row['role'] == 1) ? 'Admin' : 'User'; ?></td>
                                  <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                                  <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                              </tr>
                          <?php } ?>
                      </tbody>
                  </table>

                  <!-- Pagination -->
                  <ul class='pagination admin-pagination'>
                      <!-- Previous Page -->
                      <?php if($current_page > 1) { ?>
                          <li><a href="?page=<?php echo $current_page - 1; ?>">Prev</a></li>
                      <?php } ?>

                      <!-- Page Number Links -->
                      <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                          <li class="<?php if($i == $current_page) echo 'active'; ?>">
                              <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                          </li>
                      <?php } ?>

                      <!-- Next Page -->
                      <?php if($current_page < $total_pages) { ?>
                          <li><a href="?page=<?php echo $current_page + 1; ?>">Next</a></li>
                      <?php } ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
