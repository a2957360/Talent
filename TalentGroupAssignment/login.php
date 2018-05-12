<?php
ob_start();
session_start(); 
include("includes/database.php");
$errormessage = "";
$logname = $_POST['UserName'];
$logpassword = $_POST['Password'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $pdo->prepare("SELECT * From `userTable` where Username = '$logname' ;");
  $stmt->execute();
  if($stmt != null){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      if($logpassword == $row['Password']){
          $_SESSION["Usrname"] = $logname;
          $id = $row['Id'];
          $_SESSION["UserId"] = $id;
        echo "<script> location.href='index.php'; </script>";
            exit;
      }else{
          $errormessage = "Your username or password is not correct, please enter again.";
      }
    }
  }
}
include("includes/head.php");?>
    <title>Talent-Log in</title>
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

          </ul>
        </div>
      </div>
    </nav>
    <section id="home" class="margin-btm  alcenter">
      <div class="fullscreen">
        <img src="img/log_bg_letterless.png">
      </div>
    </section>
    <section id="maincontent" class="margin-btm">
      <div class="container">
        <div class="row justify-content-center">
          <?php 
          echo $errormessage; 
          echo "<br>";
          ?>
        </div>
        <div class="row justify-content-center">
          <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
            <input type="text" name="UserName" Id="UserName" placeholder="Username" onchange="logcheck()" />
            <input type="password" name="Password" Id="Password" placeholder="Password" onchange="logcheck()"/>
            <input type="submit" id="login" value="LET'S START" class="button" disabled="true" />
          </form>
        </div>
        <div class="row justify-content-center">
          <p>Not registered yet? Please 
            <a href="signup.php" class="talent-link">Sign Up</a>
          </p>
        </div>  
      </div>
    </section>
<? include("includes/footer.php"); ?>
<script type="text/javascript">
  function logcheck(){
    var UserName = document.getElementById("UserName");
    var Password = document.getElementById("Password");
    var btn = document.getElementById("login");
    if(UserName != null && Password != null){
      btn.disabled = false;
    }
  }
</script>
