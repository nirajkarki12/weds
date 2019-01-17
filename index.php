<?php
require_once('config/db.php');
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Weds Works</title>

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

    <!-- Banner -->
    <?php include('includes/banner.php');?>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Welcome to Weds Works</h1>
      <!-- Intro Content -->
      <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="http://placehold.it/750x450" alt="">
        </div>
        <div class="col-lg-6">
          <h2>About Modern Business</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis?</p>
        </div>
      </div>
      <!-- Portfolio Section -->
      <h2>Our Services</h2>

      <div class="row">
        <?php
          $query = "SELECT ch.* FROM pages AS p JOIN pages AS ch ON (p.id = ch.parent) WHERE p.url = 'what-we-deliver'";
          $result = db::getInstance()->dbquery($query);
          while($res = $result->fetch_assoc()){
          $image = '';
          $slug = $res['url'];
          $title = $res['title'];
          $content = $res['content'];
          $link = "<a href=page.php?slug=$slug>$title</a>";
          $dotLink = " <a href=page.php?slug=$slug>[..]</a>";

          preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);

        ?>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="uploads/<?= $image['src']?>" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <?= $link?>
              </h4>
              <p class="card-text">
                <?= strlen(strip_tags($res['content'])) > 220 ? substr(strip_tags($res['content']), 0, 220).$dotLink : strip_tags($res['content']);?>
              </p>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
      <!-- /.row -->

      <hr>
      <!-- Call to Action Section -->
      <div class="row mb-4">
        <div class="col-md-8">
          <p>We are here to hear you, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo</p>
        </div>
        <div class="col-md-4">
          <a class="btn btn-lg btn-secondary btn-block" href="contact.php">Reach Us</a>
        </div>
      </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include('includes/footer.php');?>

  </body>

</html>
