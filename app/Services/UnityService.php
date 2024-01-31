<?php
namespace App\Services;

use App\Http\Requests\CadastroProdutoRequest;
use App\Models\Products;
use App\Models\Unity;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;


use function Pest\Laravel\json;
use function PHPUnit\Framework\returnSelf;

/** @package App\Services */
class UnityService {

    protected Unity $unity;
    //protected CadastroProdutoRequest $cadProdutoRequest;

    /** @return void  */
    public function __construct() {
        $this->unity = new Unity();
        //$this->cadProdutoRequest = new CadastroProdutoRequest();
    }


    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index()
    {
        $unities =  $this->unity->all();
        return response()->json(['data' => $unities ]);

    }

/**
 * @param Request $request
 * @return JsonResponse
 * @throws BindingResolutionException
 */
public function store(Request $request)
{
// $data = $request->all();
// $validade = Validator($data, $this->product->rules());
// if( $validade->fails()){
//     $messages =  $validade->getMessageBag();
//     return response()->json(['validate.error', $messages]);


    $insert = $this->unity->create($request->all());

    if(!$insert){
    return response()->json(['error'=> 'Erro ao inserir'], 500);
    }
    return response()->json(['result'=>$insert]);
}


/**
 * @param mixed $id
 * @return JsonResponse
 * @throws BindingResolutionException
 */
public function show($id)
    {
        $unity =  $this->unity->find($id);
        if(!$unity)
        return response()->json(['error' => 'Produto Não Encontrado']);
        return  response()->json(['data' => $unity]);
    }


    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function update(Request $request, string $id)
    {
       $data = $request->all();
        //  $validade = Validator($data, $this->product->rules($id));
        //    if( $validade->fails())
        //        $messages =  $validade->getMessageBag();
        //        return response()->json(['validate.error', $messages]);

        //Se  o Produto nao for encontrado.
        $unity =  $this->unity->find($id);
        if(!$unity)
        return response()->json(['error' => 'Unidade Não Encontrado']);

        //Se  ocorrer algum erro ao atualizar o Produto.
        $update = $unity->update($data);
        if( !$update )
        return response()->json(['error' => 'Unidade Não Atualizado', 500]);
        return response()->json(['response' => $update]);

    }

    /**
     * @param mixed $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function destroy($id)
    {
        //$data = $request->all();
         //Se  o Produto nao for encontrado.
         $unity =  $this->unity->find($id);
         if(!$unity)
         return response()->json(['error' => 'Produto Não Encontrado']);

         $delete = $unity->delete();

         //Se  ocorrer algum erro ao atualizar o Produto.
        $delete = $unity->delete();
        if( !$delete )
        return response()->json(['error' => 'Unidade Não Excluído', 500]);
        return response()->json(['response' => $delete]);
    }


    /**
     * @param array $data
     * @param int $totalPage
     * @param int $page
     * @return mixed
     */
    public function search(array $data, int $totalPage, int $page)
    {
        // return $this->where('name', $data['key-search'])
        //                 ->orWhere('description', 'LIKE', "%{$data['key-search']}%")
        //                 ->paginate($totalPage);

        // Forma 2
        return Unity::where('name', $data['key-search'])
        ->orWhere('description', 'LIKE', "%{$data['key-search']}%")
        ->paginate($totalPage);

        // Forma 3
        // return self::where('name', $data['key-search'])
        // ->orWhere('description', 'LIKE', "%{$data['key-search']}%")
        // ->paginate($totalPage);
    }
}