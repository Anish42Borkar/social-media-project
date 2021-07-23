<?php
    include '../api/connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_SESSION['userName'])){
        $message = "";
        function fileupload($functionTask,$fileName,$conn,$sessionId){

            $result="";
            $file =$_FILES[$fileName]; //$filename here

            $file_name = $file['name'];  
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size']; 
            $file_error = $file['error'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            if($file_error === 0){
                $file_name_new = uniqid('', true) . '.' . $file_ext; 
                $file_destination = 'uploads/userPictures/' . $file_name_new;

                if(move_uploaded_file($file_tmp, $file_destination)) {
                
                    $conn->query("update user set Profile = '$file_destination' where u_id = '".$_SESSION['userId']."'");                    //$functionTask , $sessionId , $conn above
                    return $result ="SuccessFully moved";
                }else{
                    return $result="files not moved";
                }

            }else{
                return $result="file Error";
            }  
        }

        if($_POST["profileCheck"]==true and isset($_FILES['file']['tmp_name'])){

            $ProfileResult =fileupload("file","file",$conn,$_SESSION['userId']);
            $message= "Profile " . $ProfileResult . " ";
        }

        
        if($_POST["coverCheck"]==true and isset($_FILES['cover']['tmp_name'])){

            $CoverResult =fileupload("cover","cover",$conn,$_SESSION['userId']);
            $message= $message . "cover " . $CoverResult . " ";
        }

        if($_POST["descriptionCheck"]==true and isset($_POST["description"])){

            // $conn->query("update user set description={$_POST['description']} where u_id={$_SESSION['userId']}");
            $conn->query("update user set description = '".$_POST['description']."' where u_id = '".$_SESSION['userId']."'");
            $message= $message .  "description updated successful";
        }
        
        
        $response = array('status'=>false,'message'=>"$message","body"=>null);

         
        
        }else{
            $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
        }
    }else{
        $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
    }
    
    
        echo json_encode($response);
        mysqli_close($conn);
    
?>