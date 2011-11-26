<?php

if( isset($_POST) ){
    $uid = (double)123456789;
    $body = $_POST['status'];
    $file_bin = "";
    $created_at = (double)date("ymdHis");
    $updated_at = (double)date("ymdHis");

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $pattern = '/(http|https):\/\/([-._a-z\d]+\.[a-z]{2,4})([\w,.:;&=+*%$#!@()~\'\/-]*)\??([\w,.:;&=+*%$#!?@()~\'\/-]*)/';
    $match = array();
    preg_match($pattern, $body, $match);
    if( isset($match) ) {
        $short_url = file_get_contents('http://tinyurl.com/api-create.php?url='.$match[0]);
        $body = str_replace($match[0], $short_url, $body);
    }

    try{
        $m = new Mongo("mongodb://127.0.0.1:27017");
        $db = $m->miniblog;
        $collection = $db->tweet;
        $obj = array( "uid" => $uid, "body"=>$body, "file_bin"=>$file_bin, "created_at"=>$created_at, "updated_at"=>$updated_at);
        $collection->insert($obj,array('safe'=>true));

        if(isset($latitude) && isset($longitude)){
            $collection = $db->places;
            $obj= array( "latitude"=>$latitude, "longtitude"=>$longitude);
            $collection->insert($obj,array('safe'=>true));  
        }

    }catch(MongoCursorException $e) {
        echo  $e->getMessage(), "\n";
        echo "Can't save the same person twice!\n";
    }catch (Exception $e ){
        echo  $e->getMessage(), "\n";
    }

    unset($m);
    unset($db);
    unset($collection);
    unset($obj);

    header("Cache-Control: no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Location: /index.php",TRUE,303);
    exit();
}

function isIncludedUrl($str) {
    if (preg_match('/(https?|http)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $str)) {
        return true;
    } else {
        return false;
    }
}
