<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuscarProdutoRequest;
use App\Http\Requests\AtualizaProdutoRequest;
use App\Http\Requests\BuscarUnityRequest;
use App\Http\Requests\BuscaUnityRequest;
use App\Http\Requests\CadastroProdutoRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use App\Models\Unity;
use App\Services\UnityService;
use App\Services\UnitytServiceService;
use Illuminate\Http\JsonResponse;

use function Laravel\Prompts\error;
use function Laravel\Prompts\search;

class UnityController extends Controller
{
    private UnityService $unityService;
    private int $totalPage = 5;


    /**
     * @param App\Http\Controllers\Api\V1\UnityService $unity
     * @return void
     */
    public function __construct(UnityService $unity)
    {
        $this->unityService = $unity;
    }
    /**
     * Exibir todos os Produtos.
     */
    public function index(BuscarUnityRequest $request)
    {
        //limitando a quantidade de Página que poderão ser abertas
        $unityService = $this->unityService->index();
        return response()->json(['data' => $unityService]);
    }

      /**
     * Armazene um recurso recém-criado.
     */
    public function store(Request $request)
    {
        $unityService = $this->unityService->store($request);
        return response()->json(['data' => $unityService]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unityService = $this->unityService->show($id);
        return response()->json(['data' => $unityService]);
    }

    /**
     * @param Request $request
     * @param mixed $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function update(Request $request,  $id)
    {
        $data = $request->all();
        $unityService = $this->unityService->update($id, $request);
        return response()->json(['data' => $unityService]);
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

        $unityService = $this->unityService->destroy($id, $request);
        return response()->json(['data' => $unityService]);;
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