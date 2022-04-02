<?php
	session_start();
	
	$pageTitle="Login";
	if(isset($_SESSION['user'])){
		header('Location:index.php'); 
	}
	include 'init.php';
	// chek if user coming from request post
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['login'])) {
	 
	
$user = $_POST['username'];
$pass = $_POST['password'];
$hashedPass= sha1($pass);

//check if user in database
 
$stmt = $con->prepare("SELECT Username,Password FROM users WHERE Username=? AND Password =? ");
$stmt->execute(array($user,$hashedPass));

$count = $stmt->rowCount();
if ($count>0){

	$_SESSION['user'] = $user;
	 // register session name
	
	header('Location:index.php');//redirectio to dashboard
	exit();
}
} else {
	$formErrors = array();

	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];

	if (isset($username)) {
		$filtredUser =filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		if (strlen($filtredUser)<4 ) {
			$formErrors[] ='Username must be larger than 4 caracter';
		}
	}
	if (isset($password) && isset($password2)) {
		$pass1=sha1($password);
		$pass2=sha1($password2);

		if ($pass1 !== $pass2) {
			$formErrors[] = 'Sorry password is not match';
		}
	}

	if (isset($email)) {
		$filtredEmail =filter_var($email, FILTER_SANITIZE_EMAIL);
		if (filter_var($filtredEmail,FILTER_VALIDATE_EMAIL)!= true) {
			
			$formErrors[]= 'this email is not valid';
		}
	}

		// check if there is no error proced the user add 
	    if(empty($formErrors)) {

					//check if user exist in DB
					
			    $check =checkItem("Username","users",$username);
			    if ($check == 1) {
			    	$formErrors [] = 'this user is exist';			    	
			    }else{

					// insert userinfo in data base
					$stmt = $con ->prepare("INSERT INTO users(Username,Password,Email,RegStatus,Date)VALUES(:zuser,:zpass,:zmail,0,now()) ");
					$stmt->execute(array(
						'zuser'=>$username,
						'zpass'=>sha1($password),
						'zmail'=>$email
						
						));


				// echo succes message

				 $succesMsg='congrate you are now registred user';


				}    
			}

}
} 


?>
	<div class="container login-page">
	<h1 class="text-center"><span class="selected" data-class="login">Login</span> | <span data-class="signup">Signup</span></h1>

		<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST" >
			<input class="form-control" type="text" name="username" autocomplete="off" placeholder="type your user name">
			<input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="type your password">
			<input class="btn btn-primary btn-block" name="login" type="submit" value="Login">
		
		</form>
		<form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
			<input pattern=".{4,}" title="Username must be larger than 4" class="form-control" type="text" name="username" autocomplete="off" placeholder="type your user name" required>
			<input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="type a complex password" required>
			<input class="form-control" type="password" name="password2" autocomplete="new-password" placeholder="repeat your password" required >
			<input class="form-control" type="email" name="email" placeholder="type a valid email" required>


			<input class="btn btn-success btn-block" name="signup" type="submit" value="Signup"></div>
		
		</form>
		<div class="the-errors text-center">
			<?php 
				if (!empty($formErrors)) {
					foreach ($formErrors as $error) {
						echo '<div class="msg error">'. $error ."</div>";
					}
				}
				if (isset($succesMsg)) {
					echo '<div class="msg success">'.$succesMsg .'</div>';
				}
			?>
			
		</div>
    </div>



<?php
	include $tpl .'footer.php';

?> 