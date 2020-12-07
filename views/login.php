
<form  action="index.php?action=login" method="POST">
  <section>
    <div id="regtext"> <a name="registration">Вхід</a></div>
    <p><a name="email"></a></p>
    <hr>

    <div class="inlinetxt"><label class="log" for="email"><b>Ел. пошта</b></label></div>
    <input type="text" placeholder="Введіть електронну пошту" name="email" required>
<br>

    <div class="inlinetxt"><label class="log" for="psw"><b>Пароль</b></label></div>
    <input type="password" placeholder="Введіть пароль" name="psw" required>
<br>
<br>
 <div align="center"><button type="submit" class="registerbtn" >Увійти</button>
 <p>Не зареєстровані?<a href="index.php?action=registration" class = "reglink"> Реєстрація</a></p></div>
<span class="error">

 
 <?php 
$auth = False;
if(!empty($_POST)) {
  $servername = "localhost";
  $database = "atm_teamdb";
  $username = "root";
  $password = "";
        $conn = mysqli_connect($servername,$username,$password,$database);
        if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
                    }

     else{
       $email1=$_POST["email"];
       $password1=$_POST["psw"];
       //$hash = password_hash($password1, PASSWORD_DEFAULT);
    
    $query = "SELECT * FROM clients";
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()){

    if($email1 == $row["email"] && password_verify($password1,$row["password"])) {
     session_start();
     $auth = True;
      $_SESSION['login'] = $email1;
      $_SESSION['id'] = $row["client_id"];
      $_SESSION['name'] = $row["full_name"];
      $_SESSION['admin'] = $row["admin"];
      
      $my_id = (int)$_SESSION['id'];
      
    $insql = "INSERT INTO orders(client_id) VALUES ('$my_id');";
    $sql = "SELECT @@identity;";
    $res = mysqli_query($conn, $insql) or die("Ошибка " . mysqli_error($conn)); 
    $resultsql = mysqli_query($conn, $sql) or die("Ошибка " . mysqli_error($conn)); 
    if($res && $resultsql)
    {
    
    while ($row = mysqli_fetch_row($resultsql)) {
      $_SESSION['neworder'] =$row[0]; 
    }
    
    mysqli_free_result($resultsql);
    }

     header("Location:http://localhost/pal_ker_kla/index.php?action=home");
    }}
    if($auth == False){
      $Err = "Неправильна пошта або пароль!";
      echo $Err;
      }
       
    mysqli_close($conn);
   }
    }         
 ?>
    
</span>
 </section></form>