<?php
    include 'connection.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    // $user = $data['user'];
    // $pass = $data['pass'];
    

    $sql = "SELECT * FROM `post`";
    $result = $conn->query($sql);
    
    $response = array();

    if($result->num_rows > 0){

        while($row = mysqli_fetch_array($result)){

            array_push($response, array(
                'p_id' => $row['p_id'],
                'u_id' => $row['u_id'],
                'date' => $row['p_date'],
                'content' => $row['p_content']
            ));

        }

    }

    echo json_encode($response);
    
    mysqli_close($conn);
?>