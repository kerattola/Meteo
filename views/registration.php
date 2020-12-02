<?php 
//для перевірки правильності введеного
$fullnameErr = $phoneErr= $emailErr= $passwordErr = $repassErr  =  "";
$fullname1= $phone1= $email1 = $password1 ='';
$flag = true;
$fullnamepattern  = '/^([A-Za-z][A-Za-z\-\'])|([А-ЯЁIЇҐЄа-яёіїґє][А-ЯЁIЇҐЄа-яёіїґє\-\'])$/';
$phonepattern = '/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/';
$emailpattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/';
$passwordpattern = '/^[a-z+A-Z+0-9+]{7,}$/';


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
<form  action="index.php?action=registration" method="POST">
    <div id="regtext"> <a name="registration">Реєстрація</a></div>
    <div align = "center"> <p>Будь ласка, заповніть форму реєстрації.</p></div>
    <hr>
    <div class="inlinetxt"><label class="log" for="fullname"><b>П.І.Б.</b></label></div>
    <input type="text" placeholder="Введіть П.І.Б" name="fullname" required>
  <span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["fullname"]) && !preg_match ($fullnamepattern, $_POST["fullname"])) {
      $fullnameErr = "Введено некоректно!";
      echo $fullnameErr; $flag = false;
      }
      }
    ?></span><br>
    <div class="inlinetxt"><label class="log" for="email"><b>Ел. пошта</b></label></div>
    <input type="text" placeholder="Введіть електронну адресу" name="email" required>
  <span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["email"]) && !preg_match ($emailpattern, $_POST["email"])) {
      $emailErr = "Введено некоректно!";
      echo $emailErr; $flag = false;
      }}?></span><br>
    
    <div class="inlinetxt"><label class="log" for="phone"><b>Номер телефону</b></label></div>
    <input type="text" placeholder="Введіть номер телефону" name="phone" required>
    <span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["phone"]) && !preg_match ($phonepattern, $_POST["phone"])) {
      $phoneErr = "Введено некоректно!";
      echo $phoneErr; $flag = false;
      } }?></span><br>   

    <div class="inlinetxt"><label class="log" for="psw"><b>Пароль</b></label></div>
    <input type="password" placeholder="Введіть пароль" name="psw" required>
  <span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["psw"]) && !preg_match ($passwordpattern, $_POST["psw"])) {
      $passwordErr = "Введено некоректно!";
      echo $passwordErr; $flag = false;
      }  }
  ?></span><br>

     <div class="inlinetxt"><label class="log" for="psw-repeat"><b>Повторіть пароль</b></label></div>
    <input type="password" placeholder="Повторіть пароль" name="psw-repeat" required>
  <span class="error"> <?php if(!empty($_POST)) {
      if(isset($_POST["psw-repeat"]) && ($_POST["psw-repeat"] != $_POST["psw"])) {
      $repassdErr = "Направильний пароль!";
      echo $repassdErr; $flag = false;
      }
      }
  ?></span><br>
  
    <hr>
    
    <div align = "center"><button type="submit" class="registerbtn">Зареєструватися</button>
  <p>Уже зареєстровані?<a href="index.php?action=login" class = "reglink"> Увійти</a></p>
  <p>Повернутися на<a href="index.php?action=home" class = "reglink"> головну</a></p></div>
  <p></p>
  <span> 
  <?php if(!empty($_POST)) {
      if($flag == true) {
        $conn = mysqli_connect($servername,$username,$password,$database);
        if (!$conn) {
      die("Помилка з'єднання: " . mysqli_connect_error());
                    }

     else{
       $fullname1=$_POST["fullname"];
        $password1=$_POST["psw"];
        $hash = password_hash($password1, PASSWORD_DEFAULT);
         $email1=$_POST["email"];
          $phone1=$_POST["phone"];
       $sql = "INSERT INTO clients (full_name, email, password, phone) VALUES ('$fullname1', '$email1', '$hash',' $phone1')";
       if (mysqli_query($conn, $sql)) {header("Location:http://localhost/ATM_project/index.php?action=registration_successful");}
       else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       }
    mysqli_close($conn);
   }
    }
}         
 ?>
    
</span>
  </section>

</form>
