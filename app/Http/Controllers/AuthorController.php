<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Retorna todos os autores.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $authors = $this->authorService->getAllAuthors();
        return response()->json($authors);
    }

    /**
     * Retorna um autor pelo ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $author = $this->authorService->getAuthorById($id);
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        return response()->json($author);
    }

    /**
     * Cria um novo autor.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:authors',
        ]);

        $author = $this->authorService->createAuthor($request->all());
        return response()->json($author, 201);
    }

    /**
     * Atualiza um autor existente.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:authors,email,' . $id,
        ]);

        $author = $this->authorService->updateAuthor($id, $request->all());
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        return response()->json($author);
    }

    /**
     * Exclui um autor.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $author = $this->authorService->deleteAuthor($id);
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        return response()->json(['message' => 'Author deleted']);
    }
}
