<?php include 'init.php'; ?>
  	
  	<div class="container">
  	<h1 class="text-center"><?php echo str_replace('-', ' ',$_GET['pagename'] ) ?> </h1>
  	<div class="row"> 
	  	<?php  
	  		foreach (getItems('Cat_ID',$_GET['pageid']) as $item) {
	  				echo '<div class="col-sm-6 col-md-3">';
	  					echo '<div class="thumbnail item-box">';
	  						echo '<span class ="price-tag">'.$item['Price'].' $</span>';
	  						echo '<img class="img-responsive" src="'.$item['Image'].'" alt="" height="70%" width="70%" >';
	  						echo '<div class="caption">';
	  							echo '<h3>'.$item['Name'].'</h3>';
	  							echo '<p>' .$item['Description']. '</p>';
	  							echo '<span><a href="details.php?itemid='.$item['item_ID'].'&itemname='.$item['Name'].'"><div class="btn btn-success "><i class ="fa fa-edit"></i>details</div></a></span> ';
	  							echo '<span><a href="panier.php?do=Update&itemid='.$item['item_ID'].'"><div class="btn btn-primary pull-right "><i class ="fa fa-edit"></i>Acheter</div></a></span> ';


	  						echo'</div>';
	  					echo'</div>';
	  				echo'</div>';

	  			}	
	  	?>
  		</div>
  	</div>


 <?php	include $tpl . 'footer.php'; ?> 

 