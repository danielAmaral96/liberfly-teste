<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Retorna todas as categorias.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Category::all();
    }

    /**
     * Retorna uma categoria pelo ID.
     *
     * @param int $id
     * @return \App\Models\Category|null
     */
    public function getById($id)
    {
        return Category::find($id);
    }

    /**
     * Cria uma nova categoria.
     *
     * @param array $data
     * @return \App\Models\Category
     */
    public function create($data)
    {
        return Category::create($data);
    }

    /**
     * Atualiza uma categoria existente.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Category|null
     */
    public function update($id, $data)
    {
        $category = Category::find($id);
        if (!$category) {
            return null;
        }
        $category->update($data);
        return $category;
    }

    /**
     * Exclui uma categoria.
     *
     * @param int $id
     * @return \App\Models\Category|null
     */
    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return null;
        }
        $category->delete();
        return $category;
    }
}