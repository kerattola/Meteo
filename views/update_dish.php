<div class="leftrow">
<form  action="index.php?action=update_picture" method="GET">
  <div class="container">
    <h1><a name="update_picture">Create new picture</a></h1>
    <p>Please fill in this form to create picture.</p>
    <hr>


<?php 
$nameErr = $yearErr = $typeErr = $priceErr = "";
$name1 = $year1 = $type1 = $price1 = '';
$id=0;
$id = (int)$_GET["id"];
$flag = true;
$namepattern  = '/^[a-zA-Zа-яА-Я0-9]{2,20}$/';
$yearpattern = '/^[0-9]{4}$/';
$typepattern = '/^[a-zA-Zа-яА-Я]{2,20}$/';
$pricepattern = '/^[0-9]{0,255}$/';

$flag2 = false;
  $servername = "localhost";
  $database = "atm_teamdb";
  $username = "root";
  $password = "";

 $conn3 = mysqli_connect($servername,$username,$password,$database);
        if (!$conn3) {
      die("Connection failed: " . mysqli_connect_error());
                    }

     else{
    $query = "SELECT * FROM pictures WHERE `pictures`.`id_picture`=" . $id;
    $result = $conn3->query($query);
    while($row = $result->fetch_assoc()){
   
   $name1 = $row["name"];
   
   $year1 = $row["year"];
   
   $type1 = $row["type"];
  
   $price1 =$row["price"]; 
   if($row["id_picture"]==$id) {
      $flag2 = true;}
  }
}

  mysqli_close($conn3);
  if($flag2 == false) echo "<span class='error'> There are no such picture in the database </span>";
?>
</form>
<form  method="POST">
    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" required <?php echo "value = '$name1'";?> >
<span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["name"]) && !preg_match ($namepattern, $_POST["name"])) {
      $nameErr = "Invalid Name";
      echo $nameErr; $flag = false;
      }
      }
?></span><br>

    <label for="year"><b>Year</b></label>
    <input type="text" placeholder="Enter Year" name="year" required  <?php echo "value = '$year1'";?>>
<span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["year"]) && !preg_match ($yearpattern, $_POST["year"])) {
      $yearErr = "Invalid year";
      echo $yearErr; $flag = false;
      }
      }
?></span><br>

    <label for="type"><b>Type</b></label>
    <input type="text" placeholder="Enter Type" name="type" required  <?php echo "value = '$type1'";?>>
<span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["type"]) && !preg_match ($typepattern, $_POST["type"])) {
      $typeErr = "Invalid type";
      echo $typeErr; $flag = false;
      }
      }
?></span><br>
    
<label for="price"><b>Price</b></label>
    <input type="text" placeholder="Enter Price" name="price" required  <?php echo "value = '$price1'";?>>
<span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["price"]) && !preg_match ($pricepattern, $_POST["price"])) {
      $priceErr = "Invalid price";
      echo $priceErr; $flag = false;
      }
      }
?></span><br> 

<label for="visible"><b>Visible</b></label>
    <input type="radio" name="visible">
    <hr>
    
    <button type="submit" class="registerbtn">Update picture</button>  
<span> <?php if(!empty($_POST)) {
    
      if($flag == true) {
        
        $conn2 = mysqli_connect($servername,$username,$password,$database);
        if (!$conn2) {echo("HERE2");
      die("Connection failed: " . mysqli_connect_error());
                    }

     else{
       $name1=$_POST["name"];
        $year1=$_POST["year"];
         $type1=$_POST["type"];
          $price1=$_POST["price"];
          if($_POST["visible"]==true) $i=1;
           else $i=0;
   $sql2 = "UPDATE `pictures` SET `visible` = '$i', `name` = '$name1', `year` = '$year1', `type` = '$type1', `price` = '$price1' WHERE `pictures`.`id_picture`=" . $id;
       if (mysqli_query($conn2, $sql2)) {header("Location:http://localhost/labor/index.php?action=main");}
       else {
      echo "Error: " . $sql2 . "<br>" . mysqli_error($conn2);
       }
    mysqli_close($conn2);
   }
    }
}         
 ?>
    
</span>
  </div>

</form>
</div>