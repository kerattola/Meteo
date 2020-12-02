<?php 
   $address='inf';
   $fullprice='inf';
  $servername = "localhost";
  $database = "atm_teamdb";
  $username = "root";
  $password = "";
        $conn3 = mysqli_connect($servername,$username,$password,$database);
        mysqli_set_charset($conn3, 'utf8');
        if (!$conn3) {
      die("Connection failed: " . mysqli_connect_error());
                    }

    else{
     	
     	$my_or = (int)$_SESSION['neworder'];

        $query3 = "SELECT * FROM `orders` WHERE `orders`.`order_id`=" . $my_or;
        $result3 = $conn3->query($query3);
  
 		 while ($row =$result3->fetch_assoc()) {
 		 	$address=$row["address"];
 		 	$fullprice=$row["full_price"];
       }
    
    if($address == '' && $fullprice == ''){
    	$mensql = "DELETE FROM `order_menudish` WHERE `order_menudish`.`order_id`=" . $my_or; 
        $res = mysqli_query($conn3, $mensql) or die("Ошибка " . mysqli_error($conn3)); 

        $dissql = "DELETE FROM `order_dish` WHERE `order_dish`.`order_id`=" . $my_or; 
        $res = mysqli_query($conn3, $dissql) or die("Ошибка " . mysqli_error($conn3)); 

        $outsql = "DELETE FROM `orders` WHERE `orders`.`order_id`=" . $my_or; 
        $res = mysqli_query($conn3, $outsql) or die("Ошибка " . mysqli_error($conn3)); 
    }

        mysqli_close($conn3);
    }

 unset($_SESSION["login"]);
 session_destroy();
 header("Location:http://localhost/ATM_project/index.php?action=home");
 ?>