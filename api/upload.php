<?php
    include 'connect.php';
    //  $videoPath = "uploads/".basename($_FILES['fileVideo']['name']);
    // $imagePath = "uploads/".basename($_FILES['fileImage']['name']);

    // $tempFile = $_FILES['fileVideo']['tmp_name'];
    // if(!$tempFile){
    //     echo json_encode(array('message'=>"error: plasese upload a file",'status'=>false));
    //     exit();
    // }
    // if(move_uploaded_file($_FILES['fileVideo']['tmp_name'],$videoPath) and move_uploaded_file($_FILES['fileImage']['tmp_name'],$imagePath) ){
    //     echo json_encode(array('message'=>"file uploaded",'status'=>true));
    // }
    // else{
        // echo json_encode(array('message'=>"file faild uploaded",'status'=>false,'body'=>$_FILES,'values'=>$_POST));
    // }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       if(isset($_SESSION['userName'])){
           $current = $_SESSION['userId'];
           if(isset($_FILES['fileVideo']['tmp_name'])){
               
               $file =$_FILES['fileVideo'];
               $thumbnail =$_FILES['fileImage'];   
   
               // print_r($file);
               $file_name = $file['name'];  
               $file_tmp = $file['tmp_name'];
               $file_size = $file['size']; 
               $file_error = $file['error']; 
           
               $thumbnail_name = $thumbnail['name'];
               $thumb_tmp = $thumbnail['tmp_name'];
               $thumb_size = $thumbnail['size'];
               $thumb_error = $thumbnail['error']; 
   
               $title = $_POST["postTitle"];
               $description=$_POST["postDesc"];
               
               $file_ext = explode('.', $file_name);
               $file_ext = strtolower(end($file_ext)); 
   
               $thumb_ext = explode('.', $thumbnail_name);
               $thumb_ext = strtolower(end($thumb_ext));
   
                   if($file_error === 0 and $thumb_error === 0){ 
                           $file_name_new = uniqid('', true) . '.' . $file_ext; 
                           $file_destination = 'uploads/video/' . $file_name_new;
   
                           $thumb_name_new = uniqid('', true) . '.' . $thumb_ext; 
                           $thumb_destination = 'uploads/thumbnail/' . $thumb_name_new;
   
                           if(move_uploaded_file($file_tmp, $file_destination) and move_uploaded_file($thumb_tmp, $thumb_destination)) {
                               // echo $file_destination ." ".$thumb_destination;
                               // $conn->query("insert into follow (u_id,su_id)values($current,$other)");
                               // $conn->query("insert into post (u_id,p_date,p_content,thumnail,p_title,p_discription,approve) values 
                               // ($current,CURDATE(),$file_destination,$thumb_destination,$title,$description,0)");
                               
                               $file_destination = 'api/uploads/video/' . $file_name_new;
                               $thumb_destination = 'api/uploads/thumbnail/' . $thumb_name_new;

                               $conn->query("INSERT INTO post( u_id, p_date, p_content, thumnail, p_title, p_discription, approve) VALUES ($current,CURDATE(),'$file_destination','$thumb_destination','$title','$description',0);");
                               // INSERT INTO post( u_id, p_date, p_content, thumnail, p_title, p_discription, approve) VALUES (1,CURDATE(),"abc post","abc thumbnail","abc title","abc description",0);
                               $response = array('status'=>false,'message'=>"files moved successfully","body"=>null); 
                           }else{
                            //    echo "files not moved";
                               $response = array('status'=>false,'message'=>"files not moved","body"=>null);
                           }
                   }else{
                    //    echo $_FILES['file']['error'];
                       $response = array('status'=>false,'message'=>"file error","body"=>null);
                   } 
           }else{
            //    echo"files are not set";
               $response = array('status'=>false,'message'=>"files are not set","body"=>null);
           }
       }else{
           $response = array('status'=>false,'message'=>"No Session is Set","body"=>null);
       }
   }else{
       $response = array('status'=>false,'message'=>"Invalid Method","body"=>null);
   }
   
   
    echo json_encode($response);
    mysqli_close($conn);
      
?>