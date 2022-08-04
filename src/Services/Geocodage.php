<?php

namespace App\Services;

class Geocodage 
{

    //https://packagist.org/packages/opencage/geocode; api : https://opencagedata.com/api

    /**
     * Convert the address in longitude and latitude
     *
     * @param [type] $address
     * 
     * @return void
     */
    public function geocoding ($address){

        $geocoder = new \OpenCage\Geocoder\Geocoder('01534106af904849972628c720331642');

        $result = $geocoder->geocode($address);
        
        //return an array with the latitude and longitude 
        return $result['results'][0]['geometry'];
    }

}

// Array
// (
//     [total_results] => 2
//     [status] => Array
//         (
//             [message] => OK
//             [code] => 200
//         )
//  !   [results] => Array
//         (
//   !          [0] => Array
//                 (
//                     [annotations] => Array
//                         (
//                             [DMS] => Array
//                                 (
//                                     [lat] => 51° 31' 21.60894'' N
//                                     [lng] => 0° 6' 8.95198'' E
//                                 )

//                             [MGRS] => 30UYC0100511930
//                             [Maidenhead] => IO91wm75qk
//                             [Mercator] => Array
//                                 (
//                                     [x] => -11408.763
//                                     [y] => 6680801.955
//                                 )

//                             [OSGB] => Array
//                                 (
//                                     [easting] => 531628.199
//                                     [gridref] => TQ 316 821
//                                     [northing] => 182177.015
//                                 )

//                             [OSM] => Array
//                                 (
//                                     [url] => http://www.openstreetmap.org/?mlat=51.52267&mlon=-0.10249#map=17/51.52267/-0.10249
//                                 )

//                             [callingcode] => 44
//                             [geohash] => gcpvjemm7csmhczg9cvt
//                             [sun] => Array
//                                 (
//                                     [rise] => Array
//                                         (
//                                             [apparent] => 1452931140
//                                             [astronomical] => 1452923940
//                                             [civil] => 1452928800
//                                             [nautical] => 1452926280
//                                         )

//                                     [set] => Array
//                                         (
//                                             [apparent] => 1452961320
//                                             [astronomical] => 1452968520
//                                             [civil] => 1452963660
//                                             [nautical] => 1452966120
//                                         )

//                                 )

//                             [timezone] => Array
//                                 (
//                                     [name] => Europe/London
//                                     [now_in_dst] => 0
//                                     [offset_sec] => 0
//                                     [offset_string] => 0
//                                     [short_name] => GMT
//                                 )

//                             [what3words] => Array
//                                 (
//                                     [words] => gallons.trim.tips
//                                 )

//                         )

//                     [bounds] => Array
//                         (
//                             [northeast] => Array
//                                 (
//                                     [lat] => 51.5227563
//                                     [lng] => -0.1023801
//                                 )

//                             [southwest] => Array
//                                 (
//                                     [lat] => 51.5226042
//                                     [lng] => -0.1025907
//                                 )

//                         )

//                     [components] => Array
//                         (
//                             [city] => London
//                             [country] => United Kingdom
//                             [country_code] => gb
//                             [house_number] => 82
//                             [postcode] => EC1M 5RF
//                             [road] => Clerkenwell Road
//                             [state] => England
//                             [state_district] => Greater London
//                             [suburb] => Clerkenwell
//                         )

//                     [confidence] => 10
//                     [formatted] => 82 Clerkenwell Road, London EC1M 5RF, United Kingdom
//   !                  [geometry] => Array
//                         (
//                             [lat] => 51.52266915
//                             [lng] => -0.10248666188363
//                         )

//                 )

//             [1] => Array
//                 (
//                     [annotations] => Array
//                         (
//                             [DMS] => Array
//                                 (
//                                     [lat] => 51° 30' 30.70800'' N
//                                     [lng] => 0° 7' 32.66400'' E
//                                 )

//                             [MGRS] => 30UXC9945410295
//                             [Maidenhead] => IO91wm42vb
//                             [Mercator] => Array
//                                 (
//                                     [x] => -13997.313
//                                     [y] => 6678279.278
//                                 )

//                             [OSGB] => Array
//                                 (
//                                     [easting] => 530055.544
//                                     [gridref] => TQ 300 805
//                                     [northing] => 180563.298
//                                 )

//                             [OSM] => Array
//                                 (
//                                     [url] => http://www.openstreetmap.org/?mlat=51.50853&mlon=-0.12574#map=17/51.50853/-0.12574
//                                 )

//                             [geohash] => gcpvj0u6yjcmwxz8bn43
//                             [sun] => Array
//                                 (
//                                     [rise] => Array
//                                         (
//                                             [apparent] => 1452931140
//                                             [astronomical] => 1452923940
//                                             [civil] => 1452928800
//                                             [nautical] => 1452926340
//                                         )

//                                     [set] => Array
//                                         (
//                                             [apparent] => 1452961320
//                                             [astronomical] => 1452968520
//                                             [civil] => 1452963660
//                                             [nautical] => 1452966120
//                                         )

//                                 )

//                             [timezone] => Array
//                                 (
//                                     [name] => Europe/London
//                                     [now_in_dst] => 0
//                                     [offset_sec] => 0
//                                     [offset_string] => 0
//                                     [short_name] => GMT
//                                 )

//                             [what3words] => Array
//                                 (
//                                     [words] => thing.then.link
//                                 )

//                         )

//                     [bounds] => Array
//                         (
//                             [northeast] => Array
//                                 (
//                                     [lat] => 51.7202301025
//                                     [lng] => 0.336111992598
//                                 )

//                             [southwest] => Array
//                                 (
//                                     [lat] => 51.2786598206
//                                     [lng] => -0.523222982883
//                                 )

//                         )

//                     [components] => Array
//                         (
//                             [country] => United Kingdom
//                             [county] => Greater London
//                             [state] => England
//                             [town] => London
//                         )

//                     [confidence] => 1
//                     [formatted] => London, Greater London, United Kingdom
//                     [geometry] => Array
//                         (
//                             [lat] => 51.50853
//                             [lng] => -0.12574
//                         )

//                 )

//         )
// )
