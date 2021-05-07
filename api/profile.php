<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(isset($_SESSION['userName'])){
            $userId = $_SESSION['userId'];
            // $userId = 2;
            $sql = "SELECT user.u_id,user.name,post.p_content from post,user where post.u_id = user.u_id AND 
            user.u_id = '$userId'";
            $result = $conn->query($sql);

            $userPost = array();
            if($result->num_rows > 0){
                // echo json_encode($result);
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    array_push($userPost,array(
                        'name'=>$row['name'],
                        'post'=>$row['p_content']
                    ));
                }
                $response = response(array('status'=>false,'message'=>"Record Found","body"=>$userPost));
            }
            else{
                $response = response(array('status'=>false,'message'=>"No Record Found","body"=>null)); 
            }
        }
        else{
            $response = response(array('status'=>false,'message'=>"No Session is Set","body"=>null));
        }
    }
    else{
        $response = response(array('status'=>false,'message'=>"Invalid Method","body"=>null));
    }

    echo json_encode($response);
    mysqli_close($conn);

?>