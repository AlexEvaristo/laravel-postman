<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuscarProdutoRequest;
use App\Http\Requests\AtualizaProdutoRequest;
use App\Http\Requests\CadastroProdutoRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

use function Laravel\Prompts\error;
use function Laravel\Prompts\search;

class ProductController extends Controller
{
    private ProductService $productService;
    private int $totalPage = 5;

    /**
     * @param ProductService $product
     * @return void
     */
    public function __construct(ProductService $product)
    {
        $this->productService = $product;
    }
    /**
     * Exibir todos os Produtos.
     */
    public function index(BuscarProdutoRequest $request)
    {
        //limitando a quantidade de Página que poderão ser abertas
        $productService = $this->productService->index();
        return response()->json(['data' => $productService]);
    }

      /**
     * Armazene um recurso recém-criado.
     */
    public function store(CadastroProdutoRequest $request)
    {
        $productService = $this->productService->store($request->all());
        return response()->json(['data' => $productService]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productService = $this->productService->show($id);
        return response()->json(['data' => $productService]);
    }

    /**
     * @param Request $request
     * @param mixed $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function update(AtualizaProdutoRequest $request,  int $id)
    {
        $data = $request->all();
        // // Retorna os produtos encontrados
        // return response()->json(['data' => $request]);
        $productService = $this->productService->update($data, $id);
        return response()->json(['data' => $productService]);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function destroy(int $id)
    {
        $productService = $this->productService->destroy($id);
        return response()->json(['data' => $productService]);;
    }

    /**
     * @param BuscarProdutoRequest $request
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function search(BuscarProdutoRequest $request)
    {
        // Obter todos os dados da solicitação
        $data = $request->all();
        // Realiza a busca dos produtos
        // $products = $this->product->search(data: $data, totalPage: $this->totalPage, page: 1);

        // $productService = new ProductService();
        // $products = $productService->search(data: $data, totalPage: $this->totalPage, page: 1);

        // Retorna os produtos encontrados
        return response()->json(['data' => $request]);
    }

}