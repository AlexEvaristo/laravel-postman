<?php
namespace App\Services;

use App\Http\Requests\CadastroProdutoRequest;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\Productcategories;

use function Pest\Laravel\json;
use function PHPUnit\Framework\returnSelf;

/** @package App\Services */
class ProductService {

    protected Products $product;
    // protected CadastroProdutoRequest $cadProdutoRequest;

    public function __construct() {
        $this->product = new Products();
        // $this->cadProdutoRequest = new CadastroProdutoRequest();
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
public function store(array $request)
{
// $data = $request->all();
// $validade = Validator($data, $this->product->rules());
// if( $validade->fails()){
//     $messages =  $validade->getMessageBag();
//     return response()->json(['validate.error', $messages]);


    $insert = $this->product->create($request);

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
    public function update(array $data, string $id)
    {
        //Se  o Produto nao for encontrado.
        $product =  $this->product->find($id);
        if(!$product)
        return response()->json(['error' => 'Produto Não Encontrado']);

        //Se  ocorrer algum erro ao atualizar o Produto.
        $update = $product->update($data);

        $categories = $data['categories'];

        $listar_categorias_enviadas = explode(',', $data['categories']);

        //Método Sync - Sincronizaçao
        //$product->categories()->sync($listar_categorias_enviadas);

        //Método Attach
        //$product->categories()->attach($listar_categorias_enviadas);

        //Método Detach
        $product->categories()->detach($listar_categorias_enviadas);

        if( !$update )
        return response()->json(['error' => 'Produto Não Atualizado', 500]);
        return response()->json(['response' => $update]);

    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function destroy(array $data, $request, int $id)
    {
        //$data = $request->all();
         //Se  o Produto nao for encontrado.
         $product =  $this->product->find($id);
         if(!$product)
         return response()->json(['error' => 'Produto Não Encontrado']);


         $listar_categorias_enviadas = explode(',', $data['categories']);
         //Método Detach
         $product->categories()->detach($listar_categorias_enviadas);

        //Se  ocorrer algum erro ao atualizar o Produto.
        $delete = $product->delete($data);
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