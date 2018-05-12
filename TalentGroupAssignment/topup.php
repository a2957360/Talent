<?php 
ob_start();
session_start(); 
$errormessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = "mysql:host=localhost;dbname=katemao4_talent";
    $username = 'katemao4_wutia';
    $password = 'a2957360';
    $pdo = new PDO($dsn, $username, $password);
    $Id = $_SESSION["UserId"];
   $ballence = $_POST['ballence'];
   $userId = $_SESSION["UserId"];
   $stmt = $pdo->prepare("UPDATE `userTable` SET `TCoin` = `TCoin` + '$ballence' Where `Id` = '$Id';");
   $stmt->execute();
   echo "<script> location.href='wallet.php'; </script>";
}
include("includes/head.php");?>
    <title>Top Up</title>
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
            <li class="nav-item">
              <a class="nav-link" href="faq.php">FAQ</a>
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
      <div class="box">
        <div class="row justify-content-center">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
            <div class="alcenter">
            <p>1 T Coin = CAD1</p>
              <input type="text" id="ballence" name="ballence" onchange="logcheck()" placeholder="enter amount" />
            <hr>
            <p>Top Up with</p>
            <img src="img/PayPal.png"/>
            <p>or with card</p>
            </div>
            <input type="text" placeholder="First Name"/>
            <input type="text" placeholder="Last Name"/>
            <input type="text" placeholder="Card Number"/>
            <input type="text" placeholder="Exp.Month"/>
            <input type="text" placeholder="Exp.Year"/>
            <input type="text" placeholder="CVV"/>
            <input type="text" placeholder="Street"/>
            <input type="text" placeholder="City"/>
            <input type="text" placeholder="Province"/>
            <input type="text" placeholder="Zip Code"/>
            <input type="text" placeholder="Country"/>
            <input type="text" placeholder="Comment"/>
            <input type="submit" value="Top Up Now" id="topup" disabled="true"/>
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
        <script type="text/javascript">
      function logcheck(){
        var ballence = document.getElementById("ballence");
        var btn = document.getElementById("topup");
        if(ballence != null){
          btn.disabled = false;
        }
      }
    </script>
  </body>
</html>