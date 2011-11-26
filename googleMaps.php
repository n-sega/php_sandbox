<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
     function initialize() {
     //var latlng = new google.maps.LatLng(35.1118062,139.0868519);
     var latlng = new google.maps.LatLng(35.133,138.9);
     var myOptions = {
     zoom: 14,
     center: latlng,
     mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 }

</script>
</head>
<body onload="initialize()">
  <div id="map_canvas" style="width:100%; height:100%"></div>
</body>
</html>