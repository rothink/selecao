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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
