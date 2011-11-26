<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>IPアドレスから位置情報を取得</title>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAEIEYZJEcIHoENq1ahrGsFRRo24mv1ViKPr6g41_mP7VmX_bQSBTzwP6LPJF34XNGzvhSJqojBmeM_A"></script>
<script type="text/javascript">
<!--
     google.load("maps", "2", {"language" : "ja_JP"});

function getLocation() {
    // Google API の利用
    var cl = google.loader.ClientLocation;
    var message = "";
    if(cl !== null){
        message = "* 位置情報の取得に成功しました *";
        // HTML表示の更新
        document.getElementById("latitude").innerHTML = cl.latitude;
        document.getElementById("longitude").innerHTML = cl.longitude;
        document.getElementById("country_code").innerHTML = cl.address.country_code;
        document.getElementById("country").innerHTML = cl.address.country;
        document.getElementById("region").innerHTML = cl.address.region;
        document.getElementById("city").innerHTML = cl.address.city;
    }else{
        alert("* 位置情報の取得に失敗しました *");
    }
    document.getElementById("message").innerHTML = message;
}

google.setOnLoadCallback(getLocation); 
//-->
</script>
</head>
<body>
<h2>IPアドレスから位置情報を取得</h2>
Google APIを利用して、IPアドレスから位置情報を取得するサンプルです。<br>
APIの詳細は、 <a href="http://code.google.com/intl/ja/apis/ajax/documentation/">http://code.google.com/intl/ja/apis/ajax/documentation/</a> で確認できます。
<hr>
<div id="message">ネットワークに接続されていないか JavaScript が有効ではありません</div>
<table summary="取得した位置情報">
<tr><td>緯度:</td><td id="latitude">--</td></tr>
    <tr><td>経度:</td><td id="longitude">--</td></tr>
    <tr><td>ISO 3166-1 の国名コード:</td><td id="country_code">--</td></tr>
    <tr><td>国名:</td><td id="country">--</td></tr>
    <tr><td>各国固有の地域名:</td><td id="region">--</td></tr>
    <tr><td>都市名:</td><td id="city">--</td></tr>
</table>
<hr>
</body>
</html>