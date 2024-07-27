<?php
session_start();
require_once 'inc/header.php';
require_once 'controllers/posts/ShowPostsController.php';

list($posts, $page, $totalPages) = showPosts();
?>

<style>
  .down-content p {
    word-break: break-word;
  }
  .product-item img {
    width: 100%;
    height: 200px; 
    object-fit: cover; 
  }
</style>

<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner header-text">
  <div class="owl-banner owl-carousel">
    <div class="banner-item-01">
      <div class="text-content">
      </div>
    </div>
    <div class="banner-item-02">
      <div class="text-content">
      </div>
    </div>
    <div class="banner-item-03">
      <div class="text-content">
      </div>
    </div>
  </div>
</div>
<!-- Banner Ends Here -->

<?php
if (isset($_SESSION['errors'])) {
  foreach ($_SESSION['errors'] as $error) {
    echo "<div class='alert alert-danger'>$error</div>";
  }
  unset($_SESSION['errors']);
}

if (isset($_SESSION['success'])) {
  foreach ($_SESSION['success'] as $success) {
    echo "<div class='alert alert-success'>$success</div>";
  }
  unset($_SESSION['success']);
}
?>

<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Latest Posts</h2>
        </div>
      </div>
      <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
        <div class="col-md-4">
          <div class="product-item">
            <a href="#"><img src="assets/images/<?php echo $post['image']; ?>" alt=""></a>
            <div class="down-content">
              <a href="#"><h4><?php echo $post['title']; ?></h4></a>
              <h6><?php echo $post['created_at']; ?></h6>
              <p><?php echo $post['body'] . " ..."; ?></p>
              <div class="d-flex justify-content-end">
                <a href="viewPost.php?id=<?php echo $post['id']; ?>" class="btn btn-info">View</a>
              </div>          
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-md-12">
          <p>No Posts Found.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="row">
      <div class="col-md-12">
        <ul class="pagination justify-content-center">
          <?php if ($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $page - 1; ?>"><<</a>
            </li>
          <?php endif; ?>

          <?php
          $start = max(1, $page - 2);
          $end = min($totalPages, $page + 2);

          if ($start > 1) {
              echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
              if ($start > 2) {
                  echo '<li class="page-item"><span class="page-link">...</span></li>';
              }
          }

          for ($i = $start; $i <= $end; $i++) {
              echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">';
              echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
              echo '</li>';
          }

          if ($end < $totalPages) {
              if ($end < $totalPages - 1) {
                  echo '<li class="page-item"><span class="page-link">...</span></li>';
              }
              echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">' . $totalPages . '</a></li>';
          }
          ?>

          <?php if ($page < $totalPages): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $page + 1; ?>">>></a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>


<?php require_once 'inc/footer.php'; ?>
