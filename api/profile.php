<?php

    include 'connect.php';
    session_start();
    $response = array();
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

                array_push($response,array(
                    'success'=>true,
                    'message'=>"Record Found",
                    'body'=>$userPost
                ));
            }
            else{

                array_push($response,array(
                    'success'=>false,
                    'message'=>"No Record Found"
                ));
                
            }

        }
        else{
            array_push($response,array(
                'success'=>false,
                'message'=>"No Session is Set"
            ));
        }
    }
    else{
        array_push($response,array(
            'success'=>false,
            'message'=>"Invalid Method"
        ));
    }

    echo json_encode($response);
    mysqli_close($conn);

?>