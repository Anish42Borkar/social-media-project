<?php

    include 'connect.php';
    session_start();
    $response = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_SESSION['userName'])){
            session_unset();
            session_destroy();
            array_push($response,array(
                'success'=>true,
                'message'=>'Logout Successfull'
            ));
        }else{
            array_push($response,array(
                'success'=>true,
                'message'=>'Logout Already'
            ));
        }

    }else{
        array_push($response,array(
            'success'=>false,
            'message'=>'Invalid Method'
        ));
    }

    echo json_encode($response);

?>