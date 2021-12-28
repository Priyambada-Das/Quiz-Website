<?php
session_start();

$con=mysqli_connect('localhost','root');
//if($con){
    //echo "connection";
//}
mysqli_select_db($con,'test');
?>


<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
    <body>
        <div class="container text-center">

            <br></br>

            <h1 class=" text-center text-success text-uppercase"> Web Development Quiz</h1>

            <br><br>

            <table border='1px' width='100%' class="card-header text-center">
                <tr>
                    <th colspan="2" class="bg-dark"><h1 class="text-white">Results</h1></th>
                </tr>  
                
                <tr>
                    <td>
                        Question Attempted
                    </td>   
                     
                    <?php
                
                    $Resultans=0;
                    
                    if(isset($_POST['submit'])){
                        if(!empty($_POST['quizcheck'])){
                            //counting no of checked checkboxes.
                            $checked_count=count($_POST['quizcheck']);
                            //print_r($_POST);
                        ?>

                        <td>
                            <?php
                            echo "Out of 10,You have attempt" .$checked_count. "option";?>
                        </td>

                        
                        <td>
                            <?php
                            //loop to store and display values of indivisual checked checkbox.
                            $selected=$_POST['quizcheck'];

                            $q1="select * from questions";
                            $ansresults=mysqli_query($con,$q1);
                            $i=1;

                            while($rows=mysqli_fetch_array($ansresults)){
                                $flag=$rows['ans_id']==$selected[$i];

                                if($flag)
                                {
                                    //echo "correct ans is ".$rows['ans_id']."<br>";
                                    //$counter++;
                                    $Resultans++;
                                   // echo "Well Done! Your".$counter."answer is correct<br><br>";

                                }else{
                                    //$counter++;
                                    //echo "Sorry Your".$counter."answer is inncorrect<br><br>";
                                }
                                $i++;
                            }

                            ?>

                            <tr>
                                <td>
                                    Your Total score
                                </td>
                                <td colspan="2">

                                <?php
                                echo "<br>Your Score is".$Resultans.".";
                        }else{
                            echo"<b>Please Select Atleast One Option.</b>";
                        }
                    }
                    ?>
                    </td>
                </tr>
                
                <?php
                $name=$_SESSION['username'];
                $finalresult="Insert into user(username,totalques,answerscorrect)values('$name','10','$Resultans')";
                $queryresult=mysqli_query($con,$finalresult);
                //if($queryresult){
                    //echo "successss";

                
                ?>
            </table>
                <a href="logout.php" class="btn btn-success">LOGOUT</a>
        </div>
   </body>
</html>




