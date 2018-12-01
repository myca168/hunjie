<?php
/*
** calulate lat and long based on zip code
*/
class Caclass_Distance {
	public static function GetLatLong($postalcode) {
		
		$zip=str_replace(' ','',$postalcode);
		
		$geocode=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$zip&sensor=false");
		$data= json_decode($geocode);
		
		if ($data && $data->status=="OK") {
			try {
			$lat = $data->results[0]->geometry->location->lat;
			$long = $data->results[0]->geometry->location->lng;
			return array ('lat' => $lat, 'long' => $long );
			} catch ( Exception $ex )
				//	{return array ('lat' => 90, 'long' => 180 );}	
					{return false;}
		} else return false;
	}
}