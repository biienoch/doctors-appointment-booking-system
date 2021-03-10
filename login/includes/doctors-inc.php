<?php

if(isset($_POST['submit'])){
    require 'conn.php';

    $username=$_POST['username'];
    $password=$_POST['password'];
    if(empty($username)||empty($password)){
       header("location: ../../index.php?error=emptyfields");
       exit();
    }else{
        $sql= "SELECT *FROM doctors where username= ?";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
           header("location: ../../index.php?error=sqlerror");
       exit(); 
        }else{
            mysqli_stmt_bind_param($stmt, "s",$username);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result)){
                $passcheck=password_verify($password,$row['password']);
                if($passcheck==false){
                   header("location: ../../index.php?error=wrongpass");
                   exit();
                }elseif ($passcheck==true){
                    session_start();
                    $_SESSION['sessionid']=$row['id'];
                    $_SESSION['sessionuser']=$row['username'];
                    header("location: ../../index.php?success=loggedin");
                   exit();

                }else{
                   header("location: ../../index.php?error=wrongpass");
                   exit();

                }

            }else{
               header("location: ../../index.php?error=nouser");
               exit();
            }
        }
    }

}else{
   header("location: ../../index.php?error=accessforbiden");
   exit();
}

?>