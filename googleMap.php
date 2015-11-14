<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
</head> 
<body>
  <div id="map" style="width: 500px; height: 400px;"></div>

  <script type="text/javascript">
    var locations = [
      ['Chipotle - 10% off meal', 38.049170, -78.503690, 10],
      ['Taco Bell - One free burrito', -33.923036, 151.259052, 9],
      ['McDonalds - Free small fries', 38.032854, -78.484963, 8],
      ['Outback Steakhouse - One free non-alcoholic drink', 38.065883, -78.487291, 7],
      ['Christians - Free slice of pizza', 38.030804, -78.482211, 6],
	  ['Boylan Heights - Half off loaded tots or fries', 38.034106, -78.499367, 5],
	  ['Pigeon Hole - Buy one get one free late night breakfast', 38.036055, -78.500198, 4],
	  ['Trinity Irish Pub - Unlimited refills for regular soda', 38.034929, -78.500308, 3],
	  ['Got Dumplings - Free tofu dumplings or bubble tea', 38.034021, -78.499211, 2],
	  ['Cook out - Half off milkshake', 38.054967, -78.496842, 1]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: new google.maps.LatLng(38.04708, -78.49689),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</body>
</html>