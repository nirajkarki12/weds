<?php
require_once('config/db.php');

if(isset($_POST['submit'])){
  $fullname = db::getInstance()->escapeString($_POST['fullname']);
  $email = db::getInstance()->escapeString($_POST['email']);
  $message = db::getInstance()->escapeString($_POST['message']);
  $query_date = date("Y-m-d");

  $msg = '';
  $query = "INSERT INTO query_form (fullname, email, message, message_date) VALUES ('$fullname', '$email', '$message', '$query_date')";
  if(db::getInstance()->dbquery($query)){
    $status = "send";
  }else{
    $status = "error";
  }
  header("location:contact.php?status=$status");
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reach Us - The Weds Works</title>

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
        <small>Reach Us</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Reach Us</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        <!-- Contact Details Column -->
        <div class="col-lg-3 mb-3">
          <h3>Contact Details</h3>
          <p>
            3481 Melrose Place
            <br>Beverly Hills, CA 90210
            <br>
          </p>
          <p>
            <abbr title="Phone">P</abbr>: (123) 456-7890
          </p>
          <p>
            <abbr title="Email">E</abbr>:
            <a href="mailto:name@example.com">name@example.com
            </a>
          </p>
          <p>
            <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM
          </p>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-6 mb-6" style="margin-bottom: 1em;">
          <?php if(isset($_GET['status']) && $_GET['status'] === 'send'){?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Message send successfully
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
          <h3>Query Form</h3>
          <form name="sentMessage" action="" method="post">
            <div class="control-group form-group">
              <div class="controls">
                <label>Full Name:</label>
                <input type="text" class="form-control" name="fullname" required>
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Email Address:</label>
                <input type="email" class="form-control" name="email" required>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Message:</label>
                <textarea rows="10" cols="100" class="form-control" name="message" required maxlength="999" style="resize:none"></textarea>
              </div>
            </div>
            <div id="success"></div>
            <!-- For success/fail messages -->
            <input type="submit" class="btn btn-primary" name="submit" value="Send">
          </form>
        </div>
        <!-- Map Column -->
        <div class="col-lg-3 mb-3">
          <!-- Embedded Google Map -->
          <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
        </div>
        <hr>
      </div>
    </div>
    <!-- Footer -->
    <?php include('includes/footer.php');?>
  </body>

</html>
