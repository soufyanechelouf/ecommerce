<?php
	session_start();
	$noNavbar='';
	$pageTitle='login';
	if(isset($_SESSION['Username'])){
		header('Location:dashboard.php');//redirectio to dashboard

	}
	include 'init.php';
  

// chek if user coming from request post
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$username = $_POST['user'];
$password = $_POST['pass'];
$hashedPass= sha1($password);

//check if user in database
 
$stmt = $con->prepare("SELECT UserID,username,Password FROM users WHERE Username=? AND Password =? AND GroupeID = 1 LIMIT 1");
$stmt->execute(array($username,$hashedPass));
$row =$stmt->fetch();
$count = $stmt->rowCount();
if ($count>0){
	$_SESSION['Username'] = $username;
	 // register session name
	$_SESSION['ID'] = $row['UserID'];
	header('Location:dashboard.php');//redirectio to dashboard
	exit();
}
} 

 
?> 
	<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<h3 class="text-center">ADMIN LOGIN</h3>
		<input class="form-control" type="text" name="user" placeholder="username" autocomplete="off">
		<input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new password">
		<input class="btn btn-primary btn-block" type="submit" name="login">
	</form>	


<?php include $tpl . 'footer.php'; ?> 	   