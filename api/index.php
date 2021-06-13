<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(isset($_SESSION['userName'])){

            $userId = $_SESSION['userId'];
            // $userId = 2;

            $followingsPost = array();
            $checkFollowing = "SELECT u_id FROM follow WHERE su_id = '$userId'";
            $result = $conn->query($checkFollowing);
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $id = $row['u_id'];

                $fetchFollowingsPost = "SELECT * from post WHERE post.u_id = '$id' ORDER BY `p_id` DESC LIMIT 3";

                $result2 = $conn->query($fetchFollowingsPost);
                while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){
                    array_push($followingsPost,array(
                        'post'=>$row2['p_content'],
                        'id'=>$row2['u_id'],
                        'pId'=>$row2['p_id'],
                        'thumnail'=>$row2['thumnail']
                    ));
                }
            }
            
            $response = array('status'=>true,'message'=>(checkNoOfRows($result) ? "Record Found" : "No Record Found"),"body"=>(checkNoOfRows($result) ? array('post'=>$followingsPost) : null));
        }else $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
    }else $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);  
    
    echo json_encode($response);
    mysqli_close($conn);   
?>