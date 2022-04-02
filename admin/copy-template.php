<?php

/*
=============================================
category page
=============================================
*/

session_start();
$pageTitle ='';
	if(isset($_SESSION['Username'])){

	
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 
		//start manage page
		if ($do =='Manage') {

			echo "welcome";
		}elseif ($do=='Add') {
			# code...
		}
		elseif ($do=='Insert') {
			# code...
		}elseif ($do=='Edit') {
			# code...
		}elseif ($do=='Update') {
			# code...
		

		include $tpl . 'footer.php'; 

	}else{
		
		header('Location:index.php');
		exit();
	} 

	?>