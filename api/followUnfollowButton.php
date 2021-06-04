<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_SESSION['userName'])){
            $userName = $data['userName'];
           
            function checkFollow($current,$userName,$conn){

                $row=mysqli_fetch_array($conn->query("SELECT u_id from user where name='$userName'"));
                $other = $row['u_id'];
        
                $row=mysqli_fetch_array($conn->query("SELECT f_id from follow where u_id=$other and su_id=$current"));
                $follow = $row['f_id'];
        
                if(is_null($follow) == 1){
                    $conn->query("insert into follow (u_id,su_id)values($other,$current)");
                    $response = array('status'=>true,'message'=>"follow successful","body"=>null);
                }else{
                    $conn->query("delete from follow where u_id=$other and su_id=$current");
                    $response = array('status'=>true,'message'=>"unfollow successful","body"=>null);
                }
                return $response;
            }
            $current = $_SESSION['userId'];
            $response=checkFollow($current,$userName,$conn);

        }else $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
    }else $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
    
    echo json_encode($response);
    mysqli_close($conn);
    
?>
