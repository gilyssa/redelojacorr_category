<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name,' . $this->id . '|min:3',
        ];
    }

    public function feedback()
    {
        return
            ['required' => 'O campo name é obrigatório.', 'unique' => 'Categoria já existente.', 'min' => 'O campo name precisa ter no mínimo 3 caracteres'];
    }
}
