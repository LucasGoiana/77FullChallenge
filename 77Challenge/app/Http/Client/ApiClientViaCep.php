<?php


namespace App\Http\Client;

use \App\Http\Constants\Constants;
class ApiClientViaCep
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
    public function make($cep)
    {
        $url = $this->buildQuery($cep);
        return json_decode($this->curlSet($url));
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

    private function buildQuery($cep){
        return Constants::VIACEP.str_replace(["-","."], "", $cep )."/json";
    }



}
