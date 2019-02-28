<?php

namespace App\Repositories;

use App\Endereco;
use App\Pessoa;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\EnderecoRepository;

/**
 * @SWG\Definition(definition="Pessoa")
 * @package namespace App\Repositories;
 */
class PessoaRepository extends BaseRepository
{
    /**
     * Nome da pessoa
     * @var string
     * @SWG\Property()
     */
    public $nome;

    /**
     * Sobrenome da pessoa
     * @var string
     * @SWG\Property()
     */
    public $sobrenome;
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Pessoa::class;
    }

    /**
     * @param $arrParams
     * @return \Illuminate\Http\JsonResponse
     */
    public function save($arrParams)
    {
        if(empty($arrParams['nome'])) {
            return response()->json(['msg' => 'Por favor, informe o nome'], 404);
        }

        if(empty($arrParams['sobrenome'])) {
            return response()->json(['msg' => 'Por favor, informe o sobrenome'], 404);
        }

        try {
            $pessoa = Pessoa::create($arrParams);
            if(isset($arrParams['enderecos']) && !empty($arrParams['enderecos'])) {
                $enderecoRepository = new EnderecoRepository($this->app);
                foreach($arrParams['enderecos'] as $endereco){
                    $endereco['pessoa_id'] = $pessoa->id;
                    $enderecoRepository->save($endereco);
                }
            }
            return response()->json(['data' => $pessoa, 'msg' => 'Cadastro realizado com com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Erro ao cadastrar', 'detail' => $e->getMessage()], 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
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
     * @param $idPessoa
     * @return mixed
     * Busca todos os enderecos pelo id da pessoa.
     */
    public function buscarEnderecosPorIdPessoa($idPessoa)
    {
        return \App\Endereco::where('pessoa_id', '=', $idPessoa)->get();
    }

    /**
     * @param $idPessoa
     * @return \Illuminate\Http\JsonResponse
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
}
