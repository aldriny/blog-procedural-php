<?php
session_start();
require_once 'inc/header.php';
require_once 'inc/authourize.php';

authourizedUser();
?>

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

<div class="container w-50 ">
  <div class="d-flex justify-content-center">
    <h3 class="my-5">add new Post</h3>
  </div>
  <form method="POST" action="controllers/posts/StorePostController.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" id="body" name="body" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">image</label>
        <input type="file" class="form-control-file" id="image" name="image" >
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
</div>

    <?php require_once 'inc/footer.php' ?>
