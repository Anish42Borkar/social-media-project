<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(isset($_SESSION['userName'])){
            $userName = $data['userName'];
            $currentUser = $_SESSION['userName'];
            
            $sql = "SELECT user.u_id,user.name,post.p_content,post.thumnail from post,user where post.u_id = user.u_id AND user.name = '$userName'";
            $result = $conn->query($sql);
            $userPost = array();
            $check = false;
            
            if(checkNoOfRows($result))
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                    array_push($userPost,array(
                        'post'=>$row['p_content'],
                        'thumnail'=>$row['thumnail']
                    ));
            if($currentUser != $userName)
                $check = checkFollowingOrNot($currentUser,$userName,$conn);
            $response = array('status'=>true,'message'=>"Record Found" ,"body"=>array('post'=>$userPost,'name'=>$userName,'check'=>($check ? true : false)));  
        }
        else $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
    }
    else $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
    echo json_encode($response);
    mysqli_close($conn);
?>