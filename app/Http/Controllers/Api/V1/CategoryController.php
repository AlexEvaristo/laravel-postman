<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuscarProdutoRequest;
use App\Http\Requests\AtualizaProdutoRequest;
use App\Http\Requests\CadastroProdutoRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

use function Laravel\Prompts\error;
use function Laravel\Prompts\search;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    private int $totalPage = 5;

    /**
     * @param CategoryService $product 
     * @return void 
     */
    public function __construct(CategoryService $category)
    {
        $this->categoryService = $category;
    }
    /**
     * Exibir todos as Categorias.
     */
    public function index(BuscarProdutoRequest $request)
    {
        //limitando a quantidade de Página que poderão ser abertas
        $categoryService = $this->categoryService->index();
        return response()->json(['data' => $categoryService]);
    }

      /**
     * Armazene um recurso recém-criado.
     */
    public function store(CadastroProdutoRequest $request)
    {
        $categoryService = $this->categoryService->store($request->all());
        return response()->json(['data' => $categoryService]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoryService = $this->categoryService->show($id);
        return response()->json(['data' => $categoryService]);
    }

    /**
     * @param Request $request
     * @param mixed $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function update(AtualizaProdutoRequest $request,  $id)
    {
        $data = $request->all();
        // // Retorna os produtos encontrados
        // return response()->json(['data' => $request]);
        $categoryService = $this->categoryService->update($data, $id);
        return response()->json(['data' => $categoryService]);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function destroy(Request $request, string $id)
    {
        //$data = $request->all();

        $categoryService = $this->categoryService->destroy($id, $request);
        return response()->json(['data' => $categoryService]);;
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

        // $CategoryService = new CategoryService();
        // $products = $CategoryService->search(data: $data, totalPage: $this->totalPage, page: 1);

        // Retorna os produtos encontrados
        return response()->json(['data' => $request]);
    }

}