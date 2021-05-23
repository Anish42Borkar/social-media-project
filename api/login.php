<?php
    require_once('connect.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = $data['user'];
        $pass = $data['pass'];

        $check_user = mysqli_query($conn, "SELECT * FROM `user` WHERE `name`='$user' AND `password`='$pass' LIMIT 1");
        $row = mysqli_fetch_array($check_user);
        $user_id = $row['u_id'];
        $priority = $row['priority'];

        if (mysqli_num_rows($check_user) == 1){

            $_SESSION['userName'] = $row['name'];
            $_SESSION['userId'] = $user_id;
            // $userInfo['userPriority'] = $row['priority'];
            $userInfo = array();
            array_push($userInfo,array(
                'userPriority'=>$priority
            ));
            $response = array('status'=>true,'message'=>"login success","body"=>array('post'=>$userInfo));
        }else $response = array('status'=>false,'message'=>"login Fail","body"=>null);
    }else $response = array('status'=>false,'message'=>"invalid method","body"=>null);
    echo json_encode($response);
?>