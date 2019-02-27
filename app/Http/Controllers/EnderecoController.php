<?php

namespace App\Http\Controllers;

use App\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * @SWG\Get(
     *   tags={"Endereco"},
     *   path="/endereco",
     *   summary="lista de enderecos",
     *   @SWG\Response(
     *     response=200,
     *     description="Lista de enderecos"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Endereco::all()]);
    }

    /**
     * @SWG\Post(
     *   tags={"Endereco"},
     *   path="/endereco",
     *   summary="cadastro de endereco",
     *   @SWG\Response(
     *     response=200,
     *     description="Cadastrar Endereco"
     *   ),
     *   @SWG\Header(
     *      header="X-RateLimit-Remaining",
     *   ),
     *   @SWG\Response(response="404", description="Resource Not Found"),
     *   @SWG\Response(response="400", description="Bad Request"),
     *   @SWG\Response(response="500", description="Error Request"),
     *   @SWG\Parameter(
     *     name="pessoa_id",
     *     description="ID da pessoa",
     *     required=true,
     *     type="integer",
     *     in="formData"
     *   ),
     *   @SWG\Parameter(
     *     name="cep",
     *     description="Cep do endereco",
     *     required=true,
     *     type="integer",
     *     in="formData"
     *   ),
     *   @SWG\Parameter(
     *     name="logradouro",
     *     description="Logradouro do endereco",
     *     required=true,
     *     type="string",
     *     in="formData"
     *   ),
     *   @SWG\Parameter(
     *     name="complemento",
     *     description="Complemento do endereco",
     *     required=false,
     *     type="string",
     *     in="formData"
     *   ),
     *   @SWG\Parameter(
     *     name="bairro",
     *     description="Bairro do endereco",
     *     required=true,
     *     type="string",
     *     in="formData"
     *   ),
     *   @SWG\Parameter(
     *     name="localidade",
     *     description="Localidade do endereco",
     *     required=true,
     *     type="string",
     *     in="formData"
     *   ),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $arrParams = $request->all();

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
     * @SWG\Get(
     *   tags={"Endereco"},
     *   path="/endereco/{id}",
     *   summary="busca um endereco",
     *   description="Retorna uma endereco pelo seu ID",
     *   @SWG\Response(
     *     response=200,
     *     description="Busca uma endereco"
     *   ),
     *   @SWG\Response(response="404", description="Resource Not Found"),
     *   @SWG\Response(response="400", description="Bad Request"),
     *   @SWG\Response(response="500", description="Error Request"),
     *   @SWG\Parameter(
     *       name="id",
     *       description="ID Endereco",
     *       required=true,
     *       type="integer",
     *       in="path"
     *   ),
     * )
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception* @return \Illuminate\Http\Response
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
     * @SWG\Delete(
     *   tags={"Endereco"},
     *   path="/endereco/{id}",
     *   summary="exclui um endereco",
     *   description="Exclui um endereco pelo seu ID",
     *   @SWG\Response(
     *     response=200,
     *     description="Exclui um endereco"
     *   ),
     *   @SWG\Response(response="404", description="Resource Not Found"),
     *   @SWG\Response(response="400", description="Bad Request"),
     *   @SWG\Response(response="500", description="Error Request"),
     *   @SWG\Parameter(
     *       name="id",
     *       description="ID Endereco",
     *       required=true,
     *       type="integer",
     *       in="path"
     *   ),
     * )
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception* @return \Illuminate\Http\Response
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
