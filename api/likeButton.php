<?php
    include '../api/connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_SESSION['userName'])){
            $post = $data['postId'];
           
                function checkFollow($current,$other,$conn){

                    // $row=mysqli_fetch_array($conn->query("SELECT u_id from user where name='$next'"));
                    // $other = $row['u_id'];
                    
                    

                    $row=mysqli_fetch_array($conn->query("SELECT * from `like_table` where u_id=$current and p_id=$other"));
                    $Like_ID = $row['l_id'];

            
                    if(is_null($Like_ID) == 1){
                        $conn->query("insert into `like_table` (u_id,p_id)values($current,$other)");
                        $response = array('status'=>true,'message'=>"Like successful","body"=>null);
                    }else{
                        $conn->query("delete from `like_table` where u_id=$current and p_id=$other");
                        $response = array('status'=>true,'message'=>"Unlike successful","body"=>null);
                    }
                    return $response;
                }
                $current = $_SESSION['userId'];
                $response=checkFollow($current,$post,$conn);

        }else{
            $response = response(array('status'=>false,'message'=>"No Session is Set","body"=>null));
        }
    }else{
        $response = response(array('status'=>false,'message'=>"Invalid Method","body"=>null));
    }
    
    
        echo json_encode($response);
        mysqli_close($conn);
    
?>
