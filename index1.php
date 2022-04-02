<?php
	session_start();
	$pageTitle="Homepage";
	include 'init.php';

?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner c2" role="listbox" style="height:500px;">
    <div class="item active">
      <img src="layout/images/i6.jpg" alt="..." width="100%">
      <div class="carousel-caption hidden-xs">
           <h1>facebook</h1>
          <p class="lead">salam alokom zourtrze uirorit eortezpoier ureieozpeor </p><div class="btn btn-danger">read</div>
          <div class="btn btn-primary">buy</div>
      </div>
    </div>
    <div class="item">
      <img src="layout/images/i1.jpg" alt="..." height="parent" width="100%">
      <div class="carousel-caption hidden-xs">
        <h1>facebook</h1>
          <p class="lead">salam alokom zourtrze uirorit eortezpoier ureieozpeor </p><div class="btn btn-danger">read</div>
          <div class="btn btn-primary">buy</div>
      </div>
    </div>
    <div class="item">
      <img src="layout/images/i2.jpg" alt="..."  width="100%">
      <div class="carousel-caption hidden-xs">
        <h1>facebook</h1>
          <p class="lead">salam alokom zourtrze uirorit eortezpoier ureieozpeor </p><div class="btn btn-danger">read</div>
          <div class="btn btn-primary">buy</div>
      </div>
    </div>
    <div class="item">
      <img src="layout/images/i3.jpg" alt="..." height="50%" width="100%">
      <div class="carousel-caption hidden-xs">
        <h1>facebook</h1>
          <p class="lead">salam alokom zourtrze uirorit eortezpoier ureieozpeor </p><div class="btn btn-danger">read</div>
          <div class="btn btn-primary">buy</div>
      </div>
    </div>
     <div class="item">
      <img src="layout/images/i4.jpg" alt="..." height="100%" width="100%">
      <div class="carousel-caption hidden-xs">
        <h1>facebook</h1>
          <p class="lead">salam alokom zourtrze uirorit eortezpoier ureieozpeor </p><div class="btn btn-danger">read</div>
          <div class="btn btn-primary">buy</div>
      </div>
    </div>
       <div class="item">
      <img src="layout/images/i5.jpg" alt="..." height="100%" width="100%">
      <div class="carousel-caption hidden-xs hidden-xs">
        <h1>facebook</h1>
          <p class="lead">salam alokom zourtrze uirorit eortezpoier ureieozpeor </p>
          <div class="btn btn-danger">read</div>
          <div class="btn btn-primary">buy</div>
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        
        
        <!-- end carousel-->


          <div class="container">
    <h3 class="text-center">refrigeraturs</h3>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',11) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].'</span>';
                echo '<img class="img-responsive" src="img.png" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>

      <h3 class="text-center">TVs</h3>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',15) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].'</span>';
                echo '<img class="img-responsive" src="img.png" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>

      <h3 class="text-center">lave linge</h3>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',12) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].'</span>';
                echo '<img class="img-responsive" src="img.png" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>

      <h3 class="text-center">Couisson</h3>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',13) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].'</span>';
                echo '<img class="img-responsive" src="img.png" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>

      <h3 class="text-center">lave vaissels 14</h3>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',14) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].'</span>';
                echo '<img class="img-responsive" src="'.$item['Price'].'" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>
    </div>
  
	<?php

 	include $tpl . 'footer.php'; ?> 	   