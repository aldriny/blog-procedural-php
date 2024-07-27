<?php
session_start();
require_once 'inc/header.php';
require_once 'controllers/posts/ShowPostController.php';
require_once 'inc/authourize.php';

authourizedUser();

$post = showPost();
?>

 <!-- Page Content -->
 <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Edit Post</h4>
              <h2>edit your personal post</h2>
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
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
      unset($_SESSION['success']);
    }
    ?>
<div class="container w-50 ">
<div class="d-flex justify-content-center">
    <h3 class="my-5">edit Post</h3>
  </div>

    <form method="POST" action="controllers/posts/UpdatePostController.php?id=<?php echo htmlspecialchars($_GET['id']) ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title'] ?>">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body" rows="5"><?php echo $post['body'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">image</label>
            <input type="file" class="form-control-file" id="image" name="image" >
        </div>
        <img src="assets/images/<?php  echo $post['image'] ?>" alt="" width="100px" srcset=""> 
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>


<?php require_once 'inc/footer.php' ?>