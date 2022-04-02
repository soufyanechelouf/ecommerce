<?php
	ob_start(); // output buffering start   ***fix header problem
	session_start();
	if(isset($_SESSION['Username'])){

		$pageTitle = 'Dashboard';
		include 'init.php';
		
		/* start dashboard page*/
		$numUsers = 6; // number of latest users
		$latestUsers =getLatest("*","users","UserID",$numUsers);// latest user array
		$numItems =6; // number of latest items
		$latestItems=getLatest("*",'items','item_ID',$numItems);// latest items array

//

		?>
	<div class="home-stats">
		<div class="container text-center">
			<h1>Dashboard</h1>

			<div class="row">
				<div class="col-md-4">
					<div class="stat st-members ">
					<i class="fa fa-users"></i>
						<div class="info">
							<b>Total Clients</b>
						<span><a href="Members.php"><?php echo countItems('UserID','users') ?></a></span>
						</div>

					</div>
				</div>	
				

				<div class="col-md-4">
					<div class="stat st-items">
					<i class="fa fa-tag"></i>
					<div class="info">
					<b>Total Items</b>
					<span><a href="items.php"><?php echo countItems('item_ID','items') ?></a></span>
					</div> 
				</div>
				</div>
				<div class="col-md-4">
					<div class="stat st-comments">
					<i class="fa fa-comments"></i>
					<div class="info">					
					<b>Total Categories</b>
					<span><a href="categories.php"><?php echo countCat('ID','categories') ?></a></span>
					</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>	
    <div class="latest">
		<div class="container"> 
			<div class="row">
				<div class="col-sm-6">
					<div class="panel panel-default">
					<?php  ;?>
						<div class="panel-heading">
							<i class="fa fa-users"></i> Latest <?php echo $numUsers  ?> actif clients
							<span class="toggle-info pull-right">
								<i class="fa fa-plus fa-lg"></i>
							</span>
						</div>	
						<div class="panel-body">
							<ul class="list-unstyled latest-users">
							<?php 
								
								foreach ($latestUsers as $user) {

								echo '<li>' . $user['Username'] .'<a href="members.php?do=Edit&userid=' .$user['UserID'].'"><span class="btn btn-success pull-right"><i class ="fa fa-edit"></i>  Edit';
								if($user['RegStatus']==0){
					     	echo "<a href='members.php?do=Activate&userid=". $user['UserID']."' class='btn btn-info pull-right class='activate'><i class='fa fa-check'></i>Activate</a>";

							}
								echo '</span></a></li>';
								}

							?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-tag"></i> Latest Items <?php echo $numItems  ?> 
							<span class="toggle-info pull-right">
								<i class="fa fa-plus fa-lg"></i>
							</span>
						</div>	
						<div class="panel-body">

							<ul class="list-unstyled latest-users">
							<?php 
								
								foreach ($latestItems as $item) {

								echo '<li>' . $item['Name'] .'<a href="items.php?do=Edit&itemid=' .$item['item_ID'].'"><span class="btn btn-success pull-right"><i class ="fa fa-edit"></i>  Edit';
								if($item['Approve']==0){
					     	echo "<a href='items.php?do=Approve&itemid=". $item['item_ID']."' class='btn btn-info pull-right class='activate'><i class='fa fa-check'></i>Activate</a>";

							}
								echo '</span></a></li>';
								}

							?>
							</ul>
							
						</div>
					</div>
				</div>
			</div>
			
		</div>

	</div>	
		<?php
		/* start dashboard page*/
		include $tpl . 'footer.php'; 

	}else{
		
		header('Location:index.php');
		exit();
	} 

	ob_end_flush();
	?>