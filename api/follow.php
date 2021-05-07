<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_SESSION['userName'])){
            $userId = $_SESSION['userId'];
            // $userId = 8;
            $fillowerSql = "SELECT COUNT(su_id) as follower FROM `follow` WHERE u_id = '$userId'";
            $followingSql = "SELECT COUNT(u_id) as following FROM `follow` WHERE su_id = '$userId'";

            $follower = $conn->query($fillowerSql);
            $following = $conn->query($followingSql); 

            $result = $follower->fetch_array(MYSQLI_ASSOC);
            $result2 = $following->fetch_array(MYSQLI_ASSOC);
            $obj = array(
                'follower'=>$result['follower'],
                'following'=>$result2['following']
            );
            $response = response(array('status'=>false,'message'=>"Record Found","body"=>$obj)); 
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