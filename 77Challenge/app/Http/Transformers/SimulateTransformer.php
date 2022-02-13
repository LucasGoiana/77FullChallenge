<?php


namespace App\Http\Transformers;


class SimulateTransformer
{
    public function transformer($simulate) {
        $obj = json_decode($simulate);
        $objTransformed = [];
        if (!isset($obj->parcelamento)){
            $mensagem['mensagem'] = 'Valor da Conta ou Tipo de Telhado inválido. Por favor, verifique novamente!';
            $mensagem['error'] = 500;
            return response(json_encode($mensagem), 500);
        }
        foreach($obj->parcelamento as $key => $value){
            $objTransformed['parcelamento'][$key] = $value->parcelas. " X R$ ". number_format($value->valor_minimo, 2, ',', '.') . "\n" ;

        }
        $objTransformed['potencial'] = $obj->potencial;
        $objTransformed['economia'] = $obj->economia;

        header('Content-Type: application/json');
        return json_encode($objTransformed);
    }
}
