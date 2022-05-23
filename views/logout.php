<?php
 unset($_SESSION["login"]);
 session_destroy();
 header("Location:http://localhost/meteo/index.php?action=home");
 ?>