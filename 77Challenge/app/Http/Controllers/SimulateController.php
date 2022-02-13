<?php

namespace App\Http\Controllers;

use Http\Adapter\Guzzle6\Client;
use Illuminate\Http\Request;
use App\Http\Client\ApiClient77Sol;
use App\Http\Client\ApiClientViaCep;
use App\Http\Client\ApiClientGoogleApi;
use App\Http\Transformers\SimulateTransformer;

class SimulateController extends Controller
{
    /**
     * @var ApiClient77Sol
     */
    private $apiClient77Sol;


    /**
     * @var ApiClienteViaCep
     */
    private $apiClienteViaCep;

    /**
     * @var ApiClientGoogleApi
     */
    private $apiClientGoogleApi;

    /**
     * SimulateController constructor.
     */
    public function __construct()
    {
        $this->apiClient77Sol = new ApiClient77Sol();
        $this->apiClienteViaCep = new ApiClientViaCep();
        $this->apiClientGoogleApi = new ApiClientGoogleApi();
        $this->simulateTransformer = new SimulateTransformer();
    }

    /**
     * @param Request $request
     */
    public function run (Request $request){

       $viacep = $this->apiClienteViaCep->make($request->post('cep'));

       if(is_null($viacep) || isset($viacep->erro)){
            $mensagem['mensagem'] = 'Erro na Busca. Por favor, informar um CEP diferente';
            $mensagem['error'] = 500;
            return response(json_encode($mensagem), 500);
        }

       $googleApi = $this->apiClientGoogleApi->make($viacep);

       $viacepRefactor['cidade'] = $viacep->localidade;
       $viacepRefactor['estado'] = $viacep->uf;

       if(!is_array($googleApi)){
           $mensagem['mensagem'] = 'Erro na Busca. Por favor, informar um CEP diferente';
           $mensagem['error'] = 500;
           return response(json_encode($mensagem), 500);
       }

       $simulate = $this->apiClient77Sol->makeSimulate($request->post(), $viacepRefactor, $googleApi);

       return $this->simulateTransformer->transformer($simulate);
    }

}
