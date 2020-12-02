<div class="leftrow">
<form  action="index.php?action=view_picture" method="GET">
  <div class="container">
    <h1><a name="view_picture"></a></h1>
<?php
  $flag = false;
  $servername = "localhost";
  $database = "mygallery";
  $username = "root";
  $password = "";
        $conn3 = mysqli_connect($servername,$username,$password,$database);
        if (!$conn3) {
      die("Connection failed: " . mysqli_connect_error());
                    }

     else{
    $id = (int)$_GET['id'];
    $query = "SELECT * FROM pictures";
    $result = $conn3->query($query);
    while($row = $result->fetch_assoc()){
    
    if($row["id_picture"]==$id) {
      $flag = true;
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
    echo "</tr>";
  }
}

echo("</table>");
    mysqli_close($conn3);
    if($flag == false) echo "There are no such picture in the database";
}

?>

</div>
</form>
</div>
