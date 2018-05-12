<?php 
ob_start();
session_start(); 
$errormessage = "";
$Id = $_SESSION["UserId"];
$dsn = "mysql:host=localhost;dbname=katemao4_talent";
$username = 'katemao4_wutia';
$password = 'a2957360';
$pdo = new PDO($dsn, $username, $password);
$stmt = $pdo->prepare("SELECT * FROM `messageTable` WHERE `UserId` = '$Id' ORDER BY `AlreadyRead`;");
$stmt->execute();

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
    <title>Notification</title>
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
              <p class="nav-link font-white" href="notification.php">Notification</p>
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
    <section id="maincontent" class="margin-top margin-btm">
      <div class="container">
        <div class="row justify-content-center">
          <h1>Notification</h1>
          <hr/>
        </div>
        <?php
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           $Title = $row['Title'];
           $Content = $row['Content'];
           $Date = $row['Date'];
           $AlreadyRead = $row['AlreadyRead'];
           if($AlreadyRead == 0){
      ?>
      <!-- 未读 -->
      <div class="row justify-content-center margin-btm">
        <div class="col-1">
        </div>
        <div class="col-6">
          <h4><?= $Title ?><br><?= $Content ?></h4><!-- notification content -->
          <p><?= $Date ?></p><!-- notification time -->
        </div>
        <div class="col-3">
          <p style="color:red; font-size: 2em">●</p>
        </div>
      </div>
      <hr/>

          <?php
        }else{
      ?>
      <!-- 已读 -->
      <div class="row justify-content-center margin-btm">
        <div class="col-1">
        </div>
        <div class="col-6">
          <p class="font-thin-lg"><?= $Title ?><br><?= $Content ?></p>
          <p class="font-gray"><?= $Date ?></p>
        </div>
        <div class="col-3">
        </div>
      </div>
      <hr/>
      <?php
        }
      ?>
      <?php
        }
        $stmt = $pdo->prepare("UPDATE `messageTable` SET `AlreadyRead` = '1' WHERE `UserId` = '$Id';");
        $stmt->execute();
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