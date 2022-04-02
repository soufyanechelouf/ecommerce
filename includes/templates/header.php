
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo getTitle() ?></title>
	<link rel="stylesheet"  href="layout/css/bootstrap.min.css">
	<link rel="stylesheet"  href="layout/css/font-awesome.min.css">
	<link rel="stylesheet"  href="layout/css/jquery.bxslider.css">
    
	<link rel="stylesheet"  href="layout/css/front.css">
	<link rel="stylesheet"  href="layout/css/style1.css">

</head>
<body>
	<div class="upper-bar">
		<div class="container">
			<?php 
				
				    if(isset($_SESSION['user'])){
					echo "welcome ". $sessionUser.' ';
					echo '<a href="profile.php">My Profile</a>';
					echo '-<a href="logout.php">Logout</a>';

					$userStatus=checkUserStatus($sessionUser);
					if ($userStatus ==1) {
						// user is not active
					}
				}else{

			?>
			<a href="login.php">
				<span class="pull-right">Login/Signup</span></a>
				<?php } ?>
		</div>
	</div>
	<nav class="navbar navbar-inverse">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php">Home</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="app-nav1">
	      <ul class="nav navbar-nav navbar-right">

	      <?php

	          foreach (getCat() as $cat) {
		    	echo  '<li>
		    			<a href="categories.php?pageid='.$cat['ID'] .'&pagename='.str_replace(' ', '-',$cat['Name']).' ">' . $cat['Name'] .
		    		   '</a>
		    	</li>';

	    }
	 ?>
	 <li><a href="contact.php">contact </a> </li>
	 <li><a href="panier.php">panier </a> </li>
	 <li class="Search" style="margin-top: 10px;margin-left: 5px;">
                            
                                <input  style="border: none;
    border-radius: 7px 0 0 7px;border:2px solid #0e8ce4" type="search" class="header_search_input" placeholder="Search for products..."/>
                                <button type="submit" class="header_search_button" value="Submit"><img src="layout/images/search.png" alt="search icon"></button>
                            
                    </li>
	
	       </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
