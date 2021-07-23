<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(isset($_SESSION['userName'])){
            $userName = $data['userName'];
            $currentUser = $_SESSION['userName'];
            $currentId=$_SESSION['userId'];
            
            $sql = "SELECT user.u_id,user.name,user.Profile,user.cover,user.description,post.p_id,post.p_content,post.thumnail,post.p_title,post.p_discription from post,user where post.u_id = user.u_id AND user.name = '$userName'";
            $result = $conn->query($sql);

            $userPost = array();
            $check = false;
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

            
            if(checkNoOfRows($result))
            {
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                    $liked=checkLike($currentId,$row['p_id'],$conn);
                    $likeCount=mysqli_fetch_array($conn->query("SELECT COUNT(p_id) FROM `like_table` WHERE p_id ='".$row['p_id']."'"));

                    $user_details=array(
                        'u_profile'=>$row['Profile'],
                        'u_cover'=>$row['cover'],
                        'u_desc'=>$row['description']
                    );
                    array_push($userPost,array(
                        'post'=>$row['p_content'],
                        'pId'=>$row['p_id'],
                        'thumnail'=>$row['thumnail'],
                        'title'=>$row['p_title'],
                        'desc'=>$row['p_discription'],
                        'liked'=>$liked,
                        'likeCounts'=> $likeCount['COUNT(p_id)']
                    ));
                }
            
            }else{
                $sql = "SELECT user.u_id,user.name,user.Profile,user.cover,user.description from user where user.name = '$userName'";
                $result = $conn->query($sql);
                if(checkNoOfRows($result))
                {
                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                        $user_details=array(
                            'u_profile'=>$row['Profile'],
                            'u_cover'=>$row['cover'],
                            'u_desc'=>$row['description']
                        );
                    }
                }
            }
            
            if($currentUser != $userName)
                $check = checkFollowingOrNot($currentUser,$userName,$conn);
            $response = array('status'=>true,'message'=>"Record Found" ,"body"=>array('post'=>$userPost,'userDetails'=>$user_details,'name'=>$userName,'check'=>($check ? true : false)));  
        }
        else $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);

    }
    else $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
    echo json_encode($response);
    
    mysqli_close($conn);
?>