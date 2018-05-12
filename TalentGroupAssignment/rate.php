<?php 
ob_start();
session_start(); 
$errormessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$orderId = $_POST['orderId'];
}else{
$orderId = $_GET['orderId'];
$talentId = $_GET['talentId'];
}
$dsn = "mysql:host=localhost;dbname=katemao4_talent";
$username = 'katemao4_wutia';
$password = 'a2957360';
$pdo = new PDO($dsn, $username, $password);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $comment = $_POST['comment'];
   $star = $_POST['Star'];
   $stmt = $pdo->prepare("UPDATE `orderTable` SET `Comment`='$comment',`Star`='$star',`State` = '3' WHERE `Id` = '$orderId';");
   $stmt->execute();
   echo "<script> location.href='bookings.php'; </script>";
}
$stmt = $pdo->prepare("SELECT * FROM `talentTable` WHERE `Id` = '$talentId';");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   $Name = $row['Name'];
   $Photo = $row['Photo'];
   $Role = $row['Role'];
   $Time = $row['Time'];
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
    <title>Rate</title>
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
    <section id="maincontent" class="margin-btm">
      <div class="container">
        <div class="row justify-content-center">
          <h1>Rate</h1>
        </div>
        <div class="row justify-content-center">
          <p class="font-thin-lg">How did you enjoy <?= $Name ?>’s service?</p>
        </div>
          <div class="row justify-content-center" style="margin:50px 0;">
            <div class="col-3">
              <img src="<?= $Photo ?>" class="rounded-circle" style="width: 150px;"/>
            </div>
            <div class="col-3">
              <h4><?= $Name ?></h4>
              <p><?= $Role ?></p>
              <p><?= $date ?></p>
            </div>
          </div>
          <div class="container" style="max-width: 768px;"><hr/></div>
          <div class="row justify-content-center">
            <p class="font-thin-lg">Rate&Review</p>
          </div>
          <div class="row justify-content-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
              <input type="hidden" name="orderId" value="<?= $orderId ?>">
              <input type="hidden" name="Star" id="Star">
              <input type="hidden" id="empty" value="☆">
              <input type="hidden" id="full" value="★">
              <div class="row justify-content-center">
                <p id = "star1" onclick="changestar(1)" class="font-red" style="cursor:pointer; font-size: 1.5em">☆</p>
                <p id = "star2" onclick="changestar(2)" class="font-red" style="cursor:pointer; font-size: 1.5em">☆</p>
                <p id = "star3" onclick="changestar(3)" class="font-red" style="cursor:pointer; font-size: 1.5em">☆</p>
                <p id = "star4" onclick="changestar(4)" class="font-red" style="cursor:pointer; font-size: 1.5em">☆</p>
                <p id = "star5" onclick="changestar(5)" class="font-red" style="cursor:pointer; font-size: 1.5em">☆</p>
              </div>
              <div class="row justify-content-center">
                <textarea name="comment" placeholder="Please enter Your comment here…"></textarea>
                <input type="submit" value="Submit" />
              </div>
            </form>
          </div>
          <div class="row justify-content-center">
            <a href="bookings.php"  class="font-red">Cancle</a>
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
        <script type="text/javascript">
      function changestar(num){
        var star1 =  document.getElementById("star1");
        var star2 =  document.getElementById("star2");
        var star3 =  document.getElementById("star3");
        var star4 =  document.getElementById("star4");
        var star5 =  document.getElementById("star5");
        var empty = document.getElementById("empty").value;
        var full = document.getElementById("full").value;
        star1.innerText=empty;
        star2.innerText=empty;
        star3.innerText=empty;
        star4.innerText=empty;
        star5.innerText=empty;
        var star = "";
        for(var i = 0; i < 5; i++){
          if(i < num){
            star = star + full;
          }else{
            star = star + empty;
          }
        }
          document.getElementById("Star").value = star;

        if(num >= 1){
          star1.innerText=full;
        }
        if(num >= 2){
          star2.innerText=full;
        }
        if(num >= 3){
          star3.innerText=full;
        }
        if(num >= 4){
          star4.innerText=full;
        }
        if(num >= 5){
          star5.innerText=full;
        }
      }
    </script>
  </body>
</html>