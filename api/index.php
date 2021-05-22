<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_SESSION['userName'])){

            $userId = $_SESSION['userId'];
            // $userId = 3;
            $followingsPost = array();
            $checkFollowing = "SELECT u_id FROM follow WHERE su_id = '$userId'";
            $result = $conn->query($checkFollowing);
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $id = $row['u_id'];
                
                $fetchFollowingsPost = "SELECT post.p_content from post WHERE post.u_id = '$id' LIMIT 3";
                
                $result2 = $conn->query($fetchFollowingsPost);
                while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){
                    array_push($followingsPost,array(
                        'post'=>$row2['p_content']
                    ));
                }
                if(count($followingsPost)){
                    $response = array('status'=>true,'message'=>"Record Found","body"=>array('post'=>$followingsPost));
                }else{
                    $response = array('status'=>false,'message'=>"No Record Found","body"=>null);
                }
            }
        }else{
            $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
        }
    }else{
        $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
    }       
    
    echo json_encode($response);     
?>