<!DOCTYPE html>
<html>
<head>
<title>つぶやき</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAEIEYZJEcIHoENq1ahrGsFRRo24mv1ViKPr6g41_mP7VmX_bQSBTzwP6LPJF34XNGzvhSJqojBmeM_A"></script>
<script type="text/javascript">
<!--
google.load("maps", "2", {"language" : "ja_JP"});

function doSubmit() {
    var tweet = document.tweet;
    if( tweet.link[0].checked== true){
        var position = getLocation();
        return true;
    }else{
        return true;
    }
}

function getLocation() {
    // Gopogle API の利用
    var cl = google.loader.ClientLocation;
    if(cl !== null){
        //alert( "* 位置情報の取得に成功しました *");
        alert( "緯度："+cl.latitude+"  経度："+cl.longitude);
        //alert( cl.longitude);
        document.tweet.latitude.value = cl.latitude;
        document.tweet.longitude.value = cl.longitude;
        return true;
        // HTML表示の更新
        //document.getElementById("latitude").innerHTML = cl.latitude;
        //document.getElementById("longitude").innerHTML = cl.longitude;
    }else{
        alert("* 位置情報の取得に失敗しました *");
        return false;
    }
}

//google.setOnLoadCallback(getLocation); 
//-->
</script>
</head>
<body>
<form name="tweet" method="post" action="/tweet.php">
<div class="tweet-box condensed">
<div class="tweet-box-title">
<h2>いまどうしてる？</h2>
</div>
 <div class="text-area">
  <div class="text-area-editor twttr-editor">
  <textarea class="twitter-anywhere-tweet-box-editor" name="status" style="width: 482px; height: 36px;"></textarea>
<div>いまいるばしょを・・・
   <label for="link_b1_1"><input type="radio" id="link_b1_1" name="link" value="yes" checked/>おくる</label>
   <label for="link_b1_2"><input type="radio" id="link_b1_2" name="link" value="no" />おくらない</label></div>
  <input type="hidden" name="latitude" value="">
  <input type="hidden" name="longitude" value="">
  </div>
  </div>
 </div>
<input type="submit" value="つぶやく" onClick="doSubmit()">
</form>
<?php

$uid = (double)123456789;
try{
    $m = new Mongo("mongodb://127.0.0.1:27017");
    $collection = $m->miniblog->tweet;
    $cursor = $collection->find(array("uid" => $uid))->sort(array("_id" => -1))->limit(20);

    echo "<hr><table>";
    echo "<tr height=60>";      
    echo "<td colspan=2><strong>タイムライン</strong></td>";
    echo "</tr>";      
    foreach ($cursor as $obj) {
        echo "<tr height=60>";      
        echo "<td width=600>". convertStr($obj["body"]);
        $date = $obj["created_at"];
        $dateFormated = "20".substr($date,0,2)."/".substr($date,2,2)."/" .substr($date,4,2)." ".substr($date,6,2).":".substr($date,8,2) . ":".substr($date,10,2);
        echo "<div><font size='1'>" . $dateFormated . "</font></div></td>";
        echo "</tr>";      
    }
    echo "</table>";
}catch (Exception $e ){
    echo  $e->getMessage(), "\n";
}
unset($m);
unset($collection);
unset($obj);

function convertStr($str){
    $pattern = '/(http|https):\/\/([-._a-z\d]+\.[a-z]{2,4})([\w,.:;&=+*%$#!@()~\'\/-]*)\??([\w,.:;&=+*%$#!?@()~\'\/-]*)/';
    if (preg_match($pattern, $str)) {
        $replace = '<a href="$0">$0</a>';
        $convertedStr = preg_replace($pattern, $replace, $str);
    } else {
        $convertedStr = htmlspecialchars($str, ENT_QUOTES);
    }
    return $convertedStr;
}

?>
</body>
</html>