<?php

namespace App\Http\Controllers;

use App\Pessoa;
use App\Repositories\EnderecoRepository;
use App\Repositories\PessoaRepository;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * @var PessoaRepository
     */
    protected $pessoaRepository;
    /**
     * @var EnderecoRepository
     */
    protected $enderecoRepository;

    public function __construct(
        PessoaRepository $pessoaRepository,
        EnderecoRepository $enderecoRepository
    ){
        $this->pessoaRepository = $pessoaRepository;
        $this->enderecoRepository = $enderecoRepository;
    }

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
        return $this->pessoaRepository->save($request->all());
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
        return $this->pessoaRepository->show($id);
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
        return $this->pessoaRepository->destroy($id);
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
        return $this->pessoaRepository->enderecoByIdPessoa($idPessoa);
    }


}
