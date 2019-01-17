<?php
require_once('config/db.php');
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Logo</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <?php
          $query = "SELECT * FROM pages WHERE parent = 0 ORDER BY position asc";
          $result = db::getInstance()->dbquery($query);
          while($res = $result->fetch_assoc()){
          $id = $res['id'];
          $child = false;
          $url = ($res['url'] == 'home') ? '/mikal' : 'page.php?slug=' . $res['url'];

          $childQuery = "SELECT * FROM pages WHERE parent = '$id' ORDER BY position asc";
          $childResult = db::getInstance()->dbquery($childQuery);
          if($childResult->num_rows > 0){
            $child = true;
          }
        ?>
        <li class="nav-item <?php if($child){ echo 'dropdown';}?>">
          <a class="nav-link <?php if($child){ echo 'dropdown-toggle';}?>" href="<?php if($child){ echo '#';}else echo $url;?>" id="<?php if($child){ echo $res['id'];}?>" <?php if($child){ ?> data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php }?>>
            <?= $res['title']?>
          </a>
          <?php 
            if($child){
          ?>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="<?= $res['id']?>">
            <?php 
              while($childRes = $childResult->fetch_assoc()){
            ?>
            <a class="dropdown-item" href="page.php?slug=<?= $childRes['url']?>"><?= $childRes['title']?></a>
            <?php 
              }
            ?>
          </div>
          <?php } ?>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Reach Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>