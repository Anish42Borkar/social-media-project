<?php
    include 'connect.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $user = $data['searchTerm'];
    // $user = 'a';
    $sql = "SELECT * FROM user WHERE name LIKE '$user%'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){

        $response['success'] = true;
        $response['message'] = 'Records Found';
        $userNames = array();

        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $userNames[]=$row["name"];
            
        }
        $response['body'] = $userNames;
    }
    else{
        $response['success'] = false;
        $response['message'] = 'NO RECORDS FOUND';
    }
    
    echo json_encode($response);
    mysqli_close($conn);;
?>

