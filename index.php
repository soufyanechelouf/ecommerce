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
  <div class="carousel-inner c2" role="listbox">
    <div class="item active">
      <img src="layout/images/i2.jpg" >
      <div class="carousel-caption hidden-xs">
           <h1 class="h1s">Brandt </h1>
          <p class="lead">a new brand in the world of smart technology </p>
      </div>
    </div>
    <div class="item">
      <img src="layout/images/i1.jpg" alt="..." >
      <div class="carousel-caption hidden-xs">
        <h1 class="h1s">Toshiba</h1>
          <p class="lead">the giant of electronic tech in ASIE </p>
      </div>
    </div>
    <div class="item">
      <img src="layout/images/i6.jpg" alt="...">
      <div class="carousel-caption hidden-xs">
        <h1 class="h1s">STRALIGHT</h1>
          <p class="lead">le marché algerien est tres satisfait par nos produit </p>
      </div>
    </div>
    <div class="item">
      <img src="layout/images/i3.jpg" alt="...">
      <div class="carousel-caption hidden-xs">
        <h1 class="h1s">mega FLASH</h1>
          <p class="lead">ne ratez jamais dans ce weekend des remise sur tous les produits </p>
      </div>
    </div>
     <div class="item">
      <img src="layout/images/i4.jpg" alt="..." >
      <div class="carousel-caption hidden-xs">
        <h1 class="h1s">SAMSUNG</h1>
          <p class="lead">c'est la féte 50 ans de domination sur le marché </p><div class="btn btn-danger">read</div>
          <div class="btn btn-primary">buy</div>
      </div>
    </div>
       <div class="item">
      <img src="layout/images/i5.jpg" alt="..." >
      <div class="carousel-caption hidden-xs hidden-xs">
        <h1 class="h1s">facile et express</h1>
          <p class="lead">bien venue chez nous </p>
        
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
          <hr>
    <h2 class="text-center">refrigeraturs</h2>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',11) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].' $</span>';
                echo '<img class="img-responsive" src="'.$item['Image'].'" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
                echo '<span><a href="details.php?itemid='.$item['item_ID'].'&itemname='.$item['Name'].'"><div class="btn btn-success "><i class ="fa fa-edit"></i>details</div></a></span> ';
                  echo '<span><a href="panier.php?do=Update&itemid='.$item['item_ID'].'"><div class="btn btn-primary pull-right "><i class ="fa fa-edit"></i>Acheter</div></a></span> ';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>
<hr>
      <h2 class="text-center">TVs</h2>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',15) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].' $</span>';
                echo '<img class="img-responsive" src="'.$item['Image'].'" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
                echo '<span><a href="details.php?itemid='.$item['item_ID'].'&itemname='.$item['Name'].'"><div class="btn btn-success "><i class ="fa fa-edit"></i>details</div></a></span> ';
                  echo '<span><a href="panier.php?do=Update&itemid='.$item['item_ID'].'"><div class="btn btn-primary pull-right "><i class ="fa fa-edit"></i>Acheter</div></a></span> ';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>

      <hr>

      <h2 class="text-center">lave linge</h2>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',12) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].'</span>';
                echo '<img class="img-responsive" src="'.$item['Image'].'" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
                echo '<span><a href="details.php?itemid='.$item['item_ID'].'&itemname='.$item['Name'].'"><div class="btn btn-success "><i class ="fa fa-edit"></i>details</div></a></span> ';
                  echo '<span><a href="panier.php?do=Update&itemid='.$item['item_ID'].'"><div class="btn btn-primary pull-right "><i class ="fa fa-edit"></i>Acheter</div></a></span> ';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>
      <hr>

      <h2 class="text-center">Climatiseur</h2>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',13) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].' $</span>';
                echo '<img class="img-responsive" src="'.$item['Image'].'" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
                echo '<span><a href="details.php?itemid='.$item['item_ID'].'&itemname='.$item['Name'].'"><div class="btn btn-success "><i class ="fa fa-edit"></i>details</div></a></span> ';
                  echo '<span><a href="panier.php?do=Update&itemid='.$item['item_ID'].'"><div class="btn btn-primary pull-right "><i class ="fa fa-edit"></i>Acheter</div></a></span> ';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>

      <hr>
      <h2 class="text-center">lave vaisselle</h2>
    <div class="row"> 
      <?php  
        foreach (getItems('Cat_ID',14) as $item) {
            echo '<div class="col-sm-6 col-md-3">';
              echo '<div class="thumbnail item-box">';
                echo '<span class ="price-tag">'.$item['Price'].' $</span>';
                echo '<img class="img-responsive" src="'.$item['Image'].'" alt="" height="70%" width="70%" >';
                echo '<div class="caption">';
                  echo '<h3>'.$item['Name'].'</h3>';
                  echo '<p>' .$item['Description']. '</p>';

                echo'</div>';
                echo '<span><a href="details.php?itemid='.$item['item_ID'].'&itemname='.$item['Name'].'"><div class="btn btn-success "><i class ="fa fa-edit"></i>details</div></a></span> ';
                  echo '<span><a href="panier.php?do=Update&itemid='.$item['item_ID'].'"><div class="btn btn-primary pull-right "><i class ="fa fa-edit"></i>Acheter</div></a></span> ';
              echo'</div>';
            echo'</div>';

          } 
      ?>
      </div>
    </div>
  
	<?php

 	include $tpl . 'footer.php'; ?> 	   