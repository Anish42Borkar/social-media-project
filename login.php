<?php
    include 'connection.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $user = $data['user'];
    $pass = $data['pass'];


    $sql = "SELECT * FROM login WHERE u_name = '$user' AND pass = '$pass'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){

        echo 'ok';
        // $row = mysqli_fetch_array($result);
        // $response['name'] = $row['u_name'];
        // $response['pass'] = $row['pass'];
    }
    else{
        echo "No Record Found";
    }
    
    mysqli_close($conn);;

    // echo json_encode($response);
?>

