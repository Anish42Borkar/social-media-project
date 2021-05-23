<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_SESSION['userName'])){

            $userId = $_SESSION['userId'];
            $followingsPost = array();
            $fetchFollowingsPost = "SELECT post.p_content from post WHERE post.u_id IN (SELECT u_id FROM follow WHERE su_id = '$userId')";
            
            $result = $conn->query($fetchFollowingsPost);
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                array_push($followingsPost,array(
                    'post'=>$row['p_content']
                ));
            }
            if(checkNoOfRows($followingsPost)){
                $response = array('status'=>true,'message'=>(checkNoOfRows($followingsPost) ? "Record Found" : "No Record Found"),"body"=>(checkNoOfRows($followingsPost) ? array('post'=>$followingsPost) : null));
        }else $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
    }else $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);  
    
    echo json_encode($response);     
?>