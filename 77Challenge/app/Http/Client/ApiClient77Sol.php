<?php


namespace App\Http\Client;


use App\Http\Constants\Constants;

class ApiClient77Sol
{
    /**
     * @var $curl
     */
    private $curl;

    public function __construct(){
        $this->curl = curl_init();
    }

    /**
     * @param array $request
    */
    public function makeSimulate(array $request = [], array $viacep = [] ,array $geoLocation = [])
    {
        $url = $this->buildQuery($request, $viacep ,$geoLocation);
        return $this->curlSet($url);
    }

    /**
     * @param $query
     */

    private function curlSet($query){

        curl_setopt_array($this->curl, array(
            CURLOPT_URL => $query,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($this->curl);

        curl_close($this->curl);

        return $response;

    }

    /**
     * @param $post
     * @return string
     */

    private function buildQuery(array $request = [], $viacep, array $geoLocation = []){

        $query = http_build_query($request).'&'.http_build_query($viacep).'&'.http_build_query($geoLocation);
        return Constants::ENDPOINT_SOL.$query;
    }



}
