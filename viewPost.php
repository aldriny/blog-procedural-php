<?php 
session_start();
require_once 'inc/header.php';
require_once 'controllers/posts/ShowPostController.php';
?>

<?php
$post = showPost();
?>

<style>
    p {
        word-break: break-word;
    }
    .right-image {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 300px;
        overflow: hidden;
        background-color: #f0f0f0;
    }
    .right-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

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
        
    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Our Background</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/<?php echo htmlspecialchars(($post['image'])); ?>" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4><?php echo htmlspecialchars(($post['title'])); ?></h4>
              <h4> Author: <?php echo htmlspecialchars(($post['name'])); ?></h4>
              <p><?php echo htmlspecialchars(($post['body'])); ?></p>

              
              <div class="d-flex justify-content-center">
                
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']){ ?>
                  <a href="editPost.php?id=<?php echo htmlspecialchars(($post['post_id'])); ?>" class="btn btn-success mr-3 "> edit post</a>
              
                  <form action="controllers/posts/DeletePostController.php?id=<?php echo htmlspecialchars(($post['post_id'])); ?>" method="post">
                    <button type="submit" name="submit" class="btn btn-danger">delete post</button>
                  </form>
                  <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

    <?php require_once 'inc/footer.php' ?>
