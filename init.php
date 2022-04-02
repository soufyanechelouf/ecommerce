<?php
// Error Reporting

ini_set('display_errors','On');
error_reporting(E_ALL);

include 'admin/connect.php';

$sessionUser='';

if (isset($_SESSION['user'])) {

	$sessionUser =$_SESSION['user'];
}

// routes

$tpl   = 'includes/templates/'; 
$lang1 = 'includes/languages/';
$func  = 'includes/functions/';
$css   = 'layout/css/';
$js    = 'layout/js/';



//include the important file 
include $func. 'functions.php';
include $lang1 . 'english.php';
include $tpl . 'header.php'; 




    
