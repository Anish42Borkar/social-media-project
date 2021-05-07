<?php
    include 'connect.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $user = $data['searchTerm'];
        // $user = '';
        if(!empty($user)){
            
            $sql = "SELECT * FROM user WHERE name LIKE '$user%'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $userNames = array();
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $userNames[]=$row["name"];
                }
                $response = response(array('status'=>false,'message'=>"Record Found","body"=>$userNames));
            }
            else{
                $response = response(array('status'=>false,'message'=>"NO RECORDS FOUND","body"=>null));
            }
        }
        else{
            $response = response(array('status'=>false,'message'=>"No Value Pass","body"=>null));
        }
    }
    else{
        $response = response(array('status'=>false,'message'=>"INVALID METHOD","body"=>null));
    }
    echo json_encode($response);
    mysqli_close($conn);
?>

