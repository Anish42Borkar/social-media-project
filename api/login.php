<?php

    require_once('connect.php');
    session_start();

    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $response = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $user = $data['user'];
        $pass = $data['pass'];
        // $user = 'anita';
        // $pass = '12345';

        $check_user = mysqli_query($conn, "SELECT * FROM `user` WHERE `name`='$user' AND `password`='$pass'");
        $row = mysqli_fetch_array($check_user);
        $user_id = $row['u_id'];
        $priority =$row['priority'];

        if (mysqli_num_rows($check_user) == 1){

            $_SESSION['userName'] = $row['name'];
            $_SESSION['userId'] = $user_id;
            array_push($response, array(
                'success' => true,
                'message' => 'login success',
                'body' => [$user_id, $priority]
            ));

        }else{

            array_push($response, array(
                'success' => false,
                'message' => 'login Fail'
            )); 

        }

    }else{

        array_push($response, array(
            'success' => false,
            'message' => 'invalid method'
        )); 

    }


    echo json_encode($response);

?>