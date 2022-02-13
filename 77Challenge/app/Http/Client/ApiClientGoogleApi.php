<?php


namespace App\Http\Client;

use \App\Http\Constants\Constants;
use \Http\Adapter\Guzzle6\Client;
use \Geocoder\Query\GeocodeQuery;
use \Geocoder\Provider\GoogleMaps\GoogleMaps;
use \Geocoder\StatefulGeocoder;


class ApiClientGoogleApi
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
    public function make($data)
    {
        $httpClient = new Client();

        $provider = new GoogleMaps($httpClient, null, 'AIzaSyD26b35IaSn0xrl_UhNex1i2Ez8J37ZJKY');
        $geocoder = new StatefulGeocoder($provider, 'pt-br');
        $result = $geocoder->geocodeQuery(GeocodeQuery::create($data->logradouro.",".$data->bairro.','.$data->localidade.','.$data->uf.','.$data->cep));

        if(count($result) == 0)
            return response('Erro Busca, por favor, informar um CEP diferemte', 500);

        return [
                "latitude" => $result->all()[0]->getCoordinates()->getLatitude(),
                "logintude"=> $result->all()[0]->getCoordinates()->getLongitude()
        ];
    }

}
