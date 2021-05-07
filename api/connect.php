<?php
    session_start();
    $servrName = 'localhost';
    $userName = 'root';
    $userPassword = '';
    $dbName = 'content-sharing';
    //create connection
    $conn = new Mysqli($servrName,$userName,$userPassword,$dbName);

    
    function response($input){
        $response = array();
        array_push($response ,array(
            'success'=>$input['status'],
            'message'=>$input['message'],
            'body'=>$input['body']
        ));
        return $response;
    }
    $response = array();
?>