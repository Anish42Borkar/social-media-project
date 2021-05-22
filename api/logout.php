<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_SESSION['userName'])){
            session_unset();
            session_destroy();
            $response = array('status'=>false,'message'=>"Logout Successfull","body"=>null);
        }else{
            $response = array('status'=>false,'message'=>"Logout Already","body"=>null);
        }
    }else{
        $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
    }
    echo json_encode($response);
?>