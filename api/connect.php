<?php
    header("Content-Type: application/json");
    session_start();
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    
    $servrName = 'localhost';
    $userName = 'root';
    $userPassword = '';
    $dbName = 'content-sharing';
    //create connection
    $conn = new Mysqli($servrName,$userName,$userPassword,$dbName);

    
    function response($input){
        $response = array();
        array_push($response ,array(
            'status'=>$input['status'],
            'message'=>$input['message'],
            'body'=>$input['body']
        ));
        return $response;
    }
    // $response = array();
?>