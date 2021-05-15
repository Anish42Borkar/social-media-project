<?php
    // echo json_encode($_FILES['fileInput']);
    // $targetPath = "uploads/".basename($_FILES['fileInput']['name']);
    // move_uploaded_file($_FILES['fileInput']['tmp_name'],$targetPath);
    echo '<pre>';
    print_r($_FILES);

    $response = array();

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
    $val = array('post'=>$userPost);
    print_r($val);
    echo '<pre>';
    print_r( json_encode(array(array('status'=>false,'message'=>"Record Found","body" =>$val))));
    $v = array('status'=>false,'message'=>"Record Found","body" =>$val);
    echo '<pre>';
    echo json_encode(array('status'=>false,'message'=>"Record Found","body"=>$userPost));
    echo '<pre>';

    $array = array(array('hi'=>'h1','h1'=>'h1'),'hi'=>'ok');
    echo '<pre>';
    print_r(json_encode($v));

?>