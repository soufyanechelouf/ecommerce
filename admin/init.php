<?php

include 'connect.php';

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

//include navbar on all pages expect the one with $nonavbar

if(!isset($noNavbar)){include $tpl . 'navbar.php';}

    
