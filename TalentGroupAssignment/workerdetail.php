<?php 
ob_start();
session_start(); 
$errormessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$Id = $_POST['Id'];
}else{
$Id = $_GET['Id'];
}
$dsn = "mysql:host=localhost;dbname=katemao4_talent";
$username = 'katemao4_wutia';
$password = 'a2957360';
$pdo = new PDO($dsn, $username, $password);
$stmt = $pdo->prepare("SELECT * FROM `talentTable` WHERE `Id` = '$Id';");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   $Name = $row['Name'];
   $Photo = $row['Photo'];
   $Role = $row['Role'];
   $Star = $row['Star'];
   $Description = $row['Description'];
   $Salary = $row['Salary'];
   $Availabletime = $row['Availabletime'];
}
$timelist = explode(",",$Availabletime);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $weekday = $_POST['weekday'];
   $daytime = $_POST['daytime'];
   $userId = $_SESSION["UserId"];
   $msgDate = new DateTime();
   $msgDate = $msgDate->format('Y-m-d');
   $date = $weekday.",".$daytime;
   $timelist[($weekday - 1) * 12 + $daytime - 1] = 0;
   $Availabletime = implode(",",$timelist);
   $stmt = $pdo->prepare("UPDATE `userTable` SET `TCoin`= `TCoin` - '$Salary' Where `Id` = '$userId';");
   $stmt->execute();
   $stmt = $pdo->prepare("INSERT INTO `messageTable` VALUES ('', '$userId','Booking','your server is booked','$msgDate','0');");
   $stmt->execute();
   $stmt = $pdo->prepare("UPDATE `talentTable` SET `Availabletime`='$Availabletime' Where `Id` = '$Id';");
   $stmt->execute();
   $stmt = $pdo->prepare("INSERT INTO `orderTable` VALUES ('', '$userId','$Id','$date','0','','');");
   $stmt->execute();
   echo "<script> location.href='bookings.php'; </script>";
}
include("includes/head.php");?>
    <title>Worker Detail</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" id="nav-bg">
      <div class="container">
        <a class="navbar-logo" href="index.php" style="margin-right: 50%;">Talent</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="bookings.php">My Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="wallet.php">Wallet</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="notification.php">Notification</a>
            </li>
            <? if($_SESSION["UserId"]==null){?>
              <li class="nav-item">
                <a class="nav-link font-white" href="login.php">Log In</a>
              </li> 
            <?}else{?>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>         
            <?}?>
          </ul>
        </div>
      </div>
    </nav>
    <section id="maincontent" class="margin-top margin-btm">
      <div class="container">
        <div class="row justify-content-center margin-btm">
          <div class="col alcenter  justify-content-center">
            <img src="<?= $Photo ?>" class="rounded-circle" style="width: 150px;"/>
          </div>
        </div>
        <div class="row">
          <div class="col alcenter  justify-content-center">
            <p class="font-thin-lg"><?= $Name ?></p>
            <p class="font-gray"><?= $Role ?></p>
            <p class="font-red"><?= $Star ?></p>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="row">
        <div class="fullscreen margin-btm" style="background-color: #f4f4f4; padding: 50px 0;">
          <div class="container" style="padding:0 40px;">
            <p class="font-thin-lg">BIO</p>
            <p class="font-gray"><?= $Description ?></p>
          </div>
        </div>
      </div>
    </section>
    <section>
    <section id="maincontent" class="margin-btm">
      <div class="container">
        <div class="row justify-content-center">
          <form id="dayform"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
            <input type="hidden" name="Id" value="<?= $Id ?>">
            <input type="hidden" id="timelist" value="<?= $Availabletime ?>">
            <select id = "weekday" name = "weekday" onclick="WeekdaySelection()" onchange="DayHourSelection()">
              <option value ="0">Select Day</option>
              <option value ="1">Monday</option>
              <option value ="2">Tuesday</option>
              <option value="3">Wednesday</option>
              <option value="4">Thursday</option>
              <option value="5">Friday</option>
              <option value="6">Saturday</option>
              <option value="7">Sunday</option>
            </select>
            <select id = "daytime" name = "daytime" >
              <option value ="0">Select Hour</option>
              <option value ="1">9:00-10:00</option>
              <option value ="2">10:00-11:00</option>
              <option value="3">11:00-12:00</option>
              <option value="4">12:00-13:00</option>
              <option value="5">13:00-14:00</option>
              <option value="6">14:00-15:00</option>
              <option value="7">15:00-16:00</option>
              <option value="8">16:00-17:00</option>
              <option value="9">17:00-18:00</option>
              <option value="10">18:00-19:00</option>
              <option value="11">19:00-20:00</option>
              <option value="12">20:00-21:00</option>
            </select>
          <p style="text-align: left">Price:</p>
          <p style="text-align: right" class="font-thin-lg"><?= $Salary ?></p>
        <input type="submit" name="" value="OK" onclick="checksub()" />
        <a href="index.php" class="font-red">Cancle</a>
        <br/>
        <br/>
        </form>
        </div>
      </div>
    </section>
    <footer>
      <span>©2018.katemao.net. All right reserved</span>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="js/index.js?ver=6:7"></script>
    <script>
      function checksub(){
        var day = document.getElementById("weekday").value;
        var hour = document.getElementById("daytime").value;
          if(day == 0 || hour == 0){
            alert("Please Select Day And Hour");
          }else{
            document.getElementById("dayform").submit()
          }
      }
      function WeekdaySelection(){
        var timelist = new Array();
        var time =  document.getElementById("timelist").value;
        timelist = time.split(",");
        var opt = document.getElementById("weekday").options;
        for(var week = 0; week < 7; week++){
          var sum = 0;
          for(var day = 0; day < 12; day++){
            if(timelist[week * 12 + day] != 0){
              sum++;
            }
          }
          if(sum == 0){
            opt[week].disabled=true;
          }
        }
      }
      function DayHourSelection(){
        var timelist = new Array();
        var time =  document.getElementById("timelist").value;
        timelist = time.split(",");
        var day = document.getElementById("weekday").value;
        var opt = document.getElementById("daytime").options;
        var sum = 0;
        for(var i = 0; i < 12; i++){
          if(timelist[(day - 1) * 12 + i] == 0){
            opt[i].disabled=true;
          }else{
            opt[i].disabled=false;
          }
        }
      }
    </script>
  </body>
</html>