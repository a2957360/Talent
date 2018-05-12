<?php 
ob_start();
session_start(); 
$errormessage = "";
$Id = $_SESSION["UserId"];
$dsn = "mysql:host=localhost;dbname=katemao4_talent";
$username = 'katemao4_wutia';
$password = 'a2957360';
$pdo = new PDO($dsn, $username, $password);
$stmt = $pdo->prepare("SELECT * FROM `userTable` WHERE `Id` = '$Id';");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$TCoin = $row['TCoin'];
// $timelist = explode(",",$Availabletime);
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $weekday = $_POST['weekday'];
//    $daytime = $_POST['daytime'];
//    $userId = $_SESSION["UserId"];
//    $date = $weekday.",".$daytime;
//    $timelist[($weekday - 1) * 12 + $daytime - 1] = 0;
//    $Availabletime = implode(",",$timelist);
//    $stmt = $pdo->prepare("UPDATE `talentTable` SET `Availabletime`='$Availabletime' Where `Id` = '$Id';");
//    $stmt->execute();
//    $stmt = $pdo->prepare("INSERT INTO `orderTable` VALUES ('', '$userId','$Id','$date','0','','');");
//    $stmt->execute();
// }
include("includes/head.php");?>
    <title>Wallet</title>
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
              <p class="nav-link font-white" href="wallet.php">Wallet</p>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="notification.php">Notification</a>
            </li>
            <? if($_SESSION["UserId"]==null){?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Log In</a>
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
    <section class="margin-top margin-btm">
      <div class="container" style="margin-top: 20px;">
        <div class="row justify-content-center" >
          <div class="col alcenter  justify-content-center">
            <div style="width: 300px; height: 300px; background-color: #f4f4f4; border-radius: 50%; margin:auto; padding-top: 100px;">
              <h5>TotalBalence</h5>
              <h1><?= $TCoin ?></h1>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <a href="topup.php" class="button-yellow">Top Up</a>
        </div>
      </div>
    </section>
    <section>
      <div class="fullscreen alcenter margin-btm" style="background-color: #f4f4f4; padding: 15px 0;">
        <p class="font-thin-lg">BILL</p> 
      </div>
    </section>
    <section id="maincontent" >
      <div class="container">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM `orderTable` join `talentTable` WHERE `talentTable`.`Id` = `orderTable`.`TalentId` and `orderTable`.`UserId` = '$Id';");
        $stmt->execute();
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
             $Name = $row['Name'];
             $Photo = $row['Photo'];
             $Role = $row['Role'];
             $Salary = $row['Salary'];
             $Time = $row['Time'];
            $timelist = explode(",", $Time);
             switch ($timelist['0']) {
               case '1':
                  $date = "Monday";
                 break;
               case '2':
                  $date = "Tuesday";
                 break;
               case '3':
                  $date = "Wednesday";
                 break;
               case '4':
                  $date = "Thursday";
                 break;
               case '5':
                  $date = "Friday";
                 break;
               case '6':
                  $date = "Staturday";
                 break;
               case '7':
                  $date = "Sunday";
                 break;
             }
             $hour = $timelist['1'] + 8;
             $date = $date." ".$hour." : 00";
        ?>
        <div class="row">
          <div class="container">
            <div class="row">
              <div class="col-4">
                <?= $date ?>
              </div>
              <div class="col-3">
                <?= $Name ?>
              </div>
              <div class="col-3">
                <?= $Role ?>
              </div>
              <div class="col-2">
                <?= $Salary ?>
              </div>
            </div>
          </div>
        </div>
        <hr/>
      <?php
        }
      ?>

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
  </body>
</html>