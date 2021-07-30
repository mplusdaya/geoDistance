/* geo Distance straigth line */

    $theta = $longitudefrom - $drop_longitude;
    $dist = sin(deg2rad($latitudefrom)) * sin(deg2rad($drop_latitude)) + cos(deg2rad($latitudefrom)) *
    cos(deg2rad($drop_latitude)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $distanceget = $miles * 1.609344;
    $your_distance = round($distanceget);
