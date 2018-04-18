<?php
	if(isset($_GET['location']) && !empty($_GET['location'])) {
		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($_GET['location']);

		$maps_json = file_get_contents($url);
		//decode JSON api response into an array -> true means convert into array
		$maps_array = json_decode($maps_json, true);
		//extract coordinates from JSON response
		$lat = $maps_array['results'][0]['geometry']['location']['lat'];
		$lng = $maps_array['results'][0]['geometry']['location']['lng'];
		//INSTAGRAM CLIENT ID
				//cbd5c3dcdb9c42f0b01a6d3154212542
		//prepare call to INSTAGRAM's API:
		$insta_url = 'https://api.instagram.com/v1/media/search?lat='.$lat.'&lng='.$lng.'&client_id=cbd5c3dcdb9c42f0b01a6d3154212542';
		$insta_json = file_get_contents($insta_url);
		$insta_array = json_decode($insta_json, true);
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Geogram</title>
 </head>
 <body>
 <form action="" method="GET">
 	<input type="text" name="location"></input>
 	<button type="submit">SEARCH!</button>
	<br/>
<!-- insert recieved from API data using PHP -->
<?php 

if(!empty($insta_array)) {
	foreach($insta_array['data'] as $image){
		echo '<img src = "'.$image['images']['low_resolution']['url'].'"></img><br/>';
	}
}
	
?>
		
 </form>
 </body>
 </html>