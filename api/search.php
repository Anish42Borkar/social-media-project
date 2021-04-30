<?php
    include 'connect.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $response = array();
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
                
                array_push($response,array(
                    'success'=>true,
                    'message'=>"Record Found",
                    'body'=>$userNames
                ));
            }
            else{

                array_push($response,array(
                    'success'=>false,
                    'message'=>"NO RECORDS FOUND"
                ));
            }
        }
        else{
            array_push($response,array(
                'success'=>false,
                'message'=>"No Value Pass"
            ));
        }
    }
    else{
        array_push($response,array(
            'success'=>false,
            'message'=>"INVALID METHOD"
        ));
    }
    
    
    echo json_encode($response);
    mysqli_close($conn);
?>

