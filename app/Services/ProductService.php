<?php
namespace App\Services;

use App\Models\Products;

class ProductService {

    protected Products $product;
    public function __construct() {
        $this->product = new Products();
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