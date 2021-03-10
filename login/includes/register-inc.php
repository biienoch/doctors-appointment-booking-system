<?php
if(isset($_POST['submit'])){
    //add database connection
    require 'conn.php';

    $username=$_POST['username'];
    $password=$_POST['password'];
    $confirmPass=$_POST['confirmPassword'];

    if(empty($username)||empty($password)||empty($confirmPass)){
        header("location: ../register.php?error=emptyfields&username=".$username);
        exit();
        }   elseif(!preg_match("/^[a-zA-Z0-9]*/",$username)){
            header("location: ../register.php?error=invalidusername&username=".$username);
        exit();       
    }elseif($password!== $confirmPass){
        header("location: ../register.php?error=passwordsdonotmatch&username=".$username); 
        exit();
    }else{
        $sql="SELECT username FROM patient WHERE username=?";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../register.php?error=sqlerror".$username); 
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowcount=mysqli_stmt_num_rows($stmt); 
            if($rowcount>0){
                header("location: ../register.php?error=usernametaken"); 
                exit();
            }else{
                $sql="INSERT INTO patient (username,password) VALUES(?,?)";
                $stmt=mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    header("location: ../register.php?error=sqlerror"); 
                    exit();
                
                }else{

                    $hashedpass=password_hash($password,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"ss",$username,$hashedpass);
                    mysqli_stmt_execute($stmt);                            
                    header("location: ../register.php?success=registered");
                    exit();
                }

            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
?>