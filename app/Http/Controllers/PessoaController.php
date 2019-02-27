<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * @SWG\Get(
     *   tags={"Pessoa"},
     *   path="/pessoa",
     *   summary="lista de pessoas",
     *   @SWG\Response(
     *     response=200,
     *     description="Lista de pessoas"
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   ),
     * )
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Pessoa::all()], 200);
    }


    /**
     * @SWG\Post(
     *   tags={"Pessoa"},
     *   path="/pessoa",
     *   summary="cadastro de pessoa",
     *   @SWG\Response(
     *     response=200,
     *     description="Cadastrar pessoa"
     *   ),
     *   @SWG\Header(
     *      header="X-RateLimit-Remaining",
     *   ),
     *   @SWG\Response(response="404", description="Resource Not Found"),
     *   @SWG\Response(response="400", description="Bad Request"),
     *   @SWG\Response(response="500", description="Error Request"),
     *   @SWG\Parameter(
     *     name="nome",
     *     description="nome da pessoa",
     *     required=true,
     *     type="string",
     *     in="formData"
     *   ),
     *   @SWG\Parameter(
     *     name="sobrenome",
     *     description="sobrenome da pessoa",
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

        if(empty($arrParams['nome'])) {
            return response()->json(['msg' => 'Por favor, informe o nome'], 404);
        }

        if(empty($arrParams['sobrenome'])) {
            return response()->json(['msg' => 'Por favor, informe o sobrenome'], 404);
        }

        try {
            $pessoa = Pessoa::create($arrParams);
            return response()->json(['data' => $pessoa, 'msg' => 'Pessoa cadastrada com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Erro ao cadastrar pessoa', 'detail' => $e->getMessage()], 500);
        }
    }

    /**
     * @SWG\Get(
     *   tags={"Pessoa"},
     *   path="/pessoa/{id}",
     *   summary="busca uma pessoa",
     *   description="Retorna uma pessoa pelo seu ID",
     *   @SWG\Response(
     *     response=200,
     *     description="Busca uma pessoa"
     *   ),
     *   @SWG\Response(response="404", description="Resource Not Found"),
     *   @SWG\Response(response="400", description="Bad Request"),
     *   @SWG\Parameter(
     *       name="id",
     *       description="ID Pessoa",
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
            return response()->json(['msg' => 'Por favor, informa o ID da pessoa'], 400);
        }

        $pessoa = \App\Pessoa::find($id);

        if(!$pessoa) {
            return response()->json(['msg' => 'Nenhuma pessoa encontrada'], 404);
        }

        return response()->json(['data' => $pessoa], 200);
    }
    /**
     * @SWG\Delete(
     *   tags={"Pessoa"},
     *   path="/pessoa/{id}",
     *   summary="exclui uma pessoa e seus enderecos",
     *   description="Exclui uma pessoa e seus enderecos pelo seu ID",
     *   @SWG\Response(
     *     response=200,
     *     description="Exclui uma pessoa"
     *   ),
     *   @SWG\Response(response="404", description="Resource Not Found"),
     *   @SWG\Response(response="400", description="Bad Request"),
     *   @SWG\Response(response="500", description="Error Request"),
     *   @SWG\Parameter(
     *       name="id",
     *       description="ID Pessoa",
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
            return response()->json(['msg' => 'Por favor, informa o ID da pessoa'], 400);
        }

        $pessoa = Pessoa::find($id);

        if(!$pessoa) {
            return response()->json(['msg' => 'Nenhuma pessoa encontrado'], 404);
        }

        try {
            $enderecos = $this->buscarEnderecosPorIdPessoa($id);
            if($enderecos){
                foreach ($enderecos as $endereco) {
                    Endereco::destroy($endereco->id);
                }
            }
            Pessoa::destroy($id);
            return response()->json(['msg' => 'Excluido com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Erro ao excluir Usuario e seus enderecos', 'detail' => $e->getMessage()], 500);
        }
    }

    /**
     * @SWG\Get(
     *   tags={"Pessoa"},
     *   path="/pessoa/{pessoa_id}/endereco",
     *   summary="busca o endereço de uma pessoa",
     *   description="Retorna um enderecço pelo ID de uma pessoa",
     *   @SWG\Response(
     *     response=200,
     *     description="Busca o endereço de uma pessoa"
     *   ),
     *   @SWG\Response(response="404", description="Resource Not Found"),
     *   @SWG\Response(response="400", description="Bad Request"),
     *   @SWG\Parameter(
     *       name="pessoa_id",
     *       description="ID da Pessoa",
     *       required=true,
     *       type="integer",
     *       in="path"
     *   ),
     * )
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception* @return \Illuminate\Http\Response
     */
    public function enderecoByIdPessoa($idPessoa)
    {
        if(empty($idPessoa)) {
            return response()->json(['msg' => 'Por favor, informa o ID da pessoa'], 400);
        }
        $endereco = $this->buscarEnderecosPorIdPessoa($idPessoa);

        if(count($endereco) == 0) {
            return response()->json(['msg' => 'Nenhum endereço encontrado'], 404);
        }

        return response()->json(['data' => $endereco]);
    }

    /**
     * @param $idPessoa
     * @return mixed
     * Busca todos os enderecos pelo id da pessoa.
     */
    public function buscarEnderecosPorIdPessoa($idPessoa)
    {
        return \App\Endereco::where('pessoa_id', '=', $idPessoa)->get();
    }
}
