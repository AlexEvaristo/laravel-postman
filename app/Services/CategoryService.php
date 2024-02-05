<?php
namespace App\Services;

use App\Http\Requests\CadastroCategoryRequest;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

use function Pest\Laravel\json;
use function PHPUnit\Framework\returnSelf;

/** @package App\Services */
class CategoryService {

    protected Category $category;
    // protected CadastroCategoryRequest $cadCategoryRequest;

    public function __construct() {
        $this->category = new Category();
        // $this->cadCategoryRequest = new CadastroCategoryRequest();
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index()
    {
        $categories =  $this->category->all();
        return response()->json(['data' => $categories ]);

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


    $insert = $this->category->create($request);

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
        $category =  $this->category->find($id);
        if(!$category)
        return response()->json(['error' => 'Produto Não Encontrado']);
        return  response()->json(['data' => $category]);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function update(array $request, string $id)
    {
       $data = $request;
        //  $validade = Validator($data, $this->product->rules($id));
        //    if( $validade->fails())
        //        $messages =  $validade->getMessageBag();
        //        return response()->json(['validate.error', $messages]);

        //Se  o Produto nao for encontrado.
        $category =  $this->category->find($id);
        if(!$category)
        return response()->json(['error' => 'Produto Não Encontrado']);

        //Se  ocorrer algum erro ao atualizar o Produto.
        $update = $category->update($data);
        if( !$update )
        return response()->json(['error' => 'Categoria Não Atualizada', 500]);
        return response()->json(['response' => $update]);

    }

    public function destroy($id)
    {
        //$data = $request->all();
         //Se  o Produto nao for encontrado.
         $category =  $this->category->find($id);
         if(!$category)
         return response()->json(['error' => 'Categoria  Não Encontrado']);

         $delete = $category->delete();

         //Se  ocorrer algum erro ao atualizar a Categoria.
        $delete = $category->delete();
        if( !$delete )
        return response()->json(['error' => 'Categoria Não Excluída', 500]);
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