<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_SESSION['userName'])){

            
            if(isset($data['comment_load_data'])){
                $postId = $data['postId'];
                $comments_query = "SELECT * FROM comment where p_id = '$postId'";
                $comments_query_run = mysqli_query($conn,$comments_query);
        
                $array_result = [];
        
                if(mysqli_num_rows($comments_query_run)){
                    foreach($comments_query_run as $row){
                        $user_id = $row['u_id'];
                        $user_query = "SELECT * FROM user WHERE u_id = '$user_id' LIMIT 1";
                        $user_query_run = mysqli_query($conn,$user_query);
                        $user_result = mysqli_fetch_array($user_query_run,MYSQLI_ASSOC);
                        array_push($array_result,[
                            'cmt'=>$row,
                            'user'=>$user_result
                        ]);
                    }
                    header("Content-type:application/json");
                    $response = array('status'=>true,'message'=>"Comment addded","body"=>$array_result);
                    // echo json_encode($array_result);
                }
            }

            if(isset($data['add_comment'])){
                $msg = mysqli_real_escape_string($conn,$data['msg']);
                $userId = $_SESSION['userId'];
                $postId = $data['postId'];
        
                $comment_add_query = "INSERT INTO comment (u_id,p_id,msg) VALUES ('$userId','$postId','$msg')";
                $comment_add_query_run = mysqli_query($conn,$comment_add_query);
        
                if($comment_add_query_run){
                    $response = array('status'=>true,'message'=>"Comment addded","body"=>null);
                }else{
                    $response = array('status'=>false,'message'=>"Comment not addded","body"=>null);
                }
            }

        }
        else $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
    }
    else $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);

    echo json_encode($response);
    mysqli_close($conn);
?>