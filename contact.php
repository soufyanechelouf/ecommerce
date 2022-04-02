<?php
	session_start();

	$pageTitle="Contact";

	include 'init.php';

	if(isset($_SESSION['user'])){

	$getUser =$con -> prepare("SELECT * from users where Username= ?")	;
	$getUser->execute(array($sessionUser));
	$info =$getUser ->fetch();


	?>
<h1 class="text-center">Contact</h1>
  
<div class="information block">
	<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading"> Contact Information</div>
		<div class="panel-body">
			<ul class="list-unstyled">
			<li>
				<i class="fa fa-unlock-alt fa fa-fw"></i>
				<span>Name</span>: Ocean Strore</li>
			<li>
				<i class="fa fa-envelope-o fa fa-fw"></i>
				<span>Email</span>:oceanstore@gmail.com</li>
			<li>
				<i class="fa fa-user fa fa-fw"></i>
				<span>adresse</span>: coop-c1, Draria, Algiers, Algeria</li>
			<li>
				<i class="fa fa-phone fa fa-fw"></i>
				<span>Tel</span>: +213-540-57-66-32</li>

			</ul>
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