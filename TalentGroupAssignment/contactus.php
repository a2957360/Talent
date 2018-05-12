<?php 
ob_start();
session_start(); 
$errormessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$orderId = $_POST['Id'];
}else{
$orderId = $_GET['Id'];
}
$Id = $_SESSION["UserId"];
$dsn = "mysql:host=localhost;dbname=katemao4_talent";
$username = 'katemao4_wutia';
$password = 'a2957360';
$pdo = new PDO($dsn, $username, $password);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $Name = $_POST['Name'];
   $Email = $_POST['Email'];
   $Message = $_POST["Message"];
   $Reason = $_POST["Reason"];
   $stmt = $pdo->prepare("INSERT INTO `reportTable` VALUES ('', '$orderId','$Email','$Name','$Message','$Reason');");
   $stmt->execute();
   echo "<script> location.href='contact-thanks.html'; </script>";
}

$stmt = $pdo->prepare("SELECT * FROM `userTable` WHERE `Id` = '$Id';");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   $Name = $row['UserName'];
   $Email = $row['Email'];
}
$timelist = explode(",",$Availabletime);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css?ver=1:2" type="text/css">
    <title>Log in</title>
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
    <section id="home" class="margin-btm">
      <div class="container">
        <div class="row justify-content-center">
          <h1>Contact Us</h1>
        </div>
        <div class="row justify-content-center">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
            <select name="Reason">
              <option value="" disabled selected>Reason for Contact</option>
              <option value ="1">Worker didn’t show up</option>
              <option value ="2">Bad Behavior</option>
              <option value ="3">Top up failed</option>
            </select>
            <input type="hidden" name="Id" value="<?= $orderId ?>">
            <input type="text" name="Email" placeholder="Email" value="<?= $Email ?>" />
            <input type="text" name="Name" placeholder="Name" value="<?= $Name ?>"/>
            <textarea name="Message" placeholder="Message"></textarea>
            <input type="submit" name="" value="Send"/>
          </form>
        </div>
        <div class="row justify-content-center">
          <a href="bookings.php" class="font-red">Cancle</a>
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