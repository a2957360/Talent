<?php 
ob_start();
session_start(); 
$errormessage = "";

$orderId = $_GET['orderId'];
$modifytime = $_GET['modifytime'];

$dsn = "mysql:host=localhost;dbname=katemao4_talent";
$username = 'katemao4_wutia';
$password = 'a2957360';
$pdo = new PDO($dsn, $username, $password);

$stmt = $pdo->prepare("SELECT `talentTable`.`Id` as `talentId`,`Availabletime` FROM `talentTable` JOIN `orderTable` WHERE `orderTable`.`Id` = '$orderId' and `orderTable`.`TalentId` = `talentTable`.`Id`;");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   $talentId = $row['talentId'];
   $Availabletime = $row['Availabletime'];
}

$timelist = explode(",",$Availabletime);
$modifylist = explode(",",$modifytime);
$timelist[($modifylist[0] - 1) * 12 + ($modifylist[1] - 1)] = 1;
$Availabletime = implode(",",$timelist);
$stmt = $pdo->prepare("UPDATE `talentTable` SET `Availabletime`='$Availabletime' Where `Id` = '$talentId';");
$stmt->execute();
$stmt = $pdo->prepare("UPDATE `orderTable` SET `State`='4' Where `Id` = '$orderId';");
$stmt->execute();

echo "<script> location.href='bookings.php'; </script>";
?>