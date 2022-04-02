<?php include 'init.php'; ?>
  	
  	<div class="container">
  	<h1 class="text-center"><?php echo $_GET['itemname'] ?> </h1>
  	<div class="row text-center"> 
	  	<?php  
	  		foreach (getItems('item_ID',$_GET['itemid']) as $item) {
	  				echo '<div class="col-sm-12 col-md-12">';
	  					echo '<div class="thumbnail item-box">';
	  						echo '<span class ="price-tag">'.$item['Price'].' $</span>';
	  						echo '<img class="img-responsive" src="'.$item['Image'].'" alt="" height="70%" width="70%" >';
	  						echo '<div class="caption">';
	  							echo '<h3>'.$item['Name'].'</h3>';
	  							echo '<p>' .$item['Description']. '</p>';
	  							echo '<h2> Prix: '.$item['Price'].' $</h2>';
	  							

	  						echo'</div>';

	  							echo '<span><a href="panier.php?do=Update&itemid='.$item['item_ID'].'"><div class="btn btn-primary pull-right "><i class ="fa fa-edit"></i>Acheter</div></a></span> ';
	  					echo'</div>';
	  				echo'</div>';

	  			}	
	  	?>
  		</div>
  	</div>


 <?php	include $tpl . 'footer.php'; ?> 

 