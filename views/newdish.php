<form method="POST">
    <a name="newdish"></a>
    <div class="container">

      <br><br><div class = "row"><div class = "col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-dark"style="width:400px">
        <div class="card-body text-center">
                <p class="card-text">Додати складену страву до замовлення і перейти у корзину</p>
                <input type="radio" id= "1" name="cart"  value= "1" onchange="this.form.submit()"><label for="1"><p>Вибрати</p></label> 
         </div></div></div>
         <div class = "col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-dark"style="width:400px">
        <div class="card-body text-center">
                <p class="card-text">Додати складену страву до замовлення і продовжити складати</p>
                <input type="radio" id= "2" name="cart" value= "2" onchange="this.form.submit()"><label for="2"><p>Вибрати</p></label>
         </div></div></div></div>

      <br><br><div class = "row"><div class = "col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-dark" style="width:400px">
        <div class="card-body text-center">
                <p class="card-text">Спробувати скласти нову страву</p>
                <input type="radio" id= "3" name="cart" value= "3" onchange="this.form.submit()"><label for="3"><p>Вибрати</p></label>
        </div></div></div>
        <div class = "col-lg-6 col-md-6 col-sm-12">
        <div class="card bg-dark"style="width:400px">
        <div class="card-body text-center">
                <p class="card-text">Переглянути зпропоноване меню</p>
                <input type="radio" id= "4" name="cart" value= "4" onchange="this.form.submit()"><label for="4"><p>Вибрати</p></label> 
         </div></div></div></div>

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

if(isset($_POST['cart'])){
        $typ = (int)$_POST['cart'];
        $my_or = (int)$_SESSION['neworder'];
        $my_dish = (int)$_SESSION['newdish'];
        
        if($typ==1){

          $addin = "INSERT INTO `order_dish`(`order_id`, `dish_id`) VALUES ($my_or,$my_dish)";
          if (mysqli_query($conn3, $addin)) {header("Location:http://localhost/pal_ker_kla/index.php?action=shopping_cart");}
          else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn3);
           }
        }

        if($typ==2){

          $addin = "INSERT INTO `order_dish`(`order_id`, `dish_id`) VALUES ($my_or,$my_dish)";
          if (mysqli_query($conn3, $addin)) {header("Location:http://localhost/pal_ker_kla/index.php?action=constructure");}
          else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn3);
           }
          }

          if($typ==3){

          $addin = "DELETE FROM `prod_dish` WHERE `dish_id`=$my_dish";
          $addin2 = "DELETE FROM `dish` WHERE `dish_id`=$my_dish";
          if (mysqli_query($conn3, $addin) && mysqli_query($conn3, $addin2)) {header("Location:http://localhost/pal_ker_kla/index.php?action=constructure");}
          else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn3);
           }
          }

          if($typ==4){

          $addin = "DELETE FROM `prod_dish` WHERE `dish_id`=$my_dish";
          $addin2 = "DELETE FROM `dish` WHERE `dish_id`=$my_dish";
          if (mysqli_query($conn3, $addin) && mysqli_query($conn3, $addin2)) {header("Location:http://localhost/pal_ker_kla/index.php?action=our_menu");}
          else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn3);
           }
          }
        
      }
    mysqli_close($conn3);
  }

?>
</div>
 </form>