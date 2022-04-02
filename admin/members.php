<?php

/*
=============================================
manages memebers page
you can add /edit /delete members from here 
=============================================
*/

session_start();
$pageTitle ='members';
	if(isset($_SESSION['Username'])){

	
		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 
		//start manage page
		if ($do =='Manage') {// manage membre page 

			 $query='';
			 if(isset($_GET['page']) && $_GET['page'] == 'Pending'){
			 	$query='AND RegStatus = 0';
			 }
			// select all user except admin=gid =1
			$stmt =$con ->prepare("SELECT * from users WHERE GroupeID != 1 $query ORDER BY UserID DESC");
			$stmt -> execute();

			//assign to variable
			$rows =$stmt ->fetchAll();  


		 ?>

		<h1 class="text-center">Manage Clients</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
						<td>#ID</td>
						<td>Username</td>
						<td>Email</td>
						<td>Full Name</td>
						<td>Registred Date</td>	
						<td>Control</td>
					</tr>
					<?php
					   foreach ($rows as $row )	{
					   	echo "<tr>";
					   		echo "<td>" . $row['UserID'] . "</td>";
					   		echo "<td>" . $row['Username'] . "</td>";
					   		echo "<td>" . $row['Email'] . "</td>";
					   		echo "<td>" . $row['FullName'] . "</td>";
					   		echo "<td>" .$row['Date'] . "</td>";
					   		echo "<td> 
					   			<a href='members.php?do=Edit&userid=". $row['UserID']."'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
					   		<a href='members.php?do=Delete&userid=". $row['UserID']."' class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
					   		if($row['RegStatus']==0){
					     	echo "<a href='members.php?do=Activate&userid=". $row['UserID']."' class='btn btn-info class='activate'><i class='fa fa-check'></i>Activate</a>";

							}
							echo"</td>";

							


					   	echo"<tr>";
					   }


					?>

			
					

				</table>
			
			</div>
			<a href="members.php ?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> New Membre</a>
			
		</div>

	    
		<?php } 
		elseif ($do == 'Add') { // add members?>
			
				<h1 class="text-center">Add New Member</h1>
<div class="container">
					<form class="form-horizontal" action="?do=Insert" method="POST">
						
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="username" class="form-control"  autocomplete ="off" required="required" placeholder="username to login th shop">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10 col-md-4">
								
								<input type="password" name="Password" autocomplete="new-password" class=" password form-control" required="required" placeholder="password hard and complexe">
								<i class="show-pass fa fa-eye fa-2x"></i>
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10 col-md-4">
								<input type="email" name="Email" class="form-control" required="required" placeholder="Email must be valid">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Full Name</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="Full" class="form-control"  required="required">
							</div>
						</div>
						<div class="form-group form-group-lg">
							
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="Add Member" class="btn btn-primary">
							</div>
						</div>
				</form>
			</div>
		<?php
		 }elseif ($do == 'Insert') {
		 	//insert membre page
		 		

 
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				echo "<h1 class='text-center'>INSERT Member</h1>";
			echo "<div class ='container'>";
				//get the variable from the form
				
				$user = $_POST['username'];
				$pass = sha1($_POST['Password']);
				$email = $_POST['Email'];
				$name = $_POST['Full'];

				$hashedpass = sha1($_POST['Password']);

				
				// validate the form
				$formErrors = array();
				if (strlen($user)<4) {

					$formErrors[]='username cant be less than 4 carcaters';
				}
				if (strlen($user)>20) {

					$formErrors[]='username cant be more than 4 carcaters';
				}
				if (empty($user)) {
					$formErrors[]='username cant be empty';
				}
				if (empty($pass)) {
					$formErrors[]='password cant be empty';
				}

				if (empty($name)) {
					$formErrors[]='name cant be empty';
				}
				if (empty($email)) {
					$formErrors[]='email cant be empty';
				}

				foreach ($formErrors as $error) {
					echo '<div class="alert alert-danger">'. $error. '</div>' ;
				}
				// check if there is no error proced the update operation 
				if(empty($formErrors)) {

					//check if user exist in DB
					
			    $check =checkItem("Username","users",$user);
			    if ($check == 1) {
			    	$theMsg = "<div class='alert alert-danger' Sorry this User Is Exist</div>";
			    	redirectHome($theMsg,'back');
			    }else{

					// insert users info in data base
					$stmt = $con ->prepare("INSERT INTO users(Username,Password,Email,FullName,RegStatus,Date)VALUES(:zuser,:zpass,:zmail,:zname,1,now()) ");
					$stmt->execute(array(
						'zuser'=>$user,
						'zpass'=>$hashedpass,
						'zmail'=>$email,   
						'zname'=>$name
						));


				// echo succes message

				 $theMsg="<div class='alert alert-success'>". $stmt->rowCount() . 'record inserted </div>';

				 	redirectHome($theMsg,'back');

				}    
			}

			}else{
				echo "<div class='container'>";
				$theMsg = '<div class="alert alert-danger">SORRY YOU CANT BROWSE THIS PAGE DIRECT</div>';
				redirectHome($theMsg);
                echo "</div>";
			}
			echo "</div>";
		 }
		elseif ($do == 'Edit') {//edit page  
			// check if get request userid is numirec and get the integer value of it
			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			//selecct all data depend this id
			$stmt = $con->prepare("SELECT * FROM users WHERE  UserID = ? LIMIT 1");
			//exexute query
			$stmt->execute(array($userid));
			//fetch the data
			$row =$stmt->fetch();
			// the row count
			$count = $stmt->rowCount();
			// if there is such id show the form
			if ($count> 0) { ?>

				<h1 class="text-center">Edit fournisseur</h1>
				<div class="container">
					<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="userid" value="<?php echo $userid ?>">
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="username" class="form-control" value="<?php echo $row['Username'] ?>" autocomplete ="off" required="required">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10 col-md-4">
								<input type="hidden" name="oldPassword" value="<?php echo $row['Password'] ?>">
								<input type="password" name="newPassword" autocomplete="new-password" class="form-control">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10 col-md-4">
								<input type="email" name="Email" class="form-control" value="<?php echo $row['Email'] ?>" required="required">
							</div>
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-2 control-label">Full Name</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="Full" class="form-control" value="<?php echo $row['FullName'] ?>" required="required">
							</div>
						</div>
						<div class="form-group form-group-lg">
							
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" value="save" class="btn btn-primary">
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
		}	

		elseif ($do == 'Update') {// update page
			echo "<h1 class='text-center'>Update Member</h1>";
			echo "<div class ='container'>";
 
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				//get the variable from the form
				$id = $_POST['userid'];
				$user = $_POST['username'];
				$email = $_POST['Email'];
				$name = $_POST['Full'];

				//password triks

				$pass =empty($_POST['newPassword']) ? $_POST['oldPassword'] : sha1($_POST['newPassword']);
				// validate the form
				$formErrors = array();
				if (strlen($user)<4) {

					$formErrors[]='<div class="alert alert-danger">username cant be less than 4 carcaters</div>';
				}
				if (strlen($user)>20) {

					$formErrors[]='<div class="alert alert-danger"> username cant be more than 4 carcaters</div>';
				}
				if (empty($user)) {
					$formErrors[]=' <div class="alert alert-danger"> username cant be empty</div>';
				}

				if (empty($name)) {
					$formErrors[]=' <div class="alert alert-danger"> name cant be empty</div>';
				}
				if (empty($email)) {
					$formErrors[]='<div class="alert alert-danger"> email cant be empty</div>';
				}

				foreach ($formErrors as $error) {
					echo $error ;
				}
				// check if there is no error proced the update operation 
				if(empty($formErrors)) {
  					$stmt2=$con -> prepare("SELECT * FROM users WHERE Username =? AND UserID !=? ");
  					$stmt2-> execute(array($user,$id));
  					$count =$stmt2 -> rowCount(); 
  					
  					if ($count == 1) {
  						echo "<div class='alert alert-danger'>sorry this user is exist</div>";
  						redirectHome($theMsg,'back');
  					} else {
  							// update the database with this is info

							$stmt =$con->prepare("UPDATE users SET Username = ?,Email =?, FullName=? ,Password=? WHERE UserID = ?");
							 $stmt->execute(array($user,$email,$name,$pass,$id));

							// echo succes message

							 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record updated</div>';
							 redirectHome($theMsg,'back');

  					}


				}

			}else{

				$theMsg= '<div class="alert alert-danger">SORRY YOU CANT BROWSE THIS PAGE DIRECT </div>';
				redirectHome($theMsg);
			}
			echo "</div>";
		}elseif ($do == "Delete") {//delete members page
			echo "<h1 class='text-center'>DELETE MEMBERS</h1>";
			echo "<div class ='container'>";
			
			// check if get request userid is numirec and get the integer value of it 
			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			//selecct all data depend this id
			//$stmt = $con->prepare("SELECT * FROM users WHERE  UserID = ? LIMIT 1");
			$check=checkItem('userid','users',$userid);
			
			/*exexute query
			$stmt->execute(array($userid));
			
			// the row count
			 $count = $stmt->rowCount();*/
			// if there is such id show the form
			if ($check > 0) { 

				$stmt = $con-> prepare("DELETE FROM users WHERE UserID = :zuser");
				$stmt->bindParam(":zuser",$userid);
				$stmt->execute();
				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record deleted</div>';
				 redirectHome($theMsg,'back');

			}else{
				$theMsg= "<div class='alert alert-danger'>this id is not exist </div>";
				redirectHome($theMsg);
			}

			echo "</div>";
		}elseif ($do == 'Activate') {// activate page
			echo "<h1 class='text-center'>Activate MEMBERS</h1>";
			echo "<div class ='container'>";
			
			// check if get request userid is numirec and get the integer value of it 
			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			//selecct all data depend this id
			//$stmt = $con->prepare("SELECT * FROM users WHERE  UserID = ? LIMIT 1");
			$check=checkItem('userid','users',$userid);
			
			/*exexute query
			$stmt->execute(array($userid));
			
			// the row count
			 $count = $stmt->rowCount();*/
			// if there is such id show the form
			if ($check > 0) { 

				$stmt = $con-> prepare("UPDATE users SET RegStatus =1  WHERE UserID = ?");
				
				$stmt->execute(array($userid));
				 $theMsg= "<div class='alert alert-success'>". $stmt->rowCount() . 'record ACTIVATED</div>';
				 redirectHome($theMsg);

			}else{
				$theMsg= "<div class='alert alert-danger'>this id is not exist </div>";
				redirectHome($theMsg);
			}

			echo "</div>";
		}

		
		include $tpl . 'footer.php'; 

	}
	else{
		
		header('Location:index.php');
		exit();
	} 