<?php 
ob_start();
session_start(); 
$errormessage = "";

$orderId = $_GET['orderId'];
$talentId = $_GET['talentId'];

$dsn = "mysql:host=localhost;dbname=katemao4_talent";
$username = 'katemao4_wutia';
$password = 'a2957360';
$pdo = new PDO($dsn, $username, $password);

$stmt = $pdo->prepare("SELECT `orderTable`.`Star` as 'Star',`Name`,`Photo`,`Role`,`Time`,`Comment` FROM `talentTable` JOIN `orderTable` WHERE `talentTable`.`Id` = `orderTable`.`TalentId` and `orderTable`.`Id` = '$orderId';");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   $Name = $row['Name'];
   $Photo = $row['Photo'];
   $Role = $row['Role'];
   $Time = $row['Time'];
   $Star = $row['Star'];
   $Comment = $row['Comment'];
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
}
$timelist = explode(",",$Availabletime);

include("includes/head.php");?>
    <title>View My Rate</title>
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
    <section id="home" class="margin-btm" style="margin-bottom: 100px;">
      <div class="container">
        <div class="row justify-content-center">
          <h1>View My Rate</h1>
        </div>
        <div class="row justify-content-center">
          <p>How did you enjoy <?= $Name ?>’s service?</p>
        </div>
        <div class="box">
          <div class="row justify-content-center" style="margin:50px 0;">
            <div class="col-3">
              <img src="<?= $Photo ?>" class="rounded-circle" style="width: 150px;">
            </div>
            <div class="col-3">
              <h4><?= $Name ?></h4>
              <p><?= $Role ?></p>
              <p><?= $date ?></p>
            </div>
          </div>
          <div class="row justify-content-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
              <input type="hidden" name="Id" value="<?= $talentId ?>">
              <div class="row justify-content-center">
                <p class="font-thin-lg">Rate&Review</p>
              </div>
              <div class="row justify-content-center">
                <p class="font-red" style="font-size: 1.5em"> 
                  <?= $Star ?> 
                </p>
              </div>
            </form>
          </div>
          <div class="row justify-content-center" style="margin-top: 50px;">
            <a href="bookings.php" class="font-red">Back</a>
          </div>  
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
  </body>
</html>