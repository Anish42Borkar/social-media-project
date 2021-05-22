<?php
    // echo json_encode($_FILES['fileInput']);
    // $targetPath = "uploads/".basename($_FILES['fileInput']['name']);
    // move_uploaded_file($_FILES['fileInput']['tmp_name'],$targetPath);
    echo '<pre>';
    print_r($_FILES);

    // $response = array();

    function response($input){
        $response = array();
        array_push($response ,array(
            'status'=>$input['status'],
            'message'=>$input['message'],
            'body'=>$input['body']
        ));
        return $response;
    }
    $userPost = array();
    array_push($userPost,array(
        'name'=>'name',
        'post'=>'p_content'
    ));

    $response = array('status'=>true,'message'=>'success','body'=>array('post'=>$userPost,'check'=>true));
    print_r(json_encode($response));
    

?>