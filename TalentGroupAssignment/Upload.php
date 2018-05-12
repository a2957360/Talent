<?php
ob_start();
session_start(); 
?>
<!DOCTYPE HTML>
<html>
   <head>
      <meta charset="UTF-8" />
      <link rel="stylesheet" type="text/css" href="Css2/main.css">

   </head>

   <body>
      <?php 
      $errormessage = "";
      $Date = new DateTime();
      $Date = $Date->format('Y-m-d');
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $dsn = "mysql:host=localhost;dbname=katemao4_talent";
      $username = 'katemao4_wutia';
      $password = 'a2957360';
      $pdo = new PDO($dsn, $username, $password);
      $Name = $_POST['Name'];
      $Role = $_POST['Role'];
      $Salary = $_POST['Salary'];
      $Description = $_POST['Description'];
      $file = '';
      $filetoolarge = '';
      $availabletime = '';
         if($_FILES['Photo']['name'] != null){
            $Photo = 'Photo/'.$Name.$Date.$_FILES['Photo']['name'];
         }
         if($_FILES['file1']['name'] != null){
            $file1 = 'File/'.$Name.$Date.$_FILES['file1']['name'].';';
            $file = $file.$file1;
         }
         if($_FILES['file2']['name'] != null){
            $file2 = 'File/'.$Name.$Date.$_FILES['file2']['name'].';';
            $file = $file.$file2;
         }
         if($_FILES['file3']['name'] != null){
            $file3 = 'File/'.$Name.$Date.$_FILES['file3']['name'].';';
            $file = $file.$file3;
         }

      if(filesize($_FILES['Photo']['tmp_name'])  < 500 * 1024){
         if(filesize($_FILES['file1']['tmp_name'])  < 1000 * 1024 && filesize($_FILES['file2']['tmp_name'])  < 1000 * 1024 && filesize($_FILES['file3']['tmp_name'])  < 1000 * 1024){
            $stmt = $pdo->prepare("INSERT INTO `talentTable` VALUES ('', '$Date','$Name','$Photo','$Role','$availabletime','$file','☆☆☆☆☆','$Description','$Salary');");
            $stmt->execute();`
            if($stmt->fetch(PDO::FETCH_ASSOC)){

            }
            move_uploaded_file($_FILES['Photo']['tmp_name'], $Photo);
            echo  filesize($_FILES['Photo']['tmp_name']);
            move_uploaded_file($_FILES['file1']['tmp_name'], $file1);   
            move_uploaded_file($_FILES['file2']['tmp_name'], $file2);   
            move_uploaded_file($_FILES['file3']['tmp_name'], $file3); 
         }else{
            $filetoolarge = 'You Files size must less than 1Mb';
         }
      }else{
            $filetoolarge = 'You Photo size must less than 500kb ';
      }




      }
      ?>

      <h1>What new Idea do you have?</h1>
      <div class="centerLog">
         <div class="forform">
            <?php echo $filetoolarge?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype='multipart/form-data' id="upload">
               <img src="">
               <br>
               <input type="file" name="Photo" />
               <br>
               <label>Name</label>
               <input type="text"  name="Name" />
               <br>
               <label>Date</label>
               <input type="text"  name="Date" value="<?= $Date ?>" readonly = "true"/>
               <br>
               <label>Role</label>
               <input type="text"  name="Role"/>
               <br>
               <label>Salary</label>
               <input type="text"  name="Salary"/>
               <br>
               <label>Description</label>
               <textarea name="Description" form="upload"></textarea> 
               <br>
               <input type="file" name="file1" />
               <br>
               <input type="file" name="file2" />
               <br>
               <input type="file" name="file3" />
               <br>
               <input type="submit" name="Login" value="Add Idea" />
            </form>
         </div>
      </div>
      <?php 
         die();
      ?>
   </body>
</html>

