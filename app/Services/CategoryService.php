<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Retorna todas as categorias.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Retorna uma categoria pelo ID.
     *
     * @param int $id
     * @return \App\Models\Category|null
     */
    public function getCategoryById($id)
    {
        return $this->categoryRepository->getById($id);
    }

    /**
     * Cria uma nova categoria.
     *
     * @param array $data
     * @return \App\Models\Category
     */
    public function createCategory($data)
    {
        return $this->categoryRepository->create($data);
    }

    /**
     * Atualiza uma categoria existente.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Category|null
     */
    public function updateCategory($id, $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    /**
     * Exclui uma categoria.
     *
     * @param int $id
     * @return \App\Models\Category|null
     */
    public function deleteCategory($id)
    {
        return $this->categoryRepository->delete($id);
    }
}