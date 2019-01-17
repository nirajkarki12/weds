<?php
session_start();
require_once('../config/db.php');
   
if(!isset($_SESSION['loggedIn'])){
  header("location: login.php");
}
if(isset($_GET['id']) && $_GET['id'] !== ''){
  $id = $_GET['id'];
  $query = "SELECT * FROM pages WHERE id = $id";
  $page = db::getInstance()->getResult($query);

  if(strtolower($page['title']) === 'home'){
    header("location:pages.php");
  }
}else{
  header("location:pages.php");
}

if(isset($_POST['submit'])){
  $id = $_GET['id'];
  $title = db::getInstance()->escapeString($_POST['title']);
  $parent = db::getInstance()->escapeString($_POST['parent']);
  $content = db::getInstance()->escapeString($_POST['content']);
  $position = db::getInstance()->escapeString($_POST['position']);
  $url = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

  $msg = '';
  $query = "UPDATE pages SET title = '$title', parent = '$parent', content = '$content', position = '$position', url = '$url' WHERE id = '$id'";
  if(db::getInstance()->dbquery($query)){
    $msg = "Page updated successfully";
    $status = "success";
  }else{
    $status = "error";
  }
    header("location:pages.php?status=$status&msg=$msg");
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

    <title>Weds - Edit a Page</title>

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
            <li class="breadcrumb-item active">Edit Page</li>
            <li class="breadcrumb-item active"><?= $page['title']?></li>
          </ol>

          <form method="post" action="">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="<?= $page['title']?>" placeholder="Title" required>
            </div>

            <div class="form-group">
              <label for="parent">Parent</label>
              <select class="form-control" id="parent" name="parent" required>
                <option value="0" <?php if($page['parent'] === 0) echo "selected";?>>--select parent--</option>
                <?php
                  $query = "SELECT * FROM pages WHERE parent = 0 AND LOWER(title) != 'home' ORDER BY position asc";
                  $result = db::getInstance()->dbquery($query);
                  while($res = $result->fetch_assoc()){
                ?>
                <option value="<?= $res['id']?>" <?php if($res['id'] == $page['parent']) echo "selected";?>><?= $res['title']?></option>
                <?php } ?>
              </select>
            </div>
            
            <div class="form-group">
              <textarea name="content" id="content" cols="10" rows="10" class="tinymce"><?= $page['content']?></textarea>
            </div>
            <div class="form-group">
              <label for="position">Position</label>
              <input type="number" class="form-control" id="position" min="1" max="50" name="position" value="<?= $page['position']?>" placeholder="Position" required>
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
    <script type="text/javascript" src="../vendor/tinymce/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector:'textarea#content',
        height:'280px',
        plugins: [
        "advlist autolink lists link charmap print preview anchor",
        "searchreplace visualblocks code image fullscreen",
        "insertdatetime table contextmenu paste filemanager"],
        toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code fullscreen",
        //link unlink responsivefilemanager image media
       external_filemanager_path: '../filemanager/',
       filemanager_title:"Filemanager" ,
       external_plugins: { "filemanager" : "filemanager/plugin.min.js"},
      });
    </script>
  </body>

</html>
