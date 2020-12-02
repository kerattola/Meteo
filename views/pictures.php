<div class="leftrow">
<form  action="index.php?action=pictures" method="POST">
  <div class="container">
    <h1><a name="pictures"></a></h1>

<?php
  $id_bd=0;
  $servername = "localhost";
  $database = "mygallery";
  $username = "root";
  $password = "";
        $conn3 = mysqli_connect($servername,$username,$password,$database);
        if (!$conn3) {
      die("Connection failed: " . mysqli_connect_error());
                    }

     else{
    $query3 = "SELECT * FROM pictures ORDER BY id_picture DESC";
    $result3 = $conn3->query($query3);
    $id=0;
    if(isset($_SESSION['login']) and !empty($_SESSION['login'])) {
    $id = (int)$_SESSION['id'];}

    echo("<table>");
   echo "<th>";
   echo "AUTHOR_id"; echo "</th>";
   echo "<th>";
   echo "NAME"; echo "</th>";
   echo "<th>";
   echo "YEAR"; echo "</th>";
   echo "<th>";
   echo "TYPE"; echo "</th>";
   echo "<th>";
   echo "PRICE"; echo "</th>";

   while ($row =$result3->fetch_assoc()) {
   	if((int)$row["visible"]==1){
     $id_bd=(int)$row["id_picture"];
   	echo "<tr>";
   echo "<td>";
   echo $row["author_id"]; echo "</td>";
   echo "<td>";
   echo $row["name"]; echo "</td>";
   echo "<td>";
   echo $row["year"]; echo "</td>";
   echo "<td>";
   echo $row["type"]; echo "</td>";
   echo "<td>";
   echo $row["price"]; echo "</td>";
  echo "<td>";
   echo "<a class='button' href='index.php?action=view_picture&id=$id_bd'> See </a>";
   if($id==1){
   echo "<a class='button' href='index.php?action=update_picture&id=$id_bd'> Red </a>";
   echo "<a class='button' href=\"index.php?action=delete_picture&id=$id_bd\" OnClick=\"return confirm('Are you sure?');\"> Del </a>";
   echo "</td>";
    echo "</tr>";
  }
}}
echo("</table>");
    mysqli_close($conn3);
}

?>

</div>
</form>
</div>
