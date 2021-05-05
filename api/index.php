<?php

    include 'connect.php';
    session_start();

    $response = array();
    // if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_SESSION['userName'])){

            $userId = $_SESSION['userId'];
            $result = mysqli_query($conn,"select * from post where u_id = '$userId'");

            while($row = mysqli_fetch_array($result)){

                array_push($response, array(
                    'p_id' => $row['p_id'],
                    'u_id' => $row['u_id'],
                    'date' => $row['p_date'],
                    'body' => $row['p_content']
                ));
            }

            echo json_encode($response);

        }else{
            echo "back to login";
        }
    // }
    // else{
    //     echo 'invalid method';
    // }

?>