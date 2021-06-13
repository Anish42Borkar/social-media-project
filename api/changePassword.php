<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_SESSION['userName'])){
            
            $current=$data['currentPassword'];
            $new=$data['newPassword'];
            $row=mysqli_fetch_array($conn->query("SELECT password from user where u_id=".$_SESSION['userId'].""));
            $defaultPass =$row['password'];
            
            if($defaultPass==$current){
                if($defaultPass==$new){
                    $response = array('status'=>false,'message'=>"New password is same as old password","body"=>null);
                }else{
                    $conn->query("update user set password=$new where u_id=".$_SESSION['userId']."");
                    // update user set password="12345" where u_id=3;
                    $response = array('status'=>true,'message'=>"Password Successfully changed","body"=>null);
                }
            }else{
                $response = array('status'=>false,'message'=>"wrong password entered","body"=>null);
            }
            // $response=$_SESSION['userId'];
        }else{
            $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
        }
    }else{
        $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
    }
    
    
    echo json_encode($response);
    mysqli_close($conn);
    
?>
