<?php
    header("Content-Type: application/json");
    session_start();
    
    $data = json_decode(file_get_contents('php://input'),true);
    
    $servrName = 'localhost';
    $userName = 'root';
    $userPassword = '';
    $dbName = 'content-sharing';
    //create connection
    $conn = new Mysqli($servrName,$userName,$userPassword,$dbName);

    function checkNoOfRows($input){
        if($input->num_rows) return true;
        return false;
    }

    function checkFollowingOrNot($currentUser,$differentUser,$conn){
        $sql = "SELECT follow.u_id FROM follow WHERE follow.su_id = (SELECT user.u_id from user where user.name = '$currentUser') and follow.u_id = (SELECT user.u_id FROM user WHERE user.name = '$differentUser') LIMIT 1";
        $result = $conn->query($sql);
        if(checkNoOfRows($result)) return true;
        false;
    }
?>