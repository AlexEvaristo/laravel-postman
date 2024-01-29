<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
    public function rules($id)
    {
        return [
            'name'        => "required|min:3|max:100|unique:products,name,{$id},id",
            'description' => 'required|min:3|max:1500'
        ];
    }

    public function rulesSearch()
    {
        return [
            'key-search' => 'O campo de pesquisa é Obrigatório!.',
        ];
    }

    public function search($data, $totalPage)
    {
        return $this
                        ->paginate($this->totalPage)
                        ->where('name', $data['key-search'])
                        ->orWhere('description', 'LIKE', "%{$data['key-search']}%")
                        ->paginate($totalPage);
    }
}
