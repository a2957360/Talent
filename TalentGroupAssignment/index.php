<?php
ob_start();
session_start(); 
include("includes/database.php");
$errormessage = "";
$Id = '';
$Src = '';
$Title = '';
$Description = '';
$stmt = $pdo->prepare("SELECT * From `talentTable`;");

include("includes/head.php");?>
    <title>Talent</title>
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
                <p class="nav-link font-white" href="index.php">Home</p>
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
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>         
            <?}?>
          </ul>
        </div>
      </div>
    </nav>
    <section id="home" class="margin-btm  alcenter">
      <div class="fullscreen">
        <img src="img/home-banner.png">
      </div>
    </section>
    <section id="catelog" class="margin-btm">
      <div class="container justify-content-center">
        <div class="row justify-content-center">
          <div class="col-3 alcenter">
            <a href="departmentlist.php?Role=Masseuse">
              <img src="img/masseuse@3x.png">
              <h6>Masseuse</h6>
            </a>
          </div>
          <div class="col-3 alcenter">
          <a href="departmentlist.php?Role=Pet Care">
              <img src="img/pet_care@3x.png">
              <h6 style="color:">Pet Care</h6>
            </a>
          </div>
          <div class="col-3 alcenter">
            <a href="departmentlist.php?Role=Chef">
              <img src="img/chef@3x.png">
              <h6>Chef</h6>
            </a>
          </div>
          <div class="col-3 alcenter">
            <a href="departmentlist.php?Role=Cleaning">
              <img src="img/cleaning@3x.png">
              <h6>Cleaning</h6>
            </a>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="fullscreen alcenter margin-btm" style="background-color: #f4f4f4; padding: 15px 0;">
        <p class="font-thin-lg">Top Stars</p> 
      </div>
    </section>
    <section id="topstar" class="margin-btm">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col">
          <?php 
          $stmt->execute();
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $Id = $row['Id'];
          $Src = $row['Photo'];
          $Name = $row['Name'];
          $Role = $row['Role'];
          $Star = $row['Star'];
          $Salary = $row['Salary'];
          $Description = $row['Description'];
          if($_SESSION["UserId"] != null){
            echo "<a href='workerdetail.php?Id=$Id'>";
          }else{
            echo "<a href='login.php'>";
          }
        ?>        
          <div class="row">
            <div class="col-4" style="max-width: 210px;">              
              <img src="<?= $Src ?>" class="img-avatar" >
            </div>
            <div class="col-8">
              <div class="row">
                <div class="col-8">
                  <h4><?= $Role ?></h4>              
                </div>
                <div class="col-4 alright">
                  <p class="font-thin-lg">$<?= $Salary ?>/h</p>              
                </div>            
              </div>
              <div class="row">
                <div class="col">
                  <p class="font-thin"><?= $Name ?></p>
                  <p class="font-red"><?= $Star ?></p>
                  <p class="font-gray" style="max-width: 700px;"><?= $Description ?></p>
                </div>
              </div>
            </div>
          </div>
        </a>
        <hr>
        <?php 
          }
        ?>  
          </div>           
        </div>
      </div>
    </section>
<? include("includes/footer.php"); ?>
