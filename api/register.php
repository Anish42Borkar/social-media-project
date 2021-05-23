<?php
    require_once('connect.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $data['user'];
        $pass = $data['pass'];
        $phone = $data['phone'];
        $DOB = $data['DOB'];
        $email = $data['email'];
        $check_user = mysqli_query($conn, "SELECT * FROM `user` WHERE `name`='$name'");

        if(mysqli_num_rows($check_user) == 1) $response = response(array('status'=>false,'message'=>"User already exist","body"=>null));
        else{
            $priority = "user";
            $register = mysqli_query($conn, "INSERT INTO `user` (`u_id`, `name`, `ph_no`, `email`, `dob`, `password`, `priority`) VALUES (NULL, '$name', '$phone', '$email', '$DOB', '$pass', '$priority')");
            
            $fetch_user = mysqli_query($conn, "SELECT * FROM `user` WHERE `name`='$name' limit 1");
            $row = mysqli_fetch_array($fetch_user);

            $user_id = $row['u_id'];
            $response = response(array('status'=>true,'message'=>"Registered Success","body"=>null));
        }
    }else $response = response(array('status'=>false,'message'=>"INVALID METHOD","body"=>null));
    echo json_encode($response);
    mysqli_close($conn);
?>