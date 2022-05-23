<!DOCTYPE html>
<html>
<head>
  <meta http-equiv=content-type content="text/html; charset=utf-8">
  <link href="./css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
 
</head>

<body>
  <nav class="navbar navbar-expand-md">
    <div class="collapse navbar-collapse" id="main-navigation">
    <ul class="nav nav-inline">
      <li  class="nav-item">
        <button class="glow-on-hover" type="button">
          <a class="nav-link" href="index.php?action=home"><p>Головна</p></a>
        </button>
      </li>
      <li class="nav-item">
        <button class="glow-on-hover" type="button">
      <a  class="nav-link" href="index.php?action=about"><p>Дані метеостанції</p></a>
    </button>
      </li>

<?php  
if(!isset($_SESSION['login']) and empty($_SESSION['login'])) {
echo "<li class='nav-item'>
<button class='glow-on-hover' type='button'>
      <a class='nav-link' href='index.php?action=login'><p>Вхід</p></a>
      </button>
      </li>";
}
else{
echo "<li class='nav-item'>
<button class='glow-on-hover' type='button'>
      <a class='nav-link' href='index.php?action=constructure'><p>Додати дані</p></a>
      </button>
      </li>";

echo "<li class='nav-item'>
<button class='glow-on-hover' type='button'>
      <a class='nav-link' href='index.php?action=logout'><p>Вихід</p></a>
      </button>
      </li>";
}
?>
     </ul>
   </div>
      </nav>