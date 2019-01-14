<?php
require_once('config/db.php');
$query = "SELECT * FROM banner ORDER BY position asc";
?>
<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php
        $listActive = true;
        $listResult = db::getInstance()->dbquery($query);
        while($list = $listResult->fetch_assoc()){
      ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?= $list['id']?>" class="<?php if($listActive){ echo 'active';}?>"></li>
      <?php 
        $listActive = false;
        }
      ?>
    </ol>
    <div class="carousel-inner" role="listbox">
      <?php
        $slideActive = true;
        $slideResult = db::getInstance()->dbquery($query);
        while($res = $slideResult->fetch_assoc()){
        $image = 'banner/' . $res['image'];
      ?>
      <div class="carousel-item <?php if($slideActive){ echo 'active';}?>" style="background-image: url('<?= $image?>')">
        <div class="carousel-caption d-none d-md-block">
          <h3><?= $res['title']?></h3>
          <p><?= $res['content']?></p>
        </div>
      </div>
      <?php 
        $slideActive = false;
        }
      ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</header>