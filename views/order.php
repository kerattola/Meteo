<?php 
$servername = "localhost";
$database = "atm_teamdb";
$username = "root";
$password = "";

      $conn3 = mysqli_connect($servername,$username,$password,$database);
        mysqli_set_charset($conn3, 'utf8');
        if (!$conn3) {
      die("Connection failed: " . mysqli_connect_error());
                    }
?>

<section>
<form  action="index.php?action=order" method="POST">
    <div id="regtext"> <a name="order">Оформлення замовлення</a></div>
    <div align = "center"> <p>Дозаповніть форму.</p></div>
             <?php
              if(isset($_SESSION['neworder'])){
              $id=$_SESSION['neworder'];

               $sql3="SELECT c.phone,c.full_name, o.full_price
                 FROM  `orders` AS o
                 INNER JOIN `clients` AS c ON o.client_id=c.client_id
                 WHERE o.order_id=$id";
                 $query3=mysqli_query($conn3,$sql3);
                   if ($sql3){
                    while($row=mysqli_fetch_array($query3)){
                    $fullname1 = $row["full_name"];
                    $phone1 = $row["phone"];
                    $fullprice1 = $row["full_price"];
                    }}
                     ?>
       <table >
         <tr>
            <td><div class="inlinetxt"><b>П.І.Б.</b></label></div> </td>
            <td class="tdwidth"><div class="inlinetxt"><?php echo $_SESSION['name'] ?></label></div> </td>
       </tr>
        <tr>
            <td><div class="inlinetxt"><b>Номер телефону</b></label></div> </td>
            <td class="tdwidth"><div class="inlinetxt"><?php echo $phone1 ?></label></div> </td>
        </tr>
        <tr>
             <td><div class="inlinetxt"><label for="address"><b>Адреса</b></label></div></td>
            <td class="tdwidth"><input type="address" placeholder="Введіть адресу" name="address" required></td>
        </tr>
         <tr>
             <td><div class="inlinetxt"><b>До сплати:</b></label></div> </td>
             <td class="tdwidth"><div class="inlinetxt"><?php echo $fullprice1?><b>грн.</b></label></div> </td>
         </tr>
          <table>
          <br>
           <br>
         <div align = "center"><button type="submit" name="confirm" class="registerbtn">Підтвердити замовлення </button></div>

     <?php

   }
      if(isset($_POST['confirm'])){
        $count= "SELECT * FROM `clients` WHERE client_id = ".$_SESSION['id'];
        $res_c = $conn3->query($count);
            while ($row =$res_c ->fetch_assoc()) {
                  $amount=$row['order_emount'];
             }
        $amount=$amount+1;
        $upamount = "UPDATE `clients` SET `order_emount`='$amount' WHERE client_id =".$_SESSION['id']; 
        $res = mysqli_query($conn3, $upamount) or die("Ошибка " . mysqli_error($conn3)); 
                 
        $address= $_POST['address'];
          $sql4 = "UPDATE `orders` SET `address`='$address' WHERE order_id=$id";
            if (mysqli_query($conn3,$sql4)) {

             $my_id = (int)$_SESSION['id'];
      
             $insql = "INSERT INTO orders(client_id) VALUES ('$my_id');";
             $sql = "SELECT @@identity;";
             $res = mysqli_query($conn3, $insql) or die("Ошибка " . mysqli_error($conn3)); 
             $resultsql = mysqli_query($conn3, $sql) or die("Ошибка " . mysqli_error($conn3)); 
             if($res && $resultsql)
             {
    
               while ($row = mysqli_fetch_row($resultsql)) {
                $_SESSION['neworder'] =$row[0]; 
              }
    
              mysqli_free_result($resultsql);
              }
              echo '<script>location.replace("http://localhost/pal_ker_kla/index.php?action=order_successful");</script>';}
             else {
              echo "Error: " . $sql4 . "<br>" . mysqli_error($conn3);
                 }}
               mysqli_close($conn3);
               ?>

</form>
 </section>