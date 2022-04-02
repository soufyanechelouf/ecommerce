<?php


/** Get  categories functions v 1.0
**function to get categories  from data base*/

function getCat(){

	GLOBAL $con;
	$getCat = $con->prepare("SELECT * FROM categories ORDER BY ID DESC");
	$getCat->execute();
	$cats =$getCat->fetchAll();
	return $cats;
}



/** Get  items functions v 1.0
**function to get items  from data base*/

function getItems($where,$value){

	GLOBAL $con;
	$getItems = $con->prepare("SELECT * FROM items where $where=? ORDER BY item_ID DESC");
	$getItems->execute(array($value));
	$items =$getItems->fetchAll();
	return $items;
}


/*  
** check if user is not activated
** function to xheck the reg status of the user
*/
function checkUserStatus($user){

	GLOBAL $con;
 
$stmtx = $con->prepare("SELECT Username,RegStatus FROM users WHERE Username=? AND RegStatus = 0 ");
$stmtx->execute(array($user));

$status = $stmtx->rowCount();
return $status;

}











/* back end functions*/
/*
**title func v1.0 that echo in case has the variable $pagetitle and echo default title for others*/

function getTitle() {

	GLOBAL $pageTitle;

	if (isset($pageTitle)) {
		echo $pageTitle;
	}else {
		echo "default";
	}

} 

/* redirect function  v2.0*/

function redirectHome($theMsg,$url=null,$second = 1){

	if ($url === null) {
		$url ='index.php';
		
	}
	else{
		$url = isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']!== '' ? $_SERVER['HTTP_REFERER']:'index.php';
		
		
	}
	echo $theMsg;
	echo "<div class ='alert alert-info'>you will be redirected to $url after. $second. </div>";
	header("refresh:$second;url=$url");
	exit();

}
/*
**function to check items in database v1.0*/

function checkItem($select,$from,$value){
	GLOBAL $con;
	$statement2 = $con->prepare("SELECT $select FROM $from WHERE $select = ?"); 
	$statement2->execute(array($value));
	$count =$statement2->rowCount();
	return $count;
}

/** Coun tnumber of Items function v 1.0
**function to count nnumber of items rows*/
function countItems($item,$table){

	GLOBAL $con;
	$stmt2= $con->prepare("SELECT COUNT($item) from $table");
		$stmt2-> execute();
		return $stmt2->fetchColumn();

}

function countCat($cat,$table){

	GLOBAL $con;
	$stmt2= $con->prepare("SELECT COUNT($cat) from $table");
		$stmt2-> execute();
		return $stmt2->fetchColumn();

}
/** Get latest record functions v 1.0
**function to get lates items from data base*/

function getLatest($select,$table,$order,$limit){

	GLOBAL$con;
	$getStmt =$con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit ");
	$getStmt->execute();
	$rows =$getStmt->fetchAll();
	return $rows;
}
