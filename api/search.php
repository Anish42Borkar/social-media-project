<?php
    include 'connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = $data['searchTerm'];
        $currentUser = $_SESSION['userName'];
        // $user = '';
        if(!empty($user)){
            $sql = "SELECT * FROM user WHERE name LIKE '$user%' AND name != '$currentUser'";
            $result = $conn->query($sql);
            $userNames = array();

            if(checkNoOfRows($result)) while($row = $result->fetch_array(MYSQLI_ASSOC)) $userNames[]=$row["name"];
            $response = array('status'=>true,'message'=>(checkNoOfRows($result) ? "Record Found" : "NO RECORDS FOUND"),"body"=>(checkNoOfRows($result) ? array('userNames'=>$userNames) : null));
        }
        else $response = array('status'=>false,'message'=>"No Value Pass","body"=>null);
    }
    else $response = array('status'=>false,'message'=>"INVALID METHOD","body"=>null);
    echo json_encode($response);
    mysqli_close($conn);
?>

