<?php

/*
=============================================
category page
=============================================
*/
//ob_start();
session_start();
$pageTitle ='Categories';
	if(isset($_SESSION['Username'])){

	
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 
		//start manage page
		if ($do =='Manage') {
			$sort='ASC';
			$sort_array=array('ASC','DESC');
			if(isset($_GET['sort'])&& in_array($_GET['sort'],$sort_array)){
				$sort=$_GET['sort'];
			}
			$stmt2 = $con ->prepare("SELECT * FROM categories ORDER BY Ordering $sort")	;	
			$stmt2-> execute();	 
			$cats = $stmt2->fetchAll(); ?>

			<h1 class="text-center">Manage Categories </h1>
			<div class="container category">
				<div class="panel panel-default">
					<div class="panel-heading">Manage Categories
						<div class="Ordering pull-right">
							Ordering:
							<a href="?sort=ASC">ASC</a> |
							<a href="?sort=DESC">DESC</a>
						</div>
					</div>
					<div class="panel-body " style="padding: 0px;">
					<?php  
					foreach($cats as $cat ){
						echo '<div class="cat" style="padding: 15px;
	position: relative;">';
							echo "<div class ='hidden-buttons' style='position:absolute;
							top:15px;right: 10px;'>";
								echo "<a href='categories.php?do=Edit&catid=". $cat['ID'] ."' class='btn btn-xs btn-primary' style='
    margin-right:  5px;'><i class='fa fa-edit'></i> Edit</a>";
								echo "<a href='categories.php?do=Delete&catid=". $cat['ID'] ."' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i> Delete</a>";
								echo "</div>";
							echo "<h3>" .$cat['Name'] ."</h3>";
							echo "<p>";if ($cat['Description'] =='') {
								echo 'this category has no description';
							} else{ echo $cat['Description'];} 
							echo "</p>";
							if ($cat['Visibility'] == 1) {
							 	echo '<span class="visibility"> Hidden </span>';
							 } 
							 if ($cat['Allow_Comment'] == 1) {
							 	echo '<span class="commenting"> comment disabled </span>';
							 } 
							 if ($cat['Allow_Ads'] == 1) {
							 	echo '<span class="advertising"> ads disabled </span>';
							 } 
							
						
						echo "</div>";
						echo"<hr style='margin-top: 5px;margin-bottom: 5px;'>";

					}

					?>	
					</div>

				</div>
				<a style="margin-bottom: 30px; margin-top: -10px;" class="add-category btn btn-primary" href="categories.php?do=Add"><i class="fa fa-plus"></i> Add New Category</a>
			</div>


			<?php
		}elseif ($do=='Add') { ?>
			
		<h1 class="text-center">Add New Category</h1>
<div class="container">
					<form class="form-horizontal" action="?do=Insert" method="POST">
						
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="name" class="form-control"  autocomplete ="off" required="required" placeholder="Name of the Category">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Description</label>
							<div class="col-sm-10 col-md-4">
								
								<input type="text" name="description"  class=" password form-control"  placeholder="Describe the Category">
								
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Ordering</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="ordering" class="form-control" placeholder="Number to arrange the category">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Visible</label>
							<div class="col-sm-10 col-md-4">
								<div>
									<input id="vis-yes" type="radio" name="visibility" value="0" checked >
									<label for="vis-yes">Yes</label>
								</div>
								<div>
									<input id="vis-no" type="radio" name="visibility" value="1" >
									<label for="vis-no">No</label>
								</div>
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Allow Commenting</label>
							<div class="col-sm-10 col-md-4">
								<div>
									<input id="com-yes" type="radio" name="commenting" value="0" checked>
									<label for="com-yes">Yes</label>
								</div>
								<div>
									<input id="com-no" type="radio" name="commenting" value="1">
									<label for="com-no">No</label>
								</div>
							</div>
						</div>

						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Allow Ads</label>
							<div class="col-sm-10 col-md-4">
								<div>
									<input id="ads-yes" type="radio" name="ads" value="0" checked >
									<label for="ads-yes">Yes</label>
								</div>
								<div>
									<input id="ads-no" type="radio" name="ads" value="1" >
									<label for="ads-no">No</label>
								</div>
							</div>
						</div>
						<div class="form-group form-group-lg">
							
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Add Category" class="btn btn-primary">
							</div>
						</div>
				</form>
			</div>
		<?php
		}
		elseif ($do=='Insert') {
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				echo "<h1 class='text-center'>Insert Category</h1>";
			echo "<div class ='container'>";
				//get the variable from the form
				
				$name 	  = $_POST['name'];
				$desc 	  = $_POST['description'];
				$order = $_POST['ordering'];
				$visible  = $_POST['visibility'];
				$comment  = $_POST['commenting'];
				$ads 	  = $_POST['ads'];

			
				
				

					//check if category exist in DB
					
			    $check =checkItem("Name","categories",$name);
			    if ($check == 1) {
			    	$theMsg = "<div class='alert alert-danger'> Sorry this Category Is Exist</div>";
			    	redirectHome($theMsg,'back');
			    }else{

					// insert users info in data base
					$stmt = $con ->prepare("INSERT INTO categories (Name, Description, Ordering, Visibility, Allow_Comment, Allow_Ads)
						VALUES(:zname, :zdesc, :zorder, :zvisible, :zcomment, :zads)"); 
					$stmt->execute(array(
						'zname'		=> $name,
						'zdesc'		=> $desc,
						'zorder'	=> $order,   
						'zvisible'	=> $visible,
						'zcomment'	=> $comment,
						'zads'		=> $ads

						));


				// echo succes message

				 $theMsg="<div class='alert alert-success'>". $stmt->rowCount() . 'record inserted </div>';

				 	redirectHome($theMsg,'back');

				}    
			

			}else{
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">SORRY YOU CANT BROWSE THIS PAGE DIRECT</div>';
				redirectHome($theMsg,'back');
                echo "</div>";
			}
			echo "</div>";
			# code...
		}elseif ($do=='Edit') {

			// check if get request catID is numirec and get the integer value of it
			$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

			//select all data depend this id
			$stmt = $con->prepare("SELECT * FROM categories WHERE  ID = ? ");
			//exexute query
			$stmt->execute(array($catid));
			//fetch the data
			$cat =$stmt->fetch();
			// the row count
			$count = $stmt->rowCount();
			// if there is such id show the form
			if ($count> 0) { ?>

			<h1 class="text-center">Edit Category</h1>
<div class="container">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="catid" value="<?php echo $catid ?>" *
						>
						
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="name" class="form-control"  required="required" placeholder="Name of the Category" value="<?php echo $cat['Name'] ?>">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Description</label>
							<div class="col-sm-10 col-md-4">
								
								<input type="text" name="description"  class=" password form-control"  placeholder="Describe the Category" value="<?php echo $cat['Description'] ?>">
								
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Ordering</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="ordering" class="form-control" placeholder="Number to arrange the category" value="<?php echo $cat['Ordering'] ?>">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Visible</label>
							<div class="col-sm-10 col-md-4">
								<div>
									<input id="vis-yes" type="radio" name="visibility" value="0" <?php if ($cat['Visibility']== 0) {
										echo "checked";
									}?> >
									<label for="vis-yes">Yes</label>
								</div>
								<div>
									<input id="vis-no" type="radio" name="visibility" value="1" <?php if ($cat['Visibility']== 1) {
										echo "checked";
									}?> >
									<label for="vis-no">No</label>
								</div>
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Allow Commenting</label>
							<div class="col-sm-10 col-md-4">
								<div>
									<input id="com-yes" type="radio" name="commenting" value="0" <?php if ($cat['Allow_Comment']== 0) {
										echo "checked";
									}?>>
									<label for="com-yes">Yes</label>
								</div>
								<div>
									<input id="com-no" type="radio" name="commenting" value="1" <?php if ($cat['Allow_Comment']== 1) {
										echo "checked";
									}?>>
									<label for="com-no">No</label>
								</div>
							</div>
						</div>

						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Allow Ads</label>
							<div class="col-sm-10 col-md-4">
								<div>
									<input id="ads-yes" type="radio" name="ads" value="0" <?php if ($cat['Allow_Ads']== 0) {
										echo "checked";
									}?>>
									<label for="ads-yes">Yes</label>
								</div>
								<div>
									<input id="ads-no" type="radio" name="ads" value="1" <?php if ($cat['Allow_Ads']== 1) {
										echo "checked";
									}?>>
									<label for="ads-no">No</label>
								</div>
							</div>
						</div>
						<div class="form-group form-group-lg">
							
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Save" class="btn btn-primary">
							</div>
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
			echo "<h1 class='text-center'>Update Category</h1>";
			echo "<div class ='container'>";
 
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				//get the variable from the form
				$id = $_POST['catid'];
				$name = $_POST['name'];
				$desc = $_POST['description'];
				$order = $_POST['ordering'];
				$visible = $_POST['visibility'];
				$comment = $_POST['commenting'];
				$ads = $_POST['ads'];

				
				
				
				// update the database with this is info

				$stmt =$con->prepare("UPDATE categories SET Name = ?,Description =?, Ordering=? ,Visibility=? ,Allow_Comment=? ,Allow_Ads=? WHERE ID = ?");
				 $stmt->execute(array($name,$desc,$order,$visible,$comment,$ads,$id));

				// echo succes message

				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record updated</div>';
				 redirectHome($theMsg,'back');
				

			}else{

				$theMsg= '<div class="alert alert-danger">SORRY YOU CANT BROWSE THIS PAGE DIRECT </div>';
				redirectHome($theMsg);
			}
			echo "</div>";

		}
		elseif ($do=='Delete') {
				echo "<h1 class='text-center'>DELETE CATEGORY</h1>";
			echo "<div class ='container'>";
			
			// check if get request catid is numirec and get the integer value of it 
			$catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

			//selecct all data depend this id
			//$stmt = $con->prepare("SELECT * FROM users WHERE  UserID = ? LIMIT 1");
			$check=checkItem('ID','categories',$catid);
			
			/*exexute query
			$stmt->execute(array($userid));
			
			// the row count
			 $count = $stmt->rowCount();*/
			// if there is such id show the form
			if ($check > 0) { 

				$stmt = $con-> prepare("DELETE FROM categories WHERE ID = :zid");
				$stmt->bindParam(":zid",$catid);
				$stmt->execute();
				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record deleted</div>';
				 redirectHome($theMsg,'back');

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
	//ob_end_flush();

	?>