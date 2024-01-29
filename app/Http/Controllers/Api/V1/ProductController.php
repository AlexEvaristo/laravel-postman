<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuscarProdutoRequest;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Services\ProductService;

use function Laravel\Prompts\error;
use function Laravel\Prompts\search;

class ProductController extends Controller
{
    private ProductService $productService;
    private int $totalPage = 5;

    public function __construct(ProductService $product)
    {
        $this->productService = $product;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //limitando a quantidade de Página que poderão ser abertas
        $products = $this->productService->index()->paginate($this->totalPage);
        return response()->json(['data' => $products]);
    }

      /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate =  validator($data, $this->product->rules(''));

        if($validate->fails() )
        {

            $messages = $validate->errors();
            return response()->json(['validate.error', $messages]);
        }

        if ( !$insert = $this->product->create($data) )
            return response()->json(['error' => 'error_insert'], 500);

        return response()->json($insert);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if( !$product = $this->product->find($id))

           return response()->json(['error'=> 'product_not_found']);

        return response()->json(['data' => $product]);
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validaçao
        $data = $request->all();

        $validate =  validator($data, $this->product->rules($id));

        if( $validate->fails() )
        {
            $messages = $validate->errors();
            return response()->json(['validate.error', $messages]);
        }
        //Recuperando o Produto pelo id "se não encontrado retorno a msg"
        if( !$product = $this->product->find($id))
        return response()->json(['error'=> 'product_not_found']);

        //Editar os dados de acordo com a variável data.
        if( !$update = $product->update($data))
            return response()->json(['error'=> 'product_not_update'], 500);
        return response()->json(['response' => $update]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Recuperando o Produto pelo id "se não encontrado retorno a msg"
        if( !$product = $this->product->find($id))
        return response()->json(['error'=> 'product_not_found']);
        //$delete = $product->delete();

        if( !$delete = $product->delete())
        return response()->json(['error'=> 'product_not_delete'], 500);
    return response()->json(['response' => $delete]);
    }

    public function search(BuscarProdutoRequest $request)
    {
        // Obter todos os dados da solicitação
        $data = $request->all();

        // Realiza a busca dos produtos
        // $products = $this->product->search(data: $data, totalPage: $this->totalPage, page: 1);
        
        // $productService = new ProductService();
        // $products = $productService->search(data: $data, totalPage: $this->totalPage, page: 1);



        // Retorna os produtos encontrados
        return response()->json(['data' => $products]);
    }

}