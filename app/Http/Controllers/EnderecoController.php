<?php

namespace App\Http\Controllers;

use App\Repositories\EnderecoRepository;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * @var EnderecoRepository
     */
    protected $enderecoRepository;

    public function __construct(
        EnderecoRepository $enderecoRepository
    ){
        $this->enderecoRepository = $enderecoRepository;
    }

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
        return response()->json(['data' => $this->enderecoRepository->all()], 200);
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
        return $this->enderecoRepository->save($request->all());
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
        return $this->enderecoRepository->show($id);
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
        return $this->enderecoRepository->destroy($id);
    }
}
