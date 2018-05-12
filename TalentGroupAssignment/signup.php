<?php 
ob_start();
session_start(); 
  $errormessage = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("includes/database.php");
    $errormessage = "";
    $Mail = $_POST['email'];
    $UserName = $_POST['username'];
    $Password = $_POST['password'];
    $Repassword = $_POST['repassword'];
    $Phone = $_POST['phone'];
    $Street = $_POST['Street'];
    $City = $_POST['City'];
    $Province = $_POST['Province'];
    $Photo = '';
    if($_FILES['Photo']['name'] != null){
      $Photo = 'Photo/'.$UserName.$Phone.$_FILES['Photo']['name'];
    }
    if($Password == $Repassword){
      $stmt = $pdo->prepare("SELECT * FROM `userTable` WHERE `UserName` = '$UserName';");
      $stmt->execute();
      if($stmt != null){
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "1";
            $errormessage = "UserName repeat";
          }
      }
      if($errormessage != "UserName repeat"){
        $stmt = $pdo->prepare("INSERT INTO `userTable` VALUES ('','$Photo','$UserName','$Password','$Mail','$Phone','$Street','$City','$Province','0');");
        $stmt->execute();
        if($stmt != null){
            move_uploaded_file($_FILES['Photo']['tmp_name'], $Photo);
            echo "<script> location.href='login.php'; </script>";
        }else{
          $errormessage = "Datebase Error!";
        }
      }
    }else{
      $errormessage = "Password do not match!";
    }
}
include("includes/head.php");?>
    <title>Sign up</title>
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
    <section id="maincontent" class="margin-btm">
      <div class="container">
        <div class="row justify-content-center">
          <h1>SIGN UP</h1>
          <hr/>
        </div>
        <div class="row justify-content-center errormessage">
          <?php 
          echo $errormessage; 
          echo "<br/>"; 
          ?>
        </div>
        <div class="row justify-content-center">
          <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data'>
            <div id="imgPreview" class="margin-btm">
              <img src="img/placeholder.png" class="img-avatar" />
            </div>
            <input type='file' name='Photo' onchange="PreviewImage(this)"/>
            <input type="text" id="username" name="username" placeholder="Username" onchange="logcheck()" />
            <input type="password" id="password" name="password" placeholder="Password" onchange="logcheck()"/>
            <input type="password" id="repassword" name="repassword" placeholder="Confirm Password" onchange="logcheck()"/>
            <input type="text" name="email" placeholder="example@email.com" />
            <input type="text" name="phone" placeholder="Phone Number" />
            <input type="text" name="Street" placeholder="street" />
            <input type="text" name="City" placeholder="city" />
            <input type="text" name="Province" placeholder="province" />

            <input type="submit" id="signup" name="" value="SIGN UP" disabled="true" />
          </form>
        </div>
        <div class="row justify-content-center">
          <p>Already registered? Please 
            <a href="login.php" class="talent-link">Log In</a>
          </p>
        </div>  
      </div>
    </section>
    <script type="text/javascript">
      function logcheck(){
        var UserName = document.getElementById("username");
        var Password = document.getElementById("password");
        var repassword = document.getElementById("repassword");
        var btn = document.getElementById("signup");
        if(UserName != null && Password != null && repassword != null){
          btn.disabled = false;
        }
      }
    </script>
<? include("includes/footer.php"); ?>