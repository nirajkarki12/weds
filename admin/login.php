<?php
session_start();
require_once('../config/db.php');
   

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
  header("location: index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
 $username = db::getInstance()->escapeString($_POST['username']);
 $password = db::getInstance()->escapeString($_POST['password']);
  
  $query = "SELECT * FROM user WHERE username = '$username' AND password = MD5('$password')";
  $result = db::getInstance()->getResult($query);

  if($result) {

    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = $result['username'];
    $_SESSION['id'] = $result['id'];

    header("location: index.php");
  }else {
    $error = "Your Login Name or Password is invalid";
  }
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

    <title>Weds Admin - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
      <?php echo $password;?>

          <div style = "font-size:11px; color:#cc0000; margin-bottom:10px"><?php echo $error; ?></div>
          <form action="" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                <label for="inputEmail">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block value="Login">
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>