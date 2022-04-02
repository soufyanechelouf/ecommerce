<?php

/*
=============================================
category page
=============================================
*/
//ob_start();
session_start();
$pageTitle ='panier';
	if(isset($_SESSION['Username'])){

	
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 
		//start manage page
		if ($do =='Manage') {
				echo '<div class="container">';
				echo '<div class="text-center" style="margin:10px"><a class="add-category btn btn-primary" href="panier.php?do=acheter"><i class="fa fa-plus"></i>Acheter</a></div>';
  	echo '<h1 class="text-center">manage panier </h1>';
  	echo '<div class="row"> ';
	  	 
	  		foreach (getItems('Rating',1) as $item) {
	  				echo '<div class="col-sm-6 col-md-3 ">';
	  					echo '<div class="thumbnail item-box s">';
	  						echo '<span class ="price-tag">'.$item['Price'].' $</span>';
	  						echo '<img class="img-responsive" src="'.$item['Image'].'" alt="" height="70%" width="70%" >';
	  						echo '<div class="caption">';
	  							echo '<h3>'.$item['Name'].'</h3>';
	  							echo '<p>' .$item['Description']. '</p>';
	  							
	  							


	  						echo'</div>';
	  						echo '<div class ="bdelete"><a href="panier.php?do=Update1&itemid='.$item['item_ID'].'"><div class="btn btn-danger "><i class ="fa fa-cross"></i> supprimer </div></a></div> ';
	  					echo'</div>';
	  				echo'</div>';

	  			}	
	  	?>
  		</div>
  	</div>

			
				
			</div>


			<?php
	

		}elseif ($do=='Update') {
			echo "<h1 class='text-center'>Update Category</h1>";
			echo "<div class ='container'>";
 
			
				//get the variable from the form
				$id = $_GET['itemid'];
			
				// update the database with this is info

				$stmt =$con->prepare("UPDATE items SET Rating = 1 WHERE item_ID = ?");
				 $stmt->execute(array($id));

				// echo succes message

				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record updated</div>';
				 redirectHome($theMsg,'back');
				

			
			echo "</div>";

		}
		elseif ($do=='Update1') {
			echo "<h1 class='text-center'>Update Category</h1>";
			echo "<div class ='container'>";
 
			
				//get the variable from the form
				$id = $_GET['itemid'];
			
				// update the database with this is info

				$stmt =$con->prepare("UPDATE items SET Rating = 0 WHERE item_ID = ?");
				 $stmt->execute(array($id));

				// echo succes message

				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record updated</div>';
				 redirectHome($theMsg,'back');
				

			
			echo "</div>";

		}
		elseif ($do=='acheter') {?>
			 <section>
            <div class="card">
                <h1>Information Bancaire</h1>           
                <form action="#" method="post">
                        <?php
                        echo '<div class="text-center"><a class="add-category btn btn-danger" href="panier.php"><i class="fa fa-plus"></i>Annuler</a></div>';?>
                        <br>
                        <br>
                        <div>
                            <input id="column-left" type="text" name="first-name" placeholder="Nom" required/>
                            <input id="column-right" type="text" name="last-name" placeholder="Prenom" required/><br/>
                            <input id="input-field" type="number" name="number" placeholder="Numero de la Carte" required/><br/>
                            <input id="column-left" type="date" name="expiry" required/>
                            <input id="column-right" type="number" name="cvc" placeholder="CCV" required/>
                            <label>carte de payement</label>
                      <select  class="select-item">
            <option id="c" value="paybal">paybal</option>
            <option id="m" value="visacard">visacard</option>
            
            <option id="d" value="mastercard">mastercard</option>
            
        </select>
        
                        </div>
                        <br>
                        <br>
                        <?php
                        echo '<div class="text-center"><a class="add-category btn btn-primary" href="panier.php?do=Delete"><i class="fa fa-plus"></i>valider votre paiment</a></div>';?>
                </form>
                <div class="logos">
                        <ul class="logos_list">
                            <li><a href="#"><img src="layout/images/logos_1.png" alt=""></a></li>
                            <li><a href="#"><img src="layout/images/logos_2.png" alt=""></a></li>
                            <li><a href="#"><img src="layout/images/logos_3.png" alt=""></a></li>
                            <li><a href="#"><img src="layout/images/logos_4.png" alt=""></a></li>
                        </ul>
                </div>   
            </div>
        </section>
<?php
		}
		elseif ($do=='Delete') {
			echo "<h1 class='text-center'>Update Category</h1>";
			echo "<div class ='container'>";
 
			
				//get the variable from the form
				//$id = $_GET['itemid'];
			
				// update the database with this is info

				$stmt =$con->prepare("UPDATE items SET Rating = 0");
				 $stmt->execute();

				// echo succes message

				header('Location:index.php');
				

			
			echo "</div>";

		}
		
		include $tpl . 'footer.php'; 

	}else{
		header('Location:index.php');
		
		exit();
	} 
	//header('Location:index.php');
	//ob_end_flush();

	?>