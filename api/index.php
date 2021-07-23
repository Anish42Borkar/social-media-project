<?php
    include '../api/connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(isset($_SESSION['userName'])){

            $userId = $_SESSION['userId'];

            function checkLike($current,$other,$conn){
                
                $row=mysqli_fetch_array($conn->query("SELECT l_id from `like_table` where u_id='".$current."' and p_id='".$other."'"));
                $Like_ID = $row['l_id'];

        
                if(is_null($Like_ID) == 1){
                    $liked="notLiked";
                }else{
                    $liked="liked";
                }
                return $liked;
            }

            $followingsPost = array();
            $checkFollowing = "SELECT u_id FROM follow WHERE su_id = '$userId'";
            $result = $conn->query($checkFollowing);
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $id = $row['u_id'];

                $fetchFollowingsPost = "SELECT * from post WHERE post.u_id = '$id' ORDER BY `p_id` DESC LIMIT 3";

                $result2 = $conn->query($fetchFollowingsPost);
                while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){

                    $likeCount=mysqli_fetch_array($conn->query("SELECT COUNT(p_id) FROM `like_table` WHERE p_id ='".$row2['p_id']."'"));
                    $liked=checkLike($userId,$row2['p_id'],$conn);
                    
                    array_push($followingsPost,array(
                        'post'=>$row2['p_content'],
                        'id'=>$row2['u_id'],
                        'pId'=>$row2['p_id'],
                        'thumnail'=>$row2['thumnail'],
                        'title'=>$row2['p_title'],
                        'desc'=>$row2['p_discription'],
                        'liked'=>$liked,
                        'likeCounts'=> $likeCount['COUNT(p_id)']
                    ));
                }
            }
            
            $response = array('status'=>true,'message'=>(checkNoOfRows($result) ? "Record Found" : "No Record Found"),"body"=>array('post'=>$followingsPost));
        }else $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
    }else $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);  
    
    echo json_encode($response);
    mysqli_close($conn);   
?>