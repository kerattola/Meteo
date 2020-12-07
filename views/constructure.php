<form action="index.php?action=constructure" method="POST">
    <a name="constructure"></a>
    <div class="container">
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

else{
  
  echo '<p>Виберіть страву, яку хочете скласти в конструкторі</p>
       <div class = "row">';

    $type_dish= "SELECT * FROM type_dish";
    $res_type = $conn3->query($type_dish);
       while ($row =$res_type ->fetch_assoc()) {
          echo '<div class = "col-lg-4 col-md-4 col-sm-4">';
          echo '<input type="radio" id= "'.$row["id"].']" name="typedish" value= "'.$row["id"].'">
          <label class="log" for="'.$row["id"].'">'.$row["name"].'</label>';
          echo '</div><br>';
       }
  echo '</div><br><br>';

    
    $query3 = "SELECT * FROM products";
    $result3 = $conn3->query($query3);
   
   $r1 = '<div class = "row">';
   echo $r1;
  while ($row =$result3->fetch_assoc()) {
 
        echo '<div class = "col-lg-3 col-md-3 col-sm-6">
              <div class = "test"><div class="zoom">
              <img class = "imgcard" src="/pal_ker_kla/img/products/'.$row["image"].'" style="width:270px;height:180px;">'.'<p>'.$row["title"].'</p></div><p>'.$row["price"].'</p>'.'<label class="switch"><input type="checkbox" name="prod_list[]" value="'.$row["product_id"].'"><span class="slider"></span></label></div></div>';
  
  if ($row["product_id"]%4==0){
    echo '</div><p></p><div class = "row">';
      }
}
echo '<br></div><p>Виберіть Спосіб приготування </p>
           <div class = "row">';
          $type_cook= "SELECT * FROM type_cooking";
          $res_cook = $conn3->query($type_cook);
       while ($row =$res_cook ->fetch_assoc()) {
          
          echo '<div class = "col-lg-3 col-md-3 col-sm-6">
                <div class = "testsmal"><div class="zoom">
                <img class = "imgcard" src="/pal_ker_kla/img/products/'.$row["image"].'" style="width:150px;height:100px;">'.'<p>'.$row["method"].'</p></div><p>'.$row["price"].'</p>'.'<input type="radio" id= "'.$row["id"].']" name="typecook" value= "'.$row["id"].'">
          <label class="log" for="'.$row["id"].'"></label></div></div>';
          
       }
       echo '</div><br>'; 

$perevirka=0;
if(isset($_POST['typedish'])){
        $typ_id = (int)$_POST['typedish'];
        //echo '<p>'.$typ_id.'</p>';
        $perevirka=$perevirka+1;
      }

if(isset($_POST['typecook'])){
        $cook_id = (int)$_POST['typecook'];
        //echo '<p>'.$cook_id.'</p>';
        $perevirka=$perevirka+1;
      }

if(!empty($_POST['prod_list'])) {
  $produ=array();
  $sumprice=0;
    foreach($_POST['prod_list'] as $check) {
      array_push($produ, $check);
    }
$testtry= "SELECT * FROM products WHERE product_id IN (" . implode(',', $produ) . ")";
$tryres = $conn3->query($testtry);
       while ($row =$tryres ->fetch_assoc()) {
         $sumprice = $sumprice + (int)$row["price"];
         }
   $perevirka=$perevirka+1;
}

if($perevirka==3){
   $indish = "INSERT INTO `dish`(`type`, `price`, `cook_method`) VALUES ('$typ_id','$sumprice','$cook_id')";
   $dishfind = "SELECT @@identity;";
        $indo1 = mysqli_query($conn3, $indish) or die("Ошибка " . mysqli_error($conn3)); 
        $indo2 = mysqli_query($conn3, $dishfind) or die("Ошибка " . mysqli_error($conn3));
      if($indo1 && $indo2)
    {
        while ($row = mysqli_fetch_row($indo2)) {
            $myid_dish =$row[0]; 
          }
     $_SESSION['newdish'] =$myid_dish; 
    mysqli_free_result($indo2);
    }

foreach($produ as $id) {
$inprodish = "INSERT INTO `prod_dish`(`product_id`, `dish_id`) VALUES ('$id','$myid_dish')";
$resofdish = mysqli_query($conn3, $inprodish) or die("Ошибка " . mysqli_error($conn3)); 
}

}
echo '<button type="submit" name="new">Зібрати страву</button>';

if(isset($_POST['new'])){
 echo '<script>location.replace("http://localhost/pal_ker_kla/index.php?action=newdish");</script>';
  }
    mysqli_close($conn3);
  }

?>
</div>
 </form>