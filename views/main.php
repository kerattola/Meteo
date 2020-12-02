 <a name="home"></a>
<div class="containerimage">
  <div class="box">
    <img src="/ATM_project/img/slide_avocado.jpg">
    <span><p>Прояви</p></span>
  </div>
  <div class="box">
    <img src="/ATM_project/img/slide_carrot.jpg">
    <span><p>фантазію -</p></span>
  </div>
  <div class="box">
    <img src="/ATM_project/img/slide_lemon.jpg">
    <span><p>будь</p></span>
  </div>
  <div class="box">
    <img src="/ATM_project/img/slide_tomato.jpg">
    <span><p>автором</p></span>
  </div>
  <div class="box">
    <img src="/ATM_project/img/slide_onion.jpg">
    <span><p>свого</p></span>
  </div>
  <div class="box">
    <img src="/ATM_project/img/slide_pepper.jpg">
    <span><p>обіду</p></span>
  </div>
</div>

<?php 
  
  if(isset($_SESSION['login']) and !empty($_SESSION['login'])) {

   $s=''; $s=$_SESSION['login'];
   $q=''; $q=$_SESSION['id'];
   $e=''; $e=$_SESSION['neworder'];
   echo "You entered as \n"; echo ($s); echo("<br>"); echo ($q);
   echo "Your order: \n"; echo ($e);echo("\n");
}

   ?>