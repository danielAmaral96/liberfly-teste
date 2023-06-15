<?php

namespace App\Services;

use App\Repositories\AuthorRepository;

class AuthorService
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Retorna todos os autores.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllAuthors()
    {
        return $this->authorRepository->getAll();
    }

    /**
     * Retorna um autor pelo ID.
     *
     * @param int $id
     * @return \App\Models\Author|null
     */
    public function getAuthorById($id)
    {
        return $this->authorRepository->getById($id);
    }

    /**
     * Cria um novo autor.
     *
     * @param array $data
     * @return \App\Models\Author
     */
    public function createAuthor($data)
    {
        return $this->authorRepository->create($data);
    }

    /**
     * Atualiza um autor existente.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Author|null
     */
    public function updateAuthor($id, $data)
    {
        return $this->authorRepository->update($id, $data);
    }

    /**
     * Exclui um autor.
     *
     * @param int $id
     * @return \App\Models\Author|null
     */
    public function deleteAuthor($id)
    {
        return $this->authorRepository->delete($id);
    }
}