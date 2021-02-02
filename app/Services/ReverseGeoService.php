<?php


namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PhpParser\Error;

/**
 * Class reverseGeoService
 * @package App\Services
 */
class reverseGeoService
{
    /**
     * @param float $latitude
     * @param double $loungitude
     * @return mixed
     * @throws GuzzleException
     */
    public function parseAddress(float $latitude, float $loungitude) {
        $client = new Client();
            $res = $client->request('GET', 'https://nominatim.openstreetmap.org/reverse', [
                'query' => [
                    'format' => 'jsonv2',
                    'lat' => $latitude,
                    'lon' => $loungitude
                ]
            ]);

            $finalRes = json_decode($res->getBody())->display_name;
            return $finalRes;
    }

}
