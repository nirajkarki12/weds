<?php
session_start();
require_once('../config/db.php');
   
if(!isset($_SESSION['loggedIn'])){
  header("location: login.php");
}

if(isset($_GET['id']) && $_GET['id'] !== ''){
  $id = $_GET['id'];
  $query = "SELECT * FROM banner WHERE id = $id";
  $banner = db::getInstance()->getResult($query);

}else{
  header("location:banner.php");
}

if(isset($_POST['submit'])){
  $title = db::getInstance()->escapeString($_POST['title']);
  $content = db::getInstance()->escapeString($_POST['content']);
  $position = db::getInstance()->escapeString($_POST['position']);

  $targetFile = "../banner/" . basename($_FILES["banner"]["name"]);

  $msg = '';
  $files = false;
  if($_FILES["banner"]["name"]){
    if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFile)){
      $files = true;
      unlink("../banner/" . $banner['image']);
    }else{
      $status = 'error';
      header("location:banner.php?status=$status&msg=$msg");
    }
  }
    $image = ($files) ? $_FILES['banner']['name'] : $banner['image'];
    $query = "UPDATE banner SET title = '$title', content = '$content', image = '$image', position = '$position' WHERE id = '$id'";
    if(db::getInstance()->dbquery($query)){
      $msg = "Banner updated successfully";
      $status = "success";
    }else{
      $status = "error";
    }
  header("location:banner.php?status=$status&msg=$msg");
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Weds - Edit a Banner</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Header -->
    <?php include('includes/header.php');?>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php include('includes/sidebar.php');?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Edit a Banner</li>
          </ol>

          <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= $banner['title']?>" required>
            </div>

            <div class="form-group">
              <label for="content">Content</label>
              <textarea class="form-control" name="content" id="content" rows="3" style="resize: none;"><?= $banner['content']?></textarea>
            </div>

            <div class="form-group">
              <label for="position">Position</label>
              <input type="number" class="form-control" id="position" min="1" max="50" name="position" placeholder="Position" value="<?= $banner['position']?>" required>
            </div>

            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="banner">
                <label class="custom-file-label" for="file">Choose file...</label>
              </div>
              <hr>
              <img src="../banner/<?= $banner['image']?>" width="280">
            </div>

            <input type="submit" name="submit" value="Save" class="btn btn-primary">
          </form>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php include('includes/footer.php');?>
  </body>

</html>
