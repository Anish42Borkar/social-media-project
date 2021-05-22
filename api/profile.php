<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(isset($_SESSION['userName'])){
            $userName = $data['userName'];
            // $userId = 2;
            $sql = "SELECT user.u_id,user.name,post.p_content from post,user where post.u_id = user.u_id AND 
            user.name = '$userName'";
            $result = $conn->query($sql);

            $userPost = array();
            if($result->num_rows > 0){
                $name;
                // echo json_encode($result);
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    $name = $row['name'];
                    array_push($userPost,array(
                        'post'=>$row['p_content']
                    ));
                }
                
               
                $response = array('status'=>false,'message'=>"Record Found","body"=>array('post'=>$userPost,'name'=>$name));
            }
            else{
                $response = array('status'=>false,'message'=>"No Record Found","body"=>null); 
            }
        }
        else{
            $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
        }
    }
    else{
        $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
    }

    echo json_encode($response);
    mysqli_close($conn);

?>