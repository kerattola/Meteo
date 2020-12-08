<?php 
session_start();
require_once ("./layout/right_menu.php");
$file='';
if(isset($_GET['action'])){
$file = './views/'.$_GET['action'].'.php';
}

if (file_exists($file)) {
	require_once $file;
	if (($file != './views/login.php')&&($file != './views/registration.php')&&($file != './views/newdish.php')) {
		require_once ("./layout/footer.php");
    }
}
else{
	require_once ("./layout/header.php");
	require_once ("./views/main.php");
	require_once ("./layout/footer.php");
}

?>