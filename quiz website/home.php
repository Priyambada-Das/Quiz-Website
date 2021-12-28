<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:index.php');
}

$con=mysqli_connect('localhost','root');

mysqli_select_db($con, 'test');

?>

<!DOCTYPE html>
<html lang="en">
<head>
     <title>Document</title>
     <link rel="stylesheet" type="text/css" href="bootstrap.css">
     <style>
body {
/* background-color: rgb(24, 197, 91); */
background-image: url("bg.jpg");
font-family: Helvetica;
}
</style>
</head>
<body>

<div class="container">

   <br><h1 class="text-center text-primary">WEBDEVELOPER QUIZ</h1></br>

    <h2 class="text-center text-success">Welcome <?php echo $_SESSION['username']; ?></h2>

<div class=" col-xl-8 col-lg-8 col-md-8 col-sm-8 m-auto d-block">     
   
    <div class="card">

        <h3 class="text-center card-header"> Welcome <?php echo $_SESSION['username']; ?> , you have to select only one out of 4. Best of luck :)

    </div><br>

<form action="check.php" id="form1" method="post">
    
    <?php

for($i=1 ;$i<=10; $i++){
      $q= "select * from questions where qid=$i";
      $query = mysqli_query($con,$q);

    while($rows=mysqli_fetch_array($query)){
      
    ?>
        <div class="card">
            <h4 class="card-header"><?php echo $rows['question'];?> </h4>
        
            <?php 
                $s="select * from answers where ans_id=$i";
                $query=mysqli_query($con, $s);

                while($rows=mysqli_fetch_array($query)){
            ?> 
                    <div class="card-body">

                      <input type="radio" name="quizcheck[<?php echo $rows['ans_id'];?>]" value="<?php echo $rows['aid'];?>" >
                      
                      <?php echo $rows['answer']; ?>
                
                    </div>
            
        <?php
                }
            
           }    
        }
    ?>

    <input type="submit" name="submit" value="Submit" class="btn btn-success m-auto d-block">

</form>
</div>
</div><br>
          
        <div class="m-auto d-block">
           <a href="logout.php" class="btn btn-primary" > LOGOUT </a>
        </div><br>

        <div>
          <h5 class="text-center"> @2021 WebDevelopment </h5>
        </div><br><br>

        </div>
      
</body>
</html>