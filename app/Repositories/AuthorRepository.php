<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    /**
     * Retorna todos os autores.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Author::all();
    }

    /**
     * Retorna um autor pelo ID.
     *
     * @param int $id
     * @return \App\Models\Author|null
     */
    public function getById($id)
    {
        return Author::find($id);
    }

    /**
     * Cria um novo autor.
     *
     * @param array $data
     * @return \App\Models\Author
     */
    public function create($data)
    {
        return Author::create($data);
    }

    /**
     * Atualiza um autor existente.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Author|null
     */
    public function update($id, $data)
    {
        $author = Author::find($id);
        if (!$author) {
            return null;
        }
        $author->update($data);
        return $author;
    }

    /**
     * Exclui um autor.
     *
     * @param int $id
     * @return \App\Models\Author|null
     */
    public function delete($id)
    {
        $author = Author::find($id);
        if (!$author) {
            return null;
        }
        $author->delete();
        return $author;
    }
}