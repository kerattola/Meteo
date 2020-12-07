<form action="index.php?action=our_menu" method="POST">
    <a name="our_menu"></a>
    <div class="container">
<?php
  $id_bd=0;
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
    $query3 = "SELECT * FROM menu_dish";
    $result3 = $conn3->query($query3);
   
   $r1 = '<div class = "row">';
   echo $r1;
  while ($row =$result3->fetch_assoc()) {
  $im1 = '<div class = "col-lg-3 col-md-3 col-sm-6"><div class = "test"><div class="zoom"><img class = "imgcard" src="/pal_ker_kla/img/our_menu/'.$row["image"].'" style="width:243px;height:324px;">'.'<p>'.$row["title"].'</p></div><p>'.$row["price"].'</p>'.'</div></div>';
  $im2 = '<div class = "col-lg-3 col-md-3 col-sm-6"><div class = "test"><div class="zoom"><img class = "imgcard" src="/pal_ker_kla/img/our_menu/'.$row["image"].'" style="width:243px;height:324px;">'.'<p>'.$row["title"].'</p></div><p>'.$row["price"].'</p>'.'<label class="switch"><input type="checkbox" name="menu_list[]" value="'.$row["menudish_id"].'"><span class="slider"></span></label></div></div>';
  
  if(!isset($_SESSION['login']) and empty($_SESSION['login'])) echo $im1;  
  else echo $im2;
  if ($row["menudish_id"]%4==0)
  	{$r2 = '</div><p></p><div class = "row">';
      echo $r2;} 
}
echo '</div>';
if(isset($_SESSION['login']) and !empty($_SESSION['login'])){
echo '<div id="follow">
      <input type="submit" value= "Додати до замовлення"/>
      </div>';
}
if(!empty($_POST['menu_list'])) {
  $menuls=array();
  $my_or = (int)$_SESSION['neworder'];
  
  foreach($_POST['menu_list'] as $check) {
      array_push($menuls, $check);
    }

foreach($menuls as $id) {
$inormenu = "INSERT INTO order_menudish(order_id,menudish_id) VALUES ('$my_or','$id');";
$resofmenu = mysqli_query($conn3, $inormenu) or die("Ошибка " . mysqli_error($conn3)); 
}
       }


mysqli_close($conn3);
}

?>

</div>
</form>