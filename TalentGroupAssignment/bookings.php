<?php 
ob_start();
session_start(); 
$errormessage = "";
$Id = $_SESSION["UserId"];
$dsn = "mysql:host=localhost;dbname=katemao4_talent";
$username = 'katemao4_wutia';
$password = 'a2957360';
$pdo = new PDO($dsn, $username, $password);
$stmt = $pdo->prepare("SELECT `orderTable`.`Id` AS `OrderId` , `talentTable`.`Id` AS `TalentId`,`Name`,`Photo`,`Role`,`Time`,`Phone`,`State` FROM `orderTable` join `talentTable` WHERE `talentTable`.`Id` = `orderTable`.`TalentId` and `orderTable`.`UserId` = '$Id' ORDER BY `State`;");
$stmt->execute();

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
    <title>My Orders</title>
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
            <? if($_SESSION["UserId"]==null){?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Log In</a>
              </li> 
            <?}else{?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item ">
              <p class="nav-link font-white" href="bookings.php">My Orders</p>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="wallet.php">Wallet</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="notification.php">Notification</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>         
            <?}?>
          </ul>
        </div>
      </div>
    </nav>
    <section id="maincontent" class="margin-top margin-btm">
      <?php
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           $Name = $row['Name'];
           $OrderId = $row['OrderId'];
           $TalentId = $row['TalentId'];
           $Photo = $row['Photo'];
           $Role = $row['Role'];
           $Time = $row['Time'];
           $Phone = $row['Phone'];
           $State = $row['State'];
           $date = '';
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
           if($State == 0){
      ?>
      <!-- upcoming -->
      <div class="container margin-btm">
        <div class="row">
          <div class="col-3">
            <img src="<?= $Photo ?>" class="rounded-circle" style="width: 150px;"/">
          </div>
          <div class="col-6">
            <h4><?= $Name ?></h4>
            <p><?= $Role ?></p>
            <p><?= $date ?></p>
          </div>
          <div class="col-3">
            <p>upcoming</p><!-- echo 状态 here ！ -->
          </div>
        </div>
        <div class="row">
          <div class="col">
            <a href="tel:<?=$Phone?>" class="order-green"><i class="fas fa-phone fa-lg"></i></a>
          </div>
          <div  class="col">
            <a href="workerdetailmodify.php?Id=<?=$OrderId?>&modifytime=<?=$Time?>" class="order-yellow">Modify</a>
          </div>
          <div class="col">
            <a oncl href="workercancel.php?orderId=<?=$OrderId?>&modifytime=<?=$Time?>" class="order-red">Cancel</a>
          </div>
        </div>
        <hr/>
      </div>
      <?php
        }
        if($State == 1){
      ?>
      <!-- serving-->
      <div class="container margin-btm">
        <div class="row">
          <div class="col-3">
            <img src="<?= $Photo ?>">
          </div>
          <div class="col-6">
            <h4><?= $Name ?></h4>
            <p><?= $Role ?></p>
            <p><?= $date ?></p>
          </div>
          <div class="col-3">
            <p>serving</p><!-- echo 状态 here ！ -->
          </div>
        </div>
        <div class="row">
          <div class="col">
            <a href="tel:<?=$Phone?>" class="order-green"><i class="fas fa-phone fa-lg"></i></a>
          </div>
          <div class="col">
            <a href="contactus.php?Id=<?=$OrderId?>" class="order-orange">get help</a>
          </div>
        </div>
        <hr/>
      </div>
      <?php
        }
        if($State == 2){
      ?>
      <!--complete -->
      <div class="container margin-btm">
        <div class="row">
          <div class="col-3">
            <img src="<?= $Photo ?>">
          </div>
          <div class="col-6">
            <h4><?= $Name ?></h4>
            <p><?= $Role ?></p>
            <p><?= $date ?></p>
          </div>
          <div class="col-3">
            <p>complete</p><!-- echo 状态 here ！ -->
          </div>
        </div>
        <div class="row">
          <div class="col">
            <a href="rate.php?orderId=<?=$OrderId?>&talentId=<?=$TalentId?>" class="order-green">Rate</a>
          </div>
          <div class="col">
            <a href="contactus.php?Id=<?=$OrderId?>" class="order-orange">get help</a>
          </div>
        </div>
        <hr/>
      </div> 
      <?php
        }
        if($State == 3){
      ?>
      <!--complete rated-->
      <div class="container">
        <div class="row">
          <div class="col-3">
            <img src="<?= $Photo ?>">
          </div>
          <div class="col-6">
            <h4><?= $Name ?></h4>
            <p><?= $Role ?></p>
            <p><?= $date ?></p>
          </div>
          <div class="col-3">
            <p>complete</p><!-- echo 状态 here ！ -->
          </div>
        </div>
        <div class="row">
          <div class="col">
            <a href="viewrate.php?orderId=<?=$OrderId?>&talentId=<?=$TalentId?>" class="order-gray">View Rate</a>
          </div>
          <div class="col">
            <a href="contactus.php?Id=<?=$OrderId?>" class="order-orange">get help</a>
          </div>
        </div>
        <hr/>
      </div>        
      <?php
        }
        if($State == 4){
      ?>
      <!-- cancled -->
      <div class="container margin-btm">
        <div class="row">
          <div class="col-3">
            <img src="<?= $Photo ?>">
          </div>
          <div class="col-6">
            <h4><?= $Name ?></h4>
            <p><?= $Role ?></p>
            <p><?= $date ?></p>
          </div>
          <div class="col-4">
            <p>cancled</p><!-- echo 状态 here ！ -->
          </div>
        </div>
        <div class="row">
          <div class="col">
            <a href="contactus.php?Id=<?=$OrderId?>" class="order-orange">get help</a>
          </div>  
        </div>  
        <hr/>
      </div>
      <?php
          }
      }
      ?>
    </section>
    <footer>
      <span>©2018.katemao.net. All right reserved</span>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script type="text/javascript">
      function disp_confirm()
      {
      var r=confirm("Press a button")
      if (r==true)
        {
        document.write("You pressed OK!")
        }
      else
        {
        document.write("You pressed Cancel!")
        }
      }
    </script>
  </body>
</html>