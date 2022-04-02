<?php

/*
=============================================
items page
=============================================
*/

session_start();
$pageTitle ='Items';
	if(isset($_SESSION['Username'])){

	
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 
		//start manage page
		if ($do =='Manage') {

			
			
			$stmt =$con ->prepare("SELECT items.*,
				categories.Name as category_name,
				users.Username  FROM items INNER JOIN categories ON categories.ID = items.Cat_ID 
INNER JOIN users ON users.UserID=items.Member_ID ORDER BY item_ID DESC ");
			$stmt -> execute();

			//assign to variable
			$items =$stmt ->fetchAll();  


		 ?>

		<h1 class="text-center">Manage Items</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
						<td>#ID</td>
						<td>Name</td>
						<td>Description</td>
						<td>Price</td>
						<td>Adding Date</td>
						<td>Category</td>
						<td>Username</td>	
						<td>Control</td>
					</tr>
					<?php
					   foreach ($items as $item )	{
					   	echo "<tr>";
					   		echo "<td>" . $item['item_ID'] . "</td>";
					   		echo "<td>" . $item['Name'] . "</td>";
					   		echo "<td>" . $item['Description'] . "</td>";
					   		echo "<td>" . $item['Price'] . "</td>";
					   		echo "<td>" .$item['Add_Date'] . "</td>";
					   		echo "<td>" .$item['category_name'] . "</td>";
					   		echo "<td>" .$item['Username'] . "</td>";
					   		echo "<td> 
					   			<a href='items.php?do=Edit&itemid=". $item['item_ID']."'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
					   		<a href='items.php?do=Delete&itemid=". $item['item_ID']."' class='btn btn-danger confirm'><i class='fa fa-close'></i>saled</a>";
					   		if($item['Approve']== 0){
					     	echo "<a href='items.php?do=Approve&itemid=". $item['item_ID']."' class='btn btn-info activate' style ='margin-left:5px;'>
					     		<i class='fa fa-check'></i>Approve</a>";

							}
							echo"</td>";

							


					   	echo"<tr>";
					   }


					?>

			
					

				</table>
			
			</div>
			<a href="items.php ?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> New Item</a>
			
		</div>

	    <?php
		}elseif ($do=='Add') { ?>
			<h1 class="text-center">Add New Item</h1>
<div class="container">
					<form class="form-horizontal" action="?do=Insert" method="POST">
						
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="name" class="form-control"  autocomplete ="off" required="required" placeholder="Name of the Item">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Description</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="description" class="form-control"  autocomplete ="off" required="required" placeholder="Description of the Item">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Price</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="price" class="form-control"  autocomplete ="off" required="required" placeholder="Price of the Item">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Country</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="country" class="form-control"  autocomplete ="off" required="required" placeholder="Country of made">
							</div>
						</div>
						
							<label class="col-sm-2 control-label">image</label>
							<div class="col-sm-10 col-md-4">
								<input type="file" name="image" class="form-control"  autocomplete ="off" required="required" placeholder="Country of made">
							</div>
							<br>
												<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Marque</label>
							<div class="col-sm-10 col-md-4">
								<select class="form-control" name="status">
								    <option value="0">...</option>
									<option value="brandt">brandt</option>
									<option value="2">beko</option>
									<option value="3">eniem</option>
									<option value="4">toshiba</option>
									<option value="5">LG</option>
									<option value="6">starlight</option>
									<option value="7">inconnue</option>
									<option value="8">marque default</option>
							    </select>
							</div>
						</div>

						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Member</label>
							<div class="col-sm-10 col-md-4">
								<select class="form-control" name="member">
								    <option value="0">...</option>
								    <?php
								    	$stmt=$con->prepare("SELECT * from users");
								    	$stmt->execute();
								    	$users=$stmt->fetchAll();
								    	foreach ($users as $user) {
								    		
								    		echo "<option value='".$user['UserID']. "'>".$user['Username']."</option>";
								    	}

								    ?>
								
							    </select>
							</div>
						</div>


						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Category</label>
							<div class="col-sm-10 col-md-4">
								<select class="form-control" name="category">
								    <option value="0">...</option>
								    <?php
								    	$stmt2=$con->prepare("SELECT * from categories");
								    	$stmt2->execute();
								    	$cats=$stmt2->fetchAll();
								    	foreach ($cats as $cat) {
								    		
								    		echo "<option value='".$cat['ID']. "'>".$cat['Name']."</option>";
								    	}

								    ?>
								
							    </select>
							</div>
						</div>

						

						
						
						<div class="form-group form-group-lg">
							
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Add Item" class="btn btn-primary btn-sm">
							</div>
						</div>
				</form>
			</div>
		<?php
		}
		elseif ($do=='Insert') {
			//insert items page
		 		

 
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				echo "<h1 class='text-center'>INSERT Item</h1>";
			echo "<div class ='container'>";
				//get the variable from the form
				
				$name = $_POST['name'];
				$desc = $_POST['description'];
				$price = $_POST['price'];
				$country= $_POST['country'];
				$status = $_POST['status'];
				$member = $_POST['member'];
				$cat = $_POST['category'];


				

				 
				// validate the form
				$formErrors = array();
				if (empty($name)) {

					$formErrors[]='Name cant be empty';
				}
				if (empty($desc)) {

					$formErrors[]='Description cant be empty';
				}
				if (empty($price)) {
					$formErrors[]='Price cant be empty';
				}
				if (empty($country)) {
					$formErrors[]='Country cant be empty';
				}

				/*if ($status == 0) {
					$formErrors[]='You must choose the Status';
				}*/

				if ($member == 0) {
					$formErrors[]='You must choose the member';
				}

				if ($cat == 0) {
					$formErrors[]='You must choose the Category';
				}
				

				foreach ($formErrors as $error) {
					echo '<div class="alert alert-danger">'. $error. '</div>' ;
				}
				// check if there is no error proced the update operation 
				if(empty($formErrors)) {

					

					// insert users info in data base
					$stmt = $con ->prepare("INSERT INTO items(Name,Description,Price,Country_Made,Status,Add_Date,Cat_ID,Member_ID)VALUES(:zname,:zdesc,:zprice,:zcountry,:zstatus,now(),:zcat,:zmember) ");
					$stmt->execute(array(
						'zname'		=>$name,
						'zdesc'		=>$desc,
						'zprice'	=>$price,   
						'zcountry'	=>$country,
						'zstatus'	=>$status,
						'zcat'		=>$cat,
						'zmember'	=>$member

						));


				// echo succes message

				 $theMsg="<div class='alert alert-success'>". $stmt->rowCount() . 'record inserted </div>';

				 	redirectHome($theMsg,'back');

				    
			}

			}else{
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">SORRY YOU CANT BROWSE THIS PAGE DIRECT</div>';
				redirectHome($theMsg);
                echo "</div>";
			}
			echo "</div>";
		}elseif ($do=='Edit') {
			

			// check if get request itemid is numirec and get the integer value of it
			$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

			//selecct all data depend this id
			$stmt = $con->prepare("SELECT * FROM items WHERE  item_ID = ?");
			//exexute query
			$stmt->execute(array($itemid));
			//fetch the data
			$item =$stmt->fetch();
			// the row count
			$count = $stmt->rowCount();
			// if there is such id show the form
			if ($count> 0) { ?>

			<h1 class="text-center">Edit Item</h1>
<div class="container">
					<form class="form-horizontal" action="?do=Update" method="POST">
					<input type="hidden" name="itemid" value="<?php echo $itemid ?>">

						
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="name" class="form-control"  autocomplete ="off" required="required" placeholder="Name of the Item" value="<?php echo $item['Name']  ?>">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Description</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="description" class="form-control"  autocomplete ="off" required="required" placeholder="Description of the Item"
								value="<?php echo $item['Description']  ?>">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Price</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="price" class="form-control"  autocomplete ="off" required="required" placeholder="Price of the Item"
								value="<?php echo $item['Price']  ?>">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Country</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="country" class="form-control"  autocomplete ="off" required="required" placeholder="Country of made"
								value="<?php echo $item['Country_Made']?>">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Status</label>
							<div class="col-sm-10 col-md-4">
								<select class="form-control" name="status">
								    <option value="0">...</option>
									<option value="1" <?php if ($item['Status'] == 1) {echo "selected";
									} ?>>New</option>
									<option value="2" <?php if ($item['Status'] == 2) {echo "selected";
									} ?>>Like New</option>
									<option value="3" <?php if ($item['Status'] == 3) {	echo "selected";} ?>>Used</option>
									<option value="4" <?php if ($item['Status'] == 4) {echo "selected";
									} ?>>Very Old</option>
							    </select>
							</div>
						</div>

						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Member</label>
							<div class="col-sm-10 col-md-4">
								<select class="form-control" name="member">
								    <option value="0">...</option>
								    <?php
								    	$stmt=$con->prepare("SELECT * from users");
								    	$stmt->execute();
								    	$users=$stmt->fetchAll();
								    	foreach ($users as $user) {
								    		
								    		echo "<option value='".$user['UserID']. "'";
								    		if ($item['Member_ID'] == $user['UserID']) {echo "selected";} 

								    	echo ">".$user['Username']."</option>";
								    	}

								    ?>
								
							    </select>
							</div>
						</div>


						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Category</label>
							<div class="col-sm-10 col-md-4">
								<select class="form-control" name="category">
								    <option value="0">...</option>
								    <?php
								    	$stmt2=$con->prepare("SELECT * from categories");
								    	$stmt2->execute();
								    	$cats=$stmt2->fetchAll();
								    	foreach ($cats as $cat) {
								    		
								    		echo "<option value='".$cat['ID']. "'";
								    		if ($item['Cat_ID'] == $cat['ID']) {echo "selected";} 
								    		echo ">".$cat['Name']."</option>";
								    	}

								    ?>
								
							    </select>
							</div>
						</div>

						

						
						
						<div class="form-group form-group-lg">
							
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Add Item" class="btn btn-primary btn-sm">
							</div>
						</div>
				</form>
			</div>			



		

		<?php 
				// else  there is no id show err message
				}else{
					echo "<div class='container'>";
					$theMsg='<div class ="alert alert-danger"> there is no such id</div>';
					redirectHome($theMsg);
					echo "</div>";
				}

		}elseif ($do=='Update') {

			echo "<h1 class='text-center'>Update Item</h1>";
			echo "<div class ='container'>";
 
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				//get the variable from the form
				$id = $_POST['itemid'];
				$name = $_POST['name'];
				$desc = $_POST['description'];
				$price = $_POST['price'];
				$country = $_POST['country'];
				$status = $_POST['status'];
				$member = $_POST['member'];
				$cat = $_POST['category'];
				

			
				// validate the form
				$formErrors = array();
				if (empty($name)) {

					$formErrors[]='Name cant be empty';
				}
				if (empty($desc)) {

					$formErrors[]='Description cant be empty';
				}
				if (empty($price)) {
					$formErrors[]='Price cant be empty';
				}
				if (empty($country)) {
					$formErrors[]='Country cant be empty';
				}

				if ($status == 0) {
					$formErrors[]='You must choose the Status';
				}

				if ($member == 0) {
					$formErrors[]='You must choose the member';
				}

				if ($status == 0) {
					$formErrors[]='You must choose the Category';
				}
				

				foreach ($formErrors as $error) {
					echo '<div class="alert alert-danger">'. $error. '</div>' ;
				}
				// check if there is no error proced the update operation 
				if(empty($formErrors)) {
					// update the database with this is info

				$stmt =$con->prepare("UPDATE items SET Name = ?,Description =?, Price=? ,Country_Made=? ,Status=? ,Cat_ID=? ,Member_ID=? WHERE item_ID = ?");
				 $stmt->execute(array($name,$desc,$price,$country,$status,$cat,$member,$id));

				// echo succes message

				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record updated</div>';
				 redirectHome($theMsg,'back');

				}

			}else{

				$theMsg= '<div class="alert alert-danger">SORRY YOU CANT BROWSE THIS PAGE DIRECT </div>';
				redirectHome($theMsg);
			}
			echo "</div>";

		}
		elseif ($do=='Delete') {
			echo "<h1 class='text-center'>DELETE Item</h1>";
			echo "<div class ='container'>";
			
			// check if get request itemid is numirec and get the integer value of it 
			$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

			//selecct all data depend this id
			//$stmt = $con->prepare("SELECT * FROM users WHERE  UserID = ? LIMIT 1");
			$check=checkItem('item_ID','items',$itemid);
			
			/*exexute query
			$stmt->execute(array($userid));
			
			// the row count
			 $count = $stmt->rowCount();*/
			// if there is such id show the form
			if ($check > 0) { 

				$stmt = $con-> prepare("DELETE FROM items WHERE item_ID = :zid");
				$stmt->bindParam(":zid",$itemid);
				$stmt->execute();
				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record deleted</div>';
				 redirectHome($theMsg,'back');

			}else{
				$theMsg= "<div class='alert alert-danger'>this id is not exist </div>";
				redirectHome($theMsg);
			}

			echo "</div>";
		}
		elseif ($do=='Approve') {
			echo "<h1 class='text-center'>Approve Item</h1>";
			echo "<div class ='container'>";
			
			// check if get request itemid is numirec and get the integer value of it 
			$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

			//selecct all data depend this id
			//$stmt = $con->prepare("SELECT * FROM users WHERE  UserID = ? LIMIT 1");
			$check=checkItem('item_ID','items',$itemid);
			
			/*exexute query
			$stmt->execute(array($userid));
			
			// the row count
			 $count = $stmt->rowCount();*/
			// if there is such id show the form
			if ($check > 0) { 

				$stmt = $con-> prepare("UPDATE items SET Approve =1  WHERE item_ID = ?");
				
				$stmt->execute(array($itemid));
				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record ACTIVATED</div>';
				 redirectHome($theMsg);

			}else{
				$theMsg= "<div class='alert alert-danger'>this id is not exist </div>";
				redirectHome($theMsg);
			}

			echo "</div>";
		}
			
		

		include $tpl . 'footer.php'; 

	}else{
		
		header('Location:index.php');
		exit();
	} 

	?>