<?php
namespace App\Services;

use App\Http\Requests\CadastroProdutoRequest;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

use function Pest\Laravel\json;
use function PHPUnit\Framework\returnSelf;

/** @package App\Services */
class ProductService {

    protected Products $product;
    protected CadastroProdutoRequest $cadProdutoRequest;

    public function __construct() {
        $this->product = new Products();
        $this->cadProdutoRequest = new CadastroProdutoRequest();
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index()
    {
        $products =  $this->product->all();
        return response()->json(['data' => $products ]);

    }
/**
 * @param App\Services\Request $request
 * @return void
 */
public function store(Request $request)
{
// $data = $request->all();
// $validade = Validator($data, $this->product->rules());
// if( $validade->fails()){
//     $messages =  $validade->getMessageBag();
//     return response()->json(['validate.error', $messages]);


    $insert = $this->product->create($request->all());

    if(!$insert){
    return response()->json(['error'=> 'Erro ao inserir'], 500);
    }
    return response()->json(['result'=>$insert]);
}

/**
 * @param string $id
 * @return JsonResponse
 * @throws BindingResolutionException
 */
public function show($id)
    {
        $product =  $this->product->find($id);
        if(!$product)
        return response()->json(['error' => 'Produto Não Encontrado']);
        return  response()->json(['data' => $product]);
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
        $product =  $this->product->find($id);
        if(!$product)
        return response()->json(['error' => 'Produto Não Encontrado']);

        //Se  ocorrer algum erro ao atualizar o Produto.
        $update = $product->update($data);
        if( !$update )
        return response()->json(['error' => 'Produto Não Atualizado', 500]);
        return response()->json(['response' => $update]);

    }

    public function destroy($id)
    {
        //$data = $request->all();
         //Se  o Produto nao for encontrado.
         $product =  $this->product->find($id);
         if(!$product)
         return response()->json(['error' => 'Produto Não Encontrado']);

         $delete = $product->delete();

         //Se  ocorrer algum erro ao atualizar o Produto.
        $delete = $product->delete();
        if( !$delete )
        return response()->json(['error' => 'Produto Não Excluído', 500]);
        return response()->json(['response' => $delete]);


    }

    /**
     * Retorna os resultados da busca realizada
     * @param array $data
     * @param int $totalPage
     * @param int $page
     * @return Products[]
     */
    public function search(array $data, int $totalPage, int $page)
    {
        // return $this->where('name', $data['key-search'])
        //                 ->orWhere('description', 'LIKE', "%{$data['key-search']}%")
        //                 ->paginate($totalPage);

        // Forma 2
        return Products::where('name', $data['key-search'])
        ->orWhere('description', 'LIKE', "%{$data['key-search']}%")
        ->paginate($totalPage);

        // Forma 3
        // return self::where('name', $data['key-search'])
        // ->orWhere('description', 'LIKE', "%{$data['key-search']}%")
        // ->paginate($totalPage);
    }
}