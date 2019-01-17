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

    <title>Weds - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="<?= SITE_URL?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts-->
    <link href="<?= SITE_URL?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles-->
    <link href="<?= SITE_URL?>admin/css/style.css" rel="stylesheet">

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
            <li class="breadcrumb-item active">
              Dashboard
            </li>
          </ol>

          <div class="card mb-3">
            <div class="card-header">
              <i class="far fa-envelope-open"></i>
              Messages</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th width="45%">Query</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $results_per_page = 10;
                    $countQuery = "SELECT id FROM query_form";
                    $result = db::getInstance()->dbquery($countQuery);
                    $total = $result->num_rows;
                    $num_pages = ceil($total / $results_per_page);

                    $page = (isset($_GET['page']) && (int) $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
                    $startPoint = ($page * $results_per_page) - $results_per_page;

                    $query = "SELECT * FROM query_form ORDER BY message_date desc LIMIT $startPoint, $results_per_page";
                    $result = db::getInstance()->dbquery($query);
                    while($res = $result->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?= $res['fullname']?></td>
                      <td><?= $res['email']?></td>
                      <td><?= $res['message']?></td>
                      <td><?= $res['message_date']?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
                <?php if($num_pages > 1){?>
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                      <?php if($page > 1){ ?>
                        <li class="page-item">
                          <a class="page-link" href="index.php?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                      <?php } ?>

                      <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
                        <li class="page-item <?php if($page == $i){ echo 'active';}?>">
                          <a class="page-link" href="<?php echo ($page == $i) ? 'javascript:void(0)' : 'index.php?page=' .$i; ?>">
                            <?= $i?>
                          </a>
                        </li>
                      <?php  }?>

                      <?php if($page < $num_pages) {?>
                        <li class="page-item">
                          <a class="page-link" href="index.php?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      <?php }?>
                    </ul>
                  </nav>
                <?php }?>
              </div>
            </div>
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
