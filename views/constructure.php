<?php
  $servername = "localhost";
  $database = "meteo_db";
  $username = "root";
  $password = "";
?>

<form action="index.php?action=constructure" method="POST">
    <a name="constructure"></a>
    <div class="container">
        <p>Заповніть Дані метеостанції</p>
        <p>1 - номер міста Чернівці</p>
        <p>2 - номер міста Львів</p>
        <p>3 - номер міста Київ</p>
    <hr>
        <div class="adding">
            <div class="adding__inner">
                <label for="name"><b>Місто</b></label>
                <input type="text" placeholder="Введіть номер міста" name="id_region" required>
            </div>
            <div class="adding__inner">
                <label for="year"><b>Рік</b></label>
                <input type="text" placeholder="Введіть рік" name="year" required>
            <div class="adding__inner">
                <label for="type"><b>Місяць</b></label>
                <input type="text" placeholder="Введіть місяць" name="month" required>
            </div>
            <div class="adding__inner">
                <label for="price"><b>День</b></label>
                <input type="text" placeholder="Введіть день" name="day" required>
            </div>
            <div class="adding__inner">
                <label for="price"><b>Температура</b></label>
                <input type="text" placeholder="Введіть температуру" name="temperature" required>
            </div>
            <div class="adding__inner">
                <label for="price"><b>Тиск</b></label>
                <input type="text" placeholder="Введіть тиск" name="pressure" required>
            </div>
            <div class="adding__inner">
                <label for="price"><b>Вологість повітря</b></label>
                <input type="text" placeholder="Введіть вологість повітря" name="humidity" required>
            </div>
            <div class="adding__inner">
                <label for="price"><b>Швидкість вітру</b></label>
                <input type="text" placeholder="Введіть швидкість вітру" name="wind_speed" required>
            </div>
            <div class="adding__inner">
                <label for="price"><b>Опади</b></label>
                <input type="text" placeholder="Введіть кількість опадів" name="precipitation" required>
            </div>
            <hr>
        </div>
        <button type="submit" class="registerbtn">Додати дані</button>
        <?php if(!empty($_POST)) {

                $conn = mysqli_connect($servername,$username,$password,$database);
                mysqli_set_charset($conn, 'utf8');
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                else{
                    $id_region=$_POST["id_region"];
                    $year=$_POST["year"];
                    $month=$_POST["month"];
                    $day=$_POST["day"];
                    $temperature=$_POST["temperature"];
                    $pressure=$_POST["pressure"];
                    $humidity=$_POST["humidity"];
                    $wind_speed=$_POST["wind_speed"];
                    $precipitation=$_POST["precipitation"];


                    $sql2 = "INSERT INTO date_time (year, month ,day ) VALUES ('$year','$month','$day')";
                    $sql = "SELECT @@identity;";
                    $result = mysqli_query($conn, $sql2) or die("Error " . mysqli_error($conn));
                    $get_id = mysqli_query($conn, $sql) or die("Error " . mysqli_error($conn));
                    if($result && $get_id)
                    {
                        while ($row = mysqli_fetch_row($get_id)) {
                            $id_time = $row[0];
                        }
                        mysqli_free_result($get_id);
                    }
                    $sql3 = "INSERT INTO meteo (id_region, id_time, temperature, pressure, humidity, wind_speed, precipitation) VALUES ('$id_region', '$id_time ', '$temperature', '$pressure', '$humidity','$wind_speed','$precipitation')";
                    $result = mysqli_query($conn, $sql3) or die("Error " . mysqli_error($conn));
                    mysqli_close($conn);
                }

        }

        ?>
    </div>
</div>
 </form>