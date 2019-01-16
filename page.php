<?php
require_once('config/db.php');
if(isset($_GET['slug']) && $_GET['slug'] !== ''){
  $slug = $_GET['slug'];
  $query = "SELECT * FROM pages WHERE url = '$slug'";
  $page = db::getInstance()->getResult($query);

  if(!$page){
    header("location:". SITE_URL);
  }
}else{
  header("location:". SITE_URL);
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $page['title']?> :: The Weds Works</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo SITE_URL;?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo SITE_URL;?>vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="<?php echo SITE_URL;?>css/style.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <?php include('includes/nav.php');?>
    
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">
        <small>
          <?= $page['title']?>
        </small>
      </h1>

      <?= str_replace('../', '', $page['content'])?>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include('includes/footer.php');?>
  </body>

</html>
