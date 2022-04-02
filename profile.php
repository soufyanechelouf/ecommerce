<?php
	session_start();

	$pageTitle="Profile";

	include 'init.php';

	if(isset($_SESSION['user'])){

	$getUser =$con -> prepare("SELECT * from users where Username= ?")	;
	$getUser->execute(array($sessionUser));
	$info =$getUser ->fetch();


	?>
<h1 class="text-center">My Profile</h1>
  
<div class="information block">
	<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">My Information</div>
		<div class="panel-body">
			<ul class="list-unstyled">
			<li>
				<i class="fa fa-unlock-alt fa fa-fw"></i>
				<span>Login Name</span>: <?php echo $info['Username'] ?></li>
			<li>
				<i class="fa fa-envelope-o fa fa-fw"></i>
				<span>Email</span>: <?php echo $info['Email'] ?></li>
			<li>
				<i class="fa fa-user fa fa-fw"></i>
				<span>Full Name</span>: <?php echo $info['FullName'] ?></li>
			<li>
				<i class="fa fa-calendar fa fa-fw"></i>
				<span>Register Date</span>: <?php echo $info['Date'] ?></li>
				<li>
					<i class="fa fa-tags fa fa-fw"></i>
					<span>Fav Category</span> : </li>

			</ul>
		</div>
	</div>
	</div>
</div>



<div class="my-comment block">
	<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Latest Comment</div>
		<div class="panel-body">
			test comment
		</div>
	</div>
	</div>
</div>

	<?php

}else{

	header('Location: login.php');
	exit();
}

 	include $tpl . 'footer.php'; ?> 