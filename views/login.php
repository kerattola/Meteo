
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
<span class="error">

 
 <?php 
$auth = False;
if(!empty($_POST)) {
    $login = "admin@gmail.com";
    $pws = "admin1";

    $login1=$_POST["email"];
    $password1=$_POST["psw"];

 if($login == $login1 && $pws == $password1) {
     session_start();
     $auth = True;
     $id = 1;

     $_SESSION['login'] = $login;
     $_SESSION['id'] = $id;
     header("Location:http://localhost/meteo/index.php?action=home");
 }
}
 ?>
    
</span>
 </section></form>