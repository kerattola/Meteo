<form action="index.php?action=about" method="POST">
    <a name="about"></a>
 <div class="container">
     <?php
     $servername = "localhost";
     $database = "meteo_db";
     $username = "root";
     $password = "";
     $conn3 = mysqli_connect($servername,$username,$password,$database);
     mysqli_set_charset($conn3, 'utf8');
     if (!$conn3) {
         die("Connection failed: " . mysqli_connect_error());
     }

     else{
         echo '<h4><p>Виберіть місто, прогноз якого бажаєте переглянути</p></h4>
       <div class = "row">';
         $type_dish= "SELECT * FROM region";
         $res_type = $conn3->query($type_dish);
         while ($row =$res_type ->fetch_assoc()) {
             echo '<div class = "col-lg-4 col-md-4 col-sm-4">
                <div class = "testsmal"><div class="zoom">
                <img class = "imgcard" src="/meteo/img/'.$row["region_title"].'.png" style="width:150px;height:100px;">'.'<p>'.$row["region_title"].'</p></div>'.'<input type="radio" id= "'.$row["id_region"].']" name="region" value= "'.$row["id_region"].'">
          <label class="log" for="'.$row["id_region"].'"></label></div></div>';
         }
         echo '</div><br>';
         echo '<p><button type="submit" class="buttondish" name="new">Вибрати місто</button></p><br>';

             if(isset($_POST['new']) && isset($_POST['region'])){
                 $reg = $_POST['region'];

                  $query3 = "SELECT * FROM meteo WHERE id_region = $reg";

                  $result3 = $conn3->query($query3);

                  echo("<table>");
                   echo "<th>";echo "Date"; echo "</th>";
                   echo "<th>";echo "Temperature"; echo "</th>";
                   echo "<th>";echo "Pressure"; echo "</th>";
                   echo "<th>";echo "Humidity"; echo "</th>";
                   echo "<th>";echo "Wind speed"; echo "</th>";
                   echo "<th>"; echo "Precipitation"; echo "</th>";

                 echo "<tr>";


                   while ($row =$result3->fetch_assoc()) {
                       $id_t = $row["id_time"];
                       $query4 = "SELECT * FROM date_time WHERE id_time = $id_t";
                       $result4 = $conn3->query($query4);
                       echo "<td>";
                       echo("<table>");
                               echo "<th>";
                               echo "Day"; echo "</th>";
                               echo "<th>";
                               echo "Month"; echo "</th>";
                               echo "<th>";
                               echo "Year"; echo "</th>";
                       while ($row1 =$result4->fetch_assoc()) {
                               echo "<tr>";
                               echo "<td>";
                               echo $row1["day"]; echo "</td>";
                               echo "<td>";
                               echo $row1["month"]; echo "</td>";
                               echo "<td>";
                               echo $row1["year"]; echo "</td>";
                               echo "</tr>";
                       }
                       echo("</table>");
                       echo "</td>";
                       echo "<td>";echo $row["temperature"]; echo "</td>";
                       echo "<td>";echo $row["pressure"]; echo "</td>";
                       echo "<td>";echo $row["humidity"]; echo "</td>";
                       echo "<td>";echo $row["wind_speed"]; echo "</td>";
                       echo "<td>";echo $row["precipitation"]; echo "</td>";
                       echo "</tr>";
                }
                echo("</table>");
             }
}
     mysqli_close($conn3);

     ?>
</div>
</form>