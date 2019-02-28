<?php

namespace App\Repositories;

use App\Endereco;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * @SWG\Definition(definition="Endereco")
 * @package namespace App\Repositories;
 */
class EnderecoRepository extends BaseRepository
{
    /**
     * Cep do endereco
     * @var integer
     * @SWG\Property()
     */
    public $cep;

    /**
     * Logradouro do endereco
     * @var string
     * @SWG\Property()
     */
    public $logradouro;

    /**
     * ID da pessoa
     * @var integer
     * @SWG\Property()
     */
    public $pessoa_id;

    /**
     * Complemento do endereco
     * @var string
     * @SWG\Property()
     */
    public $complemento;

    /**
     * Bairro do endereco
     * @var string
     * @SWG\Property()
     */
    public $bairro;

    /**
     * Localidade do endereco
     * @var string
     * @SWG\Property()
     */
    public $localidade;


    /**
     * @return string
     */
    public function model()
    {
        return Endereco::class;
    }

    /**
     * @param $arrParams
     * @return \Illuminate\Http\JsonResponse
     */
    public function save($arrParams)
    {
        if(empty($arrParams['pessoa_id'])) {
            return response()->json(['msg' => 'Por favor, informe o ID da pessoa'], 404);
        }

        if(empty($arrParams['cep'])) {
            return response()->json(['msg' => 'Por favor, informe o cep'], 404);
        }

        if(empty($arrParams['logradouro'])) {
            return response()->json(['msg' => 'Por favor, informe o logradouro'], 404);
        }

        if(empty($arrParams['bairro'])) {
            return response()->json(['msg' => 'Por favor, informe o bairro'], 404);
        }

        if(empty($arrParams['localidade'])) {
            return response()->json(['msg' => 'Por favor, informe a localidade'], 404);
        }

        try {
            $endereco = Endereco::create($arrParams);
            return response()->json(['data' => $endereco], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Erro ao cadastrar Endereco', 'detail' => $e->getMessage()], 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if(empty($id)) {
            return response()->json(['msg' => 'Por favor, informa o ID do endereco'], 400);
        }
        $endereco = \App\Endereco::find($id);

        if(!$endereco) {
            return response()->json(['msg' => 'Nenhum endereco encontrado'], 404);
        }
        return response()->json(['data' => $endereco], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(empty($id)) {
            return response()->json(['msg' => 'Por favor, informa o ID do endereco'], 400);
        }

        $endereco = Endereco::find($id);

        if(!$endereco) {
            return response()->json(['msg' => 'Nenhum endereco encontrado'], 404);
        }

        try {
            Endereco::destroy($id);
            return response()->json(['msg' => 'Excluido com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Erro ao excluir Endereco', 'detail' => $e->getMessage()], 500);
        }
    }
}
