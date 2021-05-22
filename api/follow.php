<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_SESSION['userName'])){

            $userName = $data['userName'];
            // $userName = 'anish';
            $fillowerSql = "SELECT COUNT(follow.su_id) as follower FROM follow WHERE follow.u_id = (SELECT user.u_id FROM user WHERE user.name = '$userName')";
            $followingSql = "SELECT COUNT(follow.u_id) as following FROM follow WHERE follow.su_id = (SELECT user.u_id FROM user WHERE user.name = '$userName')";

            $follower = $conn->query($fillowerSql);
            $following = $conn->query($followingSql); 

            $result = $follower->fetch_array(MYSQLI_ASSOC);
            $result2 = $following->fetch_array(MYSQLI_ASSOC);
            // $obj = array();
            // array_push($obj,array(
                
                
            // ));
            $response = array('status'=>true,'message'=>"Record Found","body"=>array('follower'=>$result['follower'],'following'=>$result2['following'])); 
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