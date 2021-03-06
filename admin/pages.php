<?php
session_start();
require_once('../config/db.php');
   
if(!isset($_SESSION['loggedIn'])){
  header("location: login.php");
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

    <title>Pages - Tables</title>

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
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Pages</li>
          </ol>
          <?php if(isset($_GET['status']) && $_GET['status'] === 'success'){?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_GET['msg']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>

          <?php if(isset($_GET['status']) && $_GET['status'] === 'error'){?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Error, something went wrong
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Pages</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Content</th>
                      <th>Position</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = "SELECT * FROM pages WHERE parent = 0 ORDER BY position asc";
                    $result = db::getInstance()->dbquery($query);
                    while($res = $result->fetch_assoc()){
                    $id = $res['id'];
                  ?>
                    <tr>
                      <td><?= $res['title']?></td>
                      <td>
                        <?= strlen(strip_tags($res['content'])) > 70 ? substr(strip_tags($res['content']), 0, 70)."..." : strip_tags($res['content']);?>
                      </td>
                      <td><?= $res['position'];?></td>
                      <td>
                        <a href="edit_page.php?id=<?= $id?>" title="Edit Page">
                          <i class="far fa-edit"></i>
                        </a>
                        &nbsp;
                        <a href="delete_page.php?id=<?= $id?>" title="Delete Page" onclick="return confirm('Are you sure want to delete this page?');">
                          <i class="far fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                  <?php 
                    $childQuery = "SELECT * FROM pages WHERE parent = '$id' ORDER BY position asc";
                    $childResult = db::getInstance()->dbquery($childQuery);
                    while($childRes = $childResult->fetch_assoc()){
                  ?>
                    <tr class="table-secondary">
                      <td><i class="fas fa-angle-double-right"></i> <?= $childRes['title']?></td>
                      <td><?= strlen(strip_tags($childRes['content'])) > 70 ? substr(strip_tags($childRes['content']), 0, 70)."..." : strip_tags($childRes['content'])?></td>
                      <td><?= $childRes['position']?></td>
                      <td>
                        <a href="edit_page.php?id=<?= $childRes['id']?>" title="Edit Page">
                          <i class="far fa-edit"></i>
                        </a>
                        &nbsp;
                        <a href="delete_page.php?id=<?= $childRes['id']?>" title="Delete Page" onclick="return confirm('Are you sure want to delete this page?');">
                          <i class="far fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                  <?php
                  }
                  } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php include('includes/footer.php');?>

  </body>

</html>
